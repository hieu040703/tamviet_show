<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Post;
use App\Models\PostCatalogue;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WidgetController extends Controller
{
    public function searchItems(Request $request)
    {
        $request->validate([
            'module' => 'required|string',
            'keyword' => 'nullable|string',
        ]);
        $keyword = $request->keyword;
        $module = $request->module;
        $query = null;
        $label = '';
        switch ($module) {
            case 'products':
                $query = Product::query();
                $label = 'Sản phẩm';
                break;
            case 'categories':
                $query = Category::query();
                $label = 'Nhóm sản phẩm';
                break;
            case 'brands':
                $query = Brand::query();
                $label = 'Thương hiệu';
                break;
            case 'posts':
                $query = Post::query();
                $label = 'Bài viết';
                break;
            case 'post_catalogues':
                $query = PostCatalogue::query();
                $label = 'Nhóm bài viết';
                break;
        }
        if (!$query) {
            return response()->json(['status' => false, 'data' => []]);
        }
        if ($keyword) {
            $query->where('name', 'like', "%$keyword%");
        }
        $items = $query->limit(20)->get()->map(function ($item) use ($label) {
            $path = $item->image ?? null;
            $url = $path ? Storage::url($path) : null;
            return [
                'id' => $item->id,
                'name' => $item->name,
                'image_url' => $url,
                'moduleName' => $label,
            ];
        });

        return response()->json([
            'status' => true,
            'data' => $items,
        ]);
    }
}
