<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'Username'    => 'admin',
            'Email'       => 'admin@galeri.com',
            'Password'    => Hash::make('admin123'),
            'NamaLengkap' => 'Administrator',
            'Alamat'      => '-',
            'role'        => 'admin',
        ]);
    }
}