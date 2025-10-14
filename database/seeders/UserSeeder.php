<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        DB::table('data_user')->insert([
            'id_user' => 'ADM001',
            'nama' => 'Administrator',
            'NIK' => 1234567890123456,
            'username' => 'admin',
            'password' => Hash::make('admin123'), // password: admin123
            'email' => 'admin@example.com',
            'no_telepon' => '081234567890',
            'jenis_kelamin' => 'Pria',
            'role' => 'Admin',
            'foto' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Manager
        DB::table('data_user')->insert([
            'id_user' => 'MNG001',
            'nama' => 'Manager Utama',
            'NIK' => 9876543210987654,
            'username' => 'manager',
            'password' => Hash::make('manager123'), // password: manager123
            'email' => 'manager@example.com',
            'no_telepon' => '089876543210',
            'jenis_kelamin' => 'Pria',
            'role' => 'Manajer',
            'foto' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
