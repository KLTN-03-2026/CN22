<?php

namespace App\Console\Commands;

use App\Models\OtpCode;
use Illuminate\Console\Command;

class CleanExpiredOtp extends Command
{
    protected $signature = 'otp:clean';
    protected $description = 'Xóa các OTP đã hết hạn';

    public function handle()
    {
        $deleted = OtpCode::where('expired_at', '<', now())->delete();

        $this->info("Đã xóa {$deleted} OTP hết hạn.");
    }
}
