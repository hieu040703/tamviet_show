<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Traits\HandlesUploads;
use App\Http\Controllers\Traits\HandlesQrCode;
use App\Helpers\RouterHelper;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    use HandlesUploads;
    use HandlesQrCode;

    protected int $limit = 15;

    public function index(Request $request)
    {
        $data['sidebar'] = 'Product';
        $data['sidebar_child'] = 'Product';
        $data['title'] = 'Danh Sách Sản Phẩm';
        $data['breadcrumb'] = [
            ['route' => 'admin.products.index', 'name' => 'Danh Sách Sản Phẩm'],
        ];
        $products = Product::query()->with(['category', 'brand']);
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $products->where(function ($q) use ($keyword) {
                $q->where('name', 'like', '%' . $keyword . '%')
                    ->orWhere('code', 'like', '%' . $keyword . '%')
                    ->orWhere('sku', 'like', '%' . $keyword . '%');
            });
        }
        $products->orderByDesc('id');
        $data['products'] = $products->paginate($this->limit);
        $data['model'] = 'Product';
        return view('backend.products.index', $data);
    }

    public function create()
    {
        $data['sidebar'] = 'Product';
        $data['sidebar_child'] = 'Product';
        $data['title'] = 'Thêm Mới Sản Phẩm';
        $data['breadcrumb'] = [
            ['route' => 'admin.products.index', 'name' => 'Danh Sách Sản Phẩm'],
            ['route' => 'admin.products.create', 'name' => 'Thêm Mới Sản Phẩm'],
        ];
        $data['categories'] = Category::orderBy('name')->get();
        $data['brands'] = Brand::orderBy('name')->get();
        $data['product'] = new Product([
            'code' => Product::generateCode(),
            'sku' => Product::generateSku(),
        ]);
        $data['model'] = 'Product';
        return view('backend.products.form', $data);
    }

    public function store(ProductRequest $request)
    {
        try {
            $data = $request->validated();
            $data['user_id'] = Auth::id();
            if (empty($data['code'])) {
                $data['code'] = Product::generateCode();
            }
            if (empty($data['sku'])) {
                $data['sku'] = Product::generateSku();
            }
            $this->handleUploads($request, $data, 'products');
            $this->handleUploads($request, $data, 'products', null, 'icon');
            $this->handleAlbumUploads($request, $data, 'products');
            $product = Product::create($data);
            RouterHelper::sync('products', $product->id, $data['canonical'] ?? null, $product->name);
            $this->generateQrForModel('product.show', $product);
            return redirect()->route('admin.products.index')->with('success', 'Tạo sản phẩm + QR thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Không thêm được sản phẩm' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $data['sidebar'] = 'Product';
        $data['sidebar_child'] = 'Product';
        $data['title'] = 'Sửa Sản Phẩm';
        $data['product'] = Product::findOrFail($id);
        $data['id'] = $id;
        $data['categories'] = Category::orderBy('name')->get();
        $data['brands'] = Brand::orderBy('name')->get();
        $data['model'] = 'Product';
        return view('backend.products.form', $data);
    }

    public function update(ProductRequest $request, $id)
    {
        try {
            $product = Product::findOrFail($id);
            $data = $request->validated();
            $this->handleUploads($request, $data, 'products', $product);
            $this->handleUploads($request, $data, 'products', $product, 'icon');
            $this->handleAlbumUploads($request, $data, 'products', $product);
            $product->update($data);
            RouterHelper::sync('products', $product->id, $data['canonical'] ?? null, $product->name);
            $this->generateQrForModel('product.show', $product);
            return redirect()->route('admin.products.index')->with('success', 'Cập nhật sản phẩm + QR thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Không cập nhật được sản phẩm' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $product = Product::findOrFail($id);
            RouterHelper::delete('products', $product->id);
            if (!empty($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            if (!empty($product->icon)) {
                Storage::disk('icon')->delete($product->icon);
            }
            $this->deleteAlbumFiles($product);
            $product->delete();
            return redirect()->route('admin.products.index')->with('success', 'Xóa sản phẩm + QR thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Không xóa được sản phẩm' . $e->getMessage());
        }
    }
}
