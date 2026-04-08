<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\RegisterRequest;
use Illuminate\Http\Request;
use App\Services\AuthService;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request)
    {
        return response()->json(
            $this->authService->register($request->all())
        );
    }

    public function verifyOtp(Request $request)
    {
        return response()->json(
            $this->authService->verifyOtp($request->all())
        );
    }

    public function resendOtp(Request $request)
    {
        return response()->json(
            $this->authService->resendOtp($request->all())
        );
    }

    public function login(Request $request)
    {
        return response()->json(
            $this->authService->login($request->all())
        );
    }

    public function logout(Request $request)
    {
        return response()->json(
            $this->authService->logout($request->user())
        );
    }

    public function me(Request $request)
    {
        return response()->json(
            $this->authService->me($request->user())
        );
    }
}
