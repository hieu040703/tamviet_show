<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show(int $id, Request $request)
    {
        $hidden = "hidden md:grid";
        $hiddenHeader = "hidden md:grid";
        $post = $this->findPost($id);
        $breadcrumb = $this->getBreadcrumb($post);
        $relatedPosts = $this->getRelatedPosts($post, 6);
        $defaultCanonical = url(($post->canonical ?? '') . '.html');
        $seo = [
            'title' => system_setting('homepage_title', $post->seo_title ?? $post->name),
            'description' => system_setting('homepage_description', $post->seo_description ?? $post->description),
            'keywords' => system_setting('seo_meta_keyword', $post->seo_keyword ?? $post->name),
            'canonical' => system_setting('seo_meta_canonical', $defaultCanonical),
            'favicon' => system_setting('seo_meta_favicon', $post->image ?? $post->icon),
        ];
        return view('frontend.post.show', [
            'post' => $post,
            'breadcrumb' => $breadcrumb,
            'relatedPosts' => $relatedPosts,
            'hiddenHeader' => $hiddenHeader,
            'hidden' => $hidden,
            'seo' => $seo,
        ]);
    }

    protected function findPost(int $id): Post
    {
        return Post::with('catalogue')
            ->select('id', 'name', 'image', 'description', 'content', 'canonical', 'post_catalogue_id', 'created_at','published_at')
            ->findOrFail($id);
    }

    protected function getBreadcrumb(Post $post): array
    {
        return post_breadcrumb($post);
    }

    protected function getRelatedPosts(Post $post, int $limit = 6)
    {
        return Post::select('id', 'name', 'image', 'canonical', 'description', 'post_catalogue_id')
            ->where('status', 1)
            ->where('post_catalogue_id', $post->post_catalogue_id)
            ->where('id', '!=', $post->id)
            ->orderByRaw('COALESCE(published_at, created_at) DESC')
            ->limit($limit)
            ->get();
    }
}
