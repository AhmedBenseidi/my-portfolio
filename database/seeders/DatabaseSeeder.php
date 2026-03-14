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
        'name' => 'Ahmed BENSEIDI',
        'email' => 'ahmedbenseidi@admin.com',
        'password' => bcrypt('z/e@r8$4çuèDaF_àef65VF'), // تأكد من تغيير كلمة المرور
    ]);
    }
}
