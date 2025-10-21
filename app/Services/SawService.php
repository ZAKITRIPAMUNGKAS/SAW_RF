<?php

namespace App\Services;

use App\Models\Kandidat;
use App\Models\Kriteria;
use App\Models\Penilaian;
use App\Models\Hasil;
use Illuminate\Support\Facades\DB;

class SawService
{
    /**
     * Menghitung peringkat menggunakan metode SAW
     */
    public function hitungPeringkat()
    {
        // Ambil semua data yang dibutuhkan
        $kandidats = Kandidat::all();
        $kriterias = Kriteria::all();
        $penilaians = Penilaian::with(['kandidat', 'kriteria'])->get();

        if ($kandidats->isEmpty() || $kriterias->isEmpty() || $penilaians->isEmpty()) {
            return false;
        }

        // Buat matriks keputusan
        $matriksKeputusan = $this->buatMatriksKeputusan($kandidats, $kriterias, $penilaians);
        
        // Normalisasi matriks
        $matriksNormalisasi = $this->normalisasiMatriks($matriksKeputusan, $kriterias);
        
        // Hitung nilai preferensi (SAW)
        $hasilSAW = $this->hitungNilaiPreferensi($matriksNormalisasi, $kriterias, $kandidats);
        
        // Simpan hasil ke database
        $this->simpanHasil($hasilSAW);
        
        return $hasilSAW;
    }

    /**
     * Membuat matriks keputusan dari data penilaian
     */
    private function buatMatriksKeputusan($kandidats, $kriterias, $penilaians)
    {
        $matriks = [];
        
        foreach ($kandidats as $kandidat) {
            $matriks[$kandidat->id] = [];
            foreach ($kriterias as $kriteria) {
                $penilaian = $penilaians->where('kandidat_id', $kandidat->id)
                                       ->where('kriteria_id', $kriteria->id)
                                       ->first();
                $matriks[$kandidat->id][$kriteria->id] = $penilaian ? $penilaian->nilai : 0;
            }
        }
        
        return $matriks;
    }

    /**
     * Normalisasi matriks menggunakan rumus benefit
     */
    private function normalisasiMatriks($matriks, $kriterias)
    {
        $normalisasi = [];
        
        foreach ($kriterias as $kriteria) {
            // Cari nilai maksimal untuk kriteria ini
            $nilaiMaksimal = 0;
            foreach ($matriks as $kandidatId => $nilaiKriteria) {
                if (isset($nilaiKriteria[$kriteria->id]) && $nilaiKriteria[$kriteria->id] > $nilaiMaksimal) {
                    $nilaiMaksimal = $nilaiKriteria[$kriteria->id];
                }
            }
            
            // Normalisasi setiap kandidat untuk kriteria ini
            foreach ($matriks as $kandidatId => $nilaiKriteria) {
                if ($nilaiMaksimal > 0) {
                    $normalisasi[$kandidatId][$kriteria->id] = $nilaiKriteria[$kriteria->id] / $nilaiMaksimal;
                } else {
                    $normalisasi[$kandidatId][$kriteria->id] = 0;
                }
            }
        }
        
        return $normalisasi;
    }

    /**
     * Hitung nilai preferensi (SAW)
     */
    private function hitungNilaiPreferensi($matriksNormalisasi, $kriterias, $kandidats)
    {
        $hasil = [];
        
        foreach ($kandidats as $kandidat) {
            $nilaiTotal = 0;
            $detailPerhitungan = [];
            
            foreach ($kriterias as $kriteria) {
                $nilaiNormalisasi = $matriksNormalisasi[$kandidat->id][$kriteria->id] ?? 0;
                $bobot = $kriteria->bobot;
                $kontribusi = $nilaiNormalisasi * $bobot;
                
                $nilaiTotal += $kontribusi;
                
                $detailPerhitungan[] = [
                    'kriteria' => $kriteria->nama_kriteria,
                    'simbol' => $kriteria->simbol,
                    'nilai_normalisasi' => round($nilaiNormalisasi, 4),
                    'bobot' => $bobot,
                    'kontribusi' => round($kontribusi, 6)
                ];
            }
            
            $hasil[] = [
                'kandidat_id' => $kandidat->id,
                'nama_kandidat' => $kandidat->nama_kandidat,
                'nilai_total_saw' => round($nilaiTotal, 6),
                'detail_perhitungan' => $detailPerhitungan
            ];
        }
        
        // Urutkan berdasarkan nilai total SAW (descending)
        usort($hasil, function($a, $b) {
            return $b['nilai_total_saw'] <=> $a['nilai_total_saw'];
        });
        
        // Tambahkan ranking
        foreach ($hasil as $index => &$item) {
            $item['ranking'] = $index + 1;
        }
        
        return $hasil;
    }

    /**
     * Simpan hasil perhitungan ke database
     */
    private function simpanHasil($hasilSAW)
    {
        // Hapus hasil lama
        Hasil::truncate();
        
        // Simpan hasil baru
        foreach ($hasilSAW as $hasil) {
            Hasil::create([
                'kandidat_id' => $hasil['kandidat_id'],
                'nilai_total_saw' => $hasil['nilai_total_saw'],
                'ranking' => $hasil['ranking'],
                'detail_perhitungan' => $hasil['detail_perhitungan']
            ]);
        }
    }

    /**
     * Ambil hasil perhitungan SAW
     */
    public function getHasil()
    {
        return Hasil::with('kandidat')
                   ->orderBy('ranking')
                   ->get();
    }

    /**
     * Cek apakah semua kandidat sudah dinilai
     */
    public function cekKelengkapanPenilaian()
    {
        $totalKandidat = Kandidat::count();
        $totalKriteria = Kriteria::count();
        $totalPenilaian = Penilaian::count();
        
        $penilaianDibutuhkan = $totalKandidat * $totalKriteria;
        
        return [
            'total_kandidat' => $totalKandidat,
            'total_kriteria' => $totalKriteria,
            'total_penilaian' => $totalPenilaian,
            'penilaian_dibutuhkan' => $penilaianDibutuhkan,
            'lengkap' => $totalPenilaian >= $penilaianDibutuhkan
        ];
    }
}
