<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
<<<<<<< HEAD
    public function show(Product $product)
    {
        return view('frontend.products.show', compact('product'));
=======
    public function show(int $id, Request $request)
    {
        $hidden = "hidden md:grid";
        $hiddenHeader = "hidden md:grid";
        $bottomNav = "hidden md:grid";
        $product = Product::with('category.parent.parent')->findOrFail($id);
        $relatedProducts = $this->getRelatedProducts($product);
        $breadcrumb = product_breadcrumb($product);
        $defaultCanonical = url(($product->canonical ?? '') . '.html');
        $seo = [
            'title' => system_setting('homepage_title', $product->seo_title ?? $product->name),
            'description' => system_setting('homepage_description', $product->seo_description ?? $product->description),
            'keywords' => system_setting('seo_meta_keyword', $product->seo_keyword ?? $product->name),
            'canonical' => system_setting('seo_meta_canonical', $defaultCanonical),
            'favicon' => system_setting('seo_meta_favicon', $product->image ?? $product->album ?? $product->icon),
        ];
        return view('frontend.product.show', [
            'product' => $product,
            'breadcrumb' => $breadcrumb,
            'relatedProducts' => $relatedProducts,
            'hidden' => $hidden,
            'hiddenHeader' => $hiddenHeader,
            'bottomNav' => $bottomNav,
            'seo' => $seo,
        ]);
    }

    protected function getRelatedProducts(Product $product)
    {
        return Product::where('brand_id', $product->brand_id)->where('id', '!=', $product->id)->where('status', 1)->limit(10)->get();
>>>>>>> hieu/update-feature
    }
}
