@extends('template_admin.master')
@section('title', "Master Tugas Jabatan")
@section('tugas_jabatan', 'active')
@section('content')
<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Tugas Jabatan</h3>
            <p class="text-subtitle text-muted">Tambah Data Tugas Jabatan.</p>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('tugas_jabatan.index') }}">Tugas Jabatan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Data Tugas Jabatan</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Form Input Tugas Jabatan</h4>
        </div>
        <div class="card-body">
            <section id="multiple-column-form">
                <div class="row match-height">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <form class="form" action="{{ route('tugas_jabatan.store') }}" method="post" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="row">
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label for="nama_tugas">Nama Tugas Jabatan</label>
                                                    <input type="text" id="nama_tugas" class="form-control @error('nama_tugas') is-invalid @enderror"
                                                        placeholder="Silahkan Isi Nama Tugas Jabatan.." name="nama_tugas" value="{{ old('nama_tugas') }}" required>
                                                    @if($errors->has('nama_tugas'))
                                                      <span class="invalid-feedback" role="alert">
                                                        <strong>{{$errors->first('nama_tugas') }}</strong>
                                                      </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label for="jabatan_id">Pilih Jabatan</label>
                                                    <select name="jabatan_id" id="jabatan_id" class="form-control @error('jabatan_id') is-invalid @enderror" value="{{ old('jabatan_id') }}">
                                                        @foreach($jabatan as $k)
                                                        <option value="{{ $k->id}}">{{ $k->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                    @if($errors->has('jabatan_id'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{$errors->first('jabatan_id') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                  <label for="bobot_penilaian">Bobot Penilaian</label>
                                                  <input type="number" id="bobot_penilaian" class="form-control @error('bobot_penilaian') is-invalid @enderror"
                                                      placeholder="Silahkan Isi Bobot penilaian.." name="bobot_penilaian" value="{{ old('bobot_penilaian') }}" required>
                                                  @if($errors->has('bobot_penilaian'))
                                                    <span class="invalid-feedback" role="alert">
                                                      <strong>{{$errors->first('bobot_penilaian') }}</strong>
                                                    </span>
                                                  @endif
                                              </div>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary me-1 mb-1 pull-left">Simpan</button>
                                                <button type="reset" class="btn btn-warning me-1 mb-1 pull-left">Reset</button>
                                                <a class="btn btn-info me-1 mb-1 pull-right" href="{{ url()->previous() }}">Kembali</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>
@endsection