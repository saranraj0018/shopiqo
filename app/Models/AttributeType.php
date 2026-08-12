<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeType extends Model
{
    public function get_variant_value()
    {
        return $this->hasMany(AttributeValue::class, 'attribute_type_id', 'id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }
}
