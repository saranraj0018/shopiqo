<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'phone_number',
        'address',
        'address_type',
        'city',
        'state',
        'pincode',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
