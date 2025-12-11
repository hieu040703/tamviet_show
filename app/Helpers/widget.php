<?php

use App\Models\Widget;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\PostCatalogue;
use App\Models\Post;

if (!function_exists('widget_items')) {
    function widget_items(?string $keyword = null, int $limit = 20): array
    {
        if (empty($keyword)) {
            return ['widget' => null, 'items' => collect()];
        }

        $widget = Widget::where('keyword', $keyword)
            ->where('status', 1)
            ->first();

        $result = [
            'widget' => $widget,
            'items' => collect(),
        ];

        if (!$widget || empty($widget->model_id)) {
            return $result;
        }

        $map = [
            'categories'      => Category::class,
            'brands'          => Brand::class,
            'products'        => Product::class,
            'post_catalogues' => PostCatalogue::class,
            'posts'           => Post::class,
        ];

        $modelClass = $map[$widget->model] ?? null;
        if (!$modelClass) {
            return $result;
        }

        $ids = is_array($widget->model_id) ? $widget->model_id : (array) $widget->model_id;
        if (empty($ids)) {
            return $result;
        }

        $idList = implode(',', $ids);

        $items = $modelClass::query()
            ->whereIn('id', $ids)
            ->where('status', 1)
            ->orderByRaw('FIELD(id,' . $idList . ')')
            ->take($limit)
            ->get();

        $result['items'] = $items;

        return $result;
    }
}
