<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        \App\Models\User::factory()->create([
        'name' => env('ADMIN_USERNAME','Admin'),
        'email' => env('ADMIN_EMAIL', 'admin@example.com'), // يجلب القيمة من .env
        'password' => bcrypt(env('ADMIN_PASSWORD', 'password123')), // يجلب كلمة المرور من .env
    ]);
    }
}
