<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $fillable = [
        'nip', 'nama', 'alamat', 'no_telp', 'tanggal_lahir', 'tempat_lahir', 'jabatan_id'
    ];

    protected $table = "pegawais";

    public function jabatan() {
        return $this->belongsTo('App\Models\Jabatan', 'jabatan_id');
    }

    public function kinerjas() {
        return $this->hasMany('App\Models\Kinerja', 'pegawai_id');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
