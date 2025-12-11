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
        $hidden = "hidden md:grid";
        $hiddenHeader = "hidden md:grid";
        $catalogue = $this->getCatalogue($id);
        $posts = $this->getPosts($catalogue, $request);
        $breadcrumb = post_catalogue_breadcrumb($catalogue);
        $postCatalogue = PostCatalogue::query();
        $postCatalogue->orderBy('lft', 'ASC');
        $postCatalogues = $postCatalogue->paginate($this->limit);
        if ($request->ajax()) {
            return $this->ajaxResponse($posts);
        }
        $defaultCanonical = url(($catalogue->canonical ?? '') . '.html');
        $seo = [
            'title' => system_setting('homepage_title', $catalogue->seo_title ?? $catalogue->name),
            'description' => system_setting('homepage_description', $catalogue->seo_description ?? $catalogue->description),
            'keywords' => system_setting('seo_meta_keyword', $catalogue->seo_keyword ?? $catalogue->name),
            'canonical' => system_setting('seo_meta_canonical', $defaultCanonical),
            'favicon' => system_setting('seo_meta_favicon', $catalogue->icon ?? $catalogue->image),
        ];
        return view('frontend.post_catalogue.show', [
            'catalogue' => $catalogue,
            'breadcrumb' => $breadcrumb,
            'posts' => $posts,
            'postCatalogues' => $postCatalogues,
            'hiddenHeader' => $hiddenHeader,
            'hidden' => $hidden,
            'seo' => $seo,
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
        return $query->orderByRaw('COALESCE(published_at, created_at) DESC')->paginate($this->limit)->appends($request->query());
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
