<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderTracking extends Model
{
    //
    protected $guarded = [];
    public function order()
    {
        return $this->belongsTo(Order::class)->withDefault();
    }
    protected $casts = [
        'status_date'   => 'datetime',
        'delivery_date' => 'datetime',
    ];
}
