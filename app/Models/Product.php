<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'category_id',
        'brand_id',
        'user_id',
        'name',
        'code',
        'sku',
        'qr_code',
        'quantity',
        'description',
        'content',
        'album',
        'status',
        'is_featured',
        'seo_title',
        'seo_keyword',
        'seo_description',
        'canonical',
        'image',
        'note',
        'icon'
    ];

    protected $casts = [
        'album' => 'array',
        'status' => 'boolean',
        'is_featured' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function generateCode(): string
    {
        return 'PRD-' . now()->format('Ymd') . '-' . Str::upper(Str::random(4));
    }

    public static function generateSku(): string
    {
        return 'SKU-' . Str::upper(Str::random(8));
    }
}
