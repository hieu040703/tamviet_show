<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'content',
        'image',
        'post_catalogue_id',
        'user_id',
        'status',
        'is_featured',
        'view_count',
        'seo_title',
        'seo_keyword',
        'seo_description',
        'canonical',
    ];

    public function catalogue()
    {
        return $this->belongsTo(PostCatalogue::class, 'post_catalogue_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
