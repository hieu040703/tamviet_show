<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD

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
=======
use Illuminate\Database\Eloquent\SoftDeletes;

class Widget extends Model
{
    use SoftDeletes;

    protected $table = 'widgets';

    protected $fillable = [
        'name',
        'keyword',
        'description',
        'album',
        'model_id',
        'model',
        'short_code',
        'sort_order',
        'status',
    ];

    protected $casts = [
        'album' => 'array',
        'model_id' => 'array',
        'status' => 'integer',
        'sort_order' => 'integer',
    ];
>>>>>>> hieu/update-feature
}
