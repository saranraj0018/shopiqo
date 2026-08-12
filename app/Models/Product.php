<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'sub_category_id',
        'name',
        'product_type',
        'product_code',
        'description',
        'regular_price',
        'sale_price',
        'stock',
        'main_image',
    ];

    public function product_variant()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function get_category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function product_gallery_image()
    {
        return $this->hasMany(ProductGalleryImage::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    public function leastPricedVariant()
    {
        return $this->hasOne(ProductVariant::class, 'product_id')
            ->orderByRaw('COALESCE(sale_price, regular_price) ASC');
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class,'product_id');
    }
}
