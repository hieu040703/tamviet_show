<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AttributeCatalogue;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\AttributeRequest;
use App\Models\Attribute;
use Illuminate\Support\Facades\Auth;

class AttributeController extends Controller
{
    protected int $limit = 15;

    public function index(Request $request)
    {
        $data['sidebar'] = 'Attribute';
        $data['sidebar_child'] = 'attributes';
        $data['title'] = 'Danh Sách Thuộc tính';
        $data['breadcrumb'] = [
            ['route' => 'admin.attributes.index', 'name' => 'Danh Sách Thuộc tính'],
        ];

        $attributes = Attribute::query();

        if ($request->filled('keyword')) {
            $attributes->where('name', 'like', '%' . $request->keyword . '%');
        }

        $attributes->orderByDesc('id');
        $data['attributes'] = $attributes->paginate($this->limit);
        $data['model'] = 'Attribute';

        return view('backend.attribute.index', $data);
    }

    public function create()
    {
        $data['sidebar'] = 'Attribute';
        $data['sidebar_child'] = 'attributes';
        $data['breadcrumb'] = [
            ['route' => 'admin.attributes.index', 'name' => 'Danh Sách thuộc tính'],
            ['route' => 'admin.attributes.create', 'name' => 'Thêm mới thuộc tính'],
        ];
        $data['attribute_catalogues'] = AttributeCatalogue::all();
        $data['title'] = 'Thêm mới thuộc tính';

        return view('backend.attribute.form', $data);
    }

    public function store(AttributeRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();

        Attribute::create($data);

        return redirect()->route('admin.attributes.index')
            ->with('success', 'Tạo thuộc tính thành công');
    }

    public function edit($id)
    {
        $attribute = Attribute::findOrFail($id);

        $data['sidebar'] = 'Attribute';
        $data['sidebar_child'] = 'attributes';
        $data['breadcrumb'] = [
            ['route' => 'admin.attributes.index', 'name' => 'Danh sách thuộc tính'],
            ['route' => 'admin.attributes.edit', 'name' => 'Cập nhật thuộc tính'],
        ];
        $data['title'] = 'Cập nhật thuộc tính';
        $data['attribute'] = $attribute;
        $data['attribute_catalogues'] = AttributeCatalogue::all();
        $data['id'] = $id;
        return view('backend.attribute.form', $data);
    }

    public function update(AttributeRequest $request, $id)
    {
        try {
            $attribute = Attribute::findOrFail($id);
            $data = $request->validated();
            $data['user_id'] = Auth::id();
            $attribute->update($data);
            $catalogueIds = $request->input('attribute_catalogue_id');
            if (!is_array($catalogueIds)) {
                $catalogueIds = [$catalogueIds];
            }
            $attribute->catalogues()->sync($catalogueIds);
            return redirect()->route('admin.attributes.index')->with('success', 'Cập nhật  thuộc tính thành công');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Không cập nhật được  thuộc tính');
        }
    }
    public function delete($id)
    {
        try {
            $attribute = Attribute::findOrFail($id);
            $attribute->delete();
            return redirect()->route('admin.attributes.index')->with('success', 'Xóa thuộc tính thành công thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Không xóa được thuộc tính thành công' . $e->getMessage());
        }
    }
}
