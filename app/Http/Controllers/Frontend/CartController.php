<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Cart\AddToCartRequest;
use App\Models\Product;
use App\Models\ProductVariant;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
        // Debug: Log dữ liệu nhận được
        Log::info('=== ADD TO CART REQUEST ===', [
            'product_id' => $request->input('product_id'),
            'variant_id' => $request->input('variant_id'),
            'quantity' => $request->input('quantity'),
            'attributes' => $request->input('attributes'),
            'all_request' => $request->all()
        ]);

        $productId = (int)$request->input('product_id');
        $variantId = $request->input('variant_id');
        $attributes = $request->input('attributes', []);
        $qty = (int)$request->input('quantity', 1);

        if ($qty < 1) $qty = 1;
        if ($qty > 99) $qty = 99;

        // Tìm sản phẩm
        $product = Product::findOrFail($productId);
        $variant = null;
        $price = $product->price ?? 0;
        $image = $product->image;
        $sku = $product->sku ?? '';

        // Xử lý variant nếu có
        if ($variantId) {
            $variant = ProductVariant::find($variantId);
            if ($variant) {
                $price = $variant->price ?? $price;
                $sku = $variant->sku ?? $sku;

                $variantAlbum = json_decode($variant->album, true);
                if (!empty($variantAlbum) && is_array($variantAlbum)) {
                    $image = $variantAlbum[0];
                }
            }
        }

        // Tạo ID cho cart item (bao gồm cả attributes để phân biệt)
        $cartItemId = $this->generateCartItemId($productId, $variantId, $attributes);

        Log::info('Generated Cart Item ID: ' . $cartItemId);

        // Tìm item đã tồn tại trong cart
        $existing = Cart::search(function ($cartItem) use ($cartItemId) {
            return $cartItem->id == $cartItemId;
        });

        if ($existing->isNotEmpty()) {
            // Cập nhật số lượng nếu item đã tồn tại
            $item = $existing->first();
            $newQty = (int)$item->qty + $qty;
            if ($newQty > 99) {
                $newQty = 99;
            }

            Cart::update($item->rowId, $newQty);
            $rowId = $item->rowId;

            Log::info('Updated existing cart item', [
                'row_id' => $rowId,
                'new_qty' => $newQty
            ]);
        } else {
            // Thêm item mới
            $productName = $product->name;

            // Format attributes thành text và thêm vào tên sản phẩm
            if (!empty($attributes)) {
                $attributeText = $this->formatAttributesText($attributes);
                if ($attributeText) {
                    $productName .= ' (' . $attributeText . ')';
                }
                Log::info('Formatted attributes: ' . $attributeText);
            }

            $item = Cart::add([
                'id' => $cartItemId,
                'name' => $productName,
                'qty' => $qty,
                'price' => $price,
                'weight' => 0,
                'options' => [
                    'product_id' => $productId,
                    'variant_id' => $variantId,
                    'attributes' => $attributes, // Lưu attributes đầy đủ
                    'image' => $image,
                    'slug' => $product->canonical,
                    'sku' => $sku,
                ],
            ]);
            $rowId = $item->rowId;

            Log::info('Added new cart item', [
                'row_id' => $rowId,
                'name' => $productName,
                'attributes' => $attributes
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Sản phẩm đã được thêm vào Giỏ hàng',
            'cart_count' => Cart::count(),
            'row_id' => $rowId,
        ]);
    }

    /**
     * Tạo unique ID cho cart item dựa trên product_id, variant_id và attributes
     */
    protected function generateCartItemId($productId, $variantId, $attributes)
    {
        $id = $productId . ($variantId ? '-' . $variantId : '');

        // Thêm attributes vào ID để phân biệt các item có attributes khác nhau
        if (!empty($attributes)) {
            // Sắp xếp attributes theo key để đảm bảo consistency
            ksort($attributes);

            $attrIds = [];
            foreach ($attributes as $catalogueId => $data) {
                if (isset($data['id'])) {
                    $attrIds[] = $catalogueId . ':' . $data['id'];
                }
            }

            if (!empty($attrIds)) {
                $id .= '-' . implode('-', $attrIds);
            }
        }

        return $id;
    }

    /**
     * Format attributes thành text để hiển thị
     */
    protected function formatAttributesText($attributes)
    {
        if (empty($attributes) || !is_array($attributes)) {
            return '';
        }

        $attributeNames = [];

        foreach ($attributes as $catalogueId => $data) {
            if (isset($data['name'])) {
                $attributeNames[] = $data['name'];
            }
        }

        return implode(' - ', $attributeNames);
    }

    public function ajaxUpdate(Request $request)
    {
        $rowId = $request->input('row_id');
        $qty = (int)$request->input('quantity', 1);

        if (!$rowId) {
            return response()->json(['status' => false, 'message' => 'Missing row_id'], 400);
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
            return response()->json(['status' => false, 'message' => 'Missing row_id'], 400);
        }

        Cart::remove($rowId);

        return response()->json([
            'status' => true,
            'cart_count' => Cart::count(),
        ]);
    }

    public function ajaxClear(Request $request)
    {
        Cart::destroy();

        return response()->json([
            'status' => true,
            'message' => 'Đã xoá toàn bộ giỏ hàng',
            'cart_count' => 0,
        ]);
    }
}
