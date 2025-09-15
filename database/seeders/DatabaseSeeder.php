<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create default admin user
        User::create([
            'usn' => 'admin001',
            'first_name' => 'System',
            'last_name' => 'Admin',
            'email' => 'admin@example.com',
            'password_hash' => Hash::make('password123'), // Securely hashed
            'role' => 'admin',
        ]);

        // Optionally, create a teacher
        User::create([
            'usn' => 'teacher001',
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'teacher@example.com',
            'password_hash' => Hash::make('password123'),
            'role' => 'teacher',
        ]);

        // Optionally, create a student
        User::create([
            'usn' => 'student001',
            'first_name' => 'Jane',
            'last_name' => 'Smith',
            'email' => 'student@example.com',
            'password_hash' => Hash::make('password123'),
            'role' => 'student',
        ]);
    }
}