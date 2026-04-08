<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Jabatan;
use App\Models\User; // Tambahkan ini
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Tambahkan ini untuk transaksi
use Illuminate\Support\Facades\Hash; // Tambahkan ini untuk password
use Session;

class PegawaiController extends Controller
{
    public function index()
    {
        $datas = Pegawai::with('jabatan', 'user')->orderBy('created_at', 'desc')->paginate(10);
        return view('pegawai.index')->with('datas', $datas);
    }

    public function create()
    {
        $jabatan = Jabatan::orderBy('nama', 'asc')->get();
        return view('pegawai.create')->with('jabatan', $jabatan);
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nip' => 'required|unique:pegawais,nip',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        // Gunakan Database Transaction agar jika salah satu gagal, semua dibatalkan
        DB::transaction(function () use ($request) {
            // 1. Buat User Account
            $user = User::create([
                'name' => $request->nama,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'pegawai', // Default role
            ]);

            // 2. Buat Data Pegawai
            $pegawai = new Pegawai();
            $pegawai->user_id = $user->id; // Hubungkan ke ID User
            $pegawai->nama = $request->nama;
            $pegawai->nip = $request->nip;
            $pegawai->alamat = $request->alamat;
            $pegawai->no_telp = $request->no_telp;
            $pegawai->tanggal_lahir = $request->tanggal_lahir;
            $pegawai->jabatan_id = $request->jabatan_id;
            $pegawai->tempat_lahir = $request->tempat_lahir;
            $pegawai->save();
        });

        Session::flash("notice", "Pegawai $request->nama dan akun login berhasil dibuat.");
        return redirect()->route("pegawai.index");
    }

    public function edit(Pegawai $pegawai)
    {
        $jabatan = Jabatan::orderBy('nama', 'asc')->get();
        // Pastikan relasi user terpanggil
        return view('pegawai.edit', compact('pegawai'))->with('jabatan', $jabatan);
    }

    public function update(Request $request, $id)
    {
        $pegawai = Pegawai::findOrFail($id);
        
        DB::transaction(function () use ($request, $pegawai) {
            // 1. Update User Account
            $user = User::findOrFail($pegawai->user_id);
            $user->name = $request->nama;
            $user->email = $request->email;
            if ($request->password) {
                $user->password = Hash::make($request->password);
            }
            $user->save();

            // 2. Update Data Pegawai
            $pegawai->nama = $request->nama;
            $pegawai->nip = $request->nip;
            $pegawai->alamat = $request->alamat;
            $pegawai->no_telp = $request->no_telp;
            $pegawai->tanggal_lahir = $request->tanggal_lahir;
            $pegawai->jabatan_id = $request->jabatan_id;
            $pegawai->tempat_lahir = $request->tempat_lahir;
            $pegawai->save();
        });

        Session::flash("notice", "Data Pegawai $request->nama berhasil diperbarui.");
        return redirect()->route("pegawai.index");
    }

    public function destroy($id)
    {
        $pegawai = Pegawai::find($id);
        
        DB::transaction(function () use ($pegawai) {
            // Hapus Usernya dulu, maka data pegawai otomatis terpengaruh (tergantung setting FK)
            User::where('id', $pegawai->user_id)->delete();
            $pegawai->delete();
        });

        Session::flash("notice", "Pegawai dan akun login berhasil dihapus.");
        return redirect()->route("pegawai.index");
    }
}