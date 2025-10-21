<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kriteria;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kriterias = [
            [
                'nama_kriteria' => 'Leadership',
                'simbol' => 'C1',
                'jenis_kriteria' => 'benefit',
                'bobot' => 0.18,
                'keterangan' => 'Kemampuan memimpin dan mengambil keputusan'
            ],
            [
                'nama_kriteria' => 'Komunikasi',
                'simbol' => 'C2',
                'jenis_kriteria' => 'benefit',
                'bobot' => 0.16,
                'keterangan' => 'Kemampuan berbicara dan menyampaikan ide'
            ],
            [
                'nama_kriteria' => 'Pengalaman Organisasi',
                'simbol' => 'C3',
                'jenis_kriteria' => 'benefit',
                'bobot' => 0.15,
                'keterangan' => 'Lama dan luasnya pengalaman di IPM dan ortom'
            ],
            [
                'nama_kriteria' => 'Pengetahuan Organisasi',
                'simbol' => 'C4',
                'jenis_kriteria' => 'benefit',
                'bobot' => 0.15,
                'keterangan' => 'Pemahaman tentang IPM dan Muhammadiyah'
            ],
            [
                'nama_kriteria' => 'Representasi Daerah',
                'simbol' => 'C5',
                'jenis_kriteria' => 'benefit',
                'bobot' => 0.12,
                'keterangan' => 'Asal daerah untuk pemerataan wilayah'
            ],
            [
                'nama_kriteria' => 'Komitmen Waktu',
                'simbol' => 'C6',
                'jenis_kriteria' => 'benefit',
                'bobot' => 0.12,
                'keterangan' => 'Kesiapan mengabdi selama periode kepemimpinan'
            ],
            [
                'nama_kriteria' => 'Networking (Jaringan)',
                'simbol' => 'C7',
                'jenis_kriteria' => 'benefit',
                'bobot' => 0.12,
                'keterangan' => 'Relasi dan konektivitas dengan kader serta eksternal'
            ]
        ];

        foreach ($kriterias as $kriteria) {
            Kriteria::create($kriteria);
        }
    }
}
