<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\RouterHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PostCatalogue;
use App\Http\Controllers\Traits\HandlesUploads;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\PostRequest;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    use HandlesUploads;

    protected int $limit = 15;

    public function index(Request $request)
    {
        $data['sidebar'] = 'Post';
        $data['sidebar_child'] = 'Post';
        $data['title'] = 'Danh Sách Bài Viết';
        $data['breadcrumb'] = [
            ['route' => 'admin.posts.index', 'name' => 'Danh Sách Bài Viết'],
        ];
        $posts = Post::query()->with('catalogue');
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $posts->where(function ($q) use ($keyword) {
                $q->where('name', 'like', '%' . $keyword . '%');
            });
        }
        $posts->orderByDesc('id');
        $data['posts'] = $posts->paginate($this->limit);
        $data['model'] = 'Post';
        return view('backend.post.index', $data);
    }

    public function create()
    {
        $data['sidebar'] = 'Post';
        $data['sidebar_child'] = 'Post';
        $data['title'] = 'Thêm Mới Bài Viết';
        $data['breadcrumb'] = [
            ['route' => 'admin.posts.index', 'name' => 'Danh Sách Bài Viết'],
            ['route' => 'admin.posts.create', 'name' => 'Thêm Mới Bài Viết'],
        ];
        $data['catalogues'] = PostCatalogue::orderBy('name')->get();
<<<<<<< HEAD
=======
        $data['model'] = 'Post';
>>>>>>> hieu/update-feature
        return view('backend.post.form', $data);
    }

    public function store(PostRequest $request)
    {
        try {
            $data = $request->validated();
            $data['user_id'] = Auth::id();
            $this->handleUploads($request, $data, 'posts');
<<<<<<< HEAD
=======
            $this->handleUploads($request, $data, 'posts', null, 'icon');
>>>>>>> hieu/update-feature
            $posts = Post::create($data);
            RouterHelper::sync('posts', $posts->id, $data['canonical'] ?? null, $posts->name);
            return redirect()->route('admin.posts.index')->with('success', 'Tạo bài viết thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Không thêm được bài viết' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $data['sidebar'] = 'Post';
        $data['sidebar_child'] = 'Post';
        $data['title'] = 'Sửa Sbài viết';
        $data['post'] = Post::findOrFail($id);
        $data['id'] = $id;
        $data['catalogues'] = PostCatalogue::orderBy('name')->get();
<<<<<<< HEAD
=======
        $data['model'] = 'Post';
>>>>>>> hieu/update-feature
        return view('backend.post.form', $data);
    }

    public function update(PostRequest $request, $id)
    {
        try {
            $post = Post::findOrFail($id);
            $data = $request->validated();
            $data['user_id'] = Auth::id();
            $this->handleUploads($request, $data, 'posts', $post);
<<<<<<< HEAD
=======
            $this->handleUploads($request, $data, 'posts', $post, 'icon');
>>>>>>> hieu/update-feature
            $post->update($data);
            RouterHelper::sync('posts', $post->id, $data['canonical'] ?? null, $post->name);
            return redirect()->route('admin.posts.index')->with('success', 'Cập nhật  bài viết thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Không cập nhật được  bài viết' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $post = Post::findOrFail($id);
            RouterHelper::delete('posts', $post->id);
            if (!empty($post->image)) {
                Storage::disk('public')->delete($post->image);
            }
<<<<<<< HEAD
=======
            if (!empty($post->icon)) {
                Storage::disk('public')->delete($post->icon);
            }
>>>>>>> hieu/update-feature
            $post->delete();
            return redirect()->route('admin.post.index')->with('success', 'Xóa  bài viết thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Không xóa được bài viết' . $e->getMessage());
        }
    }
}
