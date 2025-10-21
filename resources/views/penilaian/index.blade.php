@extends('layouts.app')

@section('title', 'Input Penilaian - Sistem Rekomendasi Formatur')
@section('page-title', 'Input Penilaian')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">Matriks Penilaian Kandidat</h4>
        <div>
            <a href="{{ route('penilaian.create') }}" class="btn btn-success">
                <i class="fas fa-plus me-2"></i>
                Tambah Penilaian
            </a>
        </div>
    </div>

@if($kandidats->count() > 0 && $kriterias->count() > 0)
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
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

    <div class="card shadow">
        <div class="card-header">
            <h6 class="mb-0">
                <i class="fas fa-table me-2"></i>
                Matriks Penilaian (Kandidat × Kriteria)
            </h6>
        </div>
        <div class="card-body">
            <form action="{{ route('penilaian.matriks') }}" method="POST" id="penilaianForm">
                @csrf
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th width="200">Kandidat</th>
                                @foreach($kriterias as $kriteria)
                                <th class="text-center" title="{{ $kriteria->keterangan }}">
                                    {{ $kriteria->simbol }}<br>
                                    <small class="text-muted">{{ $kriteria->nama_kriteria }}</small>
                                    <br>
                                    <small class="badge bg-info">{{ number_format($kriteria->bobot * 100, 0) }}%</small>
                                </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kandidats as $kandidat)
                            <tr>
                                <td>
                                    <strong>{{ $kandidat->nama_kandidat }}</strong><br>
                                    <small class="text-muted">{{ $kandidat->asal_daerah }}</small>
                                </td>
                                @foreach($kriterias as $kriteria)
                                <td class="text-center">
                                    @php
                                        $penilaian = $kandidat->penilaians->where('kriteria_id', $kriteria->id)->first();
                                        $nilai = $penilaian ? $penilaian->nilai : 0;
                                    @endphp
                                    
                                    <select name="penilaian[{{ $kandidat->id }}][{{ $kriteria->id }}]" 
                                            class="form-select form-select-sm @error('penilaian.' . $kandidat->id . '.' . $kriteria->id) is-invalid @enderror"
                                            style="min-width: 60px;"
                                            onchange="console.log('Changed: kandidat={{ $kandidat->id }}, kriteria={{ $kriteria->id }}, nilai=' + this.value)">
                                        <option value="0" {{ $nilai == 0 ? 'selected' : '' }}>-</option>
                                        <option value="1" {{ $nilai == 1 ? 'selected' : '' }}>1</option>
                                        <option value="2" {{ $nilai == 2 ? 'selected' : '' }}>2</option>
                                        <option value="3" {{ $nilai == 3 ? 'selected' : '' }}>3</option>
                                        <option value="4" {{ $nilai == 4 ? 'selected' : '' }}>4</option>
                                        <option value="5" {{ $nilai == 5 ? 'selected' : '' }}>5</option>
                                    </select>
                                    
                                    @if($penilaian)
                                        <small class="text-success d-block mt-1">
                                            <i class="fas fa-check-circle"></i> Tersimpan
                                        </small>
                                    @endif
                                </td>
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-4">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Petunjuk Penilaian:</strong>
                        <ul class="mb-0 mt-2">
                            <li>Skala penilaian: 1 (Sangat Rendah) sampai 5 (Sangat Tinggi)</li>
                            <li>Semua kriteria bersifat benefit (semakin tinggi nilainya semakin baik)</li>
                            <li>Bobot kriteria sudah ditetapkan dan tidak dapat diubah</li>
                        </ul>
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>
                            Kembali ke Dashboard
                        </a>
                        <button type="submit" class="btn btn-primary" id="submitBtn">
                            <i class="fas fa-save me-2"></i>
                            Simpan Penilaian
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Daftar Penilaian yang Sudah Ada -->
    @php
        $penilaians = \App\Models\Penilaian::with(['kandidat', 'kriteria'])->get();
    @endphp
    
    @if($penilaians->count() > 0)
    <div class="card shadow mt-4">
        <div class="card-header bg-light">
            <h6 class="mb-0">
                <i class="fas fa-list me-2"></i>
                Daftar Penilaian yang Sudah Ada
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Kandidat</th>
                            <th>Kriteria</th>
                            <th>Nilai</th>
                            <th width="120">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($penilaians as $index => $penilaian)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $penilaian->kandidat->nama_kandidat }}</td>
                            <td>{{ $penilaian->kriteria->simbol }} - {{ $penilaian->kriteria->nama_kriteria }}</td>
                            <td>
                                <span class="badge bg-{{ $penilaian->nilai >= 4 ? 'success' : ($penilaian->nilai >= 3 ? 'warning' : 'danger') }}">
                                    {{ $penilaian->nilai }}
                                </span>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('penilaian.show', $penilaian) }}" 
                                       class="btn btn-sm btn-outline-info" 
                                       title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('penilaian.edit', $penilaian) }}" 
                                       class="btn btn-sm btn-outline-warning" 
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('penilaian.destroy', $penilaian) }}" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus penilaian ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-sm btn-outline-danger" 
                                                title="Hapus">
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
        </div>
    </div>
    @endif
@else
    <div class="text-center py-5">
        <i class="fas fa-exclamation-triangle fa-3x text-warning mb-3"></i>
        <h5 class="text-warning">Data Belum Lengkap</h5>
        <p class="text-muted">
            @if($kandidats->count() == 0)
                Belum ada kandidat. Silakan tambah kandidat terlebih dahulu.
            @elseif($kriterias->count() == 0)
                Data kriteria belum tersedia. Hubungi administrator.
            @endif
        </p>
        @if($kandidats->count() == 0)
            <a href="{{ route('kandidat.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>
                Tambah Kandidat
            </a>
        @endif
    </div> <!-- end card-body -->
</div> <!-- end card -->
@endif

@section('scripts')
<script>
document.getElementById('penilaianForm').addEventListener('submit', function(e) {
    console.log('Form submitted');
    
    // Debug: Log all form data
    const formData = new FormData(this);
    console.log('Form data:');
    for (let [key, value] of formData.entries()) {
        console.log(key + ': ' + value);
    }
    
    // Debug: Check if penilaian data exists
    const penilaianData = {};
    const selects = this.querySelectorAll('select[name^="penilaian"]');
    selects.forEach(select => {
        if (select.value > 0) {
            penilaianData[select.name] = select.value;
        }
    });
    console.log('Penilaian data:', penilaianData);
    
    // Show loading state
    const submitBtn = document.getElementById('submitBtn');
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...';
    submitBtn.disabled = true;
});
</script>
@endsection
