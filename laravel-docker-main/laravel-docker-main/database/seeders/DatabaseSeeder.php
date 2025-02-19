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
        // Call the UserSeeder to insert specific predefined users
        $this->call(UserSeeder::class);

        // Optionally, generate random users using the factory
        User::factory(10)->create();
    }
}
