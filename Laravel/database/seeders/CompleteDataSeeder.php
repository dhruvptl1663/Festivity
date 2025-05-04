<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompleteDataSeeder extends Seeder
{
    public function run()
    {
        // Disable foreign key checks to allow truncating tables with relationships
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Truncate tables in reverse order of dependencies
        DB::table('bookmarks')->truncate();
        DB::table('notifications')->truncate();
        DB::table('booking_cancellations')->truncate();
        DB::table('applied_promo_codes')->truncate();
        DB::table('promo_codes')->truncate();
        DB::table('admin_commissions')->truncate();
        DB::table('feedback')->truncate();
        DB::table('bookings')->truncate();
        DB::table('package_events')->truncate();
        DB::table('packages')->truncate();
        DB::table('events')->truncate();
        DB::table('contacts')->truncate();
        DB::table('carts')->truncate();
        DB::table('decorators')->truncate();
        DB::table('categories')->truncate();
        
        // We don't truncate users and admins tables to preserve existing logins
        // If you want to replace those too, uncomment the lines below
        // DB::table('users')->truncate();
        // DB::table('admins')->truncate();
        
        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        // Paths to SQL files
        $paths = [
            database_path('seeders/part1_categories_users_decorators.sql'),
            database_path('seeders/part2_events.sql'),
            database_path('seeders/part3_packages_and_events.sql'),
            database_path('seeders/part4_bookings.sql'),
            database_path('seeders/part5_feedback_and_cancellations.sql'),
            database_path('seeders/part6_remaining_tables.sql'),
        ];

        // Process and execute each SQL file
        foreach ($paths as $path) {
            $sql = file_get_contents($path);
            DB::unprepared($sql);
        }
    }
}
