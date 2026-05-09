<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $fillable = [
        'product_id',
        'regular_price',
        'sale_price',
        'stock',
        'pri_attribute_id',
        'cover_image',
        'minimum',
        'maximum'
    ];

    public function variantValues()
    {
        return $this->hasMany(ProductVariantValue::class, 'product_variant_id');
    }
}
