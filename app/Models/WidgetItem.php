<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WidgetItem extends Model
{
    protected $fillable = [
        'widget_id',
        'object_type',
        'object_id',
        'title',
        'link',
        'image',
        'sort_order',
        'is_active',
    ];

    public function widget()
    {
        return $this->belongsTo(Widget::class);
    }
}
