@extends('layouts.app')

@section('title', 'Dashboard - Sistem Rekomendasi Formatur')
@section('page-title', 'Dashboard')

@section('content')
<div class="row">
    <!-- Statistik Cards -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Kandidat
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalKandidat }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Kriteria Penilaian
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalKriteria }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Penilaian Tersimpan
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalPenilaian }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-star fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Status Penilaian
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            @if($kelengkapanPenilaian['lengkap'])
                                <span class="text-success">Lengkap</span>
                            @else
                                <span class="text-warning">Belum Lengkap</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Progress Penilaian -->
    <div class="col-lg-6 mb-4">
        <div class="card shadow">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-chart-pie me-2"></i>
                    Progress Penilaian
                </h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <div class="d-flex justify-content-between">
                        <span>Penilaian Tersimpan</span>
                        <span>{{ $kelengkapanPenilaian['total_penilaian'] }} / {{ $kelengkapanPenilaian['penilaian_dibutuhkan'] }}</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar" 
                             role="progressbar" 
                             style="width: {{ $kelengkapanPenilaian['penilaian_dibutuhkan'] > 0 ? ($kelengkapanPenilaian['total_penilaian'] / $kelengkapanPenilaian['penilaian_dibutuhkan']) * 100 : 0 }}%">
                        </div>
                    </div>
                </div>
                
                @if(!$kelengkapanPenilaian['lengkap'])
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        Penilaian belum lengkap. Silakan lengkapi penilaian untuk semua kandidat dan kriteria.
                    </div>
                @else
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle me-2"></i>
                        Penilaian sudah lengkap. Anda dapat menghitung peringkat SAW.
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="col-lg-6 mb-4">
        <div class="card shadow">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-bolt me-2"></i>
                    Aksi Cepat
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <a href="{{ route('kandidat.create') }}" class="btn btn-primary btn-block w-100">
                            <i class="fas fa-plus me-2"></i>
                            Tambah Kandidat
                        </a>
                    </div>
                    <div class="col-md-6 mb-3">
                        <a href="{{ route('penilaian.index') }}" class="btn btn-success btn-block w-100">
                            <i class="fas fa-star me-2"></i>
                            Input Penilaian
                        </a>
                    </div>
                    <div class="col-md-6 mb-3">
                        <a href="{{ route('hasil.index') }}" class="btn btn-info btn-block w-100">
                            <i class="fas fa-trophy me-2"></i>
                            Lihat Hasil
                        </a>
                    </div>
                    @if($kelengkapanPenilaian['lengkap'])
                    <div class="col-md-6 mb-3">
                        <form action="{{ route('hasil.hitung-ulang') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-warning btn-block w-100">
                                <i class="fas fa-calculator me-2"></i>
                                Hitung SAW
                            </button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@if($hasilSAW->count() > 0)
<div class="row">
    <!-- Hasil SAW Terbaru -->
    <div class="col-12">
        <div class="card shadow">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-trophy me-2"></i>
                    Hasil SAW Terbaru
                </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Peringkat</th>
                                <th>Nama Kandidat</th>
                                <th>Nilai SAW</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($hasilSAW->take(5) as $hasil)
                            <tr>
                                <td>
                                    <span class="badge bg-{{ $hasil->ranking <= 3 ? 'success' : 'primary' }}">
                                        #{{ $hasil->ranking }}
                                    </span>
                                </td>
                                <td>{{ $hasil->kandidat->nama_kandidat }}</td>
                                <td>{{ number_format($hasil->nilai_total_saw, 4) }}</td>
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
                <div class="text-center">
                    <a href="{{ route('hasil.index') }}" class="btn btn-primary">
                        <i class="fas fa-list me-2"></i>
                        Lihat Semua Hasil
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
