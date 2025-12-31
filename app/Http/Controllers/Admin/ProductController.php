<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Nestedsetbie;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\AttributeCatalogue;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\ProductVariantAttribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Traits\HandlesUploads;
use App\Http\Controllers\Traits\HandlesQrCode;
use App\Helpers\RouterHelper;
use Illuminate\Support\Facades\DB;
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
        $data['attributeCatalogue'] = $this->AttributeCatalogue();
        $data['model'] = 'Product';
        return view('backend.products.form', $data);
    }

    public function store(ProductRequest $request)
    {
        try {
            DB::beginTransaction();
            $product = $this->createProduct($request);
            $this->nestedset = new Nestedsetbie([
                'table' => 'categories',
            ]);
            $this->nestedset();
            if ($product->id > 0) {
                if ($request->input('attribute')) {
                    $this->createVariant($product, $request);
                }
            }
            DB::commit();
            return redirect()->route('admin.products.index')->with('success', 'Tạo sản phẩm + QR thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Không thêm được sản phẩm' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $data['sidebar'] = 'Product';
        $data['sidebar_child'] = 'Product';
        $data['title'] = 'Sửa Sản Phẩm';
        $data['product'] = Product::with(['categories', 'product_variants'])->findOrFail($id);
        $data['id'] = $id;
        $data['attributeCatalogue'] = $this->AttributeCatalogue();
        $data['categories'] = Category::orderBy('name')->get();
        $data['brands'] = Brand::orderBy('name')->get();

        if ($data['product']->product_variants && count($data['product']->product_variants) > 0) {
            $variantData = $this->formatVariantForEdit($data['product']);
            $data['product']->variant = json_encode($variantData);
        }

        $data['model'] = 'Product';
        return view('backend.products.form', $data);
    }

    public function update(ProductRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $product = Product::findOrFail($id);
            $data = $request->validated();
            $this->handleUploads($request, $data, 'products', $product);
            $this->handleUploads($request, $data, 'products', $product, 'icon');
            $this->handleAlbumUploads($request, $data, 'products', $product);
            $data['attributeCatalogue'] = $this->formatJson($request, 'attributeCatalogue') ?: null;
            $data['attribute'] = $this->formatJson($request, 'attribute') ?: null;
            $variantData = $request->input('variant');
            if ($variantData && isset($variantData['album'])) {
                foreach ($variantData['album'] as $key => $album) {
                    if (is_string($album)) {
                        $decoded = json_decode($album, true);
                        $variantData['album'][$key] = is_array($decoded) ? $decoded : [];
                    }
                }
            }
            $data['variant'] = $variantData ? json_encode($variantData) : null;
            $product->update($data);
            $product->categories()->sync($request->category_ids);
            if ($request->input('attribute')) {
                $oldVariants = $product->product_variants()->get();
                $oldAlbums = [];
                foreach ($oldVariants as $variant) {
                    if ($variant->album) {
                        $images = json_decode($variant->album, true);
                        if (is_array($images)) {
                            $oldAlbums = array_merge($oldAlbums, $images);
                        }
                    }
                }
                $product->product_variants()->delete();
                $this->createVariant($product, $request);
                $newAlbums = [];
                if ($variantData && isset($variantData['album'])) {
                    foreach ($variantData['album'] as $album) {
                        if (is_array($album)) {
                            $newAlbums = array_merge($newAlbums, $album);
                        }
                    }
                }
                $imagesToDelete = array_diff($oldAlbums, $newAlbums);
                foreach ($imagesToDelete as $imagePath) {
                    if (file_exists(public_path($imagePath))) {
                        unlink(public_path($imagePath));
                    }
                }
            }
            RouterHelper::sync('products', $product->id, $data['canonical'] ?? null, $product->name);
            $this->generateQrForModel('product.show', $product);

            DB::commit();
            return redirect()->route('admin.products.index')->with('success', 'Cập nhật sản phẩm + QR thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Không cập nhật được sản phẩm: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();

            $product = Product::findOrFail($id);

            RouterHelper::delete('products', $product->id);

            if (!empty($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            if (!empty($product->icon)) {
                Storage::disk('icon')->delete($product->icon);
            }

            $this->deleteAlbumFiles($product);
            $this->deleteOldVariantImages($product);

            $product->delete();

            DB::commit();
            return redirect()->route('admin.products.index')->with('success', 'Xóa sản phẩm + QR thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Không xóa được sản phẩm: ' . $e->getMessage());
        }
    }

    private function formatVariantForEdit($product)
    {
        $variantData = [
            'quantity' => [],
            'sku' => [],
            'album' => []
        ];

        foreach ($product->product_variants as $variant) {
            $variantData['quantity'][] = $variant->quantity;
            $variantData['sku'][] = $variant->sku;

            if (!empty($variant->album)) {
                $album = json_decode($variant->album, true);
                $variantData['album'][] = is_array($album) ? $album : [];
            } else {
                $variantData['album'][] = [];
            }
        }
        return $variantData;
    }

    private function deleteOldVariantImages($product)
    {
        $oldVariants = $product->product_variants;

        foreach ($oldVariants as $variant) {
            if ($variant->album) {
                $images = json_decode($variant->album, true);

                if (is_array($images)) {
                    foreach ($images as $imagePath) {
                        if (file_exists(public_path($imagePath))) {
                            unlink(public_path($imagePath));
                        }
                    }
                }
            }
        }
    }

    private function AttributeCatalogue()
    {
        return AttributeCatalogue::all()->map(function ($item) {
            return [
                'id' => $item->id,
                'name' => $item->name
            ];
        });
    }

    private function createProduct($request)
    {
        $payload = $request->only($this->payload());
        $payload['user_id'] = Auth::id();
        $payload['code'] = Product::generateCode();
        $payload['sku'] = Product::generateSku();
        $payload['attributeCatalogue'] = $this->formatJson($request, 'attributeCatalogue') ?: null;
        $payload['attribute'] = $this->formatJson($request, 'attribute') ?: null;
        $payload['variant'] = $this->formatJson($request, 'variant') ?: null;
        $this->handleUploads($request, $payload, 'products');
        $this->handleUploads($request, $payload, 'products', null, 'icon');
        $this->handleAlbumUploads($request, $payload, 'products');
        $product = Product::create($payload);
        $product->categories()->sync($request->category_ids);
        RouterHelper::sync('products', $product->id, $data['canonical'] ?? null, $product->name);
        $this->generateQrForModel('product.show', $product);
        return $product;
    }

    private function createVariant($product, $request)
    {
        $payload = $request->only(['variant', 'productVariant', 'attribute']);
        $variant = $this->createVariantArray($payload, $product);
        $variants = $product->product_variants()->createMany($variant);
        $variantsId = $variants->pluck('id');
        $variantAttribute = [];
        $attributeCombines = $this->comebineAttribute(array_values($payload['attribute']));
        if (count($variantsId)) {
            foreach ($variantsId as $key => $val) {
                if (count($attributeCombines)) {
                    foreach ($attributeCombines[$key] as $attributeId) {
                        $variantAttribute[] = [
                            'product_variant_id' => $val,
                            'attribute_id' => $attributeId
                        ];
                    }
                }
            }
        }
        $variantAttribute = ProductVariantAttribute::insert($variantAttribute);
    }

    private function createVariantArray($payload, $product): array
    {
        $variant = [];
        if (isset($payload['variant']['sku']) && count($payload['variant']['sku'])) {
            foreach ($payload['variant']['sku'] as $key => $val) {
                $sku = $val;
                while (\App\Models\ProductVariant::where('sku', $sku)->exists()) {
                    $sku = $val . '-' . strtoupper(\Illuminate\Support\Str::random(4));
                }
                $albumData = $payload['variant']['album'][$key] ?? [];
                if (is_string($albumData)) {
                    $decoded = json_decode($albumData, true);
                    $albumData = is_array($decoded) ? $decoded : [];
                }

                $albumJson = is_array($albumData) ? json_encode($albumData) : '[]';
                $variant[] = [
                    'uuid' => (string)\Ramsey\Uuid\Uuid::uuid4(),
                    'quantity' => $payload['variant']['quantity'][$key] ?? 0,
                    'sku' => $sku,
                    'name' => $payload['productVariant']['name'][$key] ?? '',
                    'user_id' => \Illuminate\Support\Facades\Auth::id(),
                    'album' => $albumJson,
                    'product_id' => $product->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }
        return $variant;
    }

    private function comebineAttribute($attributes = [], $index = 0)
    {
        if ($index === count($attributes)) return [[]];

        $subCombines = $this->comebineAttribute($attributes, $index + 1);
        $combines = [];
        foreach ($attributes[$index] as $key => $val) {
            foreach ($subCombines as $keySub => $valSub) {
                $combines[] = array_merge([$val], $valSub);
            }
        }
        return $combines;
    }

    public function formatJson($request, $inputName)
    {
        $value = $request->input($inputName);
        if (!$value || empty($value) || $value === '' || $value === []) {
            return null;
        }

        return json_encode($value);
    }

    private function nestedset()
    {
        $this->nestedset->Get('level ASC, orders ASC');
        $this->nestedset->Recursive(0, $this->nestedset->Set());
        $this->nestedset->Action();
    }

    private function payload()
    {
        return [
            'category_id',
            'brand_id',
            'user_id',
            'name',
            'code',
            'sku',
            'qr_code',
            'quantity',
            'description',
            'content',
            'album',
            'status',
            'is_featured',
            'seo_title',
            'seo_keyword',
            'seo_description',
            'canonical',
            'image',
            'note',
            'icon',
            'variant',
            'attribute',
            'attributeCatalogue',
        ];
    }
}
