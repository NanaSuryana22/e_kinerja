<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', 'keterangan'
    ];

    protected $table = "jabatans";

    public function pegawai() {
        return $this->hasOne('App\Models\Jabatan', 'jabatan_id');
    }

    public function tugas(): HasMany
    {
        return $this->hasMany(TugasJabatan::class);
    }
}
