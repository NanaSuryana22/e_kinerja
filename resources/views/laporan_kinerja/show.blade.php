@extends('template_admin.master')
@section('title', "Detail Laporan Kinerja")
@section('laporan_kinerja', 'active')
@section('content')
<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Detail Laporan Kinerja</h3>
            <p class="text-subtitle text-muted">Informasi lengkap hasil pengerjaan tugas.</p>
        </div>
    </div>
</div>

<section class="section">
    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Informasi Laporan</h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th width="30%">Nama Pegawai</th>
                            <td>{{ $data->pegawai->nama }}</td>
                        </tr>
                        <tr>
                            <th>NIP</th>
                            <td>{{ $data->pegawai->nip }}</td>
                        </tr>
                        <tr>
                            <th>Tugas</th>
                            <td>{{ $data->tugas_jabatan->nama_tugas }}</td>
                        </tr>
                        <tr>
                            <th>Bobot Tugas</th>
                            <td><span class="badge bg-info">{{ $data->tugas_jabatan->bobot_penilaian }}</span></td>
                        </tr>
                        <tr>
                            <th>Tanggal Selesai</th>
                            <td>{{ \Carbon\Carbon::parse($data->tanggal_selesai)->format('d F Y') }}</td>
                        </tr>
                    </table>

                    <div class="mt-4">
                        <h6>Foto Bukti:</h6>
                        @if($data->foto_bukti)
                            <img src="{{ asset('uploads/kinerja/'.$data->foto_bukti) }}" class="img-fluid rounded shadow-sm" style="max-height: 400px">
                        @else
                            <div class="alert alert-light-secondary">Tidak ada foto bukti yang diunggah.</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Hasil Penilaian</h4>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <small class="text-muted d-block">Status Saat Ini:</small>
                        @if($data->status == 'pending')
                            <span class="badge bg-warning p-2">MENUNGGU PERSETUJUAN</span>
                        @elseif($data->status == 'approved')
                            <span class="badge bg-success p-2">DISETUJUI (APPROVED)</span>
                        @else
                            <span class="badge bg-danger p-2">DITOLAK (REJECTED)</span>
                        @endif
                    </div>

                    <hr>

                    <div class="row text-center">
                        <div class="col-12">
                            <small class="text-muted">Skor Kinerja</small>
                            <h1 class="display-4 {{ $data->nilai >= 75 ? 'text-success' : 'text-danger' }}">
                                {{ $data->nilai ?? '0' }}
                            </h1>
                        </div>
                    </div>

                    <div class="mt-3">
                        <h6>Catatan Atasan:</h6>
                        <div class="p-3 bg-light rounded italic">
                            "{{ $data->catatan_atasan ?? 'Belum ada catatan dari atasan.' }}"
                        </div>
                    </div>

                    <div class="mt-4 d-grid gap-2">
                        <a href="{{ route('laporan_kinerja.edit', $data->id) }}" class="btn btn-primary">
                            <i class="bi bi-pencil"></i> Edit / Beri Nilai
                        </a>
                        <a href="{{ route('laporan_kinerja.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection