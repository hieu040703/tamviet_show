<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function show(int $id, Request $request)
    {
        $product = Product::with('category.parent.parent')->findOrFail($id);
        $relatedProducts = $this->getRelatedProducts($product);
        $breadcrumb = product_breadcrumb($product);

        return view('frontend.product.show', [
            'product' => $product,
            'breadcrumb' => $breadcrumb,
            'relatedProducts' => $relatedProducts,
        ]);
    }

    protected function getRelatedProducts(Product $product)
    {
        return Product::where('brand_id', $product->brand_id)->where('id', '!=', $product->id)->where('status', 1)->limit(10)->get();
    }
}
