<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BannerItem extends Model
{
    protected $table = 'banner_items';

    protected $fillable = [
        'banner_id',
        'title',
        'subtitle',
        'image',
        'link',
        'sort_order',
        'status',
        'start_at',
        'end_at',
    ];

    protected $casts = [
        'status' => 'boolean',
        'start_at' => 'datetime',
        'end_at' => 'datetime',
    ];

    public function banner()
    {
        return $this->belongsTo(Banner::class, 'banner_id', 'id');
    }

    public function scopeActive($query)
    {
        $now = now();
        return $query->where('status', 1)->where(function ($q) use ($now) {
            $q->whereNull('start_at')->orWhere('start_at', '<=', $now);
        })
            ->where(function ($q) use ($now) {
                $q->whereNull('end_at')->orWhere('end_at', '>=', $now);
            });
    }
}
