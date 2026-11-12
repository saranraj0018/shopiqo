<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'product_variant_id',
        'quantity',
        'unit_price',
        'size_label',
        'color_label',
        'print_type',
        'logo_path',
        'logo_side',
        'logo_position_x',
        'logo_position_y',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'product_variant_id');
    }

    public function getLineTotalAttribute(): float
    {
        return round($this->quantity * $this->unit_price, 2);
    }
}
