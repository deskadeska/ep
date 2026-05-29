<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'namaLengkapUser' => 'Super Administrator',
            'tipeUser' => 'Super Admin',
            'jkUser' => 'Laki-laki',
            'noTelpUser' => '081234567890',
            'email' => 'admin@ekopem.upr.ac.id',
            'password' => Hash::make('SuperAdmin123!'),
            'fotoUser' => null
            // created_at dan updated_at akan otomatis diisi dengan waktu saat ini
        ]);
    }
}
