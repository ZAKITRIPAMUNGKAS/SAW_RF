@extends('layouts.app')

@section('title', 'Detail Kandidat - Sistem Rekomendasi Formatur')
@section('page-title', 'Detail Kandidat')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-user me-2"></i>
                    Detail Kandidat
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 text-center">
                        @if($kandidat->foto)
                            <img src="{{ asset('storage/' . $kandidat->foto) }}" 
                                 alt="{{ $kandidat->nama_kandidat }}" 
                                 class="img-fluid rounded-circle mb-3" 
                                 style="width: 200px; height: 200px; object-fit: cover;">
                        @else
                            <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" 
                                 style="width: 200px; height: 200px;">
                                <i class="fas fa-user fa-4x text-white"></i>
                            </div>
                        @endif
                    </div>
                    
                    <div class="col-md-8">
                        <table class="table table-borderless">
                            <tr>
                                <td width="150"><strong>Nama Kandidat:</strong></td>
                                <td>{{ $kandidat->nama_kandidat }}</td>
                            </tr>
                            <tr>
                                <td><strong>Asal Daerah:</strong></td>
                                <td>{{ $kandidat->asal_daerah }}</td>
                            </tr>
                            <tr>
                                <td><strong>Informasi Tambahan:</strong></td>
                                <td>
                                    @if($kandidat->info_lain)
                                        {{ $kandidat->info_lain }}
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Tanggal Dibuat:</strong></td>
                                <td>{{ $kandidat->created_at->format('d M Y H:i') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Terakhir Diupdate:</strong></td>
                                <td>{{ $kandidat->updated_at->format('d M Y H:i') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                
                <hr>
                
                <div class="d-flex justify-content-between">
                    <a href="{{ route('kandidat.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>
                        Kembali ke Daftar
                    </a>
                    <div>
                        <a href="{{ route('kandidat.edit', $kandidat) }}" class="btn btn-warning">
                            <i class="fas fa-edit me-2"></i>
                            Edit Kandidat
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
