<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kandidat;
use App\Models\Kriteria;
use App\Models\Penilaian;
use App\Models\Hasil;
use App\Services\SawService;

class DashboardController extends Controller
{
    protected $sawService;

    public function __construct(SawService $sawService)
    {
        $this->sawService = $sawService;
    }

    public function index()
    {
        $totalKandidat = Kandidat::count();
        $totalKriteria = Kriteria::count();
        $totalPenilaian = Penilaian::count();
        $kelengkapanPenilaian = $this->sawService->cekKelengkapanPenilaian();
        $hasilSAW = $this->sawService->getHasil();

        return view('dashboard', compact(
            'totalKandidat',
            'totalKriteria', 
            'totalPenilaian',
            'kelengkapanPenilaian',
            'hasilSAW'
        ));
    }
}
