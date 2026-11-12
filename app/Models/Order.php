<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const SAMPLE_STAGES = [
        1 => 'Modul Process Started',
        2 => 'Designing Process',
        3 => 'Quality Check',
        4 => 'Working on Changes',
        5 => 'Ready For Review',
    ];

    protected $casts = [
        'shipped_at'         => 'datetime',
        'delivered_at'       => 'datetime',
        'cancelled_at'       => 'datetime',
        'refunded_at'        => 'datetime',
        'sample_approved_at' => 'datetime',
    ];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }

    public function sampleStageLogs()
    {
        return $this->hasMany(OrderSampleStageLog::class)->orderBy('created_at');
    }

    public function getSampleStageLabelAttribute()
    {
        return self::SAMPLE_STAGES[$this->sample_stage] ?? null;
    }

    public function Address()
    {
        return $this->belongsTo(Address::class, 'address_id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'order_id', 'order_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getStatusLabelAttribute()
    {
        return match ((int) $this->status) {
            1 => 'Pending',
            2 => 'In Progress',
            3 => 'Shipped',
            4 => 'Delivered',
            5 => 'Cancelled',
            6 => 'Refunded',
            default => 'Pending',
        };
    }

    public function getStatusBadgeClassAttribute()
    {
        return match ((int) $this->status) {
            1 => 'bg-white text-black',
            2 => 'bg-[#eef2ff] text-[#4f46e5]',
            3 => 'bg-[#fff3eb] text-[#f97316]',
            4 => 'bg-[#ecfdf3] text-[#22c55e]',
            5 => 'bg-[#fff1f3] text-[#f43f5e]',
            6 => 'bg-[#f3f4f6] text-[#6b7280]',
            default => 'bg-white text-black',
        };
    }
}
