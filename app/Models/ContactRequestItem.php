<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactRequestItem extends Model
{
    protected $table = 'contact_request_items';

    protected $fillable = [
        'contact_request_id',
        'product_id',
        'product_name',
        'product_slug',
        'product_image',
        'qty',
        'customer_id'
    ];

    protected $casts = [
        'qty' => 'integer',
    ];

    public function contactRequest()
    {
        return $this->belongsTo(ContactRequest::class, 'contact_request_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

}
