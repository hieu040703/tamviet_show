<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
<<<<<<< HEAD
=======
use App\Http\Requests\Admin\BannerRequest;
>>>>>>> hieu/update-feature

class BannerController extends Controller
{
    protected $limit = 20;

    public function index(Request $request)
    {
        $data['sidebar'] = 'Banner';
        $data['sidebar_child'] = 'Banner';
<<<<<<< HEAD
        $query = Banner::query();
        if ($request->filled('keyword')) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }
        $data['banners'] = $query->orderBy('id', 'DESC')->paginate($this->limit);
        $data['model'] = 'Banner';
        $data['title'] = 'Danh sách nhóm banner';
=======
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
>>>>>>> hieu/update-feature
        return view('backend.banners.index', $data);
    }

    public function create()
    {
<<<<<<< HEAD
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
=======
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
>>>>>>> hieu/update-feature
    }

    public function edit($id)
    {
<<<<<<< HEAD
        return view('backend.banners.form', [
            'title' => 'Sửa nhóm banner',
            'banner' => Banner::findOrFail($id),
        ]);
=======
        $data['sidebar'] = 'Banner';
        $data['sidebar_child'] = 'Banner';
        $data['title'] = 'Sửa Banner';
        $data['banner'] = Banner::findOrFail($id);
        $data['id'] = $id;
        return view('backend.banners.form', $data);
>>>>>>> hieu/update-feature
    }

    public function update(Request $request, $id)
    {
<<<<<<< HEAD
        $banner = Banner::findOrFail($id);
        $data = $request->validate([
            'name' => 'required',
            'code' => 'required|unique:banners,code,' . $id,
            'position' => 'nullable',
            'status' => 'required'
        ]);
        $banner->update($data);
        return redirect()->route('admin.banners.index')->with('success', 'Cập nhật thành công');
=======
        try {
            $banner = Banner::findOrFail($id);
            $data = $request->all();
            $banner->update($data);
            return redirect()->route('admin.banners.index')->with('success', 'Cập nhật thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Không sửa được banner' . $e->getMessage());
        }
>>>>>>> hieu/update-feature
    }

    public function delete($id)
    {
<<<<<<< HEAD
        $banner = Banner::findOrFail($id);
        $banner->delete();
        return back()->with('success', 'Xóa nhóm banner thành công');
=======
        try {
            $banner = Banner::findOrFail($id);
            $banner->delete();
            return back()->with('success', 'Xóa nhóm banner thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Không xóa được banner' . $e->getMessage());
        }
>>>>>>> hieu/update-feature
    }
}
