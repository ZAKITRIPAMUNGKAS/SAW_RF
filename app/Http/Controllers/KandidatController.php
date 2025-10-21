<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kandidat;
use App\Models\KabupatenKota;
use Illuminate\Support\Facades\Storage;

class KandidatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kandidats = Kandidat::orderBy('nama_kandidat')->get();
        return view('kandidat.index', compact('kandidats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kabupatenKota = KabupatenKota::orderBy('nama')->get();
        return view('kandidat.create', compact('kabupatenKota'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kandidat' => 'required|string|max:255',
            'asal_daerah' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'info_lain' => 'nullable|string'
        ]);

        $data = $request->only(['nama_kandidat', 'asal_daerah', 'info_lain']);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('kandidat', 'public');
        }

        Kandidat::create($data);

        return redirect()->route('kandidat.index')
                        ->with('success', 'Kandidat berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kandidat $kandidat)
    {
        return view('kandidat.show', compact('kandidat'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kandidat $kandidat)
    {
        $kabupatenKota = KabupatenKota::orderBy('nama')->get();
        return view('kandidat.edit', compact('kandidat', 'kabupatenKota'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kandidat $kandidat)
    {
        $request->validate([
            'nama_kandidat' => 'required|string|max:255',
            'asal_daerah' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'info_lain' => 'nullable|string'
        ]);

        $data = $request->only(['nama_kandidat', 'asal_daerah', 'info_lain']);

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($kandidat->foto) {
                Storage::disk('public')->delete($kandidat->foto);
            }
            $data['foto'] = $request->file('foto')->store('kandidat', 'public');
        }

        $kandidat->update($data);

        return redirect()->route('kandidat.index')
                        ->with('success', 'Kandidat berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kandidat $kandidat)
    {
        // Hapus foto jika ada
        if ($kandidat->foto) {
            Storage::disk('public')->delete($kandidat->foto);
        }

        $kandidat->delete();

        return redirect()->route('kandidat.index')
                        ->with('success', 'Kandidat berhasil dihapus.');
    }
}
