<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\System;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\AttributeCatalogue;
use App\Models\Attribute;

class ProductController extends Controller
{
    public function show(int $id, Request $request)
    {
        $hidden = "hidden md:grid";
        $hiddenHeader = "hidden md:grid";
        $bottomNav = "hidden md:grid";
        $product = Product::with([
            'category.parent.parent',
            'brand',
            'product_variants'
        ])->findOrFail($id);
        $relatedProducts = $this->getRelatedProducts($product);
        $breadcrumb = product_breadcrumb($product);
        $attributes = $this->getProductAttributes($product);
        $variantsData = $this->getProductVariantsData($product);
        $system = System::all()->keyBy('keyword');
        $defaultCanonical = url(($product->canonical ?? '') . '.html');
        $seo = [
            'title' => $product->seo_title ?? $product->name ?? ($system['seo_meta_title']->content ?? 'Trà lành'),
            'description' => $product->seo_description ?? ($system['seo_meta_description']->content ?? 'Mô tả website của bạn'),
            'keywords' => $product->seo_keyword ?? $product->name ?? ($system['seo_meta_keyword']->content ?? ''),
            'canonical' => $product->canonical ? url($product->canonical . '.html') : ($system['seo_meta_canonical']->content ?? $defaultCanonical),
            'favicon' => $product->image
                ?? ($product->album[0] ?? null)
                    ?? ($system['homepage_favicon']->content ?? asset('backend/img/not-found.jpg')),
        ];

        return view('frontend.product.show', [
            'product' => $product,
            'breadcrumb' => $breadcrumb,
            'relatedProducts' => $relatedProducts,
            'attributes' => $attributes,
            'variantsData' => $variantsData,
            'hidden' => $hidden,
            'hiddenHeader' => $hiddenHeader,
            'bottomNav' => $bottomNav,
            'seo' => $seo,
        ]);
    }

    protected function getRelatedProducts(Product $product)
    {
        return Product::where('brand_id', $product->brand_id)
            ->where('id', '!=', $product->id)
            ->where('status', 1)
            ->limit(10)
            ->get();
    }

    protected function getProductAttributes(Product $product)
    {
        $productAttributes = json_decode($product->attribute, true) ?? [];

        if (empty($productAttributes)) {
            return [];
        }

        $attributes = [];
        foreach ($productAttributes as $catalogueId => $attributeIds) {
            $catalogue = AttributeCatalogue::find($catalogueId);

            if (!$catalogue) {
                continue;
            }

            $catalogueAttributes = Attribute::whereIn('id', $attributeIds)
                ->orderBy('id')
                ->get();

            if ($catalogueAttributes->isEmpty()) {
                continue;
            }

            $attributes[] = [
                'catalogue_id' => $catalogueId,
                'catalogue_name' => $catalogue->name,
                'values' => $catalogueAttributes
            ];
        }

        return $attributes;
    }

    protected function getProductVariantsData(Product $product)
    {
        $variantsData = [];

        if (!$product->product_variants || $product->product_variants->isEmpty()) {
            return $variantsData;
        }
        foreach ($product->product_variants as $variant) {
            $album = [];
            if (!empty($variant->album)) {
                $decoded = json_decode($variant->album, true);
                $album = is_array($decoded) ? $decoded : [];
            }
            $attributeValues = [];
            if (!empty($variant->attribute)) {
                $decoded = json_decode($variant->attribute, true);
                $attributeValues = is_array($decoded) ? $decoded : [];
            }

            $variantsData[] = [
                'id' => $variant->id,
                'attribute_values' => $attributeValues,
                'album' => $album,
                'sku' => $variant->sku ?? '',
                'price' => $variant->price ?? 0,
                'quantity' => $variant->quantity ?? 0,
            ];
        }

        return $variantsData;
    }
}
