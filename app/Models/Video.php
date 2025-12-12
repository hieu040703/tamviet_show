<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Video extends Model
{
    use SoftDeletes;

    protected $table = 'videos';

    protected $fillable = [
        'user_id',
        'name',
        'canonical',
        'image',
        'youtube_id',
        'description',
        'is_featured',
        'status',
        'sort_order',
        'seo_title',
        'seo_keyword',
        'seo_description',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'status' => 'integer',
    ];
}
