<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerifySePayWebhook
{
    public function handle(Request $request, Closure $next)
    {
        \Log::info('=== WEBHOOK HIT ===');
        \Log::info('=== SEPAY WEBHOOK RAW ===');
        \Log::info($request->getContent());

        \Log::info('=== SEPAY WEBHOOK HEADERS ===');
        \Log::info($request->headers->all());

        \Log::info('=== SEPAY WEBHOOK PARSED ===');
        \Log::info($request->all());
        /*
        |--------------------------------------------------------------------------
        | 1. VERIFY SIGNATURE
        |--------------------------------------------------------------------------
        */
        $signature = $request->header('X-SEPAY-SIGNATURE');

        if ($signature) {
            $payload = $request->getContent();
            $secret = env('SEPAY_WEBHOOK_SECRET');

            $hash = hash_hmac('sha256', $payload, $secret);

            if (!hash_equals($hash, $signature)) {
                return response()->json(['error' => 'Invalid signature'], 403);
            }
        }

        return $next($request);
    }
}
