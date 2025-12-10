<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Router extends Model
{
    protected $table = 'routers';

    protected $fillable = [
        'canonical',
        'module',
        'object_id',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'object_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'object_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'object_id');
    }

    public function postCatalogue()
    {
        return $this->belongsTo(PostCatalogue::class, 'object_id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'object_id');
    }
}
