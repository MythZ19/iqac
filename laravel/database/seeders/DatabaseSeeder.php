<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
            'role' => 'admin',
        ]);

    

        // Create HOD User
        User::create([
            'name' => 'Test User',
            'email' => 'test@gmail.com',
            'password' => bcrypt('test'),
            'role' => 'hod',
    
        ]);
    }
}
