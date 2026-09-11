<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Occasion extends Model
{
    protected $casts = [
        'is_active' => 'boolean',
        'highlight_from' => 'date',
        'highlight_until' => 'date',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_occasion_tags');
    }
}
