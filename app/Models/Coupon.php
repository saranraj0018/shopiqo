<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }
}
