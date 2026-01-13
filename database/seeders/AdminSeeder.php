<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'ajayupadhyaydevops@gmail.com'],
            [
                'name' => 'ajayupadhyay',
                'password' => Hash::make('Ajay@123'),
                'role' => 'admin',
            ]
        );
    }
}
