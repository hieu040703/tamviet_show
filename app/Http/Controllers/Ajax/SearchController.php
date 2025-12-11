<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\PostCatalogue;
use App\Models\Post;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        try {
            $keyword = trim($request->query('keyword', ''));
            if ($keyword === '') {
                return response()->json(['status' => 'error', 'message' => 'Vui lòng nhập từ khóa tìm kiếm'], 400);
            }

            $limit = 6;

            $products = $this->queryModel(Product::class, $keyword, $limit);
            $categories = $this->queryModel(Category::class, $keyword, $limit);
            $brands = $this->queryModel(Brand::class, $keyword, $limit);
            $postCatalogues = $this->queryModel(PostCatalogue::class, $keyword, $limit);
            $posts = $this->queryModel(Post::class, $keyword, $limit);

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
        } catch (\Throwable $e) {
            \Log::error('Search API Exception: '.$e->getMessage(), [
                'exception' => get_class($e),
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
                'keyword' => $request->query('keyword'),
            ]);
            $msg = config('app.debug') ? $e->getMessage() : 'Lỗi hệ thống, vui lòng thử lại sau';
            return response()->json(['status' => 'error', 'message' => $msg], 500);
        }
    }

    protected function queryModel($modelClass, $keyword, $limit)
    {
        return $modelClass::query()
            ->where(function ($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%")
                    ->orWhere('canonical', 'like', "%{$keyword}%");
            })
            ->take($limit)
            ->get()
            ->map(fn($m) => $this->buildResult($m));
    }

    protected function buildResult($model)
    {
        return [
            'id' => $model->id,
            'name' => $model->name,
            'url' => $this->safeRoute($this->detectRoute($model), [$model->id]) ?? ($model->url ?? null),
            'canonical' => $this->buildCanonical($model),
            'image' => $this->getImageUrl($model),
        ];
    }

    protected function detectRoute($model)
    {
        if ($model instanceof Product) return 'product.show';
        if ($model instanceof Category) return 'category.show';
        if ($model instanceof Brand) return 'brand.show';
        if ($model instanceof PostCatalogue) return 'post.catalogue';
        if ($model instanceof Post) return 'post.show';
        return null;
    }

    protected function buildCanonical($model)
    {
        if (isset($model->canonical) && $model->canonical) {
            $c = $model->canonical;
            $c = preg_replace('#(^https?://[^/]+)#i', '', $c);
            $c = '/' . ltrim($c, '/');
            $c = preg_replace('/\.html$/i', '', $c);
            return $c;
        }

        if (isset($model->name) && $model->name) {
            $s = Str::slug($model->name);
        } else {
            $s = 'item-' . ($model->id ?? time());
        }

        $s = '/' . ltrim($s, '/');
        $s = preg_replace('/\.html$/i', '', $s);
        return $s;
    }

    protected function getImageUrl($model)
    {
        if (isset($model->image) && $model->image) {
            if (Str::startsWith($model->image, ['http://', 'https://'])) {
                return $model->image;
            }
            $path = ltrim($model->image, '/');
            if (!Str::startsWith($path, 'storage/')) {
                $path = 'storage/' . $path;
            }
            return asset($path);
        }

        if (method_exists($model, 'getFirstMediaUrl')) {
            $url = $model->getFirstMediaUrl();
            if ($url) return $url;
        }

        return null;
    }

    protected function safeRoute($name, $params = [])
    {
        if (!$name || !Route::has($name)) {
            return null;
        }
        try {
            return route($name, $params);
        } catch (\Throwable $e) {
            \Log::warning('safeRoute failed for '.$name, ['message'=>$e->getMessage()]);
            return null;
        }
    }
}
