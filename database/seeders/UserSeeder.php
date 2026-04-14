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
        User::Create([
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'admin'
        ]);

        User::Create([
            'username' => 'dosen',
            'email' => 'dosen@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'dosen'
        ]);


        User::Create([
            'username' => 'user',
            'email' => 'user@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'user'
        ]) ;
    }
}
