<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kriteria;

class KriteriaController extends Controller
{
    /**
     * Tampilkan daftar kriteria dan bobot
     */
    public function index()
    {
        $kriterias = Kriteria::orderBy('id')->get();
        return view('kriteria.index', compact('kriterias'));
    }
}
