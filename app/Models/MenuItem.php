<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class MenuItem extends Model
{
    protected $fillable = [
        'menu_id',
        'parent_id',
        'name',
        'router_id',
        'url',
        'target',
        'icon',
        'lft',
        'rgt',
        'level',
        'sort_order',
        'status',
    ];

    protected $appends = ['display_icon'];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function parent()
    {
        return $this->belongsTo(MenuItem::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(MenuItem::class, 'parent_id')
            ->where('status', 1)
            ->orderBy('sort_order');
    }

    public function router()
    {
        return $this->belongsTo(Router::class);
    }

    public function getDisplayIconAttribute(): string
    {
        if (!empty($this->icon)) {
            return Storage::url($this->icon);
        }

        $router = $this->router;

        if ($router) {
            if ($router->module === 'categories' && $router->category && !empty($router->category->icon)) {
                return Storage::url($router->category->icon);
            }

            if ($router->module === 'brands' && $router->brand && !empty($router->brand->icon)) {
                return Storage::url($router->brand->icon);
            }

            if ($router->module === 'products' && $router->product && !empty($router->product->image)) {
                return Storage::url($router->product->image);
            }

            if ($router->module === 'post_catalogue' && $router->postCatalogue && !empty($router->postCatalogue->image)) {
                return Storage::url($router->postCatalogue->image);
            }

            if ($router->module === 'posts' && $router->post && !empty($router->post->image)) {
                return Storage::url($router->post->image);
            }
        }

        return asset('backend/img/not-found.jpg');
    }
}
