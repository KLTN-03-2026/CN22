<?php

namespace App\Services;

use App\Mail\SendOtpMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Repositories\UserRepository;
use App\Repositories\OtpRepository;

class AuthService
{
    protected $userRepo;
    protected $otpRepo;

    public function __construct(UserRepository $userRepo, OtpRepository $otpRepo)
    {
        $this->userRepo = $userRepo;
        $this->otpRepo = $otpRepo;
    }

    // REGISTER
    public function register($data)
    {
        $existingUser = $this->userRepo->findByEmail($data['email']);
        if ($existingUser) {
            throw new \Exception('Email đã tồn tại. Vui lòng sử dụng email khác.');
        }

        $user = $this->userRepo->createInactive($data);

        $otp = rand(100000, 999999);

        $this->otpRepo->create($data['email'], $otp);

        Mail::to($data['email'])->send(new SendOtpMail($otp, $data['name']));

        return [
            'message' => 'OTP đã được gửi đến email của bạn. Vui lòng kiểm tra và xác nhận tài khoản.'
        ];
    }

    // VERIFY OTP
    public function verifyOtp($data)
    {
        $otp = $this->otpRepo->findValid($data['email'], $data['code']);

        if (!$otp) {
            throw new \Exception('Mã OTP không hợp lệ hoặc đã hết hạn.');
        }

        $this->userRepo->activateUser($data['email']);

        $this->otpRepo->markUsed($otp->id);

        return [
            'message' => 'Tài khoản đã được kích hoạt thành công. Bạn có thể đăng nhập ngay bây giờ.'
        ];
    }

    // RESEND OTP
    public function resendOtp($data)
    {
        $user = $this->userRepo->findByEmail($data['email']);

        if (!$user) {
            throw new \Exception('Email không tồn tại. Vui lòng đăng ký tài khoản trước.');
        }

        if ($user->is_active) {
            throw new \Exception('Tài khoản đã được kích hoạt. Vui lòng đăng nhập.');
        }

        $otp = rand(100000, 999999);

        $this->otpRepo->create($data['email'], $otp);

        Mail::to($data['email'])->send(new SendOtpMail($otp, $user->name));

        return [
            'message' => 'OTP mới đã được gửi đến email của bạn. Vui lòng kiểm tra và xác nhận tài khoản.'
        ];
    }


    // LOGIN
    public function login($data)
    {
        $user = $this->userRepo->findByEmail($data['email']);

        if (!$user || !Hash::check($data['password'], $user->password)) {
            throw new \Exception('Email hoặc mật khẩu không đúng.');
        }

        if (!$user->is_active) {
            throw new \Exception('Tài khoản chưa được kích hoạt. Vui lòng kiểm tra email để xác nhận tài khoản.');
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token
        ];
    }

    public function me($user)
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role->name
        ];
    }

    // LOGOUT
    public function logout($user)
    {
        $user->tokens()->delete();

        return [
            'message' => 'Đăng xuất thành công.'
        ];
    }
}
