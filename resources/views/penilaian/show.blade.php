@extends('layouts.app')

@section('title', 'Detail Penilaian - Sistem Rekomendasi Formatur')
@section('page-title', 'Detail Penilaian')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-star me-2"></i>
                    Detail Penilaian
                </h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <td width="150"><strong>Kandidat:</strong></td>
                        <td>{{ $penilaian->kandidat->nama_kandidat }} ({{ $penilaian->kandidat->asal_daerah }})</td>
                    </tr>
                    <tr>
                        <td><strong>Kriteria:</strong></td>
                        <td>
                            {{ $penilaian->kriteria->simbol }} - {{ $penilaian->kriteria->nama_kriteria }}
                            <br>
                            <small class="text-muted">{{ $penilaian->kriteria->keterangan }}</small>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Bobot Kriteria:</strong></td>
                        <td>{{ number_format($penilaian->kriteria->bobot * 100, 0) }}%</td>
                    </tr>
                    <tr>
                        <td><strong>Nilai:</strong></td>
                        <td>
                            <span class="badge bg-{{ $penilaian->nilai >= 4 ? 'success' : ($penilaian->nilai >= 3 ? 'warning' : 'danger') }} fs-6">
                                {{ $penilaian->nilai }}
                            </span>
                            <span class="ms-2">
                                @if($penilaian->nilai == 1)
                                    Sangat Rendah
                                @elseif($penilaian->nilai == 2)
                                    Rendah
                                @elseif($penilaian->nilai == 3)
                                    Sedang
                                @elseif($penilaian->nilai == 4)
                                    Tinggi
                                @elseif($penilaian->nilai == 5)
                                    Sangat Tinggi
                                @endif
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Tanggal Dibuat:</strong></td>
                        <td>{{ $penilaian->created_at->format('d M Y H:i') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Terakhir Diupdate:</strong></td>
                        <td>{{ $penilaian->updated_at->format('d M Y H:i') }}</td>
                    </tr>
                </table>
                
                <hr>
                
                <div class="d-flex justify-content-between">
                    <a href="{{ route('penilaian.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>
                        Kembali ke Daftar
                    </a>
                    <div>
                        <a href="{{ route('penilaian.edit', $penilaian) }}" class="btn btn-warning">
                            <i class="fas fa-edit me-2"></i>
                            Edit Penilaian
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
