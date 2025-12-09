<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostCatalogue;
use App\Models\Router;
use Illuminate\Http\Request;

class RouterController extends Controller
{
    public function handle(Request $request, string $canonical)
    {
        $router = Router::where('canonical', $canonical)->firstOrFail();

        switch ($router->module) {
            case 'categories':
                return app(CategoryController::class)->show($router->object_id, $request);

            case 'products':
                return app(ProductController::class)->show($router->object_id, $request);

            case 'brands':
                return app(BrandController::class)->show($router->object_id, $request);

            case 'posts':
                return app(PostController::class)->show($router->object_id, $request);

            case 'post_catalogue':
                return app(PostCatalogueController::class)->show($router->object_id, $request);

            default:
                abort(404);
        }
    }

    protected function renderPostCategory(int $id, Request $request)
    {
        $postCatalogue = PostCatalogue::findOrFail($id);
        $posts = Post::where('post_catalogue_id', $postCatalogue->id)
            ->where('status', 1)
            ->paginate(24);

        return view('frontend.post.catalogue.show', [
            'postCatalogue' => $postCatalogue,
            'posts' => $posts,
        ]);
    }

    public function renderPost(int $id, Request $request)
    {
        $post = Post::findOrFail($id);

        return view('frontend.post.show', [
            'post' => $post,
        ]);
    }
}
