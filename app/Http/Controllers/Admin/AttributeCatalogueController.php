<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AttributeCatalogue;
use App\Helpers\RouterHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\AttributeCatalogueRequest;

class AttributeCatalogueController extends Controller
{
    protected int $limit = 15;

    public function index(Request $request)
    {
        $data['sidebar'] = 'Attribute';
        $data['sidebar_child'] = 'attribute_catalogues';
        $data['title'] = 'Danh Sách Nhóm thuộc tính';
        $data['breadcrumb'] = [
            ['route' => 'admin.attribute.catalogues.index', 'name' => 'Danh Sách  nhóm thuộc tính'],
        ];
        $attributeCatalogues = AttributeCatalogue::query();
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $attributeCatalogues->where(function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            });
        }
        $attributeCatalogues->orderByDesc('id');
        $data['attributeCatalogues'] = $attributeCatalogues->paginate($this->limit);
        $data['model'] = 'AttributeCatalogue';
        return view('backend.attribute.catalogue.index', $data);
    }

    public function create()
    {
        $data['sidebar'] = 'Attribute';
        $data['sidebar_child'] = 'attribute_catalogues';
        $data['breadcrumb'] = [
            ['route' => 'admin.attribute.catalogues.index', 'name' => 'Danh Sách nhóm thuộc tính'],
            ['route' => 'admin.attribute.catalogues.create', 'name' => 'Thêm mới nhóm thuộc tính'],
        ];
        $data['title'] = 'Thêm mới nhóm thuộc tính';
        return view('backend.attribute.catalogue.form', $data);
    }

    public function store(AttributeCatalogueRequest $request)
    {
        try {
            $data = $request->validated();
            $data['user_id'] = Auth::id();
            $attributeCatalogue = AttributeCatalogue::create($data);
            return redirect()->route('admin.attribute.catalogues.index')->with('success', 'Tạo nhóm thuộc tính thành công');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Không thêm được nhóm thuộc tính');
        }
    }

    public function edit($id)
    {
        $attributeCatalogue = AttributeCatalogue::findOrFail($id);

        $data['sidebar'] = 'Attribute';
        $data['sidebar_child'] = 'attribute_catalogues';
        $data['breadcrumb'] = [
            ['route' => 'admin.attribute.catalogues.index', 'name' => 'Danh sách nhóm thuộc tính'],
            ['route' => 'admin.attribute.catalogues.edit', 'name' => 'Cập nhật nhóm thuộc tính'],
        ];
        $data['title'] = 'Cập nhật nhóm thuộc tính';
        $data['attributeCatalogue'] = $attributeCatalogue;
        $data['id'] = $id;
        return view('backend.attribute.catalogue.form', $data);
    }

    public function update(AttributeCatalogueRequest $request, $id)
    {
        try {
            $attributeCatalogue = AttributeCatalogue::findOrFail($id);
            $data = $request->validated();
            $data['user_id'] = Auth::id();
            $attributeCatalogue->update($data);
            return redirect()->route('admin.attribute.catalogues.index')->with('success', 'Cập nhật nhóm thuộc tính thành công');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Không cập nhật được nhóm thuộc tính');
        }
    }

    public function delete($id)
    {
        try {
            $attributeCatalogue = AttributeCatalogue::findOrFail($id);
            $attributeCatalogue->delete();
            return redirect()->route('admin.attribute.catalogues.index')->with('success', 'Xóa nhóm thuộc tính thành công thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Không xóa nhóm được thuộc tính thành công' . $e->getMessage());
        }
    }
}
