<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostCatalogue extends Model
{
    use SoftDeletes;

    protected $table = 'post_catalogues';
    protected $fillable = [
        'name',
        'description',
        'content',
        'image',
        'status',
        'is_featured',
        'lft',
        'rgt',
        'level',
        'order',
        'parent_id',
        'seo_title',
        'seo_keyword',
        'seo_description',
        'canonical',
        'image',
        'icon'
    ];

    public function posts()
    {
        return $this->hasMany(Post::class, 'post_catalogue_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
