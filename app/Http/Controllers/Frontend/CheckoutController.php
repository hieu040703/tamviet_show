<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Frontend\CheckoutContactRequest;
use App\Models\ContactRequest;
use App\Models\ContactRequestItem;
use Cart;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $hidden = "hidden md:grid";
        $hiddenHeader = "hidden md:grid";
        $bottomNav = "hidden md:grid";
        $rowIds = $this->parseRowIds($request);
        if (empty($rowIds)) {
            return redirect()->route('cart.index');
        }
        $items = $this->getCartItemsByRowIds($rowIds);

        if ($items->isEmpty()) {
            return redirect()->route('cart.index');
        }

        return view('frontend.checkout.index', [
            'items' => $items,
            'hidden' => $hidden,
            'hiddenHeader' => $hiddenHeader,
            'bottomNav' => $bottomNav,
        ]);
    }

    public function store(CheckoutContactRequest $request)
    {
        $data = $request->validated();
        $rows = explode(',', $request->input('rows', ''));
        $cartItems = collect(Cart::content())
            ->filter(function ($row) use ($rows) {
                return in_array($row->rowId, $rows, true);
            });
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index');
        }
        $contact = ContactRequest::create([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'note' => $data['note'] ?? null,
            'status' => ContactRequest::STATUS_PENDING,
            'save_info' => !empty($data['save_info']) ? 1 : 0,
            'channel' => 'website',
            'customer_id' => $data['customer_id'],
            'meta' => [
                'ip' => $request->ip(),
            ],
        ]);
        $cartItems->each(function ($item) use ($contact) {
            ContactRequestItem::create([
                'contact_request_id' => $contact->id,
                'product_id' => $item->id,
                'product_name' => $item->name,
                'product_slug' => $item->options->slug ?? '',
                'product_image' => $item->options->image ?? '',
                'qty' => $item->qty,
            ]);
        });
        $cartItems->each(function ($item) {
            Cart::remove($item->rowId);
        });
        return redirect()->route('checkout.success');
    }


    public function success()
    {
        $hiddenHeader = "hidden md:grid";
        return view('frontend.checkout.success', [
            'hiddenHeader' => $hiddenHeader,
        ]);
    }

    protected function parseRowIds(Request $request): array
    {
        $rows = $request->input('rows', '');
        return array_filter(explode(',', $rows));
    }

    protected function getCartItemsByRowIds(array $rowIds)
    {
        return collect(Cart::content())
            ->filter(function ($row) use ($rowIds) {
                return in_array($row->rowId, $rowIds, true);
            });
    }
}
