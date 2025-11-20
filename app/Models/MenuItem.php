<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
