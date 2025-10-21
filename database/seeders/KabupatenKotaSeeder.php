<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KabupatenKotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kabupatenKota = [
            // Kabupaten (29)
            'PD IPM Banjarnegara',
            'PD IPM Banyumas',
            'PD IPM Batang',
            'PD IPM Blora',
            'PD IPM Boyolali',
            'PD IPM Brebes',
            'PD IPM Cilacap',
            'PD IPM Demak',
            'PD IPM Grobogan',
            'PD IPM Jepara',
            'PD IPM Karanganyar',
            'PD IPM Kebumen',
            'PD IPM Kendal',
            'PD IPM Klaten',
            'PD IPM Kudus',
            'PD IPM Magelang',
            'PD IPM Pati',
            'PD IPM Pemalang',
            'PD IPM Purbalingga',
            'PD IPM Purworejo',
            'PD IPM Rembang',
            'PD IPM Sragen',
            'PD IPM Sukoharjo',
            'PD IPM Temanggung',
            'PD IPM Wonogiri',
            'PD IPM Wonosobo',
            
            // Kota (6)
            'PD IPM Kota Magelang',
            'PD IPM Kota Pekalongan',
            'PD IPM Kota Salatiga',
            'PD IPM Kota Semarang',
            'PD IPM Kota Surakarta',
            'PD IPM Kota Tegal'
        ];

        // Hapus data lama jika ada
        DB::table('kabupaten_kota')->truncate();

        // Insert data baru
        foreach ($kabupatenKota as $index => $nama) {
            DB::table('kabupaten_kota')->insert([
                'id' => $index + 1,
                'nama' => $nama,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
