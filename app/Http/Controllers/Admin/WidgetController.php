<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Widget;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Post;
use App\Models\PostCatalogue;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\WidgetRequest;

class WidgetController extends Controller
{
    protected int $limit = 20;

    public function index(Request $request)
    {
        $data['sidebar'] = 'Widget';
        $data['sidebar_child'] = 'Widget';
        $data['title'] = 'Quản lý Widget';
        $data['breadcrumb'] = [
            ['route' => 'admin.widgets.index', 'name' => 'Danh sách Widget'],
        ];

        $widgets = Widget::query();

        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $widgets->where(function ($q) use ($keyword) {
                $q->where('name', 'like', '%' . $keyword . '%')
                    ->orWhere('keyword', 'like', '%' . $keyword . '%');
            });
        }

        $widgets->orderBy('sort_order')->orderByDesc('id');

        $data['widgets'] = $widgets->paginate($this->limit);
        $data['model'] = 'Widget';

        return view('backend.widgets.index', $data);
    }

    public function create()
    {
        $data['sidebar'] = 'Widget';
        $data['sidebar_child'] = 'Widget';
        $data['title'] = 'Thêm Widget';
        $data['breadcrumb'] = [
            ['route' => 'admin.widgets.index', 'name' => 'Danh sách Widget'],
            ['route' => 'admin.widgets.create', 'name' => 'Thêm Widget'],
        ];

        $data['widget'] = null;
        $data['selectedItems'] = collect();

        return view('backend.widgets.form', $data);
    }

    public function store(WidgetRequest $request)
    {
        try {
            $data = $request->validated();

            $album = json_decode($request->input('album', '[]'), true) ?: [];
            $modelIds = json_decode($request->input('model_id', '[]'), true) ?: [];

            $widget = Widget::create([
                'name' => $data['name'],
                'keyword' => $data['keyword'],
                'description' => $data['description'] ?? null,
                'album' => $album,
                'model' => $data['model'] ?? null,
                'model_id' => $modelIds,
                'short_code' => '[widget-id="' . $data['keyword'] . '"]',
                'sort_order' => $data['sort_order'] ?? 0,
                'status' => $data['status'] ?? 0,
            ]);

            return redirect()->route('admin.widgets.edit', $widget->id)->with('success', 'Thêm widget thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Không thêm được widget' . $e->getMessage());
        }
    }

    public function edit(Widget $widget)
    {
        $data['sidebar'] = 'Widget';
        $data['sidebar_child'] = 'Widget';
        $data['title'] = 'Chỉnh sửa Widget';
        $data['breadcrumb'] = [
            ['route' => 'admin.widgets.index', 'name' => 'Danh sách Widget'],
            ['route' => 'admin.widgets.edit', 'name' => 'Chỉnh sửa Widget'],
        ];

        $data['widget'] = $widget;

        $ids = is_array($widget->model_id) ? $widget->model_id : [];
        $model = $widget->model;

        $selectedItems = collect();

        if (!empty($ids)) {
            $idList = implode(',', $ids);
            switch ($model) {
                case 'products':
                    $selectedItems = Product::whereIn('id', $ids)
                        ->orderByRaw('FIELD(id,' . $idList . ')')->get();
                    break;
                case 'categories':
                    $selectedItems = Category::whereIn('id', $ids)
                        ->orderByRaw('FIELD(id,' . $idList . ')')->get();
                    break;
                case 'brands':
                    $selectedItems = Brand::whereIn('id', $ids)
                        ->orderByRaw('FIELD(id,' . $idList . ')')->get();
                    break;
                case 'posts':
                    $selectedItems = Post::whereIn('id', $ids)
                        ->orderByRaw('FIELD(id,' . $idList . ')')->get();
                    break;
                case 'post_catalogues':
                    $selectedItems = PostCatalogue::whereIn('id', $ids)
                        ->orderByRaw('FIELD(id,' . $idList . ')')->get();
                    break;
            }
        }

        $data['selectedItems'] = $selectedItems;

        return view('backend.widgets.form', $data);
    }

    public function update(WidgetRequest $request, Widget $widget)
    {
        try {
            $data = $request->validated();

            $album = json_decode($request->input('album', '[]'), true) ?: [];
            $modelIds = json_decode($request->input('model_id', '[]'), true) ?: [];

            $widget->update([
                'name' => $data['name'],
                'keyword' => $data['keyword'],
                'description' => $data['description'] ?? null,
                'album' => $album,
                'model' => $data['model'] ?? null,
                'model_id' => $modelIds,
                'short_code' => '[widget-id="' . $data['keyword'] . '"]',
                'sort_order' => $data['sort_order'] ?? 0,
                'status' => $data['status'] ?? 0,
            ]);

            return back()->with('success', 'Cập nhật widget thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Không sửa được widget' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $widget = Widget::findOrFail($id);
            $widget->delete();
            return redirect()->route('admin.widgets.index')->with('success', 'Xóa widget thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Không xóa được widget' . $e->getMessage());
        }
    }
}
