<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
<<<<<<< HEAD
=======
use App\Models\PostCatalogue;
use App\Models\Banner;
>>>>>>> hieu/update-feature

class HomePageController extends Controller
{
    public function getHomePage(Request $request)
    {
<<<<<<< HEAD
        return view('frontend.home.index');
=======
        $data['homeCategories'] = widget_items('home_category');
        $data['homeProductCategories'] = widget_items('home_product_category');
        $data['homeProductBrands'] = widget_items('home_product_brand');
        // Góc sức khỏe
        $data['healthCategories'] = $this->loadHealthCategories();
        $data += $this->getHomeBanners();
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

    protected function getHomeBanners(): array
    {
        $banners = Banner::with('items')->active()->whereIn('code', ['home_main_slider', 'home_top_right_banner',])->get()->keyBy('code');
        return [
            'homeMainBanner' => $banners->get('home_main_slider'),
            'homeRightBanner' => $banners->get('home_top_right_banner'),
        ];
>>>>>>> hieu/update-feature
    }
}
