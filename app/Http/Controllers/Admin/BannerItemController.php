<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\BannerItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerItemController extends Controller
{
    protected int $limit = 20;

    public function index(Request $request)
    {
        $data['sidebar'] = 'Banner';
        $data['sidebar_child'] = 'Banner';

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
        $data['title'] = 'Danh sách Banner ảnh';

        return view('backend.banner_items.index', $data);
    }

    public function create(Request $request)
    {
        $data['title'] = 'Thêm ảnh banner';
        $data['banner_id'] = $request->banner_id;
        $data['banners'] = Banner::active()->get();
        $data['sidebar'] = 'Banner';
        $data['sidebar_child'] = 'Banner';

        return view('backend.banner_items.form', $data);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'banner_id' => 'required|exists:banners,id',
            'title' => 'nullable|string',
            'subtitle' => 'nullable|string',
            'link' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'status' => 'required|boolean',
            'image' => 'nullable|image'
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('banner_items', 'public');
        }

        $item = BannerItem::create($data);

        return redirect()->route('admin.banner_items.index', [
            'banner_id' => $item->banner_id
        ])->with('success', 'Thêm ảnh banner thành công, tiếp tục thêm ảnh.');
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

    public function update(Request $request, $id)
    {
        $item = BannerItem::findOrFail($id);

        $data = $request->validate([
            'banner_id' => 'required|exists:banners,id',
            'title' => 'nullable|string',
            'subtitle' => 'nullable|string',
            'link' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'status' => 'required|boolean',
            'image' => 'nullable|image'
        ]);

        if ($request->hasFile('image')) {
            if ($item->image) Storage::disk('public')->delete($item->image);
            $data['image'] = $request->file('image')->store('banner_items', 'public');
        }
        $item->update($data);
        return redirect()->route('admin.banner_items.index', [
            'banner_id' => $item->banner_id
        ])->with('success', 'Cập nhật ảnh thành công');
    }

    public function delete($id)
    {
        $item = BannerItem::findOrFail($id);

        if ($item->image) {
            Storage::disk('public')->delete($item->image);
        }

        $item->delete();

        return redirect()->back()->with('success', 'Xóa ảnh banner thành công');
    }

    public function sort(Request $request)
    {
        if ($request->has('orders')) {
            foreach ($request->orders as $id => $order) {
                BannerItem::where('id', $id)->update(['sort_order' => (int)$order]);
            }
        }

        if ($request->ajax()) {
            return response()->json(['status' => 'success']);
        }

        return redirect()->back()->with('success', 'Cập nhật thứ tự thành công');
    }

}
