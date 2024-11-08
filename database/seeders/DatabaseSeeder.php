<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //         User::factory(10)->create();

        User::factory()->create([
            'email' => 'admin@admin.com',
            'password' => 'password',
            'role' => 'admin',
        ]);

        User::factory()->create([
            'email' => 'user@user.com',
            'password' => 'password',
            'role' => 'user',
        ]);

        User::factory()->create([
            'email' => 'user2@user.com',
            'password' => 'password',
            'role' => 'user',
        ]);

    }
}
