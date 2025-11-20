<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostCatalogue;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class PostCatalogueController extends Controller
{
    protected int $limit = 6;

    public function show(int $id, Request $request)
    {
        $catalogue = $this->getCatalogue($id);
        $posts = $this->getPosts($catalogue, $request);
        $breadcrumb = post_catalogue_breadcrumb($catalogue);
        $postCatalogue = PostCatalogue::query();
        $postCatalogue->orderBy('lft', 'ASC');
        $postCatalogues = $postCatalogue->paginate($this->limit);
        if ($request->ajax()) {
            return $this->ajaxResponse($posts);
        }
        return view('frontend.post_catalogue.show', [
            'catalogue' => $catalogue,
            'breadcrumb' => $breadcrumb,
            'posts' => $posts,
            'postCatalogues' => $postCatalogues,
        ]);
    }

    protected function getCatalogue(int $id): PostCatalogue
    {
        return PostCatalogue::select(
            'id',
            'name',
            'description',
            'icon',
            'lft',
            'rgt',
            'status'
        )
            ->where('status', 1)
            ->findOrFail($id);
    }

    protected function getPosts(PostCatalogue $catalogue, Request $request)
    {
        $query = Post::select(
            'id',
            'name',
            'image',
            'description',
            'canonical',
            'created_at'
        )
            ->where('status', 1)
            ->where('post_catalogue_id', $catalogue->id);
        if ($request->filled('keyword')) {
            $k = $request->keyword;
            $query->where(function (Builder $q) use ($k) {
                $q->where('name', 'like', "%{$k}%")
                    ->orWhere('description', 'like', "%{$k}%");
            });
        }
        return $query->orderByDesc('id')->paginate($this->limit)->appends($request->query());
    }

    protected function ajaxResponse($posts)
    {
        return response()->json([
            'html' => view('frontend.post_catalogue.partials.list', [
                'posts' => $posts,
            ])->render(),
            'hasMore' => $posts->hasMorePages(),
            'nextPage' => $posts->currentPage() + 1,
        ]);
    }
}
