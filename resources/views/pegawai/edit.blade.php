@extends('template_admin.master')
@section('title', "Master Pegawai")
@section('pegawai', 'active')
@section('content')
<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Pegawai</h3>
            <p class="text-subtitle text-muted">Edit Data Pegawai.</p>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('pegawai.index') }}">Pegawai</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Data Pegawai</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Form Input Pegawai</h4>
        </div>
        <div class="card-body">
            <section id="multiple-column-form">
                <div class="row match-height">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <form class="form" action="{{ route('pegawai.update', $pegawai->id) }}"
                                        method="post" enctype="multipart/form-data">
                                        {{ csrf_field() }} {{method_field('PUT')}}
                                        <div class="row">
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label for="nip">NIP</label>
                                                    <input type="text" id="nip"
                                                        class="form-control @error('nip') is-invalid @enderror"
                                                        placeholder="Silahkan Isi NIP Pegawai.." name="nip"
                                                        value="{{ $pegawai->nip }}" required>
                                                    @if($errors->has('nip'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{$errors->first('nip') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label for="nama">Nama Pegawai</label>
                                                    <input type="text" id="nama"
                                                        class="form-control @error('nama') is-invalid @enderror"
                                                        placeholder="Silahkan Isi Nama Pegawai.." name="nama"
                                                        value="{{ $pegawai->nama }}" required>
                                                    @if($errors->has('nama'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{$errors->first('nama') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                                <div class="divider">
                                                    <div class="divider-text">Update Akun Login</div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="email">Email (Username)</label>
                                                    <input type="email" id="email" class="form-control" name="email"
                                                        value="{{ $pegawai->user->email }}" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="password">Password (Kosongkan jika tidak ingin
                                                        ganti)</label>
                                                    <input type="password" id="password" class="form-control"
                                                        name="password"
                                                        placeholder="Isi hanya jika ingin mengganti password">
                                                </div>
                                                <div class="form-group">
                                                    <label for="alamat">Alamat</label>
                                                    <textarea name="alamat" id="alamat" class="form-control"
                                                        required>{{ $pegawai->alamat }}</textarea>
                                                    @if($errors->has('alamat'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{$errors->first('alamat') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label for="no_telp">Nomor Telp.</label>
                                                    <input type="text" id="no_telp"
                                                        class="form-control @error('no_telp') is-invalid @enderror"
                                                        placeholder="Silahkan Isi Nomor Telp. Pegawai.." name="no_telp"
                                                        value="{{ $pegawai->no_telp }}" required>
                                                    @if($errors->has('no_telp'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{$errors->first('no_telp') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label for="tempat_lahir">Tempat Lahir.</label>
                                                    <input type="text" id="tempat_lahir"
                                                        class="form-control @error('tempat_lahir') is-invalid @enderror"
                                                        placeholder="Silahkan Isi Tempat Lahir.." name="tempat_lahir"
                                                        value="{{ $pegawai->tempat_lahir }}" required>
                                                    @if($errors->has('tempat_lahir'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{$errors->first('tempat_lahir') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label for="tanggal_lahir">Tanggal Lahir.</label>
                                                    <input type="date" id="tanggal_lahir"
                                                        class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                                        placeholder="Silahkan Isi Tanggal Lahir.." name="tanggal_lahir"
                                                        value="{{ $pegawai->tanggal_lahir }}" required>
                                                    @if($errors->has('tanggal_lahir'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{$errors->first('tanggal_lahir') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label for="jabatan_id">Pilih Jabatan</label>
                                                    <select name="jabatan_id" id="jabatan_id"
                                                        class="form-control @error('jabatan_id') is-invalid @enderror"
                                                        value="{{ $pegawai->jabatan_id }}">
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
                                            </div>
                                            <div class="col-12">
                                                <button type="submit"
                                                    class="btn btn-primary me-1 mb-1 pull-left">Simpan</button>
                                                <button type="reset"
                                                    class="btn btn-warning me-1 mb-1 pull-left">Reset</button>
                                                <a class="btn btn-info me-1 mb-1 pull-right"
                                                    href="{{ url()->previous() }}">Kembali</a>
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