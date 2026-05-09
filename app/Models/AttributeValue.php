<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    public function get_attribute()
    {
        return $this->belongsTo(AttributeType::class, 'attribute_type_id');
    }
}
