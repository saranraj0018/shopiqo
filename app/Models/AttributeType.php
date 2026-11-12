<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeType extends Model
{
    protected $table = 'variant_attributes';

    public function get_variant_value()
    {
        return $this->hasMany(AttributeValue::class, 'attribute_id', 'id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }
}
