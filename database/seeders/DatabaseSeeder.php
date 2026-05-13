<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // 1. Akun Admin Utama (Sudah diubah sesuai permintaan)
        User::create([
            'username' => 'Admin Utama',
            'email' => 'admin@gmail.com', // <-- Email baru
            'password' => Hash::make('123456'), // <-- Password baru
            'role' => 'admin',
        ]);

        // 2. Akun Mahasiswa (User) untuk testing
        User::create([
            'username' => 'Mahasiswa Teladan',
            'email' => 'student@sinaubareng.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);

        // 3. Akun Dosen untuk testing
        User::create([
            'username' => 'Dosen Pengampu',
            'email' => 'dosen@sinaubareng.com',
            'password' => Hash::make('password123'),
            'role' => 'dosen',
        ]);
    }
}