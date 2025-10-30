<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1) أدمن ثابت
        $this->call(AdminUserSeeder::class);

        // 2) 10 مستخدمين تجريبيين عبر الـ Factory (كلهم بكلمة مرور password123)
        //User::factory()->count(10)->create();
    }
}
