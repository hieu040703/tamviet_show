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
            return Menu::with(['items.router', 'items.children.router'])
                ->where('keyword', $keyword)
                ->where('status', 1)
                ->first();
        });
        $view->with('menu', $menu);
    }
}
