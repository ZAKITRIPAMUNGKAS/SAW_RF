@extends('layouts.app')

@section('title', 'Edit Kandidat - Sistem Rekomendasi Formatur')
@section('page-title', 'Edit Kandidat')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-user-edit me-2"></i>
                    Form Edit Kandidat
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('kandidat.update', $kandidat) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nama_kandidat" class="form-label">
                                    Nama Kandidat <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       class="form-control @error('nama_kandidat') is-invalid @enderror" 
                                       id="nama_kandidat" 
                                       name="nama_kandidat" 
                                       value="{{ old('nama_kandidat', $kandidat->nama_kandidat) }}" 
                                       required>
                                @error('nama_kandidat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="asal_daerah" class="form-label">
                                    Asal Daerah <span class="text-danger">*</span>
                                </label>
                                <select class="form-select @error('asal_daerah') is-invalid @enderror" 
                                        id="asal_daerah" 
                                        name="asal_daerah" 
                                        required>
                                    <option value="">Pilih PD IPM</option>
                                    @foreach($kabupatenKota as $kab)
                                        <option value="{{ $kab->nama }}" 
                                                {{ old('asal_daerah', $kandidat->asal_daerah) == $kab->nama ? 'selected' : '' }}>
                                            {{ $kab->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('asal_daerah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto Kandidat</label>
                        @if($kandidat->foto)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $kandidat->foto) }}" 
                                     alt="{{ $kandidat->nama_kandidat }}" 
                                     class="img-thumbnail" 
                                     width="100" 
                                     height="100"
                                     style="object-fit: cover;">
                                <div class="form-text">Foto saat ini</div>
                            </div>
                        @endif
                        <input type="file" 
                               class="form-control @error('foto') is-invalid @enderror" 
                               id="foto" 
                               name="foto" 
                               accept="image/*">
                        <div class="form-text">
                            Format: JPG, PNG, GIF. Maksimal 2MB. Kosongkan jika tidak ingin mengubah foto.
                        </div>
                        @error('foto')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="info_lain" class="form-label">Informasi Tambahan</label>
                        <textarea class="form-control @error('info_lain') is-invalid @enderror" 
                                  id="info_lain" 
                                  name="info_lain" 
                                  rows="3" 
                                  placeholder="Informasi tambahan tentang kandidat...">{{ old('info_lain', $kandidat->info_lain) }}</textarea>
                        @error('info_lain')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('kandidat.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>
                            Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>
                            Update Kandidat
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
