<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permission;

class PermissionController extends Controller
{
    protected int $limit = 15;

    public function index(Request $request)
    {
        $data['sidebar'] = 'Permission';
        $data['sidebar_child'] = 'Permission';
        $data['title'] = 'Danh Sách Quyền';
        $data['breadcrumb'] = [
            ['route' => 'admin.permissions.index', 'name' => 'Danh Sách Quyền'],
        ];
        $permissions = Permission::query();
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $permissions->where(function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%')
                    ->orWhere('display_name', 'like', '%' . $keyword . '%');
            });
        }
        $permissions->orderByDesc('id');
        $data['permissions'] = $permissions->paginate($this->limit);
        $data['model'] = 'Permission';
        return view('backend.permissions.index', $data);
    }
    public function create()
    {
        $data['sidebar'] = 'Permission';
        $data['sidebar_child'] = 'Permission';
        $data['title'] = 'Thêm Mới Quyền';
        $data['breadcrumb'] = [
            ['route' => 'admin.permissions.index', 'name' => 'Danh Sách Quyền'],
            ['route' => 'admin.permissions.create', 'name' => 'Thêm Mới Quyền'],
        ];
        $data['permission'] = new Permission();
        return view('backend.permissions.form', $data);
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'name'         => 'required|unique:permissions,name',
                'display_name' => 'nullable|string|max:255',
            ]);
            Permission::create($data);
            return redirect()->route('admin.permissions.index')->with('success', 'Tạo quyền thành công');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Không tạo được quyền: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $permission = Permission::findOrFail($id);

        $data['sidebar'] = 'Permission';
        $data['sidebar_child'] = 'Permission';
        $data['title'] = 'Sửa Quyền';
        $data['permission'] = $permission;
        $data['id'] = $id;
        return view('backend.permissions.form', $data);
    }

    public function update(Request $request, $id)
    {
        try {
            $permission = Permission::findOrFail($id);
            $data = $request->validate([
                'name'         => 'required|unique:permissions,name,' . $permission->id,
                'display_name' => 'nullable|string|max:255',
            ]);
            $permission->update($data);
            return redirect()->route('admin.permissions.index')->with('success', 'Cập nhật quyền thành công');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Không cập nhật được quyền: ' . $e->getMessage());
        }
    }
    public function delete($id)
    {
        try {
            $permission = Permission::findOrFail($id);
            $permission->roles()->detach();
            $permission->delete();
            return redirect()->route('admin.permissions.index')->with('success', 'Xóa quyền thành công');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Không xóa được quyền: ' . $e->getMessage());
        }
    }
}
