<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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
}
