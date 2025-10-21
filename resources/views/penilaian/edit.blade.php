@extends('layouts.app')

@section('title', 'Edit Penilaian - Sistem Rekomendasi Formatur')
@section('page-title', 'Edit Penilaian')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-edit me-2"></i>
                    Form Edit Penilaian
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('penilaian.update', $penilaian) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="kandidat_id" class="form-label">
                            Kandidat
                        </label>
                        <select class="form-select" id="kandidat_id" name="kandidat_id" disabled>
                            <option value="{{ $penilaian->kandidat_id }}">
                                {{ $penilaian->kandidat->nama_kandidat }} ({{ $penilaian->kandidat->asal_daerah }})
                            </option>
                        </select>
                        <div class="form-text">Kandidat tidak dapat diubah</div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="kriteria_id" class="form-label">
                            Kriteria
                        </label>
                        <select class="form-select" id="kriteria_id" name="kriteria_id" disabled>
                            <option value="{{ $penilaian->kriteria_id }}">
                                {{ $penilaian->kriteria->simbol }} - {{ $penilaian->kriteria->nama_kriteria }}
                                (Bobot: {{ number_format($penilaian->kriteria->bobot * 100, 0) }}%)
                            </option>
                        </select>
                        <div class="form-text">Kriteria tidak dapat diubah</div>
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
                            <option value="1" {{ old('nilai', $penilaian->nilai) == '1' ? 'selected' : '' }}>1 - Sangat Rendah</option>
                            <option value="2" {{ old('nilai', $penilaian->nilai) == '2' ? 'selected' : '' }}>2 - Rendah</option>
                            <option value="3" {{ old('nilai', $penilaian->nilai) == '3' ? 'selected' : '' }}>3 - Sedang</option>
                            <option value="4" {{ old('nilai', $penilaian->nilai) == '4' ? 'selected' : '' }}>4 - Tinggi</option>
                            <option value="5" {{ old('nilai', $penilaian->nilai) == '5' ? 'selected' : '' }}>5 - Sangat Tinggi</option>
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
                            Update Penilaian
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
