@extends('layouts.app')

@section('title', 'Kelola Kandidat - Sistem Rekomendasi Formatur')
@section('page-title', 'Kelola Kandidat')

@section('content')
<!-- Header Section -->
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <div>
        <h2 style="font-size: 1.875rem; font-weight: 700; color: var(--ipm-gray-900); margin: 0 0 0.5rem 0;">
            <i class="fas fa-users" style="margin-right: 0.75rem; color: var(--ipm-green);"></i>
            Daftar Kandidat Formatur
        </h2>
        <p style="color: var(--ipm-gray-600); margin: 0;">Kelola data kandidat untuk proses seleksi formatur</p>
    </div>
    <a href="{{ route('kandidat.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i>
        Tambah Kandidat
    </a>
</div>

<!-- Stats Grid -->
<div class="stats-grid">
    <div class="stat-card">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <div class="stat-value">{{ $kandidats->count() }}</div>
                <div class="stat-label">Total Kandidat</div>
            </div>
            <div style="font-size: 2rem; color: var(--ipm-green);">
                <i class="fas fa-users"></i>
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <div class="stat-value">{{ $kandidats->where('foto', '!=', null)->count() }}</div>
                <div class="stat-label">Dengan Foto</div>
            </div>
            <div style="font-size: 2rem; color: var(--ipm-green);">
                <i class="fas fa-camera"></i>
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <div class="stat-value">{{ $kandidats->where('info_lain', '!=', null)->count() }}</div>
                <div class="stat-label">Lengkap Info</div>
            </div>
            <div style="font-size: 2rem; color: var(--ipm-yellow);">
                <i class="fas fa-info-circle"></i>
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <div class="stat-value">{{ $kandidats->groupBy('asal_daerah')->count() }}</div>
                <div class="stat-label">Daerah</div>
            </div>
            <div style="font-size: 2rem; color: var(--ipm-gray-500);">
                <i class="fas fa-map-marker-alt"></i>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="card">
    <div class="card-header">
        <h3>
            <i class="fas fa-list"></i>
            Data Kandidat
        </h3>
    </div>
    <div class="card-body">
        @if($kandidats->count() > 0)
            <div style="overflow-x: auto;">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 60px;">No</th>
                            <th style="width: 80px;">Foto</th>
                            <th>Nama Kandidat</th>
                            <th>Asal Daerah</th>
                            <th>Info Lain</th>
                            <th style="width: 200px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kandidats as $index => $kandidat)
                        <tr>
                            <td style="text-align: center;">
                                <span class="badge badge-primary">{{ $index + 1 }}</span>
                            </td>
                            <td>
                                <div style="width: 50px; height: 50px; border-radius: 50%; background: var(--ipm-gray-200); display: flex; align-items: center; justify-content: center; overflow: hidden;">
                                    @if($kandidat->foto)
                                        <img src="{{ asset('storage/' . $kandidat->foto) }}" 
                                             alt="{{ $kandidat->nama_kandidat }}" 
                                             style="width: 100%; height: 100%; object-fit: cover;">
                                    @else
                                        <i class="fas fa-user" style="color: var(--ipm-gray-500);"></i>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div>
                                    <div style="font-weight: 600; color: var(--ipm-gray-900); margin-bottom: 0.25rem;">
                                        {{ $kandidat->nama_kandidat }}
                                    </div>
                                    <div style="font-size: 0.875rem; color: var(--ipm-gray-600);">
                                        <i class="fas fa-calendar" style="margin-right: 0.25rem;"></i>
                                        Ditambahkan {{ $kandidat->created_at->format('d M Y') }}
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge badge-primary" style="background: var(--ipm-gray-100); color: var(--ipm-gray-700);">
                                    <i class="fas fa-map-marker-alt" style="margin-right: 0.25rem;"></i>
                                    {{ $kandidat->asal_daerah }}
                                </span>
                            </td>
                            <td>
                                @if($kandidat->info_lain)
                                    <div style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="{{ $kandidat->info_lain }}">
                                        <span style="font-size: 0.875rem; color: var(--ipm-gray-600);">{{ Str::limit($kandidat->info_lain, 50) }}</span>
                                    </div>
                                @else
                                    <span style="color: var(--ipm-gray-500); font-size: 0.875rem;">
                                        <i class="fas fa-minus-circle" style="margin-right: 0.25rem;"></i>
                                        Tidak ada info
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div style="display: flex; gap: 0.5rem;">
                                    <a href="{{ route('kandidat.show', $kandidat) }}" 
                                       class="btn btn-outline" 
                                       title="Lihat Detail"
                                       style="padding: 0.5rem; font-size: 0.875rem;">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('kandidat.edit', $kandidat) }}" 
                                       class="btn btn-outline" 
                                       title="Edit"
                                       style="padding: 0.5rem; font-size: 0.875rem;">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('kandidat.destroy', $kandidat) }}" 
                                          method="POST" 
                                          style="display: inline; margin: 0;"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus kandidat ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-outline" 
                                                title="Hapus"
                                                style="padding: 0.5rem; font-size: 0.875rem; color: var(--ipm-red); border-color: var(--ipm-red);">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div style="text-align: center; padding: 3rem 1rem;">
                <div style="font-size: 3rem; color: var(--ipm-gray-300); margin-bottom: 1rem;">
                    <i class="fas fa-users"></i>
                </div>
                <h3 style="color: var(--ipm-gray-700); margin-bottom: 0.5rem;">Belum ada kandidat</h3>
                <p style="color: var(--ipm-gray-600); margin-bottom: 2rem;">Silakan tambah kandidat terlebih dahulu untuk memulai proses seleksi.</p>
                <a href="{{ route('kandidat.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                    Tambah Kandidat Pertama
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
