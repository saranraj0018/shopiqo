<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }
}
