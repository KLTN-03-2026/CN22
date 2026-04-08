<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
            $user = User::where('email', $googleUser->getEmail())->first();

            if ($user) {
                $user->update([
                    'avatar' => $googleUser->getAvatar(),
                ]);
            } else {
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'avatar' => $googleUser->getAvatar(),
                    'password' => bcrypt(Str::random(24)), // Tạo password ngẫu nhiên, user sẽ không dùng nó
                    'email_verified_at' => now(), // Google đã xác thực email
                    'role_id' => 2,
                    'is_active' => 1,
                ]);
            }

            $token = $user->createToken('auth_token')->plainTextToken;

            $redirectUrl = env('FRONTEND_URL') . '/auth/callback?token=' . $token;

            return redirect($redirectUrl);

        } catch (\Exception $e) {
            return redirect(env('FRONTEND_URL') . '/login?error=auth_failed');
        }
    }
}
