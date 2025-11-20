<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    protected $limit = 20;

    public function index(Request $request)
    {
        $data['sidebar'] = 'Banner';
        $data['sidebar_child'] = 'Banner';
        $query = Banner::query();
        if ($request->filled('keyword')) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }
        $data['banners'] = $query->orderBy('id', 'DESC')->paginate($this->limit);
        $data['model'] = 'Banner';
        $data['title'] = 'Danh sách nhóm banner';
        return view('backend.banners.index', $data);
    }

    public function create()
    {
        return view('backend.banners.form', [
            'title' => 'Thêm nhóm banner',
            'sidebar' => 'Banner',
            'sidebar_child' => 'Banner',
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'code' => 'required|unique:banners,code',
            'position' => 'nullable',
            'status' => 'required'
        ]);
        $banner = Banner::create($data);
        return redirect()->route('admin.banner_items.create', [
            'banner_id' => $banner->id
        ])->with('success', 'Tạo nhóm banner thành công, hãy thêm ảnh banner.');
    }

    public function edit($id)
    {
        return view('backend.banners.form', [
            'title' => 'Sửa nhóm banner',
            'banner' => Banner::findOrFail($id),
        ]);
    }

    public function update(Request $request, $id)
    {
        $banner = Banner::findOrFail($id);
        $data = $request->validate([
            'name' => 'required',
            'code' => 'required|unique:banners,code,' . $id,
            'position' => 'nullable',
            'status' => 'required'
        ]);
        $banner->update($data);
        return redirect()->route('admin.banners.index')->with('success', 'Cập nhật thành công');
    }

    public function delete($id)
    {
        $banner = Banner::findOrFail($id);
        $banner->delete();
        return back()->with('success', 'Xóa nhóm banner thành công');
    }
}
