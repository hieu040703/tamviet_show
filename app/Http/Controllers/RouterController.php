<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class RouterController extends Controller
{
    protected function buildCategoryProductQuery(Category $category, Request $request)
    {
        $query = Product::query()->where('status', 1)->where('category_id', $category->id);
        $brandIds = $request->input('brands', []);
        if (!empty($brandIds) && is_array($brandIds)) {
            $query->whereIn('brand_id', $brandIds);
        }
        switch ($request->input('sort')) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;

            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            default:
                $query->orderByDesc('id');
        }
        return $query->select([
            'id', 'name', 'image', 'price', 'category_id', 'brand_id', 'status',
        ]);
    }

    protected function renderCategory(int $id, Request $request)
    {
        $category = Category::with('children')->findOrFail($id);
        $products = $this->buildCategoryProductQuery($category, $request)->paginate(24)->withQueryString();
        $breadcrumb = build_breadcrumb([
            ['title' => $category->name, 'url' => null],
        ]);
        return view('frontend.category.show', compact(
            'category',
            'products',
            'breadcrumb'
        ));
    }

    public function filterAjax(int $id, Request $request)
    {
        $category = Category::findOrFail($id);

        $products = $this->buildCategoryProductQuery($category, $request)->paginate(24)->withQueryString();
        $html = view('frontend.category.partials.product-list', compact('products'))->render();
        $pagination = $products->links()->toHtml();
        return response()->json([
            'html' => $html,
            'pagination' => $pagination,
        ]);
    }
}
