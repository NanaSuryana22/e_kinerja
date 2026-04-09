@extends('template_admin.master')
@section('title', "Halaman Utama")
@section('home', 'active')
@section('content')
<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Dashboard</h3>
            <p class="text-subtitle text-muted">Widget Ringkasan, Grafik Performa, & Progress Bar.</p>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="{{ route('halaman_utama.index') }}">Dashboard</a></li>
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
            <h4 class="card-title"></h4>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body px-3 py-4-5">
                        <h6 class="text-muted font-semibold">Tugas Selesai</h6>
                        <h6 class="font-extrabold mb-0">{{ $totalSelesai }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body px-3 py-4-5">
                        <h6 class="text-muted font-semibold">Peringkat</h6>
                        <h6 class="font-extrabold mb-0">#{{ $peringkat }}</h6>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h6>Capaian Target Bobot ({{ $currentBobot }}/{{ $targetBobot }})</h6>
                        <div class="progress progress-primary  mb-4 mt-4">
                            <div class="progress-bar progress-label" role="progressbar" 
                                style="width: {{ $persenProgress }}%" 
                                aria-valuenow="{{ $persenProgress }}" aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header"><h4>Tren Kinerja (6 Bulan Terakhir)</h4></div>
                    <div class="card-body">
                        <canvas id="performaChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('performaChart').getContext('2d');
    const performaChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [{
                label: 'Jumlah Tugas Selesai',
                data: {!! json_encode($grafikData) !!},
                borderColor: 'rgb(75, 192, 192)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true, ticks: { stepSize: 1 } }
            }
        }
    });
</script>
@endsection