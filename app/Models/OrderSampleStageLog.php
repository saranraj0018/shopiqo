<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderSampleStageLog extends Model
{
    protected $fillable = [
        'order_id',
        'stage',
        'note',
        'created_by',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    public function getStageLabelAttribute()
    {
        return Order::SAMPLE_STAGES[$this->stage] ?? null;
    }
}
