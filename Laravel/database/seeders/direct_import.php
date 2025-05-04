<?php
// Direct database import script for Festivity project
// Run this script directly with PHP to import the database records

// Database connection parameters
$host = 'localhost';
$username = 'root'; // Default XAMPP username
$password = ''; // Default XAMPP password (blank)
$database = 'festivity_db'; // Change this to your actual database name

try {
    // Connect to MySQL using PDO
    $dsn = "mysql:host=$host;dbname=$database";
    $pdo = new PDO($dsn, $username, $password);
    
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Connected to database successfully.\n";
    
    // Disable foreign key checks to allow truncating tables with relationships
    $pdo->exec('SET FOREIGN_KEY_CHECKS=0');
    
    // Truncate tables in reverse order of dependencies
    $tables = [
        'bookmarks',
        'notifications',
        'booking_cancellations',
        'applied_promo_codes',
        'promo_codes',
        'admin_commissions',
        'feedback',
        'bookings',
        'package_events',
        'packages',
        'events',
        'contacts',
        'carts',
        'decorators',
        'categories',
        'users', // Note: This will remove existing users
        'admins', // Note: This will remove existing admins
    ];
    
    // Truncate all tables
    foreach ($tables as $table) {
        try {
            $pdo->exec("TRUNCATE TABLE `$table`");
            echo "Table $table truncated successfully.\n";
        } catch (PDOException $e) {
            echo "Error truncating table $table: " . $e->getMessage() . "\n";
        }
    }
    
    // Re-enable foreign key checks
    $pdo->exec('SET FOREIGN_KEY_CHECKS=1');
    
    // Get SQL files
    $sqlFiles = [
        __DIR__ . '/part1_categories_users_decorators.sql',
        __DIR__ . '/part2_events.sql',
        __DIR__ . '/part3_packages_and_events.sql',
        __DIR__ . '/part4_bookings.sql',
        __DIR__ . '/part5_feedback_and_cancellations.sql',
        __DIR__ . '/part6_remaining_tables.sql',
    ];
    
    // Execute SQL files
    foreach ($sqlFiles as $file) {
        echo "Importing $file...\n";
        
        if (!file_exists($file)) {
            echo "File does not exist: $file\n";
            continue;
        }
        
        $sql = file_get_contents($file);
        
        // Split the SQL file by semicolons to execute multiple queries
        $queries = explode(';', $sql);
        
        foreach ($queries as $query) {
            $query = trim($query);
            if (!empty($query)) {
                try {
                    $pdo->exec($query);
                    echo "Query executed successfully.\n";
                } catch (PDOException $e) {
                    echo "Error executing query: " . $e->getMessage() . "\n";
                    echo "Query: " . $query . "\n";
                }
            }
        }
        
        echo "Finished importing $file.\n";
    }
    
    echo "All SQL files imported successfully.\n";
    
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage() . "\n");
}
