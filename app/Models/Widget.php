<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Widget extends Model
{
    protected $fillable = [
        'name',
        'code',
        'position',
        'is_active',
    ];

    public function items()
    {
        return $this->hasMany(WidgetItem::class)->orderBy('sort_order');
    }
}
