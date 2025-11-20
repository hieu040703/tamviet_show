<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Nestedsetbie;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Admin\MenuRequest;

class MenuController extends Controller
{
    protected int $limit = 20;

    public function index(Request $request)
    {
        $data['sidebar'] = 'Menu';
        $data['sidebar_child'] = 'Menu';
        $data['breadcrumb'] = [
            ['route' => 'admin.menus.index', 'name' => 'Quản lý Menu'],
        ];
        $data['title'] = 'Quản lý Menu';

        $menus = Menu::query();

        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $menus->where(function ($q) use ($keyword) {
                $q->where('name', 'like', '%' . $keyword . '%')
                    ->orWhere('keyword', 'like', '%' . $keyword . '%');
            });
        }

        $menus->orderByDesc('id');

        $data['menus'] = $menus->paginate($this->limit);
        $data['model'] = 'Menu';

        return view('backend.menus.index', $data);
    }

    public function create()
    {
        $data['sidebar'] = 'Menu';
        $data['sidebar_child'] = 'Menu';
        $data['title'] = 'Thêm Mới Menu';
        $data['breadcrumb'] = [
            ['route' => 'admin.menus.index', 'name' => 'Danh Sách Menu'],
            ['route' => 'admin.menus.create', 'name' => 'Thêm Mới Menu'],
        ];
        $data['menu'] = null;

        return view('backend.menus.form', $data);
    }

    public function store(MenuRequest $request)
    {
        try {
            $data = $request->validated();

            $menu = Menu::create($data);

            return redirect()
                ->route('admin.menus.edit', $menu->id)
                ->with('success', 'Tạo menu thành công, hãy cấu hình mục menu.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Không thêm được menu: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $data['sidebar'] = 'Menu';
        $data['sidebar_child'] = 'Menu';
        $data['title'] = 'Sửa Menu';

        $data['menu'] = Menu::findOrFail($id);
        $data['id'] = $id;

        $data['items'] = MenuItem::where('menu_id', $id)
            ->where('parent_id', 0)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('backend.menus.form', $data);
    }

    public function update(MenuRequest $request, $id)
    {
        try {
            $menu = Menu::findOrFail($id);
            $data = $request->validated();

            $menu->update($data);

            return redirect()
                ->route('admin.menus.edit', $menu->id)
                ->with('success', 'Cập nhật menu thành công.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Không sửa được menu: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $menu = Menu::findOrFail($id);
            MenuItem::where('menu_id', $menu->id)->delete();
            $menu->delete();
            return redirect()->route('admin.menus.index')->with('success', 'Xóa menu thành công.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Không xóa được menu: ' . $e->getMessage());
        }
    }

    public function items(Menu $menu, Request $request)
    {
        $parentId = (int)$request->get('parent_id', 0);
        $parentItem = null;
        if ($parentId > 0) {
            $parentItem = MenuItem::where('menu_id', $menu->id)->findOrFail($parentId);
        }
        $items = MenuItem::where('menu_id', $menu->id)->where('parent_id', $parentId)->orderBy('sort_order')->orderBy('id')->get();
        $data['sidebar'] = 'Menu';
        $data['sidebar_child'] = 'Menu';
        $data['title'] = 'Cập nhật menu con cho mục ' . ($parentItem->name ?? $menu->name);
        $data['menu'] = $menu;
        $data['items'] = $items;
        $data['parentId'] = $parentId;
        $data['parentItem'] = $parentItem;
        return view('backend.menus.items', $data);
    }

    public function saveItems(Menu $menu, Request $request)
    {
        $parentId = (int)$request->get('parent_id', 0);
        $rows = collect($request->input('items', []))->values();
        DB::beginTransaction();

        try {
            $existingIds = MenuItem::where('menu_id', $menu->id)->where('parent_id', $parentId)->pluck('id');
            $sentIds = $rows->pluck('id')->filter()->map(fn($id) => (int)$id);
            $toDelete = $existingIds->diff($sentIds);
            if ($toDelete->isNotEmpty()) {
                MenuItem::whereIn('id', $toDelete)->delete();
            }
            $order = 1;
            foreach ($rows as $row) {
                $id = $row['id'] ?? null;
                $data = [
                    'menu_id' => $menu->id,
                    'parent_id' => $parentId,
                    'name' => $row['name'] ?? '',
                    'url' => $row['url'] ?? null,
                    'sort_order' => $order++,
                    'status' => !empty($row['status']) ? 1 : 0,
                ];
                if (!empty($row['router_id'])) {
                    $data['router_id'] = (int)$row['router_id'];
                }
                if ($id) {
                    MenuItem::where('id', $id)->where('menu_id', $menu->id)->update($data);
                } else {
                    MenuItem::create($data);
                }
            }
            $nested = new Nestedsetbie(['table' => 'menu_items']);
            $nested->get();
            $arr = $nested->set();
            $nested->recursive(0, $arr);
            $nested->action();
            DB::commit();
            return redirect()->route('admin.menus.items', [
                'menu' => $menu->id,
                'parent_id' => $parentId,
            ])->with('success', 'Lưu menu con thành công.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors('Lỗi khi lưu: ' . $e->getMessage());
        }
    }
}
