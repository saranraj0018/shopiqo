<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    protected $table = 'variant_attribute_values';

    public function get_attribute()
    {
        return $this->belongsTo(AttributeType::class, 'attribute_id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }
}
