<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\BannerRequest;

class BannerController extends Controller
{
    protected $limit = 20;

    public function index(Request $request)
    {
        $data['sidebar'] = 'Banner';
        $data['sidebar_child'] = 'Banner';
        $data['breadcrumb'] = [
            ['route' => 'admin.banners.index', 'name' => 'Danh Sách Banner'],
        ];
        $data['title'] = 'Danh sách nhóm banner';
        $banners = Banner::query();
        if ($request->filled('keyword')) {
            $banners->where('name', 'like', '%' . $request->keyword . '%');
        }
        $banners->orderByDesc('id');
        $data['banners'] = $banners->paginate($this->limit);
        $data['model'] = 'Banner';
        return view('backend.banners.index', $data);
    }

    public function create()
    {
        $data['sidebar'] = 'Banner';
        $data['sidebar_child'] = 'Banner';
        $data['title'] = 'Thêm Mới Banner';
        $data['breadcrumb'] = [
            ['route' => 'admin.banners.index', 'name' => 'Danh Sách Banner'],
            ['route' => 'admin.banners.create', 'name' => 'Thêm Mới Banner'],
        ];
        return view('backend.banners.form', $data);
    }

    public function store(BannerRequest $request)
    {
        try {
            $data = $request->all();
            $banner = Banner::create($data);
            return redirect()->route('admin.banner_items.create', [
                'banner_id' => $banner->id
            ])->with('success', 'Tạo nhóm banner thành công, hãy thêm ảnh banner.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Không thêm được banner' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $data['sidebar'] = 'Banner';
        $data['sidebar_child'] = 'Banner';
        $data['title'] = 'Sửa Banner';
        $data['banner'] = Banner::findOrFail($id);
        $data['id'] = $id;
        return view('backend.banners.form', $data);
    }

    public function update(Request $request, $id)
    {
        try {
            $banner = Banner::findOrFail($id);
            $data = $request->all();
            $banner->update($data);
            return redirect()->route('admin.banners.index')->with('success', 'Cập nhật thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Không sửa được banner' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $banner = Banner::findOrFail($id);
            $banner->delete();
            return back()->with('success', 'Xóa nhóm banner thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Không xóa được banner' . $e->getMessage());
        }
    }
}
