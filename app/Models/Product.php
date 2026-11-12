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
        'per_piece_price',
        'stock',
        'main_image',
    ];

    public function product_variant()
    {
        return $this->hasMany(ProductVariant::class);
    }

    /**
     * Quantity-tier price ranges — only meaningful for product_type = 'bulk'.
     */
    public function bulkProducts()
    {
        return $this->hasMany(BulkProduct::class);
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

    public function leastPricedBulkTier()
    {
        return $this->hasOne(BulkProduct::class, 'product_id')
            ->orderByRaw('COALESCE(sale_price, regular_price) ASC');
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class,'product_id');
    }

    public function occasions()
    {
        return $this->belongsToMany(Occasion::class, 'product_occasion_tags');
    }

    /**
     * Pack sizes this product ships in, e.g. [10, 20, 50]. Falls back to a
     * sane default for products an admin hasn't configured this for yet.
     */
    public function getPackagingUnitsArrayAttribute(): array
    {
        if (!$this->packaging_units) {
            return [10, 20, 50];
        }

        $units = collect(explode(',', $this->packaging_units))
            ->map(fn ($value) => (int) trim($value))
            ->filter(fn ($value) => $value > 0)
            ->unique()
            ->sort()
            ->values()
            ->all();

        return $units ?: [10, 20, 50];
    }

    /**
     * Print methods this product supports, e.g. ['Laser', 'Screen Print'].
     */
    public function getPrintCapabilityArrayAttribute(): array
    {
        if (!$this->print_capability) {
            return [];
        }

        return collect(explode(',', $this->print_capability))
            ->map(fn ($value) => trim($value))
            ->filter()
            ->values()
            ->all();
    }
}
