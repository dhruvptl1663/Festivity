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
        // Run admin user seeder first
        $this->call(AdminUserSeeder::class);

        // Create test user for development
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->call([
            PromoCodeSeeder::class
        ]);
        
        $this->call([
            CompleteDataSeeder::class,
        ]);
    }
}
