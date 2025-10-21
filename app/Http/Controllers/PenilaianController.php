<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Kandidat;
use App\Models\Kriteria;
use App\Models\Penilaian;
use App\Services\SawService;

class PenilaianController extends Controller
{
    protected $sawService;

    public function __construct(SawService $sawService)
    {
        $this->sawService = $sawService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kandidats = Kandidat::with('penilaians.kriteria')->get();
        $kriterias = Kriteria::orderBy('id')->get();
        
        return view('penilaian.index', compact('kandidats', 'kriterias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kandidats = Kandidat::orderBy('nama_kandidat')->get();
        $kriterias = Kriteria::orderBy('id')->get();
        
        return view('penilaian.create', compact('kandidats', 'kriterias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kandidat_id' => 'required|exists:kandidats,id',
            'kriteria_id' => 'required|exists:kriterias,id',
            'nilai' => 'required|numeric|min:1|max:5'
        ]);

        // Cek apakah penilaian sudah ada
        $existingPenilaian = Penilaian::where('kandidat_id', $request->kandidat_id)
                                    ->where('kriteria_id', $request->kriteria_id)
                                    ->first();

        if ($existingPenilaian) {
            return redirect()->back()
                           ->with('error', 'Penilaian untuk kandidat dan kriteria ini sudah ada.');
        }

        Penilaian::create($request->all());

        return redirect()->route('penilaian.index')
                        ->with('success', 'Penilaian berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Penilaian $penilaian)
    {
        return view('penilaian.show', compact('penilaian'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penilaian $penilaian)
    {
        $kandidats = Kandidat::orderBy('nama_kandidat')->get();
        $kriterias = Kriteria::orderBy('id')->get();
        
        return view('penilaian.edit', compact('penilaian', 'kandidats', 'kriterias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penilaian $penilaian)
    {
        $request->validate([
            'nilai' => 'required|numeric|min:1|max:5'
        ]);

        $penilaian->update($request->only('nilai'));

        return redirect()->route('penilaian.index')
                        ->with('success', 'Penilaian berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penilaian $penilaian)
    {
        $penilaian->delete();

        return redirect()->route('penilaian.index')
                        ->with('success', 'Penilaian berhasil dihapus.');
    }

    /**
     * Simpan penilaian dalam bentuk matriks
     */
    public function simpanMatriks(Request $request)
    {
        $request->validate([
            'penilaian' => 'array',
            'penilaian.*' => 'array',
            'penilaian.*.*' => 'numeric|min:0|max:5'
        ]);

        $savedCount = 0;
        if ($request->has('penilaian') && is_array($request->penilaian)) {
            foreach ($request->penilaian as $kandidatId => $kriteriaNilai) {
                if (is_array($kriteriaNilai)) {
                    foreach ($kriteriaNilai as $kriteriaId => $nilai) {
                        if ($nilai > 0) {
                            // Update atau create penilaian
                            Penilaian::updateOrCreate(
                                [
                                    'kandidat_id' => $kandidatId,
                                    'kriteria_id' => $kriteriaId
                                ],
                                ['nilai' => $nilai]
                            );
                            $savedCount++;
                        } else {
                            // Hapus penilaian jika nilai = 0
                            Penilaian::where('kandidat_id', $kandidatId)
                                    ->where('kriteria_id', $kriteriaId)
                                    ->delete();
                        }
                    }
                }
            }
        }

        if ($savedCount > 0) {
            return redirect()->route('penilaian.index')
                            ->with('success', "Penilaian berhasil disimpan. Total: {$savedCount} penilaian.");
        } else {
            return redirect()->route('penilaian.index')
                            ->with('info', "Tidak ada penilaian baru yang disimpan. Semua nilai sudah tersimpan.");
        }
    }
}
