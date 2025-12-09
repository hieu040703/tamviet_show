<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Nestedsetbie;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\HandlesUploads;
use App\Helpers\RouterHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    use HandlesUploads;

    protected $nestedset;
    protected int $limit = 15;

    public function __construct()
    {
        $this->initialize();
    }

    private function initialize(): void
    {
        $this->nestedset = new Nestedsetbie([
            'table' => 'categories',
        ]);
    }

    public function index(Request $request)
    {
        $data['sidebar'] = 'Category';
        $data['sidebar_child'] = 'Category';
        $data['title'] = 'Danh Sách Danh Mục';
        $data['breadcrumb'] = [
            ['route' => 'admin.categories.index', 'name' => 'Danh Sách Danh Mục'],
        ];
        $categories = Category::query();
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $categories->where(function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            });
        }
        $categories->orderBy('lft', 'ASC');
        $data['categories'] = $categories->paginate($this->limit);
        $data['model'] = 'Category';
        return view('backend.categories.index', $data);
    }

    public function create()
    {
        $data['sidebar'] = 'Category';
        $data['sidebar_child'] = 'Category';
        $data['title'] = 'Thêm Mới Danh Mục';
        $data['breadcrumb'] = [
            ['route' => 'admin.categories.index', 'name' => 'Danh Sách Danh Mục'],
            ['route' => 'admin.categories.create', 'name' => 'Thêm Mới Danh Mục'],
        ];
        $data['dropdown'] = $this->nestedset->Dropdown();
<<<<<<< HEAD

=======
        $data['model'] = 'Category';
>>>>>>> hieu/update-feature
        return view('backend.categories.form', $data);
    }

    public function store(CategoryRequest $request)
    {
        try {
            $data = $request->validated();
            $data['user_id'] = Auth::id();
            $this->handleUploads($request, $data, 'categories');
<<<<<<< HEAD
=======
            $this->handleUploads($request, $data, 'categories', null, 'icon');
>>>>>>> hieu/update-feature
            $category = Category::create($data);
            RouterHelper::sync('categories', $category->id, $data['canonical'] ?? null, $category->name);
            $this->nestedset = new Nestedsetbie([
                'table' => 'categories',
            ]);
            $this->nestedset();
            return redirect()->route('admin.categories.index', $category->id)->with('success', 'Tạo danh mục thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Không thêm được danh mục' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $data['sidebar'] = 'Category';
        $data['sidebar_child'] = 'Category';
        $data['title'] = 'Sửa Danh Mục';
        $data['category'] = Category::findOrFail($id);
        $data['id'] = $id;
        $data['dropdown'] = $this->nestedset->Dropdown();
<<<<<<< HEAD
=======
        $data['model'] = 'Category';
>>>>>>> hieu/update-feature
        return view('backend.categories.form', $data);
    }

    public function update(CategoryRequest $request, $id)
    {
        try {
            $category = Category::findOrFail($id);
            $data = $request->validated();
            $data['user_id'] = Auth::id();
            $this->handleUploads($request, $data, 'categories', $category);
<<<<<<< HEAD
=======
            $this->handleUploads($request, $data, 'categories', $category, 'icon');
>>>>>>> hieu/update-feature
            $category->update($data);
            RouterHelper::sync('categories', $category->id, $data['canonical'] ?? null, $category->name);
            $this->nestedset = new Nestedsetbie([
                'table' => 'categories',
            ]);
            $this->nestedset();
            return redirect()
                ->route('admin.categories.index')
                ->with('success', 'Cập nhật danh mục thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Không cập nhật được danh mục' . $e->getMessage());
        }
    }


    public function delete($id)
    {
        try {
            $category = Category::findOrFail($id);
            RouterHelper::delete('categories', $category->id);
            if (!empty($category->image)) {
                Storage::disk('public')->delete($category->image);
            }
<<<<<<< HEAD
=======
            if (!empty($category->icon)) {
                Storage::disk('public')->delete($category->icon);
            }
>>>>>>> hieu/update-feature
            $category->delete();
            return redirect()->route('admin.categories.index')->with('success', 'Xóa danh mục thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Không xóa được danh mục' . $e->getMessage());
        }
    }

    private function nestedset()
    {
        $this->nestedset->Get('level ASC, order ASC');
        $this->nestedset->Recursive(0, $this->nestedset->Set());
        $this->nestedset->Action();
    }
}
