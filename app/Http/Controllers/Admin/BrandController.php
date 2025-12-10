<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\BrandRequest;
use App\Http\Controllers\Traits\HandlesUploads;
use App\Models\Brand;
use App\Helpers\RouterHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    use HandlesUploads;

    protected int $limit = 15;

    public function index(Request $request)
    {
        $data['sidebar'] = 'Brand';
        $data['sidebar_child'] = 'Brand';
        $data['title'] = 'Danh Sách Thương Hiệu';
        $data['breadcrumb'] = [
            ['route' => 'admin.brands.index', 'name' => 'Danh Sách Thương Hiệu'],
        ];
        $brands = Brand::query();
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $brands->where(function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            });
        }
        $brands->orderByDesc('id');
        $data['brands'] = $brands->paginate($this->limit);
        $data['model'] = 'Brand';
        return view('backend.brands.index', $data);
    }

    public function create()
    {
        $data['sidebar'] = 'Brand';
        $data['sidebar_child'] = 'Brand';
        $data['title'] = 'Thêm Mới Thương Hiệu';
        $data['breadcrumb'] = [
            ['route' => 'admin.brands.index', 'name' => 'Danh Sách Thương Hiệu'],
            ['route' => 'admin.brands.create', 'name' => 'Thêm Mới Thương Hiệu'],
        ];
        $data['model'] = 'Brand';
        return view('backend.brands.form', $data);
    }

    public function store(BrandRequest $request)
    {
        try {
            $data = $request->validated();
            $data['user_id'] = Auth::id();
            $this->handleUploads($request, $data, 'brands');
            $this->handleUploads($request, $data, 'brands', null, 'icon');
            $brand = Brand::create($data);
            RouterHelper::sync('brands', $brand->id, $data['canonical'] ?? null, $brand->name);
            return redirect()->route('admin.brands.index', $brand->id)->with('success', 'Tạo Thương hiệu thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Không thêm được thương hiệu' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $data['sidebar'] = 'Brand';
        $data['sidebar_child'] = 'Brand';
        $data['title'] = 'Sửa Thương Hiệu';
        $data['brand'] = Brand::findOrFail($id);
        $data['id'] = $id;
        $data['model'] = 'Brand';
        return view('backend.brands.form', $data);
    }

    public function update(BrandRequest $request, $id)
    {
        try {
            $brand = Brand::findOrFail($id);
            $data = $request->validated();
            $data['user_id'] = Auth::id();
            $this->handleUploads($request, $data, 'brands', $brand);
            $this->handleUploads($request, $data, 'brands', $brand, 'icon');
            $brand->update($data);
            RouterHelper::sync('brands', $brand->id, $data['canonical'] ?? null, $brand->name);
            return redirect()->route('admin.brands.index', $brand->id)->with('success', 'Cập nhật thương hiệu thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Không cập nhật được thương hiệu' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $brand = Brand::findOrFail($id);
            RouterHelper::delete('brands', $brand->id);
            if (!empty($brand->image)) {
                Storage::disk('public')->delete($brand->image);
            }
            if (!empty($brand->icon)) {
                Storage::disk('public')->delete($brand->icon);
            }
            $brand->delete();
            return redirect()->route('admin.brands.index')->with('success', 'Xóa thương hiệu thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Không xóa được thương hiệu' . $e->getMessage());
        }
    }
}
