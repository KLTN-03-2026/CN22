<?php

namespace App\Repositories;

use App\Models\OtpCode;

class OtpRepository
{
    public function create($email, $code)
    {
        return OtpCode::create([
            'email' => $email,
            'code' => $code,
            'expired_at' => now()->addMinute(2),
            'is_used' => 0
        ]);
    }

    public function findValid($email, $code)
    {
        return OtpCode::where('email', $email)
            ->where('code', $code)
            ->where('is_used', 0)
            ->where('expired_at', '>', now())
            ->first();
    }

    public function markUsed($id)
    {
        return OtpCode::where('id', $id)->update([
            'is_used' => 1
        ]);
    }
}
