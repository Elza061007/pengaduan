<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'     => 'Admin Sekolah',
            'email'    => 'admin@sekolah.sch.id',
            'password' => Hash::make('password'),
            'role'     => 'admin',
        ]);

        User::create([
            'name'     => 'Budi Santoso',
            'email'    => 'budi@siswa.sch.id',
            'password' => Hash::make('password'),
            'role'     => 'siswa',
            'nis'      => '2024001',
            'kelas'    => 'XI IPA 2',
        ]);
    }
}