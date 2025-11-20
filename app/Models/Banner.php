<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = 'banners';
    protected $fillable = [
        'name',
        'code',
        'position',
        'status',
    ];
    protected $casts = [
        'status' => 'boolean',
    ];
    public function items()
    {
        return $this->hasMany(BannerItem::class, 'banner_id', 'id')
            ->orderBy('sort_order')
            ->orderByDesc('id');
    }
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
