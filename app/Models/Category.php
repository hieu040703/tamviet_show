<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'name',
        'image',
        'description',
        'content',
        'status',
        'is_featured',
        'seo_title',
        'seo_keyword',
        'seo_description',
        'canonical',
        'seo_image',
        'parent_id',
        'order',
        'lft',
        'rgt',
        'level',
        'icon'
    ];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id')->where('status', 1);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'category_product');
    }


    public function breadcrumbTrail()
    {
        $trail = collect();
        $cat = $this;

        while ($cat) {
            $trail->push($cat);
            $cat = $cat->parent;
        }

        return $trail->reverse()->values();
    }
}
