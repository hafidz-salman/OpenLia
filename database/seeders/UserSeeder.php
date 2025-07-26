<?php


namespace Database\Seeders;

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
        // Pengguna 1: Admin
        User::create([
            'name' => 'Admin OpenLia',
            'email' => 'admin@openlia.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // Pengguna 2: Dosen
        User::create([
            'name' => 'Dosen Pengampu',
            'email' => 'dosen@openlia.com',
            'password' => Hash::make('password123'),
            'role' => 'dosen',
        ]);

        // Pengguna 3: Mahasiswa
        User::create([
            'name' => 'Mahasiswa Siswa',
            'email' => 'mahasiswa@openlia.com',
            'password' => Hash::make('password123'),
            'role' => 'mahasiswa',
        ]);

        // Pengguna 4: Petugas Kebersihan
        User::create([
            'name' => 'Petugas Kebersihan',
            'email' => 'petugas@openlia.com',
            'password' => Hash::make('password123'),
            'role' => 'petugas',
        ]);
    }
}
