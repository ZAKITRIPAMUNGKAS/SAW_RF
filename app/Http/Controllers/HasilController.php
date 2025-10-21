<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SawService;

class HasilController extends Controller
{
    protected $sawService;

    public function __construct(SawService $sawService)
    {
        $this->sawService = $sawService;
    }

    /**
     * Tampilkan hasil perhitungan SAW
     */
    public function index()
    {
        $hasilSAW = $this->sawService->getHasil();
        $kelengkapanPenilaian = $this->sawService->cekKelengkapanPenilaian();
        
        return view('hasil.index', compact('hasilSAW', 'kelengkapanPenilaian'));
    }

    /**
     * Hitung ulang peringkat SAW
     */
    public function hitungUlang()
    {
        $hasil = $this->sawService->hitungPeringkat();
        
        if ($hasil === false) {
            return redirect()->back()
                           ->with('error', 'Tidak dapat menghitung peringkat. Pastikan semua data lengkap.');
        }

        return redirect()->route('hasil.index')
                        ->with('success', 'Peringkat berhasil dihitung ulang.');
    }

    /**
     * Tampilkan detail perhitungan untuk kandidat tertentu
     */
    public function detail($kandidatId)
    {
        $hasil = $this->sawService->getHasil()->where('kandidat_id', $kandidatId)->first();
        
        if (!$hasil) {
            return redirect()->route('hasil.index')
                           ->with('error', 'Data hasil tidak ditemukan.');
        }

        return view('hasil.detail', compact('hasil'));
    }

    /**
     * Ekspor hasil ke PDF
     */
    public function eksporPdf()
    {
        $hasilSAW = $this->sawService->getHasil();
        
        // Implementasi ekspor PDF akan ditambahkan nanti
        return redirect()->route('hasil.index')
                        ->with('info', 'Fitur ekspor PDF akan segera tersedia.');
    }

    /**
     * Ekspor hasil ke Excel
     */
    public function eksporExcel()
    {
        $hasilSAW = $this->sawService->getHasil();
        
        // Implementasi ekspor Excel akan ditambahkan nanti
        return redirect()->route('hasil.index')
                        ->with('info', 'Fitur ekspor Excel akan segera tersedia.');
    }
}
