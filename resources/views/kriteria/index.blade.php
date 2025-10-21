@extends('layouts.app')

@section('title', 'Kriteria Penilaian - Sistem Rekomendasi Formatur')
@section('page-title', 'Kriteria Penilaian')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Kriteria dan Bobot Penilaian</h4>
    <a href="{{ route('dashboard') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-2"></i>
        Kembali ke Dashboard
    </a>
</div>


<div class="card shadow">
    <div class="card-header">
        <h6 class="mb-0">
            <i class="fas fa-list me-2"></i>
            Daftar Kriteria Penilaian SAW
        </h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th width="60">No</th>
                        <th>Simbol</th>
                        <th>Nama Kriteria</th>
                        <th width="120">Bobot</th>
                        <th>Jenis</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kriterias as $index => $kriteria)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td class="text-center">
                            <span class="badge bg-primary fs-6">{{ $kriteria->simbol }}</span>
                        </td>
                        <td>
                            <strong>{{ $kriteria->nama_kriteria }}</strong>
                        </td>
                        <td class="text-center">
                            <span class="badge bg-info fs-6">{{ number_format($kriteria->bobot * 100, 0) }}%</span>
                        </td>
                        <td class="text-center">
                            <span class="badge bg-{{ $kriteria->jenis_kriteria == 'benefit' ? 'success' : 'warning' }}">
                                {{ ucfirst($kriteria->jenis_kriteria) }}
                            </span>
                        </td>
                        <td>
                            @if($kriteria->keterangan)
                                {{ $kriteria->keterangan }}
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot class="table-light">
                    <tr>
                        <th colspan="3" class="text-end">Total Bobot:</th>
                        <th class="text-center">
                            <span class="badge bg-success fs-6">
                                {{ number_format($kriterias->sum('bobot') * 100, 0) }}%
                            </span>
                        </th>
                        <th colspan="2"></th>
                    </tr>
                </tfoot>
            </table>
        </div>
        
        <div class="mt-4">
            <div class="alert alert-info">
                <h6><i class="fas fa-info-circle me-2"></i>Informasi Kriteria:</h6>
                <ul class="mb-0">
                    <li><strong>Benefit:</strong> Semakin tinggi nilainya semakin baik</li>
                    <li><strong>Cost:</strong> Semakin rendah nilainya semakin baik (tidak ada dalam sistem ini)</li>
                    <li><strong>Bobot:</strong> Persentase pengaruh setiap kriteria dalam perhitungan SAW</li>
                    <li><strong>Total Bobot:</strong> Harus sama dengan 100% untuk validitas perhitungan</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Chart Bobot Kriteria -->
<div class="card shadow mt-4">
    <div class="card-header">
        <h6 class="mb-0">
            <i class="fas fa-chart-pie me-2"></i>
            Visualisasi Bobot Kriteria
        </h6>
    </div>
    <div class="card-body">
        <div class="row">
            @foreach($kriterias as $kriteria)
            <div class="col-md-6 col-lg-4 mb-3">
                <div class="card border-left-primary">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    {{ $kriteria->simbol }}
                                </div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">
                                    {{ $kriteria->nama_kriteria }}
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="h5 mb-0 font-weight-bold text-primary">
                                    {{ number_format($kriteria->bobot * 100, 0) }}%
                                </div>
                            </div>
                        </div>
                        <div class="progress mt-2" style="height: 8px;">
                            <div class="progress-bar" 
                                 role="progressbar" 
                                 style="width: {{ $kriteria->bobot * 100 }}%">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
