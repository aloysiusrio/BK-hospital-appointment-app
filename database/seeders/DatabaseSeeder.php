<?php

namespace Database\Seeders;

use App\Models\Poli;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Obat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // admin
        User::create([
            'name' => 'Aluy',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'role' => 'admin',
            'is_active' => 1,
            'password' => bcrypt('admin'),
            'remember_token' => Str::random(10),
        ]);

        // dokter
        User::create([
            'name' => 'Aloy',
            'email' => 'aloy@dokter.com',
            'email_verified_at' => now(),
            'role' => 'dokter',
            'is_active' => 1,
            'password' => bcrypt('dokter'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => 'Ayaya',
            'email' => 'ayaya@dokter.com',
            'email_verified_at' => now(),
            'role' => 'dokter',
            'is_active' => 1,
            'password' => bcrypt('dokter'),
            'remember_token' => Str::random(10),
        ]);

        // pasien
        User::create([
            'name' => 'raiden',
            'email' => 'raiden@pasien.com',
            'email_verified_at' => now(),
            'role' => 'pasien',
            'is_active' => 1,
            'password' => bcrypt('pasien'),
            'remember_token' => Str::random(10),
        ]);

        Poli::create([
            'name' => 'Jantung',
            'keterangan' => 'untuk jantung',
        ]);

        Poli::create([
            'name' => 'Syaraf',
            'keterangan' => 'untuk syaraf',
        ]);

        Poli::create([
            'name' => 'THT',
            'keterangan' => 'untuk THT',
        ]);

        Poli::create([
            'name' => 'Mata',
            'keterangan' => 'untuk mata',
        ]);

        Dokter::create([
            'user_id' => 2,
            'poli_id' => 1,
            'name' => 'Aloy',
            'alamat' => 'Jl. masa lalu',
            'no_hp' => '086723517288',
        ]);

        Dokter::create([
            'user_id' => 3,
            'poli_id' => 2,
            'name' => 'Ayaya',
            'alamat' => 'Jl. inazuma',
            'no_hp' => '08679182788',
        ]);

        Pasien::create([
            'user_id' => 4,
            'name' => 'raiden',
            'no_ktp' => '1234567890123456',
            'no_rm' => '202412-069',
            'no_hp' => '081234567890',
            'alamat' => 'inazuma',
        ]);

        Obat::create([            
            'name' => 'antimo',
            'kemasan' => 'sachet',
            'harga' => '10000',            
        ]);
    }
}
