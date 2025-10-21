@extends('layouts.app')

@section('title', 'Dashboard - Sistem Rekomendasi Formatur')
@section('page-title', 'Dashboard')

@section('content')
<!-- Welcome Section -->
<div style="margin-bottom: 2rem;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
        <div>
            <h2 style="font-size: 1.875rem; font-weight: 700; color: var(--ipm-gray-900); margin: 0 0 0.5rem 0;">
                Selamat Datang di Sistem SAW
            </h2>
            <p style="color: var(--ipm-gray-600); margin: 0;">Sistem rekomendasi formatur IPM Jawa Tengah</p>
        </div>
        <div style="display: flex; gap: 1rem;">
            <a href="{{ route('hasil.index') }}" class="btn btn-outline">
                <i class="fas fa-trophy"></i>
                Lihat Hasil
            </a>
            <a href="{{ route('penilaian.index') }}" class="btn btn-primary">
                <i class="fas fa-star"></i>
                Input Penilaian
            </a>
        </div>
    </div>
</div>

<!-- Stats Grid -->
<div class="stats-grid">
    <div class="stat-card">
        <div style="display: flex; justify-content: between; align-items: center;">
            <div>
                <div class="stat-value">{{ $totalKandidat }}</div>
                <div class="stat-label">Total Kandidat</div>
            </div>
            <div style="font-size: 2rem; color: var(--primary);">
                <i class="fas fa-users"></i>
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div style="display: flex; justify-content: between; align-items: center;">
            <div>
                <div class="stat-value">{{ $totalKriteria }}</div>
                <div class="stat-label">Kriteria Penilaian</div>
            </div>
            <div style="font-size: 2rem; color: var(--success);">
                <i class="fas fa-list-check"></i>
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div style="display: flex; justify-content: between; align-items: center;">
            <div>
                <div class="stat-value">{{ $totalPenilaian }}</div>
                <div class="stat-label">Penilaian Tersimpan</div>
            </div>
            <div style="font-size: 2rem; color: var(--warning);">
                <i class="fas fa-star"></i>
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div style="display: flex; justify-content: between; align-items: center;">
            <div>
                <div class="stat-value" style="font-size: 1.25rem;">
                    @if($kelengkapanPenilaian['lengkap'])
                        <span style="color: var(--success);">Lengkap</span>
                    @else
                        <span style="color: var(--warning);">Belum Lengkap</span>
                    @endif
                </div>
                <div class="stat-label">Status Penilaian</div>
            </div>
            <div style="font-size: 2rem; color: var(--gray-500);">
                <i class="fas fa-check-circle"></i>
            </div>
        </div>
    </div>
</div>

<!-- Progress and Actions Grid -->
<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 2rem;">
    <!-- Progress Card -->
    <div class="card">
        <div class="card-header">
            <h3 style="font-size: 1.125rem; font-weight: 600; color: var(--gray-900); margin: 0;">
                <i class="fas fa-chart-pie" style="margin-right: 0.5rem; color: var(--primary);"></i>
                Progress Penilaian
            </h3>
        </div>
        <div class="card-body">
            <div style="margin-bottom: 1.5rem;">
                <div style="display: flex; justify-content: between; align-items: center; margin-bottom: 0.75rem;">
                    <span style="font-weight: 600; color: var(--gray-700);">Penilaian Tersimpan</span>
                    <span class="badge badge-primary">{{ $kelengkapanPenilaian['total_penilaian'] }} / {{ $kelengkapanPenilaian['penilaian_dibutuhkan'] }}</span>
                </div>
                <div style="background: var(--gray-200); border-radius: 0.5rem; height: 0.75rem; overflow: hidden;">
                    <div style="background: var(--primary); height: 100%; width: {{ $kelengkapanPenilaian['penilaian_dibutuhkan'] > 0 ? ($kelengkapanPenilaian['total_penilaian'] / $kelengkapanPenilaian['penilaian_dibutuhkan']) * 100 : 0 }}%; transition: width 0.3s ease;"></div>
                </div>
                <div style="font-size: 0.875rem; color: var(--gray-600); margin-top: 0.5rem;">
                    {{ $kelengkapanPenilaian['penilaian_dibutuhkan'] > 0 ? round(($kelengkapanPenilaian['total_penilaian'] / $kelengkapanPenilaian['penilaian_dibutuhkan']) * 100, 1) : 0 }}% selesai
                </div>
            </div>
            
            @if(!$kelengkapanPenilaian['lengkap'])
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle" style="margin-right: 0.5rem;"></i>
                    <strong>Penilaian Belum Lengkap</strong><br>
                    Silakan lengkapi penilaian untuk semua kandidat dan kriteria.
                </div>
            @else
                <div class="alert alert-success">
                    <i class="fas fa-check-circle" style="margin-right: 0.5rem;"></i>
                    <strong>Penilaian Lengkap</strong><br>
                    Anda dapat menghitung peringkat SAW sekarang.
                </div>
            @endif
        </div>
    </div>

    <!-- Quick Actions Card -->
    <div class="card">
        <div class="card-header">
            <h3 style="font-size: 1.125rem; font-weight: 600; color: var(--gray-900); margin: 0;">
                <i class="fas fa-bolt" style="margin-right: 0.5rem; color: var(--primary);"></i>
                Aksi Cepat
            </h3>
        </div>
        <div class="card-body">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <a href="{{ route('kandidat.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                    Tambah Kandidat
                </a>
                <a href="{{ route('penilaian.index') }}" class="btn btn-success">
                    <i class="fas fa-star"></i>
                    Input Penilaian
                </a>
                <a href="{{ route('hasil.index') }}" class="btn btn-outline">
                    <i class="fas fa-trophy"></i>
                    Lihat Hasil
                </a>
                @if($kelengkapanPenilaian['lengkap'])
                <form action="{{ route('hasil.hitung-ulang') }}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" class="btn btn-warning" style="width: 100%;">
                        <i class="fas fa-calculator"></i>
                        Hitung SAW
                    </button>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>

@if($hasilSAW->count() > 0)
<!-- Hasil SAW Terbaru -->
<div class="card">
    <div class="card-header">
        <h3 style="font-size: 1.125rem; font-weight: 600; color: var(--gray-900); margin: 0;">
            <i class="fas fa-trophy" style="margin-right: 0.5rem; color: var(--primary);"></i>
            Hasil SAW Terbaru
        </h3>
    </div>
    <div class="card-body">
        <div style="overflow-x: auto;">
            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 100px;">Peringkat</th>
                        <th>Nama Kandidat</th>
                        <th style="width: 150px;">Nilai SAW</th>
                        <th style="width: 120px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($hasilSAW->take(5) as $hasil)
                    <tr>
                        <td style="text-align: center;">
                            @if($hasil->ranking == 1)
                                <span class="badge badge-warning" style="background: var(--warning); color: var(--white);">
                                    <i class="fas fa-crown" style="margin-right: 0.25rem;"></i>#{{ $hasil->ranking }}
                                </span>
                            @elseif($hasil->ranking <= 3)
                                <span class="badge badge-success">
                                    <i class="fas fa-medal" style="margin-right: 0.25rem;"></i>#{{ $hasil->ranking }}
                                </span>
                            @else
                                <span class="badge badge-primary">#{{ $hasil->ranking }}</span>
                            @endif
                        </td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 0.75rem;">
                                <div style="width: 40px; height: 40px; border-radius: 50%; background: var(--gray-200); display: flex; align-items: center; justify-content: center;">
                                    @if($hasil->kandidat->foto)
                                        <img src="{{ asset('storage/' . $hasil->kandidat->foto) }}" 
                                             alt="{{ $hasil->kandidat->nama_kandidat }}" 
                                             style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
                                    @else
                                        <i class="fas fa-user" style="color: var(--gray-500);"></i>
                                    @endif
                                </div>
                                <div>
                                    <div style="font-weight: 600; color: var(--gray-900); margin-bottom: 0.25rem;">
                                        {{ $hasil->kandidat->nama_kandidat }}
                                    </div>
                                    <div style="font-size: 0.875rem; color: var(--gray-600);">
                                        {{ $hasil->kandidat->asal_daerah }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td style="text-align: center;">
                            <span class="badge badge-primary" style="background: var(--gray-100); color: var(--gray-700);">
                                {{ number_format($hasil->nilai_total_saw, 4) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('hasil.detail', $hasil->kandidat_id) }}" class="btn btn-outline" style="padding: 0.5rem 1rem; font-size: 0.875rem;">
                                <i class="fas fa-eye" style="margin-right: 0.25rem;"></i>
                                Detail
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div style="text-align: center; margin-top: 1.5rem;">
            <a href="{{ route('hasil.index') }}" class="btn btn-primary">
                <i class="fas fa-list" style="margin-right: 0.5rem;"></i>
                Lihat Semua Hasil
            </a>
        </div>
    </div>
</div>
@endif
@endsection
