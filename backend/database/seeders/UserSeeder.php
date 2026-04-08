<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{

    public function run(): void
    {
        DB::table('users')->truncate();
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('1234567890'),
                'role_id' => 1,
                'avatar' => 'https://i.pravatar.cc/150?img=1',
                'remember_token' => null,
                'is_active' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 2,
                'name' => 'Nguyễn Văn Học',
                'email' => 'student@example.com',
                'password' => Hash::make('1234567890'),
                'role_id' => 2,
                'avatar' => 'https://i.pravatar.cc/150?img=2',
                'remember_token' => null,
                'is_active' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 3,
                'name' => 'Trần Thị Giảng',
                'email' => 'instructor@example.com',
                'password' => Hash::make('1234567890'),
                'role_id' => 2,
                'avatar' => 'https://i.pravatar.cc/150?img=3',
                'remember_token' => null,
                'is_active' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
