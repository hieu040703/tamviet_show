<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PostCatalogue;
use App\Models\Banner;

class HomePageController extends Controller
{
    public function getHomePage(Request $request)
    {
        $data['homeCategories'] = widget_items('home_category');
        $data['homeProductCategories'] = widget_items('home_product_category');
        $data['homeProductBrands'] = widget_items('home_product_brand');
        $data['healthCategories'] = widget_items('health_corner');
        $data['featuredArticle'] = widget_items('featured_article', 7);
        $data += $this->getHomeBanners();
        return view('frontend.home.index', $data);
    }


    protected function getHomeBanners(): array
    {
        $banners = Banner::with('items')->active()->whereIn('code', ['home_main_slider', 'home_top_right_banner',])->get()->keyBy('code');
        return [
            'homeMainBanner' => $banners->get('home_main_slider'),
            'homeRightBanner' => $banners->get('home_top_right_banner'),
        ];
    }
}
