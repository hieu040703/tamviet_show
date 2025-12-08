<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    protected int $perPage = 20;

    public function show(int $id, Request $request)
    {
        $hidden = "hidden md:grid";
        $hiddenHeader = "hidden md:grid";
        $shadowYPlus = "shadow-yPlus";
        $brand = $this->findBrand($id);
        $query = $this->buildFilteredProductsQuery($brand, $request);
        [$products, $totalCount, $hasMore] = $this->paginateProducts($query, 0, $this->perPage);
        $categories = $this->getBrandCategories($brand);
        $breadcrumb = build_breadcrumb([
            ['title' => $brand->name, 'url' => null],
        ]);
        $defaultCanonical = url(($brand->canonical ?? '') . '.html');
        $seo = [
            'title' => system_setting('homepage_title', $brand->seo_title ?? $brand->name),
            'description' => system_setting('homepage_description', $brand->seo_description ?? $brand->description),
            'keywords' => system_setting('seo_meta_keyword', $brand->seo_keyword ?? $brand->name),
            'canonical' => system_setting('seo_meta_canonical', $defaultCanonical),
            'favicon' => system_setting('seo_meta_favicon', $brand->icon ?? $brand->image),
        ];
        return view('frontend.brand.show', [
            'brand' => $brand,
            'products' => $products,
            'categories' => $categories,
            'breadcrumb' => $breadcrumb,
            'hasMore' => $hasMore,
            'perPage' => $this->perPage,
            'hiddenHeader' => $hiddenHeader,
            'hidden' => $hidden,
            'shadowYPlus' => $shadowYPlus,
            'seo' => $seo,
        ]);
    }

    public function filterAjax(int $id, Request $request)
    {
        $brand = $this->findBrand($id);
        $limit = (int)$request->get('limit', $this->perPage);
        $query = $this->buildFilteredProductsQuery($brand, $request);
        [$products, $totalCount, $hasMore] = $this->paginateProducts($query, 0, $limit);
        $html = view('frontend.components.product-list', compact('products'))->render();
        return response()->json([
            'html' => $html,
            'has_more' => $hasMore,
            'limit' => $limit,
        ]);
    }

    public function loadMore(int $id, Request $request)
    {
        $brand = $this->findBrand($id);
        $offset = (int)$request->get('offset', 0);
        $limit = (int)$request->get('limit', $this->perPage);
        $query = $this->buildFilteredProductsQuery($brand, $request);
        [$products, $totalCount, $hasMore] = $this->paginateProducts($query, $offset, $limit);
        $html = view('frontend.components.product-items', compact('products'))->render();
        return response()->json([
            'html' => $html,
            'has_more' => $hasMore,
            'offset' => $offset,
        ]);
    }

    protected function findBrand(int $id): Brand
    {
        return Brand::findOrFail($id);
    }

    protected function getBrandProductsQuery(Brand $brand): Builder
    {
        return Product::query()
            ->where('brand_id', $brand->id)
            ->where('status', 1);
    }

    protected function buildFilteredProductsQuery(Brand $brand, Request $request): Builder
    {
        $query = $this->getBrandProductsQuery($brand);
        return $this->applyFilters($query, $request);
    }

    protected function paginateProducts(Builder $query, int $offset, int $limit): array
    {
        $countQuery = clone $query;
        $totalCount = $countQuery->count();
        $products = $query->skip($offset)->take($limit)->get();
        $hasMore = ($offset + $products->count()) < $totalCount;
        return [$products, $totalCount, $hasMore];
    }

    protected function getBrandCategories(Brand $brand)
    {
        $categoryIds = $this->getBrandProductsQuery($brand)->whereNotNull('category_id')->distinct()->pluck('category_id');
        if ($categoryIds->isEmpty()) {
            return collect();
        }
        return Category::query()->whereIn('id', $categoryIds)->get();
    }

    protected function applyFilters(Builder $query, Request $request): Builder
    {
        $categories = (array)$request->input('categories', []);
        $categories = array_filter($categories);
        if (!empty($categories)) {
            $query->whereIn('category_id', $categories);
        }
        $sort = $request->get('sort', 'name_asc');
        if ($sort === 'name_desc') {
            $query->orderByDesc('name');
        } else {
            $query->orderBy('name');
        }
        return $query;
    }
}
