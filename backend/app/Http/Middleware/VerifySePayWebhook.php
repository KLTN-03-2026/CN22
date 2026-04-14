<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerifySePayWebhook
{
    public function handle(Request $request, Closure $next)
    {
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

        /*
        |--------------------------------------------------------------------------
        | 2. VALIDATION
        |--------------------------------------------------------------------------
        */
        if (!$request->has('content') || !$request->has('amount')) {
            return response()->json(['error' => 'Invalid payload'], 400);
        }

        return $next($request);
    }
}
