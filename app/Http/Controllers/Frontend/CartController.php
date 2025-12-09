<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Cart\AddToCartRequest;
use App\Models\Product;
use Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $hidden = "hidden md:grid";
        $hiddenHeader = "hidden md:grid";
        $bottomNav = "hidden md:grid";
        return view('frontend.cart.index', [
            'hidden' => $hidden,
            'hiddenHeader' => $hiddenHeader,
            'bottomNav' => $bottomNav,
        ]);
    }

    public function ajaxAdd(AddToCartRequest $request)
    {
        $productId = (int)$request->input('product_id');
        $qty = (int)$request->input('quantity', 1);
        if ($qty < 1) $qty = 1;
        if ($qty > 99) $qty = 99;

        $product = Product::findOrFail($productId);

        $existing = Cart::search(function ($cartItem) use ($productId) {
            return $cartItem->id == $productId;
        });

        if ($existing->isNotEmpty()) {
            $item = $existing->first();
            $newQty = (int)$item->qty + $qty;
            if ($newQty > 99) {
                $newQty = 99;
            }

            Cart::update($item->rowId, $newQty);
            $rowId = $item->rowId;
        } else {
            $item = Cart::add([
                'id' => $product->id,
                'name' => $product->name,
                'qty' => $qty,
                'price' => 0,
                'weight' => 0,
                'options' => [
                    'image' => $product->image,
                    'slug' => $product->canonical,
                ],
            ]);
            $rowId = $item->rowId;
        }

        return response()->json([
            'status' => true,
            'message' => 'Sản phẩm đã được thêm vào Giỏ hàng',
            'cart_count' => Cart::count(),
            'row_id' => $rowId,
        ]);
    }


    public function ajaxUpdate(Request $request)
    {
        $rowId = $request->input('row_id');
        $qty = (int)$request->input('quantity', 1);
        if (!$rowId) {
            return response()->json(['status' => false], 400);
        }
        if ($qty < 1) {
            $qty = 1;
        }
        if ($qty > 99) {
            $qty = 99;
        }
        Cart::update($rowId, $qty);
        return response()->json([
            'status' => true,
            'cart_count' => Cart::count(),
        ]);
    }

    public function ajaxRemove(Request $request)
    {
        $rowId = $request->input('row_id');
        if (!$rowId) {
            return response()->json(['status' => false], 400);
        }
        Cart::remove($rowId);
        return response()->json([
            'status' => true,
            'cart_count' => Cart::count(),
        ]);
    }

    public function ajaxClear(Request $request)
    {
        \Cart::destroy();
        return response()->json([
            'status' => true,
            'message' => 'Đã xoá toàn bộ giỏ hàng',
            'cart_count' => 0,
        ]);
    }

}
