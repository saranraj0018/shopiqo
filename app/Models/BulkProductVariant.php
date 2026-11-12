<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BulkProductVariant extends Model
{
    protected $fillable = [
        'bulk_product_id',
        'attribute_id',
        'attribute_value_id',
    ];

    public function bulkProduct()
    {
        return $this->belongsTo(BulkProduct::class);
    }

    public function attribute()
    {
        return $this->belongsTo(AttributeType::class, 'attribute_id');
    }

    public function attributeValue()
    {
        return $this->belongsTo(AttributeValue::class, 'attribute_value_id');
    }
}
