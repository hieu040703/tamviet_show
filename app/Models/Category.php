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
    ];
}
