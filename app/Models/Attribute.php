<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attribute extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'attribute_catalogue_id',
        'name',
        'description',
        'status',
        'user_id',
    ];

    public function catalogues()
    {
        return $this->belongsToMany(AttributeCatalogue::class, 'attribute_catalogue_attribute', 'attribute_id', 'attribute_catalogue_id');
    }

    public function catalogue()
    {
        return $this->belongsTo(AttributeCatalogue::class, 'attribute_catalogue_id');
    }

    public function productVariants()
    {
        return $this->belongsToMany(
            ProductVariant::class,
            'product_variant_attribute',
            'attribute_id',
            'product_variant_id'
        );
    }

    public function productsCountByCategory($categoryId)
    {
        return $this->productVariants()
            ->whereHas('product.categories', function ($q) use ($categoryId) {
                $q->where('categories.id', $categoryId);
            })
            ->with('product')
            ->get()
            ->pluck('product')
            ->unique('id')
            ->count();
    }

    public function attributeCatalogue()
    {
        return $this->belongsTo(AttributeCatalogue::class, 'attribute_catalogue_id');
    }

    public function products()
    {
        return $this->hasManyThrough(
            Product::class,
            ProductVariant::class,
            'id',
            'id',
            'id',
            'product_id'
        );
    }
}
