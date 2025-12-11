<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

// Models của bạn — đổi namespace nếu khác
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
                return response()->json([
                    'status' => 'error',
                    'message' => 'Keyword empty',
                ], 400);
            }

            // Số lượng tối đa trả về mỗi loại (tùy chỉnh)
            $limit = 6;

            // Tìm sản phẩm
            $products = Product::query()
                ->where(function ($q) use ($keyword) {
                    $q->where('name', 'like', "%{$keyword}%")
                        ->orWhere('sku', 'like', "%{$keyword}%")
                        ->orWhere('slug', 'like', "%" . Str::slug($keyword) . "%");
                })
                ->take($limit)
                ->get()
                ->map(function ($p) {
                    return [
                        'id'    => $p->id,
                        'name'  => $p->name,
                        'url'   => $p->url ?? route('product.show', [$p->id]),
                        'image' => $this->getImageUrl($p),
                    ];
                });

            // Tìm danh mục
            $categories = Category::query()
                ->where('name', 'like', "%{$keyword}%")
                ->take($limit)
                ->get()
                ->map(function ($c) {
                    return [
                        'id'   => $c->id,
                        'name' => $c->name,
                        'url'  => $c->url ?? route('category.show', [$c->id]),
                        'image'=> $this->getImageUrl($c),
                    ];
                });

            // Tìm thương hiệu
            $brands = Brand::query()
                ->where('name', 'like', "%{$keyword}%")
                ->take($limit)
                ->get()
                ->map(function ($b) {
                    return [
                        'id'   => $b->id,
                        'name' => $b->name,
                        'url'  => $b->url ?? route('brand.show', [$b->id]),
                        'image'=> $this->getImageUrl($b),
                    ];
                });

            // Nhóm bài viết (post catalogues)
            $postCatalogues = PostCatalogue::query()
                ->where('name', 'like', "%{$keyword}%")
                ->take($limit)
                ->get()
                ->map(function ($pc) {
                    return [
                        'id'   => $pc->id,
                        'name' => $pc->name,
                        'url'  => $pc->url ?? route('post.catalogue', [$pc->id]),
                        'image'=> $this->getImageUrl($pc),
                    ];
                });

            // Bài viết
            $posts = Post::query()
                ->where(function ($q) use ($keyword) {
                    $q->where('title', 'like', "%{$keyword}%")
                        ->orWhere('excerpt', 'like', "%{$keyword}%")
                        ->orWhere('slug', 'like', "%" . Str::slug($keyword) . "%");
                })
                ->take($limit)
                ->get()
                ->map(function ($post) {
                    return [
                        'id'   => $post->id,
                        'name' => $post->title,
                        'url'  => $post->url ?? route('post.show', [$post->id]),
                        'image'=> $this->getImageUrl($post),
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
        } catch (\Throwable $e) {
            // Ghi log chi tiết để bạn test
            \Log::error('Search API Exception: '.$e->getMessage(), [
                'exception' => get_class($e),
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
                'keyword' => $request->query('keyword'),
            ]);

            // Nếu APP_DEBUG=true trả message lỗi chi tiết, ngược lại trả generic
            $message = config('app.debug') ? $e->getMessage() : 'Internal Server Error';

            return response()->json([
                'status' => 'error',
                'message' => $message,
            ], 500);
        }
    }

    /**
     * Lấy url ảnh phù hợp — thay đổi tùy model/project của bạn.
     */
    protected function getImageUrl($model)
    {
        // Nếu model có field 'image' và là đường dẫn tương đối
        if (isset($model->image) && $model->image) {
            // nếu đã là URL đầy đủ thì trả về luôn
            if (Str::startsWith($model->image, ['http://', 'https://'])) {
                return $model->image;
            }
            // ngược lại ghép base url hoặc storage
            return asset($model->image);
        }

        // Có thể có method helper getFirstMediaUrl (nếu dùng spatie/media-library)
        if (method_exists($model, 'getFirstMediaUrl')) {
            $url = $model->getFirstMediaUrl();
            if ($url) return $url;
        }

        // Fallback: trả null -> frontend sẽ hiển thị placeholder
        return null;
    }
}
