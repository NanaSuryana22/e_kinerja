@extends('template_admin.master')
@section('title', "Edit Laporan Kinerja")
@section('laporan_kinerja', 'active')
@section('content')
<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Edit Laporan Kinerja</h3>
            <p class="text-subtitle text-muted">Perbarui data atau berikan penilaian kinerja.</p>
        </div>
    </div>
</div>

<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Form Edit & Penilaian</h4>
        </div>
        <div class="card-body">
            <form class="form" action="{{ route('laporan_kinerja.update', $data->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="pegawai_id">Pegawai</label>
                            <select name="pegawai_id" id="pegawai_id" class="form-control" {{ Auth::user()->role != 'admin' ? 'disabled' : '' }}>
                                @foreach($pegawai as $k)
                                    <option value="{{ $k->id }}" {{ $data->pegawai_id == $k->id ? 'selected' : '' }}>{{ $k->nama }}</option>
                                @endforeach
                            </select>
                            @if(Auth::user()->role != 'admin')
                                <input type="hidden" name="pegawai_id" value="{{ $data->pegawai_id }}">
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="tugas_jabatan_id">Tugas Jabatan</label>
                            <select name="tugas_jabatan_id" id="tugas_jabatan_id" class="form-control">
                                @foreach($tugas_jabatan as $m)
                                    <option value="{{ $m->id }}" {{ $data->tugas_jabatan_id == $m->id ? 'selected' : '' }}>{{ $m->nama_tugas }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="tanggal_selesai">Tanggal Selesai</label>
                            <input type="date" name="tanggal_selesai" class="form-control" value="{{ $data->tanggal_selesai }}">
                        </div>

                        <div class="form-group">
                            <label>Foto Bukti Saat Ini</label>
                            <div class="mb-2">
                                @if($data->foto_bukti)
                                    <img src="{{ asset('uploads/kinerja/'.$data->foto_bukti) }}" width="200" class="img-thumbnail">
                                @else
                                    <p class="text-muted">Tidak ada foto.</p>
                                @endif
                            </div>
                            <label for="foto_bukti">Ganti Foto (Kosongkan jika tidak diubah)</label>
                            <input type="file" name="foto_bukti" class="form-control" accept="image/*">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status">Status Persetujuan</label>
                            <select name="status" id="status" class="form-control border-primary" {{ Auth::user()->role != 'admin' ? 'disabled' : '' }}>
                                <option value="pending" {{ $data->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="approved" {{ $data->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="rejected" {{ $data->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="nilai">Nilai Kinerja (0 - 100)</label>
                            <input type="number" name="nilai" id="nilai" class="form-control" value="{{ $data->nilai }}" 
                                {{ Auth::user()->role != 'admin' ? 'readonly' : '' }}>
                        </div>

                        <div class="form-group">
                            <label for="catatan_atasan">Catatan / Feedback Atasan</label>
                            <textarea name="catatan_atasan" class="form-control" rows="4">{{ $data->catatan_atasan }}</textarea>
                        </div>
                    </div>

                    <div class="col-12 d-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-primary me-1 mb-1">Update Data</button>
                        <a class="btn btn-info me-1 mb-1" href="{{ route('laporan_kinerja.index') }}">Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection