<?php

namespace Database\Seeders;

use App\Models\Laporan;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'nim' => '2102888',
            'namalengkap' => 'amar',
            'phone' => '089596273720',
            'email' => 'aaamar@gmail.com',
            'password' => bcrypt('password'),

        ]);
        User::create([
            'namalengkap' => 'admin',
            'phone' => '089596273720',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // Laporan::create(

        //     [
        //         'kode_laporan' => str()->random(8),
        //         'judul_laporan' => fake()->title(),
        //         'isi_laporan' => fake()->sentence(),

        //         'jenis_laporan' => 'pengaduan',
        //         'status_laporan' => false,
        //         // 'tanggapan_laporan' => fake()->sentence(),

        //         'user_id' => 1
        //     ]
        // );
    }
}
