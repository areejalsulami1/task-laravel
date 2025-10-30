<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'Admin User',
                'age' => 28,
                'email' => 'admin@example.com',
                'password' => Hash::make('123456'), // كلمة مرور الأدمن
            ]
        );
    }
}
