@extends('template_admin.master')
@section('title', "Master Pegawai")
@section('pegawai', 'active')
@section('content')
<div class="page-title">
  <div class="row">
      <div class="col-12 col-md-6 order-md-1 order-last">
          <h3>Pegawai</h3>
          <p class="text-subtitle text-muted">Koleksi Data Pegawai.</p>
      </div>
      <div class="col-12 col-md-6 order-md-2 order-first">
          <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
              <ol class="breadcrumb">
                  <li class="breadcrumb-item active"><a href="{{ route('pegawai.index') }}">Pegawai</a></li>
              </ol>
          </nav>
      </div>
  </div>
</div>
<section class="section">
  <div class="card">
    <div class="card-header">
      <div class="col-lg-12">
        @include('template_admin.notice')
      </div>
      <h4 class="card-title">Tabel Data Pegawai</h4>
      <a href="{{ route('pegawai.create') }}" class="btn btn-sm btn-info">Tambah Pegawai</a>
    </div>
    <div class="card-body">
      <div>
				<section id="no-more-tables">
					<table class="table table-bordered table-striped table-condensed cf">
						<thead class="cf">
							<tr>
								<th class="th-font">Nomor</th>
								<th class="th-font">NIP</th>
								<th class="th-font">Nama</th>
								<th class="th-font">Email/Login</th>
								<th class="th-font">Alamat </th>
								<th class="th-font">Nomor Telp.</th>
								<th class="th-font">Tempat Lahir</th>
								<th class="th-font">Tanggal Lahir</th>
								<th class="th-font">Jabatan</th>
								<th class="th-font">Aksi</th>
							</tr>
						</thead>
						<tbody>
							@foreach($datas as $no => $data)
								<tr>
									<td class="th-font" data-title="Nomor">{{ ++$no + ($datas->currentPage()-1) * $datas->perPage() }}</td>
									<td class="th-font" data-title="NIP">{{ $data->nip }}</td>
									<td class="th-font" data-title="Nama">{{ $data->nama }}</td>
									<td class="th-font" data-title="Email">{{ $data->user->email ?? '-' }}</td>
									<td class="th-font" data-title="Alamat">{{ $data->alamat }}</td>
									<td class="th-font" data-title="No. Telp">{{ $data->no_telp }}</td>
									<td class="th-font" data-title="Tempat Lahir">{{ $data->tempat_lahir }}</td>
									<td class="th-font" data-title="Tanggal Lahir">{{ $data->tanggal_lahir }}</td>
									<td class="th-font" data-title="Jabatan">{{ $data->jabatan->nama }}</td>
									<td class="th-font" data-title="Aksi">
										<form action="{{ route('pegawai.destroy', $data->id) }}" method="post">
											{{--  <a class="btn btn-sm btn-primary"
												href="{{ route('pegawai.show',$data->id) }}" title="Lihat Detail">
												<i class="fa fa-eye"></i>
											</a>  --}}
											<a class="btn btn-sm btn-warning"
												href="{{ route('pegawai.edit',$data->id) }}" title="Ubah Data">
												<i class="fa fa-pencil"></i>
											</a>
											{{ csrf_field() }}
											{{ method_field('DELETE') }}
											<button class="btn btn-sm btn-danger" type="submit"
												onclick="return confirm('Yakin ingin menghapus Pegawai ini ?')">
												<i class="fa fa-trash" title="Hapus Data"></i>
											</button>
										</form>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
					{{ $datas->links() }}
				</section>
			</div>			
    </div>
  </div>
</section>
@endsection
