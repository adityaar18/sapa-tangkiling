<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@sapa-tangkiling.palangkaraya.go.id'],
            [
                'name' => 'Admin Tangkiling',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'lurah@sapa-tangkiling.palangkaraya.go.id'],
            [
                'name' => 'Lurah Tangkiling',
                'password' => Hash::make('password123'),
                'role' => 'lurah',
            ]
        );

        User::updateOrCreate(
            ['email' => 'rt@sapa-tangkiling.palangkaraya.go.id'],
            [
                'name' => 'Rukun Tetangga',
                'password' => Hash::make('password123'),
                'role' => 'rt',
            ]
        );

        User::updateOrCreate(
            ['email' => 'rw@sapa-tangkiling.palangkaraya.go.id'],
            [
                'name' => 'Operator Kecamatan',
                'password' => Hash::make('password123'),
                'role' => 'rw',
            ]
        );
    }
}
