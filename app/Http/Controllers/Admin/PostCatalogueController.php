<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Nestedsetbie;
use App\Http\Controllers\Controller;
use App\Models\PostCatalogue;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\HandlesUploads;
use App\Http\Requests\Admin\PostCatalogueRequest;
use App\Helpers\RouterHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostCatalogueController extends Controller
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
            'table' => 'post_catalogues',
        ]);
    }

    public function index(Request $request)
    {
        $data['sidebar'] = 'PostCatalogue';
        $data['sidebar_child'] = 'PostCatalogue';
        $data['title'] = 'Danh Sách Nhóm Bài Viết';
        $data['breadcrumb'] = [
            ['route' => 'admin.post_catalogues.index', 'name' => 'Danh Sách Nhóm Bài Viết'],
        ];
        $post_catalogues = PostCatalogue::query();
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $post_catalogues->where(function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            });
        }
        $post_catalogues->orderBy('lft', 'ASC');
        $data['post_catalogues'] = $post_catalogues->paginate($this->limit);
        $data['model'] = 'PostCatalogue';
        return view('backend.post.catalogue.index', $data);
    }

    public function create()
    {
        $data['sidebar'] = 'PostCatalogue';
        $data['sidebar_child'] = 'PostCatalogue';
        $data['title'] = 'Thêm Mới Nhóm Bài Viết';
        $data['breadcrumb'] = [
            ['route' => 'admin.post_catalogues.index', 'name' => 'Danh Sách Nhóm Bài Viết'],
            ['route' => 'admin.post_catalogues.create', 'name' => 'Thêm Mới Nhóm Bài Viết'],
        ];
        $data['dropdown'] = $this->nestedset->Dropdown();
        $data['model'] = 'PostCatalogue';
        return view('backend.post.catalogue.form', $data);
    }

    public function store(PostCatalogueRequest $request)
    {
        try {
            $data = $request->validated();
            $data['user_id'] = Auth::id();
            $this->handleUploads($request, $data, 'post_catalogues');
            $this->handleUploads($request, $data, 'post_catalogues', null, 'icon');
            $post_catalogue = PostCatalogue::create($data);
            RouterHelper::sync('post_catalogue', $post_catalogue->id, $data['canonical'] ?? null, $post_catalogue->name);
            $this->nestedset = new Nestedsetbie([
                'table' => 'post_catalogues',
            ]);
            $this->nestedset();
            return redirect()->route('admin.post_catalogues.index', $post_catalogue->id)->with('success', 'Tạo nhóm bài viết thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Không thêm được nhóm bài viết' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $data['sidebar'] = 'PostCatalogue';
        $data['sidebar_child'] = 'PostCatalogue';
        $data['title'] = 'Sửa Nhóm bài viết';
        $data['post_catalogue'] = PostCatalogue::findOrFail($id);
        $data['id'] = $id;
        $data['dropdown'] = $this->nestedset->Dropdown();
        $data['model'] = 'PostCatalogue';
        return view('backend.post.catalogue.form', $data);
    }

    public function update(PostCatalogueRequest $request, $id)
    {
        try {
            $post_catalogue = PostCatalogue::findOrFail($id);
            $data = $request->validated();
            $data['user_id'] = Auth::id();
            $this->handleUploads($request, $data, 'post_catalogues', $post_catalogue);
            $this->handleUploads($request, $data, 'post_catalogues', $post_catalogue, 'icon');
            $post_catalogue->update($data);
            RouterHelper::sync('post_catalogue', $post_catalogue->id, $data['canonical'] ?? null, $post_catalogue->name);
            $this->nestedset = new Nestedsetbie([
                'table' => 'post_catalogues',
            ]);
            $this->nestedset();
            return redirect()->route('admin.post_catalogues.index')->with('success', 'Cập nhật nhóm bài viết thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Không cập nhật được nhóm bài viết' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $postCatalogue = PostCatalogue::findOrFail($id);
            RouterHelper::delete('post_catalogue', $postCatalogue->id);
            if (!empty($postCatalogue->image)) {
                Storage::disk('public')->delete($postCatalogue->image);
            }
            if (!empty($postCatalogue->icon)) {
                Storage::disk('public')->delete($postCatalogue->icon);
            }
            $postCatalogue->delete();
            return redirect()->route('admin.post_catalogues.index')->with('success', 'Xóa nhóm bài viết thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Không xóa được nhóm bài viết' . $e->getMessage());
        }
    }

    private function nestedset()
    {
        $this->nestedset->Get('level ASC, order ASC');
        $this->nestedset->Recursive(0, $this->nestedset->Set());
        $this->nestedset->Action();
    }
}
