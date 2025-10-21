@extends('layouts.app')

@section('title', 'Kelola Kandidat - Sistem Rekomendasi Formatur')
@section('page-title', 'Kelola Kandidat')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">Daftar Kandidat Formatur</h4>
        <a href="{{ route('kandidat.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>
            Tambah Kandidat
        </a>
    </div>

<div class="card shadow">
    <div class="card-body">
        @if($kandidats->count() > 0)
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Nama Kandidat</th>
                            <th>Asal Daerah</th>
                            <th>Info Lain</th>
                            <th width="200">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kandidats as $index => $kandidat)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                @if($kandidat->foto)
                                    <img src="{{ asset('storage/' . $kandidat->foto) }}" 
                                         alt="{{ $kandidat->nama_kandidat }}" 
                                         class="rounded-circle" 
                                         width="50" 
                                         height="50"
                                         style="object-fit: cover;">
                                @else
                                    <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center" 
                                         style="width: 50px; height: 50px;">
                                        <i class="fas fa-user text-white"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <strong>{{ $kandidat->nama_kandidat }}</strong>
                            </td>
                            <td>{{ $kandidat->asal_daerah }}</td>
                            <td>
                                @if($kandidat->info_lain)
                                    <small class="text-muted">{{ Str::limit($kandidat->info_lain, 50) }}</small>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('kandidat.show', $kandidat) }}" 
                                       class="btn btn-sm btn-outline-info" 
                                       title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('kandidat.edit', $kandidat) }}" 
                                       class="btn btn-sm btn-outline-warning" 
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('kandidat.destroy', $kandidat) }}" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus kandidat ini?')">
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
        @else
            <div class="text-center py-5">
                <i class="fas fa-users fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">Belum ada kandidat</h5>
                <p class="text-muted">Silakan tambah kandidat terlebih dahulu.</p>
                <a href="{{ route('kandidat.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>
                    Tambah Kandidat Pertama
                </a>
            </div>
        @endif
    </div>
</div>
</div> <!-- End container-fluid -->
@endsection
