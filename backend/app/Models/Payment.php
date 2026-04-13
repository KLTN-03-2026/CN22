<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'order_id',
        'method',
        'transaction_code',
        'amount',
        'status',
        'raw_data',
        'paid_at'
    ];

    protected $casts = [
        'raw_data' => 'array',
        'paid_at' => 'datetime'
    ];

    const SUCCESS = 1;
    const FAILED = 2;
    const PENDING = 0;
    
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
