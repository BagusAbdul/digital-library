<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
    // Seed Roles
    $adminRole = \App\Models\Role::create(['nama_role' => 'Administrator']);
    \App\Models\Role::create(['nama_role' => 'Petugas']);
    \App\Models\Role::create(['nama_role' => 'Peminjam']);

    // Seed Initial Admin
    \App\Models\User::create([
        'role_id' => $adminRole->id,
        'username' => 'admin_pusda',
        'email' => 'admin@digilib.com',
        'password' => bcrypt('password123'),
        'nama_lengkap' => 'Administrator Utama',
        'alamat' => 'Bandung, Jawa Barat',
    ]);
    }
}
