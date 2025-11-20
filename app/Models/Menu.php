<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'keyword',
        'type',
        'status',
    ];

    public function items()
    {
        return $this->hasMany(MenuItem::class)
            ->where(function ($q) {
                $q->whereNull('parent_id')->orWhere('parent_id', 0);
            })
            ->where('status', 1)
            ->orderBy('sort_order');
    }
}
