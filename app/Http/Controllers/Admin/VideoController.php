<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\VideoRequest;
use App\Http\Controllers\Traits\HandlesUploads;
use App\Models\Video;
use App\Helpers\RouterHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    use HandlesUploads;

    protected int $limit = 15;

    public function index(Request $request)
    {
        $data['sidebar'] = 'Video';
        $data['sidebar_child'] = 'Video';
        $data['title'] = 'Danh sách Video';
        $data['breadcrumb'] = [
            ['route' => 'admin.videos.index', 'name' => 'Danh sách Video'],
        ];
        $videos = Video::query();
        if ($request->filled('keyword')) {
            $videos->where('name', 'like', '%' . $request->keyword . '%');
        }
        $videos->orderBy('sort_order')->orderByDesc('id');
        $data['videos'] = $videos->paginate($this->limit);
        $data['model'] = 'Video';

        return view('backend.videos.index', $data);
    }

    public function create()
    {
        $data['sidebar'] = 'Video';
        $data['sidebar_child'] = 'Video';
        $data['title'] = 'Thêm mới Video';
        $data['breadcrumb'] = [
            ['route' => 'admin.videos.index', 'name' => 'Danh sách Video'],
            ['route' => 'admin.videos.create', 'name' => 'Thêm mới Video'],
        ];
        $data['model'] = 'Video';
        return view('backend.videos.form', $data);
    }

    public function store(VideoRequest $request)
    {
        try {
            $data = $request->validated();
            $data['user_id'] = Auth::id();
            $this->handleUploads($request, $data, 'videos');
            $video = Video::create($data);
            RouterHelper::sync('video', $video->id, $data['canonical'], $video->name);
            return redirect()->route('admin.videos.index')->with('success', 'Thêm video thành công');
        } catch (\Exception $e) {
            return back()->with('error', 'Không thêm được video: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $data['sidebar'] = 'Video';
        $data['sidebar_child'] = 'Video';
        $data['title'] = 'Cập nhật Video';
        $data['video'] = Video::findOrFail($id);
        $data['id'] = $id;
        $data['model'] = 'Video';
        return view('backend.videos.form', $data);
    }

    public function update(VideoRequest $request, $id)
    {
        try {
            $video = Video::findOrFail($id);
            $data = $request->validated();
            $data['user_id'] = Auth::id();
            $this->handleUploads($request, $data, 'videos', $video);
            $video->update($data);
            RouterHelper::sync('video', $video->id, $data['canonical'], $video->name);
            return redirect()->route('admin.videos.index')->with('success', 'Cập nhật video thành công');
        } catch (\Exception $e) {
            return back()->with('error', 'Không cập nhật được video: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $video = Video::findOrFail($id);
            RouterHelper::delete('video', $video->id);
            if (!empty($video->image)) {
                Storage::disk('public')->delete($video->image);
            }
            $video->delete();
            return redirect()->route('admin.videos.index')->with('success', 'Xóa video thành công');
        } catch (\Exception $e) {
            return back()->with('error', 'Không xóa được video: ' . $e->getMessage());
        }
    }
}
