<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show(int $id, Request $request)
    {
        $post = $this->findPost($id);
        $breadcrumb = $this->getBreadcrumb($post);
        $relatedPosts = $this->getRelatedPosts($post, 6);

        return view('frontend.post.show', [
            'post' => $post,
            'breadcrumb' => $breadcrumb,
            'relatedPosts' => $relatedPosts,
        ]);
    }

    protected function findPost(int $id): Post
    {
        return Post::with('catalogue')
            ->select('id', 'name', 'image', 'description', 'content', 'canonical', 'post_catalogue_id', 'created_at')
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
            ->orderByDesc('id')
            ->limit($limit)
            ->get();
    }
}
