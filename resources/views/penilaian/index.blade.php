@extends('layouts.app')

@section('title', 'Input Penilaian Kandidat')
@section('page-title', 'Input Penilaian Kandidat')

@section('content')
<!-- Header Section -->
<div style="margin-bottom: 2rem;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
        <div>
            <h2 style="font-size: 1.5rem; font-weight: 700; color: var(--ipm-gray-900); margin: 0 0 0.5rem 0;">
                <i class="fas fa-star" style="color: var(--ipm-green); margin-right: 0.5rem;"></i>
                Input Penilaian Kandidat
            </h2>
            <p style="color: var(--ipm-gray-600); margin: 0;">Berikan penilaian untuk setiap kandidat berdasarkan kriteria yang telah ditetapkan</p>
        </div>
        <div style="display: flex; gap: 1rem;">
            <a href="{{ route('penilaian.create') }}" class="btn btn-success">
                <i class="fas fa-plus"></i>
                Tambah Penilaian
            </a>
            <a href="{{ route('hasil.index') }}" class="btn btn-outline">
                <i class="fas fa-trophy"></i>
                Lihat Hasil
            </a>
        </div>
    </div>
</div>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('info'))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <i class="fas fa-info-circle me-2"></i>
            {{ session('info') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

<!-- Stats Cards -->
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
                <div class="stat-value">{{ $kriterias->count() }}</div>
                <div class="stat-label">Kriteria Penilaian</div>
            </div>
            <div style="font-size: 2rem; color: var(--ipm-green);">
                <i class="fas fa-list-check"></i>
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <div class="stat-value">{{ \App\Models\Penilaian::count() }}</div>
                <div class="stat-label">Penilaian Tersimpan</div>
            </div>
            <div style="font-size: 2rem; color: var(--ipm-yellow);">
                <i class="fas fa-save"></i>
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <div class="stat-value">{{ ($kandidats->count() * $kriterias->count()) - \App\Models\Penilaian::count() }}</div>
                <div class="stat-label">Belum Dinilai</div>
            </div>
            <div style="font-size: 2rem; color: var(--ipm-red);">
                <i class="fas fa-clock"></i>
            </div>
        </div>
    </div>
</div>

@if($kandidats && $kandidats->count() > 0 && $kriterias && $kriterias->count() > 0)
<!-- Matriks Penilaian -->
<div class="card">
    <div class="card-header">
        <h3>
            <i class="fas fa-table"></i>
            Matriks Penilaian (Kandidat × Kriteria)
        </h3>
    </div>
    <div class="card-body" style="padding: 0;">
        <form action="{{ route('penilaian.store') }}" method="POST" id="penilaianForm">
            @csrf
            <div style="overflow-x: auto;">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 200px; text-align: center;">
                                <i class="fas fa-user" style="margin-right: 0.5rem;"></i>
                                Kandidat
                            </th>
                            @foreach($kriterias as $kriteria)
                            <th style="text-align: center; min-width: 120px;">
                                <div style="font-weight: 700;">{{ $kriteria->simbol }}</div>
                                <div style="font-size: 0.75rem;">{{ $kriteria->nama_kriteria }}</div>
                                <div class="badge badge-warning">{{ $kriteria->bobot }}%</div>
                            </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kandidats as $kandidat)
                        <tr>
                            <td>
                                <div style="display: flex; align-items: center;">
                                    <div style="margin-right: 0.75rem;">
                                        @if($kandidat->foto)
                                            <img src="{{ asset('storage/' . $kandidat->foto) }}" 
                                                 alt="{{ $kandidat->nama_kandidat }}" 
                                                 style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%;">
                                        @else
                                            <div style="width: 40px; height: 40px; border-radius: 50%; background: var(--ipm-gray-200); display: flex; align-items: center; justify-content: center;">
                                                <i class="fas fa-user" style="color: var(--ipm-gray-500);"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <div style="font-weight: 700; color: var(--ipm-gray-900);">{{ $kandidat->nama_kandidat }}</div>
                                        <small style="color: var(--ipm-gray-600);">{{ $kandidat->asal_daerah }}</small>
                                    </div>
                                </div>
                            </td>
                            @foreach($kriterias as $kriteria)
                            <td style="text-align: center;">
                                @php
                                    $penilaian = \App\Models\Penilaian::where('kandidat_id', $kandidat->id)
                                                                    ->where('kriteria_id', $kriteria->id)
                                                                    ->first();
                                    $nilai = $penilaian ? $penilaian->nilai : 0;
                                @endphp
                                <select name="penilaian[{{ $kandidat->id }}][{{ $kriteria->id }}]" 
                                        class="form-control" 
                                        style="min-width: 80px; margin-bottom: 0.5rem;"
                                        onchange="updateStatus(this, {{ $kandidat->id }}, {{ $kriteria->id }})">
                                    <option value="0" {{ $nilai == 0 ? 'selected' : '' }}>-</option>
                                    <option value="1" {{ $nilai == 1 ? 'selected' : '' }}>1</option>
                                    <option value="2" {{ $nilai == 2 ? 'selected' : '' }}>2</option>
                                    <option value="3" {{ $nilai == 3 ? 'selected' : '' }}>3</option>
                                    <option value="4" {{ $nilai == 4 ? 'selected' : '' }}>4</option>
                                    <option value="5" {{ $nilai == 5 ? 'selected' : '' }}>5</option>
                                </select>
                                <div>
                                    @if($nilai > 0)
                                        <span class="badge badge-success">
                                            <i class="fas fa-check" style="margin-right: 0.25rem;"></i>
                                            Tersimpan
                                        </span>
                                    @else
                                        <span class="badge" style="background: var(--ipm-gray-400); color: var(--ipm-white);">
                                            <i class="fas fa-clock" style="margin-right: 0.25rem;"></i>
                                            Belum
                                        </span>
                                    @endif
                                </div>
                            </td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div style="padding: 1.5rem; background: var(--ipm-gray-50); border-top: 1px solid var(--ipm-gray-200);">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div style="color: var(--ipm-gray-600);">
                        <i class="fas fa-info-circle" style="margin-right: 0.5rem;"></i>
                        Pilih nilai 1-5 untuk setiap kriteria. Nilai 0 berarti belum dinilai.
                    </div>
                    <button type="submit" class="btn btn-success" id="submitBtn">
                        <i class="fas fa-save"></i>
                        Simpan Penilaian
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@else
<!-- No Data Message -->
<div class="card">
    <div class="card-body" style="text-align: center; padding: 3rem;">
        <div style="margin-bottom: 2rem;">
            <i class="fas fa-exclamation-triangle" style="font-size: 4rem; color: var(--ipm-yellow);"></i>
        </div>
        <h4 style="color: var(--ipm-gray-600); margin-bottom: 1rem;">Data Belum Lengkap</h4>
        <p style="color: var(--ipm-gray-600); margin-bottom: 2rem;">
            @if($kandidats->count() == 0)
                Data kandidat belum tersedia. Hubungi administrator untuk mengatur data kandidat.
            @elseif($kriterias->count() == 0)
                Data kriteria belum tersedia. Hubungi administrator untuk mengatur kriteria penilaian.
            @endif
        </p>
        @if($kandidats->count() == 0)
            <a href="{{ route('kandidat.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i>
                Tambah Kandidat
            </a>
        @endif
    </div>
</div>
@endif

<script>
document.getElementById('penilaianForm').addEventListener('submit', function(e) {
    // Show loading state
    const submitBtn = document.getElementById('submitBtn');
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Menyimpan...';
    submitBtn.disabled = true;
});

function updateStatus(select, kandidatId, kriteriaId) {
    const statusDiv = select.parentNode.querySelector('.badge');
    if (select.value > 0) {
        statusDiv.className = 'badge bg-success';
        statusDiv.innerHTML = '<i class="fas fa-check me-1"></i>Tersimpan';
    } else {
        statusDiv.className = 'badge bg-secondary';
        statusDiv.innerHTML = '<i class="fas fa-clock me-1"></i>Belum';
    }
}
</script>
@endsection