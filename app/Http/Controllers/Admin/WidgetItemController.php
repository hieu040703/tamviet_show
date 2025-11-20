<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Widget;
use App\Models\WidgetItem;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Post;
use App\Models\Router;
use Illuminate\Http\Request;

class WidgetItemController extends Controller
{
    public function create(Widget $widget)
    {
        $data['sidebar'] = 'Widget';
        $data['sidebar_child'] = 'Widget';
        $data['title'] = 'Thêm widget item';
        $data['breadcrumb'] = [
            ['route' => 'admin.widgets.index', 'name' => 'Danh sách widget'],
            ['route' => 'admin.widgets.edit', 'params' => ['id' => $widget->id], 'name' => 'Cập nhật widget'],
            ['route' => 'admin.widget_items.create', 'params' => ['widget' => $widget->id], 'name' => 'Thêm item'],
        ];

        $data['widget'] = $widget;
        $data['item'] = new WidgetItem();

        return view('backend.widget_items.form', $data);
    }

    public function store(Request $request, Widget $widget)
    {
        $data = $request->validate([
            'object_type' => 'required|string',
            'object_id'   => 'required|integer',
            'title'       => 'nullable|string|max:255',
            'link'        => 'nullable|string|max:255',
            'image'       => 'nullable|string|max:255',
            'sort_order'  => 'nullable|integer',
            'is_active'   => 'sometimes|boolean',
        ]);

        $data['widget_id'] = $widget->id;
        $data['is_active'] = $request->has('is_active');

        // nếu title hoặc link trống thì tự fill từ đối tượng
        [$autoTitle, $autoLink] = $this->getObjectData($data['object_type'], $data['object_id']);

        if (empty($data['title'])) {
            $data['title'] = $autoTitle;
        }

        if (empty($data['link'])) {
            $data['link'] = $autoLink;
        }

        WidgetItem::create($data);

        return redirect()
            ->route('admin.widgets.edit', ['id' => $widget->id])
            ->with('success', 'Thêm widget item thành công');
    }

    public function edit($id)
    {
        $item = WidgetItem::findOrFail($id);
        $widget = $item->widget;

        $data['sidebar'] = 'Widget';
        $data['sidebar_child'] = 'Widget';
        $data['title'] = 'Cập nhật widget item';
        $data['breadcrumb'] = [
            ['route' => 'admin.widgets.index', 'name' => 'Danh sách widget'],
            ['route' => 'admin.widgets.edit', 'params' => ['id' => $widget->id], 'name' => 'Cập nhật widget'],
            ['route' => 'admin.widget_items.edit', 'params' => ['id' => $item->id], 'name' => 'Cập nhật item'],
        ];

        $data['widget'] = $widget;
        $data['item'] = $item;

        return view('backend.widget_items.form', $data);
    }

    public function update(Request $request, $id)
    {
        $item = WidgetItem::findOrFail($id);

        $data = $request->validate([
            'object_type' => 'required|string',
            'object_id'   => 'required|integer',
            'title'       => 'nullable|string|max:255',
            'link'        => 'nullable|string|max:255',
            'image'       => 'nullable|string|max:255',
            'sort_order'  => 'nullable|integer',
            'is_active'   => 'sometimes|boolean',
        ]);

        $data['is_active'] = $request->has('is_active');

        [$autoTitle, $autoLink] = $this->getObjectData($data['object_type'], $data['object_id']);

        if (empty($data['title'])) {
            $data['title'] = $autoTitle;
        }

        if (empty($data['link'])) {
            $data['link'] = $autoLink;
        }

        $item->update($data);

        return redirect()
            ->route('admin.widgets.edit', ['id' => $item->widget_id])
            ->with('success', 'Cập nhật widget item thành công');
    }

    public function destroy($id)
    {
        $item = WidgetItem::findOrFail($id);
        $widgetId = $item->widget_id;
        $item->delete();

        return redirect()
            ->route('admin.widgets.edit', ['id' => $widgetId])
            ->with('success', 'Xoá widget item thành công');
    }

    /**
     * AJAX search – trả về list data cho select
     */
    public function search(Request $request)
    {
        $request->validate([
            'type' => 'required|string', // products | brands | categories | posts
            'q'    => 'nullable|string',
        ]);

        $type = $request->get('type');
        $q    = $request->get('q', '');

        $results = [];

        switch ($type) {
            case 'products':
                $query = Product::query()->select('id', 'name');
                if ($q) {
                    $query->where('name', 'like', "%{$q}%");
                }
                $items = $query->limit(20)->get();
                foreach ($items as $item) {
                    $router = Router::where('module', 'products')
                        ->where('object_id', $item->id)
                        ->first();
                    $results[] = [
                        'id'    => $item->id,
                        'text'  => $item->name,
                        'link'  => $router ? '/' . $router->canonical : '',
                    ];
                }
                break;

            case 'brands':
                $query = Brand::query()->select('id', 'name');
                if ($q) {
                    $query->where('name', 'like', "%{$q}%");
                }
                $items = $query->limit(20)->get();
                foreach ($items as $item) {
                    $router = Router::where('module', 'brands')
                        ->where('object_id', $item->id)
                        ->first();
                    $results[] = [
                        'id'    => $item->id,
                        'text'  => $item->name,
                        'link'  => $router ? '/' . $router->canonical : '',
                    ];
                }
                break;

            // tương tự cho categories, posts...
            // case 'categories': ...
            // case 'posts': ...

            default:
                $results = [];
        }

        return response()->json($results);
    }

    /**
     * Lấy title + link tự động cho item
     */
    protected function getObjectData(string $type, int $id): array
    {
        $title = '';
        $link  = '';

        switch ($type) {
            case 'products':
                if ($obj = Product::find($id)) {
                    $title = $obj->name;
                    $router = Router::where('module', 'products')
                        ->where('object_id', $obj->id)->first();
                    $link = $router ? '/' . $router->canonical : '';
                }
                break;

            case 'brands':
                if ($obj = Brand::find($id)) {
                    $title = $obj->name;
                    $router = Router::where('module', 'brands')
                        ->where('object_id', $obj->id)->first();
                    $link = $router ? '/' . $router->canonical : '';
                }
                break;

            // thêm categories/posts nếu cần
        }

        return [$title, $link];
    }
}
