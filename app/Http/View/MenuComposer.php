<?php

namespace App\Http\View;

use App\Models\Menu;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class MenuComposer
{
    public function compose(View $view): void
    {
        $data = $view->getData();
        $keyword = isset($data['menuKey']) ? $data['menuKey'] : 'main-menu';
        $cacheKey = 'menu_' . $keyword;
        $menu = Cache::remember($cacheKey, 600, function () use ($keyword) {
            return Menu::with([
                'items.router.category',
                'items.router.brand',
                'items.router.product',
                'items.router.postCatalogue',
                'items.router.post',
                'items.children.router.category',
                'items.children.router.brand',
                'items.children.router.product',
                'items.children.router.postCatalogue',
                'items.children.router.post',
            ])
                ->where('keyword', $keyword)
                ->where('status', 1)
                ->first();
        });
        $view->with('menu', $menu);
    }
}
