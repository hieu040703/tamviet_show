<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Widget;
<<<<<<< HEAD
use Illuminate\Http\Request;
=======
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Post;
use App\Models\PostCatalogue;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\WidgetRequest;
>>>>>>> hieu/update-feature

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
<<<<<<< HEAD
        $widgets = Widget::query();
=======

        $widgets = Widget::query();

>>>>>>> hieu/update-feature
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $widgets->where(function ($q) use ($keyword) {
                $q->where('name', 'like', '%' . $keyword . '%')
<<<<<<< HEAD
                    ->orWhere('code', 'like', '%' . $keyword . '%');
            });
        }
        $widgets->orderByDesc('id');
        $data['widgets'] = $widgets->paginate($this->limit);
=======
                    ->orWhere('keyword', 'like', '%' . $keyword . '%');
            });
        }

        $widgets->orderBy('sort_order')->orderByDesc('id');

        $data['widgets'] = $widgets->paginate($this->limit);
        $data['model'] = 'Widget';

>>>>>>> hieu/update-feature
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
<<<<<<< HEAD
        $data['widget'] = null;
        return view('backend.widgets.form', $data);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255|unique:widgets,code',
            'type' => 'nullable|string|max:50',
            'position' => 'nullable|integer',
            'status' => 'nullable|boolean',
        ]);
        $data['status'] = $request->has('status') ? 1 : 0;
        Widget::create($data);
        return redirect()->route('admin.widgets.index')
            ->with('success', 'Thêm Widget thành công');
    }

    public function edit($id)
    {
        $widget = Widget::findOrFail($id);

        $data['title'] = 'Cập nhật widget';
        $data['widget'] = $widget;
        $data['breadcrumb'] = [
            ['route' => 'admin.widgets.index', 'name' => 'Danh sách widget'],
            [
                'route'  => 'admin.widgets.edit',
                'name'   => 'Cập nhật widget',
                'params' => ['id' => $widget->id], // 👈 BẮT BUỘC PHẢI CÓ
            ],
        ];

        return view('backend.widgets.form', $data);
    }


    public function update(Request $request, $id)
    {
        $widget = Widget::findOrFail($id);
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255|unique:widgets,code,' . $widget->id,
            'type' => 'nullable|string|max:50',
            'position' => 'nullable|integer',
            'status' => 'nullable|boolean',
        ]);
        $data['status'] = $request->has('status') ? 1 : 0;
        $widget->update($data);
        return redirect()->route('admin.widgets.edit', $widget->id)->with('success', 'Cập nhật Widget thành công');
    }

    public function destroy($id)
    {
        $widget = Widget::with('items')->findOrFail($id);
        foreach ($widget->items as $item) {
            $item->delete();
        }
        $widget->delete();
        return redirect()->route('admin.widgets.index')->with('success', 'Xóa Widget thành công');
=======

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
>>>>>>> hieu/update-feature
    }
}
