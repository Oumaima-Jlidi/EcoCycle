<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash; // Import Hash facade

class UserSeeder extends Seeder
{
    public function run()
    {
        User::firstOrCreate(
            ['email' => 'admin@gmail.com'], // Check for existing email
            [
                'name' => 'Admin',
                'password' => Hash::make('admin123'), // Hash the password
                'role_id' => 1, // Assuming the admin role has an ID of 1
                'image' => null, // Or provide a default image path if needed
            ]
        );
    }
}
