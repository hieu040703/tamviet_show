<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PostCatalogue;

class HomePageController extends Controller
{
    public function getHomePage(Request $request)
    {
        $data['homeCategories'] = widget_items('home_category');
        $data['homeProductCategories'] = widget_items('home_product_category');
        $data['homeProductBrands'] = widget_items('home_product_brand');

        // Góc sức khỏe
        $data['healthCategories'] = $this->loadHealthCategories();

        return view('frontend.home.index', $data);
    }

    protected function loadHealthCategories(): array
    {
        $block = widget_items('health_corner');
        $items = collect($block['items'] ?? []);
        if ($items->isNotEmpty()) {
            $items->each(function ($cat) {
                if ($cat instanceof PostCatalogue) {
                    $cat->load(['posts' => function ($q) {
                        $q->where('status', 1)
                            ->orderBy('id', 'asc')
                            ->limit(7);
                    }]);
                }
            });
        }
        $block['items'] = $items;
        return $block;
    }
}
