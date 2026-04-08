<?php
namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserRepository
{
    public function findByEmail($email)
    {
        return User::where('email', $email)->first();
    }

    public function createInactive($data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id' => 2,
            'is_active' => 0
        ]);
    }

    public function activateUser($email)
    {
        return User::where('email', $email)->update([
            'is_active' => 1,
            'email_verified_at' => now()
        ]);
    }
}
