<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'name',
        'image',
        'icon',
        'description',
        'status',
        'is_featured',
        'seo_title',
        'seo_keyword',
        'seo_description',
        'canonical'
    ];
}
