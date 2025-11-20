<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\BannerItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\BannerItemRequest;

class BannerItemController extends Controller
{
    protected int $limit = 20;

    public function index(Request $request)
    {
        $data['sidebar'] = 'Banner';
        $data['sidebar_child'] = 'Banner';
        $data['title'] = 'Danh sách Banner Item ảnh';
        $data['breadcrumb'] = [
            ['route' => 'admin.banner_items.index', 'name' => 'Danh Sách Banner Item'],
        ];
        $query = BannerItem::query();
        if ($request->filled('banner_id')) {
            $query->where('banner_id', $request->banner_id);
        }
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function ($q) use ($keyword) {
                $q->where('title', 'like', '%' . $keyword . '%')
                    ->orWhere('subtitle', 'like', '%' . $keyword . '%');
            });
        }
        $query->orderBy('sort_order')->orderByDesc('id');
        $data['items'] = $query->paginate($this->limit);
        $data['banners'] = Banner::active()->get();
        $data['model'] = 'BannerItem';
        return view('backend.banner_items.index', $data);
    }

    public function create(Request $request)
    {
        $data['title'] = 'Thêm ảnh banner';
        $data['banner_id'] = $request->banner_id;
        $data['banners'] = Banner::active()->get();
        $data['sidebar'] = 'Banner';
        $data['sidebar_child'] = 'Banner';
        $data['breadcrumb'] = [
            ['route' => 'admin.banner_items.index', 'name' => 'Danh Sách Banner Item'],
            ['route' => 'admin.banner_items.create', 'name' => 'Thêm mới Banner Item'],
        ];
        return view('backend.banner_items.form', $data);
    }

    public function store(BannerItemRequest $request)
    {
        try {
            $data = $request->all();
            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('banner_items', 'public');
            }
            $item = BannerItem::create($data);
            return redirect()->route('admin.banner_items.index', [
                'banner_id' => $item->banner_id
            ])->with('success', 'Thêm ảnh banner thành công, tiếp tục thêm ảnh.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Không thêm được banner item' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $data['title'] = 'Sửa ảnh banner';
        $data['item'] = BannerItem::findOrFail($id);
        $data['banners'] = Banner::active()->get();
        $data['sidebar'] = 'Banner';
        $data['sidebar_child'] = 'Banner';

        return view('backend.banner_items.form', $data);
    }

    public function update(BannerItemRequest $request, $id)
    {
        try {
            $item = BannerItem::findOrFail($id);
            $data = $request->all();
            if ($request->hasFile('image')) {
                if ($item->image) Storage::disk('public')->delete($item->image);
                $data['image'] = $request->file('image')->store('banner_items', 'public');
            }
            $item->update($data);
            return redirect()->route('admin.banner_items.index', [
                'banner_id' => $item->banner_id
            ])->with('success', 'Cập nhật ảnh thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Không sửa được banner item' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $item = BannerItem::findOrFail($id);
            if ($item->image) {
                Storage::disk('public')->delete($item->image);
            }
            $item->delete();
            return redirect()->back()->with('success', 'Xóa ảnh banner thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Không xóa được banner item' . $e->getMessage());
        }
    }


}
