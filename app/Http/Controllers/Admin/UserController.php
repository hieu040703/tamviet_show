<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected int $limit = 15;

    public function index(Request $request)
    {
        $data['sidebar'] = 'User';
        $data['sidebar_child'] = 'User';
        $data['title'] = 'Danh Sách Thành Viên';
        $data['breadcrumb'] = [
            ['route' => 'admin.users.index', 'name' => 'Danh Sách Thành Viên'],
        ];
        $users = User::with('roles');
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $users->where(function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%')
                    ->orWhere('email', 'like', '%' . $keyword . '%');
            });
        }
        $users->orderByDesc('id');
        $data['users'] = $users->paginate($this->limit);
        $data['model'] = 'User';
        return view('backend.users.index', $data);
    }

    public function create()
    {
        $data['sidebar'] = 'User';
        $data['sidebar_child'] = 'User';
        $data['title'] = 'Thêm Mới Thành Viên';
        $data['breadcrumb'] = [
            ['route' => 'admin.users.index', 'name' => 'Danh Sách Thành Viên'],
            ['route' => 'admin.users.create', 'name' => 'Thêm Mới Thành Viên'],
        ];
        $data['user'] = new User();
        $data['roles'] = Role::orderBy('name')->get();
        $data['selectedRoles'] = [];
        $data['id'] = null;
        return view('backend.users.form', $data);
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users,email',
                'password' => 'required|string|min:6|confirmed',
                'roles' => 'array',
                'roles.*' => 'integer',
            ]);
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
            $user->roles()->sync($data['roles'] ?? []);
            return redirect()->route('admin.users.index')->with('success', 'Tạo thành viên thành công');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Không tạo được thành viên: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $user = User::with('roles')->findOrFail($id);

        $data['sidebar'] = 'User';
        $data['sidebar_child'] = 'User';
        $data['title'] = 'Sửa Thành Viên';
        $data['user'] = $user;
        $data['id'] = $id;
        $data['roles'] = Role::orderBy('name')->get();
        $data['selectedRoles'] = $user->roles->pluck('id')->toArray();
        return view('backend.users.form', $data);
    }

    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users,email,' . $user->id,
                'password' => 'nullable|string|min:6|confirmed',
                'roles' => 'array',
                'roles.*' => 'integer',
            ]);
            $updateData = [
                'name' => $data['name'],
                'email' => $data['email'],
            ];
            if (!empty($data['password'])) {
                $updateData['password'] = Hash::make($data['password']);
            }
            $user->update($updateData);
            $user->roles()->sync($data['roles'] ?? []);
            return redirect()->route('admin.users.index')->with('success', 'Cập nhật thành viên thành công');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Không cập nhật được thành viên: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->roles()->detach();
            $user->delete();
            return redirect()->route('admin.users.index')->with('success', 'Xóa thành viên thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Không xóa được thành viên: ' . $e->getMessage());
        }
    }
}
