<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class CategoryController extends Controller
{
    protected int $perPage = 20;

    public function show(int $id, Request $request)
    {
        $category = $this->findCategoryWithChildren($id);
        $query = $this->buildFilteredProductsQuery($category, $request);
        [$products, $totalCount, $hasMore] = $this->paginateProducts($query, 0, $this->perPage);
        $brands = $this->getCategoryBrands($category);
        $breadcrumb = category_breadcrumb($category);
        return view('frontend.category.show', [
            'category'   => $category,
            'products'   => $products,
            'brands'     => $brands,
            'breadcrumb' => $breadcrumb,
            'hasMore'    => $hasMore,
            'perPage'    => $this->perPage,
        ]);
    }

    public function filterAjax(int $id, Request $request)
    {
        $category = $this->findCategory($id);
        $limit    = (int) $request->get('limit', $this->perPage);
        $query = $this->buildFilteredProductsQuery($category, $request);
        [$products, $totalCount, $hasMore] = $this->paginateProducts($query, 0, $limit);
        $html = view('frontend.components.product-list', compact('products'))->render();
        return response()->json([
            'html'     => $html,
            'has_more' => $hasMore,
            'limit'    => $limit,
        ]);
    }

    public function loadMore(int $id, Request $request)
    {
        $category = $this->findCategory($id);
        $offset   = (int) $request->get('offset', 0);
        $limit    = (int) $request->get('limit', $this->perPage);
        $query = $this->buildFilteredProductsQuery($category, $request);
        [$products, $totalCount, $hasMore] = $this->paginateProducts($query, $offset, $limit);
        $html = view('frontend.components.product-items', compact('products'))->render();
        return response()->json([
            'html'     => $html,
            'has_more' => $hasMore,
            'offset'   => $offset,
        ]);
    }

    protected function findCategoryWithChildren(int $id): Category
    {
        return Category::with('children')->findOrFail($id);
    }

    protected function findCategory(int $id): Category
    {
        return Category::findOrFail($id);
    }

    protected function getCategoryProductsQuery(Category $category): Builder
    {
        return Product::query()
            ->where('category_id', $category->id)
            ->where('status', 1);
    }

    protected function buildFilteredProductsQuery(Category $category, Request $request): Builder
    {
        $query = $this->getCategoryProductsQuery($category);
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

    protected function getCategoryBrands(Category $category)
    {
        $brandIds = $this->getCategoryProductsQuery($category)->whereNotNull('brand_id')->distinct()->pluck('brand_id');
        if ($brandIds->isEmpty()) {
            return collect();
        }
        return Brand::query()->whereIn('id', $brandIds)->orderBy('name')->get();
    }
    protected function applyFilters(Builder $query, Request $request): Builder
    {
        $brands = (array) $request->input('brands', []);
        $brands = array_filter($brands);
        if (!empty($brands)) {
            $query->whereIn('brand_id', $brands);
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
