<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class System extends Model
{
    protected $table = 'systems';

    protected $fillable = [
        'user_id',
        'keyword',
        'content',
    ];

    public $timestamps = true;
}
