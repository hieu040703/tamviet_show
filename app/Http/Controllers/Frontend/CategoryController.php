<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use function Symfony\Component\String\s;

class CategoryController extends Controller
{
    protected int $perPage = 20;

    public function index(Request $request)
    {
        $hidden = "hidden md:grid";
        $hiddenHeader = "hidden md:grid";
        $title = (object)[
            'name' => 'Danh mục',
        ];
        $categories = Category::with('children')->orderBy('name')->get();
        $query = $this->getAllProductsQuery();
        $query = $this->applyFilters($query, $request);
        [$products, $totalCount, $hasMore] = $this->paginateProducts($query, 0, $this->perPage);
        $brands = Brand::query()->orderBy('name')->get();
        return view('frontend.category.index', [
            'categories' => $categories,
            'products' => $products,
            'brands' => $brands,
            'hasMore' => $hasMore,
            'perPage' => $this->perPage,
            'hidden' => $hidden,
            'hiddenHeader' => $hiddenHeader
        ], compact('title'));
    }

    protected function getAllProductsQuery(): Builder
    {
        return Product::query()->where('status', 1);
    }

    public function filterAjaxAll(Request $request)
    {
        $limit = (int)$request->get('limit', $this->perPage);
        $query = $this->getAllProductsQuery();
        $query = $this->applyFilters($query, $request);

        [$products, $totalCount, $hasMore] = $this->paginateProducts($query, 0, $limit);
        $html = view('frontend.components.product-items', compact('products'))->render();
        return response()->json([
            'html' => $html,
            'has_more' => $hasMore,
            'limit' => $limit,
        ]);
    }


    public function loadMoreAll(Request $request)
    {
        $offset = (int)$request->get('offset', 0);
        $limit = (int)$request->get('limit', $this->perPage);

        $query = $this->getAllProductsQuery();
        $query = $this->applyFilters($query, $request);

        [$products, $totalCount, $hasMore] = $this->paginateProducts($query, $offset, $limit);

        $html = view('frontend.components.product-items', compact('products'))->render();

        return response()->json([
            'html' => $html,
            'has_more' => $hasMore,
            'offset' => $offset,
        ]);
    }

    public function show(int $id, Request $request)
    {
        $hidden = "hidden md:grid";
        $hiddenHeader = "hidden md:grid";
        $category = $this->findCategoryWithChildren($id);
        $query = $this->buildFilteredProductsQuery($category, $request);
        [$products, $totalCount, $hasMore] = $this->paginateProducts($query, 0, $this->perPage);
        $brands = $this->getCategoryBrands($category);
        $breadcrumb = category_breadcrumb($category);
        $defaultCanonical = url(($category->canonical ?? '') . '.html');
        $seo = [
            'title' => system_setting('homepage_title', $category->seo_title ?? $category->name),
            'description' => system_setting('homepage_description', $category->seo_description ?? $category->description),
            'keywords' => system_setting('seo_meta_keyword', $category->seo_keyword ?? $category->name),
            'canonical' => system_setting('seo_meta_canonical', $defaultCanonical),
            'favicon' => system_setting('seo_meta_favicon', $category->icon ?? $category->image),
        ];
        return view('frontend.category.show', [
            'category' => $category,
            'products' => $products,
            'brands' => $brands,
            'breadcrumb' => $breadcrumb,
            'hasMore' => $hasMore,
            'perPage' => $this->perPage,
            'hidden' => $hidden,
            'hiddenHeader' => $hiddenHeader,
            'seo' => $seo,
        ]);
    }

    public function filterAjax(int $id, Request $request)
    {
        $category = $this->findCategory($id);
        $limit = (int)$request->get('limit', $this->perPage);
        $query = $this->buildFilteredProductsQuery($category, $request);
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
        $category = $this->findCategory($id);
        $offset = (int)$request->get('offset', 0);
        $limit = (int)$request->get('limit', $this->perPage);
        $query = $this->buildFilteredProductsQuery($category, $request);
        [$products, $totalCount, $hasMore] = $this->paginateProducts($query, $offset, $limit);
        $html = view('frontend.components.product-items', compact('products'))->render();
        return response()->json([
            'html' => $html,
            'has_more' => $hasMore,
            'offset' => $offset,
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

    protected function paginateProductsByPage(Builder $query, int $page, int $limit): array
    {
        $page = max($page, 1);
        $limit = max($limit, 1);
        $offset = ($page - 1) * $limit;

        return $this->paginateProducts($query, $offset, $limit);
    }

    protected function getCategoryBrands(Category $category)
    {
        $brandIds = $this->getCategoryProductsQuery($category)->whereNotNull('brand_id')->distinct()->pluck('brand_id');
        if ($brandIds->isEmpty()) {
            return collect();
        }
        return Brand::query()
            ->whereIn('id', $brandIds)
            ->orderBy('name')
            ->get();
    }

    protected function applyFilters(Builder $query, Request $request): Builder
    {
        $brandIds = $request->input('brand_ids', $request->input('brands', []));
        $brandIds = array_filter((array)$brandIds);
        if (!empty($brandIds)) {
            $query->whereIn('brand_id', $brandIds);
        }
        $brandKeyword = trim((string)$request->input('brand_keyword', ''));
        if ($brandKeyword !== '') {
            $query->whereHas('brand', function (Builder $q) use ($brandKeyword) {
                $q->where('name', 'LIKE', '%' . $brandKeyword . '%');
            });
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
