@extends('layouts.app')

@section('title', 'Tambah Penilaian - Sistem Rekomendasi Formatur')
@section('page-title', 'Tambah Penilaian')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-star me-2"></i>
                    Form Tambah Penilaian
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('penilaian.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="kandidat_id" class="form-label">
                            Kandidat <span class="text-danger">*</span>
                        </label>
                        <select class="form-select @error('kandidat_id') is-invalid @enderror" 
                                id="kandidat_id" 
                                name="kandidat_id" 
                                required>
                            <option value="">Pilih Kandidat</option>
                            @foreach($kandidats as $kandidat)
                                <option value="{{ $kandidat->id }}" 
                                        {{ old('kandidat_id') == $kandidat->id ? 'selected' : '' }}>
                                    {{ $kandidat->nama_kandidat }} ({{ $kandidat->asal_daerah }})
                                </option>
                            @endforeach
                        </select>
                        @error('kandidat_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="kriteria_id" class="form-label">
                            Kriteria <span class="text-danger">*</span>
                        </label>
                        <select class="form-select @error('kriteria_id') is-invalid @enderror" 
                                id="kriteria_id" 
                                name="kriteria_id" 
                                required>
                            <option value="">Pilih Kriteria</option>
                            @foreach($kriterias as $kriteria)
                                <option value="{{ $kriteria->id }}" 
                                        {{ old('kriteria_id') == $kriteria->id ? 'selected' : '' }}>
                                    {{ $kriteria->simbol }} - {{ $kriteria->nama_kriteria }}
                                    (Bobot: {{ number_format($kriteria->bobot * 100, 0) }}%)
                                </option>
                            @endforeach
                        </select>
                        @error('kriteria_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="nilai" class="form-label">
                            Nilai <span class="text-danger">*</span>
                        </label>
                        <select class="form-select @error('nilai') is-invalid @enderror" 
                                id="nilai" 
                                name="nilai" 
                                required>
                            <option value="">Pilih Nilai</option>
                            <option value="1" {{ old('nilai') == '1' ? 'selected' : '' }}>1 - Sangat Rendah</option>
                            <option value="2" {{ old('nilai') == '2' ? 'selected' : '' }}>2 - Rendah</option>
                            <option value="3" {{ old('nilai') == '3' ? 'selected' : '' }}>3 - Sedang</option>
                            <option value="4" {{ old('nilai') == '4' ? 'selected' : '' }}>4 - Tinggi</option>
                            <option value="5" {{ old('nilai') == '5' ? 'selected' : '' }}>5 - Sangat Tinggi</option>
                        </select>
                        <div class="form-text">
                            Skala penilaian: 1 (Sangat Rendah) sampai 5 (Sangat Tinggi)
                        </div>
                        @error('nilai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('penilaian.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>
                            Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>
                            Simpan Penilaian
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
