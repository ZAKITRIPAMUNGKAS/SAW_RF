@extends('layouts.app')

@section('title', 'Detail Hasil SAW - Sistem Rekomendasi Formatur')
@section('page-title', 'Detail Hasil SAW')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <!-- Informasi Kandidat -->
        <div class="card shadow mb-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-user me-2"></i>
                    Informasi Kandidat
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 text-center">
                        @if($hasil->kandidat->foto)
                            <img src="{{ asset('storage/' . $hasil->kandidat->foto) }}" 
                                 alt="{{ $hasil->kandidat->nama_kandidat }}" 
                                 class="img-fluid rounded-circle mb-3" 
                                 style="width: 150px; height: 150px; object-fit: cover;">
                        @else
                            <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" 
                                 style="width: 150px; height: 150px;">
                                <i class="fas fa-user fa-3x text-white"></i>
                            </div>
                        @endif
                    </div>
                    
                    <div class="col-md-9">
                        <table class="table table-borderless">
                            <tr>
                                <td width="150"><strong>Nama Kandidat:</strong></td>
                                <td>{{ $hasil->kandidat->nama_kandidat }}</td>
                            </tr>
                            <tr>
                                <td><strong>Asal Daerah:</strong></td>
                                <td>{{ $hasil->kandidat->asal_daerah }}</td>
                            </tr>
                            <tr>
                                <td><strong>Peringkat:</strong></td>
                                <td>
                                    @if($hasil->ranking == 1)
                                        <span class="badge bg-warning text-dark fs-6">
                                            <i class="fas fa-crown me-1"></i>
                                            #{{ $hasil->ranking }} (Terbaik)
                                        </span>
                                    @elseif($hasil->ranking == 2)
                                        <span class="badge bg-secondary fs-6">
                                            <i class="fas fa-medal me-1"></i>
                                            #{{ $hasil->ranking }}
                                        </span>
                                    @elseif($hasil->ranking == 3)
                                        <span class="badge bg-warning fs-6">
                                            <i class="fas fa-award me-1"></i>
                                            #{{ $hasil->ranking }}
                                        </span>
                                    @else
                                        <span class="badge bg-primary fs-6">#{{ $hasil->ranking }}</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Nilai SAW:</strong></td>
                                <td>
                                    <span class="h5 text-primary">{{ number_format($hasil->nilai_total_saw, 4) }}</span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detail Perhitungan -->
        <div class="card shadow">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-calculator me-2"></i>
                    Detail Perhitungan SAW
                </h6>
            </div>
            <div class="card-body">
                @if($hasil->detail_perhitungan && count($hasil->detail_perhitungan) > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Kriteria</th>
                                    <th>Simbol</th>
                                    <th>Nilai Normalisasi</th>
                                    <th>Bobot</th>
                                    <th>Kontribusi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($hasil->detail_perhitungan as $detail)
                                <tr>
                                    <td>{{ $detail['kriteria'] }}</td>
                                    <td class="text-center">
                                        <span class="badge bg-info">{{ $detail['simbol'] }}</span>
                                    </td>
                                    <td class="text-center">{{ number_format($detail['nilai_normalisasi'], 4) }}</td>
                                    <td class="text-center">{{ number_format($detail['bobot'], 4) }}</td>
                                    <td class="text-center">
                                        <strong class="text-primary">{{ number_format($detail['kontribusi'], 6) }}</strong>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="table-light">
                                <tr>
                                    <th colspan="4" class="text-end">Total Nilai SAW:</th>
                                    <th class="text-center">
                                        <span class="h5 text-success">{{ number_format($hasil->nilai_total_saw, 6) }}</span>
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    
                    <div class="mt-4">
                        <h6>Penjelasan Perhitungan:</h6>
                        <ol>
                            <li><strong>Nilai Normalisasi:</strong> Nilai asli dibagi dengan nilai maksimal pada kriteria tersebut</li>
                            <li><strong>Bobot:</strong> Persentase bobot yang telah ditetapkan untuk setiap kriteria</li>
                            <li><strong>Kontribusi:</strong> Hasil perkalian antara nilai normalisasi dengan bobot</li>
                            <li><strong>Nilai SAW:</strong> Jumlah dari semua kontribusi kriteria</li>
                        </ol>
                    </div>
                @else
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        Detail perhitungan tidak tersedia.
                    </div>
                @endif
            </div>
        </div>

        <div class="mt-4">
            <a href="{{ route('hasil.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>
                Kembali ke Hasil SAW
            </a>
        </div>
    </div>
</div>
@endsection
