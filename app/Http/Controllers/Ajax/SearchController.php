<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Post;
use App\Models\PostCatalogue;

class SearchController extends Controller
{
    public function ajaxSearch(Request $request)
    {
        $keyword = trim((string)$request->get('keyword', ''));

        if ($keyword === '') {
            return response()->json([
                'status' => 'empty',
                'data' => [],
            ]);
        }
        $limitPerType = 5;
        $suffix = config('apps.general.suffix', '.html');
        $products = Product::query()
            ->select(['id', 'name', 'canonical', 'image'])
            ->where('status', 1)
            ->where('name', 'LIKE', '%' . $keyword . '%')
            ->orderByDesc('id')
            ->limit($limitPerType)
            ->get()
            ->map(function (Product $product) use ($suffix) {
                return [
                    'type' => 'product',
                    'name' => $product->name,
                    'image' => $this->imageUrl($product->image),
                    'url' => $this->canonicalUrl($product->canonical, $suffix),
                ];
            });
        $categories = Category::query()
            ->select(['id', 'name', 'canonical'])
            ->where('status', 1)
            ->where('name', 'LIKE', '%' . $keyword . '%')
            ->orderBy('name')
            ->limit($limitPerType)
            ->get()
            ->map(function (Category $category) use ($suffix) {
                return [
                    'type' => 'category',
                    'name' => $category->name,
                    'image' => null,
                    'url' => $this->canonicalUrl($category->canonical, $suffix),
                ];
            });
        $brands = Brand::query()
            ->select(['id', 'name', 'canonical', 'image'])
            ->where('status', 1)
            ->where('name', 'LIKE', '%' . $keyword . '%')
            ->orderBy('name')
            ->limit($limitPerType)
            ->get()
            ->map(function (Brand $brand) use ($suffix) {
                return [
                    'type' => 'brand',
                    'name' => $brand->name,
                    'image' => $this->imageUrl($brand->image),
                    'url' => $this->canonicalUrl($brand->canonical, $suffix),
                ];
            });
        $postCatalogues = PostCatalogue::query()
            ->select(['id', 'name', 'canonical'])
            ->where('status', 1)
            ->where('name', 'LIKE', '%' . $keyword . '%')
            ->orderBy('name')
            ->limit($limitPerType)
            ->get()
            ->map(function (PostCatalogue $catalogue) use ($suffix) {
                return [
                    'type' => 'post_catalogue',
                    'name' => $catalogue->name,
                    'image' => null,
                    'url' => $this->canonicalUrl($catalogue->canonical, $suffix),
                ];
            });
        $posts = Post::query()
            ->select(['id', 'name', 'canonical'])
            ->where('status', 1)
            ->where('name', 'LIKE', '%' . $keyword . '%')
            ->orderByDesc('id')
            ->limit($limitPerType)
            ->get()
            ->map(function (Post $post) use ($suffix) {
                return [
                    'type' => 'post',
                    'name' => $post->name,
                    'image' => null,
                    'url' => $this->canonicalUrl($post->canonical, $suffix),
                ];
            });
        return response()->json([
            'status' => 'success',
            'data' => [
                'products' => $products,
                'categories' => $categories,
                'brands' => $brands,
                'post_catalogues' => $postCatalogues,
                'posts' => $posts,
            ],
        ]);
    }

    protected function canonicalUrl(?string $canonical, string $suffix): string
    {
        if (empty($canonical)) {
            return '#';
        }
        return '/' . ltrim($canonical, '/') . $suffix;
    }

    protected function imageUrl(?string $path): ?string
    {
        if (empty($path)) {
            return null;
        }
        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }
        return asset($path);
    }
}
