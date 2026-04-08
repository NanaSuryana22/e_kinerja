@extends('template_admin.master')
@section('title', "Master Laporan Kinerja")
@section('laporan_kinerja', 'active')
@section('content')
<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Laporan Kinerja</h3>
            <p class="text-subtitle text-muted">Tambah Data Laporan Kinerja.</p>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('laporan_kinerja.index') }}">Laporan Kinerja</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Data Laporan Kinerja</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Form Input Laporan Kinerja</h4>
        </div>
        <div class="card-body">
            <form class="form" action="{{ route('laporan_kinerja.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="pegawai_id">Pilih Pegawai</label>
                            @if(Auth::user()->role == 'admin')
                                <select name="pegawai_id" id="pegawai_id" class="form-control @error('pegawai_id') is-invalid @enderror">
                                    <option value="" selected disabled>-- Pilih Pegawai --</option>
                                    @foreach($pegawai as $k)
                                        <option value="{{ $k->id }}" {{ old('pegawai_id') == $k->id ? 'selected' : '' }}>{{ $k->nama }}</option>
                                    @endforeach
                                </select>
                            @else
                                <select name="pegawai_id" class="form-control" readonly>
                                    <option value="{{ $pegawai->first()->id }}">{{ $pegawai->first()->nama }}</option>
                                </select>
                                <input type="hidden" name="pegawai_id" value="{{ $pegawai->first()->id }}">
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="tugas_jabatan_id">Pilih Tugas Jabatan</label>
                            <select name="tugas_jabatan_id" id="tugas_jabatan_id" class="form-control @error('tugas_jabatan_id') is-invalid @enderror">
                                <option value="" selected disabled>-- Pilih Tugas --</option>
                                @foreach($tugas_jabatan as $m)
                                    <option value="{{ $m->id }}" {{ old('tugas_jabatan_id') == $m->id ? 'selected' : '' }}>{{ $m->nama_tugas }} (Bobot: {{ $m->bobot_penilaian }})</option>
                                @endforeach
                            </select>
                            @error('tugas_jabatan_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="tanggal_selesai">Tanggal Selesai Pengerjaan</label>
                            <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control @error('tanggal_selesai') is-invalid @enderror" value="{{ old('tanggal_selesai') }}">
                            @error('tanggal_selesai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="foto_bukti">Foto Bukti Kegiatan (Opsional)</label>
                            <input type="file" name="foto_bukti" id="foto_bukti" class="form-control @error('foto_bukti') is-invalid @enderror" accept="image/*">
                            <small class="text-muted">Format: JPG, PNG, JPEG. Max: 2MB</small>
                            @error('foto_bukti')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 d-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-primary me-1 mb-1">Simpan Laporan</button>
                        <button type="reset" class="btn btn-warning me-1 mb-1">Reset</button>
                        <a class="btn btn-info me-1 mb-1" href="{{ route('laporan_kinerja.index') }}">Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection