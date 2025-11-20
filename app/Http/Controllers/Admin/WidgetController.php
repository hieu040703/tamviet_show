<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Widget;
use Illuminate\Http\Request;

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
                    ->orWhere('code', 'like', '%' . $keyword . '%');
            });
        }
        $widgets->orderByDesc('id');
        $data['widgets'] = $widgets->paginate($this->limit);
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
    }
}
