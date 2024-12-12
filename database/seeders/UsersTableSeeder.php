<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'firstName' => 'Super',
                'lastName' => 'Admin',
                'dayOfBirth' => now(),
                'gender' => 'male',
                'password' => Hash::make('12345678'),
                'email' => 'admin@gmail.com',
                'email_verified_at' => now(),
                'phone' => '0123456789',
                'country' => 'Việt Nam',
                'username' => 'admin',
                'role' => 'admin',
                'status' => 'active',
                'created_at' => now(),
                'remember_token' => Str::random(10),
            ],
            [
                'firstName' => 'Staff',
                'lastName' => '1',
                'dayOfBirth' => now(),
                'gender' => 'male',
                'password' => Hash::make('12345678'),
                'email' => 'staff@gmail.com',
                'email_verified_at' => now(),
                'phone' => '0123456789',
                'country' => 'Việt Nam',
                'username' => 'staff1',
                'role' => 'staff',
                'status' => 'active',
                'created_at' => now(),
                'remember_token' => Str::random(10),
            ],
            [
                'firstName' => 'User',
                'lastName' => '1',
                'dayOfBirth' => now(),
                'gender' => 'male',
                'password' => Hash::make('12345678'),
                'email' => 'user1@gmail.com',
                'email_verified_at' => now(),
                'phone' => '0123456789',
                'country' => 'Việt Nam',
                'username' => 'user1',
                'role' => 'user',
                'status' => 'active',
                'created_at' => now(),
                'remember_token' => Str::random(10),
            ]
        ]);
    }
}
