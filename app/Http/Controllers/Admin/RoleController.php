<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;

class RoleController extends Controller
{
    protected int $limit = 15;

    public function index(Request $request)
    {
        $data['sidebar'] = 'Role';
        $data['sidebar_child'] = 'Role';
        $data['title'] = 'Danh Sách Vai Trò';
        $data['breadcrumb'] = [
            ['route' => 'admin.roles.index', 'name' => 'Danh Sách Vai Trò'],
        ];
        $roles = Role::with('permissions');
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $roles->where(function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%')
                    ->orWhere('display_name', 'like', '%' . $keyword . '%');
            });
        }
        $roles->orderByDesc('id');
        $data['roles'] = $roles->paginate($this->limit);
        $data['model'] = 'Role';
        return view('backend.roles.index', $data);
    }

    public function create()
    {
        $data['sidebar'] = 'Role';
        $data['sidebar_child'] = 'Role';
        $data['title'] = 'Thêm Mới Vai Trò';
        $data['breadcrumb'] = [
            ['route' => 'admin.roles.index', 'name' => 'Danh Sách Vai Trò'],
            ['route' => 'admin.roles.create', 'name' => 'Thêm Mới Vai Trò'],
        ];
        $data['role'] = new Role();
        $data['permissions'] = Permission::orderBy('name')->get();
        $data['selectedPermissions'] = [];

        return view('backend.roles.form', $data);
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required|unique:roles,name',
                'display_name' => 'nullable|string|max:255',
                'permissions' => 'array',
                'permissions.*' => 'integer',
            ]);
            $role = Role::create([
                'name' => $data['name'],
                'display_name' => $data['display_name'] ?? null,
            ]);
            $role->permissions()->sync($data['permissions'] ?? []);
            return redirect()->route('admin.roles.index')->with('success', 'Tạo vai trò thành công');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Không tạo được vai trò: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $data['sidebar'] = 'Role';
        $data['sidebar_child'] = 'Role';
        $data['title'] = 'Sửa Vai Trò';
        $data['role'] = $role;
        $data['id'] = $id;
        $data['permissions'] = Permission::orderBy('name')->get();
        $data['selectedPermissions'] = $role->permissions->pluck('id')->toArray();
        return view('backend.roles.form', $data);
    }

    public function update(Request $request, $id)
    {
        try {
            $role = Role::findOrFail($id);
            $data = $request->validate([
                'name' => 'required|unique:roles,name,' . $role->id,
                'display_name' => 'nullable|string|max:255',
                'permissions' => 'array',
                'permissions.*' => 'integer',
            ]);
            $role->update([
                'name' => $data['name'],
                'display_name' => $data['display_name'] ?? null,
            ]);
            $role->permissions()->sync($data['permissions'] ?? []);
            return redirect()->route('admin.roles.index')->with('success', 'Cập nhật vai trò thành công');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Không cập nhật được vai trò: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $role = Role::findOrFail($id);
            $role->permissions()->detach();
            $role->users()->detach();
            $role->delete();
            return redirect()->route('admin.roles.index')->with('success', 'Xóa vai trò thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Không xóa được vai trò: ' . $e->getMessage());
        }
    }
}
