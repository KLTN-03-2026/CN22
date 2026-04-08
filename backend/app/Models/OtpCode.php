<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OtpCode extends Model
{
    protected $table = 'otp_codes';
    protected $fillable = [
        'email',
        'code',
        'expired_at',
        'is_used',
    ];

    protected static function booted()
    {
        static::addGlobalScope('valid', function ($query) {
            $query->where('expired_at', '>', now())
                  ->where('is_used', 0);
        });
    }
}
