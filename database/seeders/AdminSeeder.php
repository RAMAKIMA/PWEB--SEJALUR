<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Account; // Ganti User menjadi Account
use Illuminate\Support\Facades\Hash; // Tambahkan ini untuk Hash::make

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Account::create([
            'username' => 'AdminSejalur',
            'email' => 'sejalur01@gmail.com',
            'no_telepon' => '081234567890',
            'role' => 'Admin',
            'password' => Hash::make('Sejalur123'),
        ]);
    }
}
