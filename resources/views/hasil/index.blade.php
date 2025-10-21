@extends('layouts.app')

@section('title', 'Hasil SAW - Sistem Rekomendasi Formatur')
@section('page-title', 'Hasil SAW')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Hasil Perhitungan SAW</h4>
    <div>
        @if($kelengkapanPenilaian['lengkap'])
            <form action="{{ route('hasil.hitung-ulang') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-warning me-2">
                    <i class="fas fa-calculator me-2"></i>
                    Hitung Ulang
                </button>
            </form>
        @endif
        <a href="{{ route('hasil.ekspor-pdf') }}" class="btn btn-danger me-2">
            <i class="fas fa-file-pdf me-2"></i>
            Ekspor PDF
        </a>
        <a href="{{ route('hasil.ekspor-excel') }}" class="btn btn-success">
            <i class="fas fa-file-excel me-2"></i>
            Ekspor Excel
        </a>
    </div>
</div>

@if(!$kelengkapanPenilaian['lengkap'])
    <div class="alert alert-warning">
        <i class="fas fa-exclamation-triangle me-2"></i>
        <strong>Penilaian Belum Lengkap!</strong>
        <p class="mb-0 mt-2">
            Penilaian tersimpan: {{ $kelengkapanPenilaian['total_penilaian'] }} dari {{ $kelengkapanPenilaian['penilaian_dibutuhkan'] }} yang dibutuhkan.
            Silakan lengkapi penilaian untuk semua kandidat dan kriteria terlebih dahulu.
        </p>
        <div class="mt-3">
            <a href="{{ route('penilaian.index') }}" class="btn btn-warning">
                <i class="fas fa-star me-2"></i>
                Lengkapi Penilaian
            </a>
        </div>
    </div>
@elseif($hasilSAW->count() > 0)
    <div class="row">
        <!-- Statistik Hasil -->
        <div class="col-lg-4 mb-4">
            <div class="card border-left-primary shadow h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Kandidat
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $hasilSAW->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 mb-4">
            <div class="card border-left-success shadow h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Nilai Tertinggi
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ number_format($hasilSAW->max('nilai_total_saw'), 4) }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-trophy fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 mb-4">
            <div class="card border-left-info shadow h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Nilai Terendah
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ number_format($hasilSAW->min('nilai_total_saw'), 4) }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chart-line fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Hasil SAW -->
    <div class="card shadow">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-trophy me-2"></i>
                Ranking Kandidat Berdasarkan Metode SAW
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th width="80">Peringkat</th>
                            <th>Nama Kandidat</th>
                            <th>Asal Daerah</th>
                            <th width="120">Nilai SAW</th>
                            <th width="100">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($hasilSAW as $hasil)
                        <tr class="{{ $hasil->ranking <= 3 ? 'table-success' : '' }}">
                            <td class="text-center">
                                @if($hasil->ranking == 1)
                                    <span class="badge bg-warning text-dark fs-6">
                                        <i class="fas fa-crown me-1"></i>
                                        #{{ $hasil->ranking }}
                                    </span>
                                @elseif($hasil->ranking == 2)
                                    <span class="badge bg-secondary fs-6">
                                        <i class="fas fa-medal me-1"></i>
                                        #{{ $hasil->ranking }}
                                    </span>
                                @elseif($hasil->ranking == 3)
                                    <span class="badge bg-warning fs-6">
                                        <i class="fas fa-award me-1"></i>
                                        #{{ $hasil->ranking }}
                                    </span>
                                @else
                                    <span class="badge bg-primary fs-6">#{{ $hasil->ranking }}</span>
                                @endif
                            </td>
                            <td>
                                <strong>{{ $hasil->kandidat->nama_kandidat }}</strong>
                            </td>
                            <td>{{ $hasil->kandidat->asal_daerah }}</td>
                            <td class="text-center">
                                <strong class="text-primary">{{ number_format($hasil->nilai_total_saw, 4) }}</strong>
                            </td>
                            <td>
                                <a href="{{ route('hasil.detail', $hasil->kandidat_id) }}" 
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye me-1"></i>
                                    Detail
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Rekomendasi -->
    @if($hasilSAW->count() > 0)
    <div class="card shadow mt-4">
        <div class="card-header bg-success text-white">
            <h6 class="m-0 font-weight-bold">
                <i class="fas fa-star me-2"></i>
                Rekomendasi Formatur
            </h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="text-success">
                        <i class="fas fa-crown me-2"></i>
                        Kandidat Terbaik
                    </h5>
                    <p class="mb-1"><strong>Nama:</strong> {{ $hasilSAW->first()->kandidat->nama_kandidat }}</p>
                    <p class="mb-1"><strong>Asal:</strong> {{ $hasilSAW->first()->kandidat->asal_daerah }}</p>
                    <p class="mb-0"><strong>Nilai SAW:</strong> {{ number_format($hasilSAW->first()->nilai_total_saw, 4) }}</p>
                </div>
                <div class="col-md-6">
                    <h6 class="text-info">3 Kandidat Teratas</h6>
                    <ol>
                        @foreach($hasilSAW->take(3) as $hasil)
                        <li>
                            <strong>{{ $hasil->kandidat->nama_kandidat }}</strong> 
                            ({{ $hasil->kandidat->asal_daerah }}) - 
                            <span class="text-primary">{{ number_format($hasil->nilai_total_saw, 4) }}</span>
                        </li>
                        @endforeach
                    </ol>
                </div>
            </div>
        </div>
    </div>
    @endif

@else
    <div class="text-center py-5">
        <i class="fas fa-calculator fa-3x text-muted mb-3"></i>
        <h5 class="text-muted">Belum Ada Hasil SAW</h5>
        <p class="text-muted">Silakan hitung peringkat SAW terlebih dahulu.</p>
        @if($kelengkapanPenilaian['lengkap'])
            <form action="{{ route('hasil.hitung-ulang') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-calculator me-2"></i>
                    Hitung Peringkat SAW
                </button>
            </form>
        @endif
    </div>
@endif
@endsection
