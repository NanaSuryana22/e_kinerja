<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Models\Kinerja;
use App\Models\Pegawai;

class HalamanUtamaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $pegawai = $user->pegawai;
        $now = now();

        // 1. Widget Ringkasan
        $totalSelesai = Kinerja::where('pegawai_id', $pegawai->id)
                        ->whereMonth('tanggal_selesai', $now->month)
                        ->count();

        $rataNilai = Kinerja::where('pegawai_id', $pegawai->id)
                        ->avg('nilai') ?? 0;

        // Perhitungan Peringkat (Berdasarkan total skor semua pegawai bulan ini)
        $peringkat = Pegawai::withSum(['kinerjas' => function($q) use ($now) {
                            $q->whereMonth('tanggal_selesai', $now->month);
                        }], 'nilai') // Sederhananya berdasarkan nilai, atau hitung via service
                        ->orderBy('kinerjas_sum_nilai', 'desc')
                        ->get()
                        ->pluck('id')
                        ->search($pegawai->id) + 1;

        // 2. Data Grafik 6 Bulan Terakhir
        $grafikData = [];
        $labels = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $labels[] = $month->format('F');
            $grafikData[] = Kinerja::where('pegawai_id', $pegawai->id)
                            ->whereMonth('tanggal_selesai', $month->month)
                            ->whereYear('tanggal_selesai', $month->year)
                            ->count();
        }

        // 3. Progress Bar (Target Bobot Misal: 1000 per bulan)
        $targetBobot = 1000;
        $currentBobot = Kinerja::where('pegawai_id', $pegawai->id)
                        ->whereMonth('tanggal_selesai', $now->month)
                        ->get()
                        ->sum(function($k) {
                            return $k->tugas_jabatan->bobot_penilaian;
                        });
        $persenProgress = min(($currentBobot / $targetBobot) * 100, 100);

        return view('halaman_utama.index', compact(
            'totalSelesai', 'rataNilai', 'peringkat', 
            'labels', 'grafikData', 'persenProgress', 'currentBobot', 'targetBobot'
        ));
    }
}
