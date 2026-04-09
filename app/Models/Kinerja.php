<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\KinerjaService;

class Kinerja extends Model
{
    use HasFactory;

    protected $table = "kinerjas";

    protected $fillable = [
        'pegawai_id', 'tugas_jabatan_id', 'tanggal_selesai', 'nilai', 'status', 'foto_bukti', 'catatan_atasan'
    ];

    public function pegawai() {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }

    public function tugas_jabatan() {
        return $this->belongsTo(TugasJabatan::class, 'tugas_jabatan_id');
    }

    /**
     * Accessor untuk mendapatkan total skor secara otomatis.
     */
    public function getTotalSkorAttribute()
    {
        $service = new KinerjaService();
        
        // Mengambil bobot dari relasi tugas_jabatan dan nilai dari kolom di table ini
        return $service->hitungSkor(
            $this->tugas_jabatan->bobot_penilaian ?? 0, 
            $this->nilai
        );
    }
}
