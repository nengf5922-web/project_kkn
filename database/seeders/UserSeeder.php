<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Data users dari SQL dump
        $users = [
            [
                'name' => 'Admin Strideelle',
                'email' => 'admin@gmail.com',
                'phone' => '082321863102',
                'address' => 'sukaratu',
                'password' => Hash::make('password'), // Default password, update sesuai kebutuhan
                'role' => 'admin',
            ],
            [
                'name' => 'Neng Fitri',
                'email' => 'nengf5922@gmail.com',
                'phone' => '082321863102',
                'address' => 'KP. Kubang Buleud, Sinagar',
                'password' => Hash::make('password'),
                'role' => 'user',
            ],
            [
                'name' => 'nurul',
                'email' => 'nurul@gmaul.com',
                'phone' => '087891112828',
                'address' => 'sinagar',
                'password' => Hash::make('password'),
                'role' => 'user',
            ],
            [
                'name' => 'putri',
                'email' => 'putri@gmail.com',
                'phone' => '087891112829',
                'address' => 'Cilampung',
                'password' => Hash::make('password'),
                'role' => 'user',
            ],
        ];

        foreach ($users as $userData) {
            User::firstOrCreate(
                ['email' => $userData['email']],
                $userData
            );
        }
    }
}

