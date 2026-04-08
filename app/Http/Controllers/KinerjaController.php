<?php

namespace App\Http\Controllers;

use App\Models\Kinerja;
use App\Models\Pegawai;
use App\Models\TugasJabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class KinerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role == 'admin') {
            // Admin melihat semua data
            $datas = Kinerja::orderBy('created_at', 'desc')->paginate(10);
        } else {
            // Pegawai hanya melihat datanya sendiri
            // Kita ambil data pegawai melalui relasi user
            $data_pegawai = $user->pegawai;

            if (!$data_pegawai) {
                return redirect()->back()->with('error', 'Profil pegawai tidak ditemukan.');
            }

            $datas = Kinerja::where('pegawai_id', $data_pegawai->id)
                            ->orderBy('created_at', 'desc')
                            ->paginate(10);
        }

        return view('laporan_kinerja.index')->with('datas', $datas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();

        if ($user->role == 'admin') {
            $pegawai = Pegawai::orderBy('nama', 'asc')->get();
            $tugas_jabatan = TugasJabatan::orderBy('nama_tugas', 'asc')->get();
        } else {
            // Ambil data pegawai lewat relasi yang kita buat tadi
            $data_pegawai = $user->pegawai;

            // Proteksi: Jika user login tapi tidak punya profil di tabel pegawais
            if (!$data_pegawai) {
                return redirect()->back()->with('error', 'Akun Anda tidak terhubung dengan data Pegawai.');
            }

            $pegawai = collect([$data_pegawai]);
            
            // Ambil jabatan_id dari profil pegawai tersebut
            $id_jabatan = $data_pegawai->jabatan_id; 
            
            $tugas_jabatan = TugasJabatan::where('jabatan_id', $id_jabatan)
                                        ->orderBy('nama_tugas', 'asc')
                                        ->get();
        }

        return view('laporan_kinerja.create', compact('pegawai', 'tugas_jabatan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 1. Validasi Data
        $request->validate([
            'pegawai_id' => 'required|exists:pegawais,id',
            'tugas_jabatan_id' => 'required|exists:tugas_jabatans,id',
            'tanggal_selesai' => 'required|date',
            'foto_bukti' => 'nullable|image|mimes:jpg,png,jpeg|max:2048', // Max 2MB
        ]);

        $data = new Kinerja();
        $data->pegawai_id = $request->pegawai_id;
        $data->tugas_jabatan_id = $request->tugas_jabatan_id;
        $data->tanggal_selesai = $request->tanggal_selesai;
        
        // Status default saat baru buat adalah pending
        $data->status = 'pending';

        // 2. Logika Upload Foto Bukti
        if ($request->hasFile('foto_bukti')) {
            // Beri nama file unik: waktu_namaasli.ext
            $file = $request->file('foto_bukti');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            
            // Simpan ke folder public/uploads/kinerja
            $tujuan_upload = 'uploads/kinerja';
            $file->move(public_path($tujuan_upload), $nama_file);
            
            // Simpan nama filenya ke database
            $data->foto_bukti = $nama_file;
        }

        $data->save();

        // 3. Feedback ke User
        return redirect()->route("laporan_kinerja.index")
                        ->with("notice", "Laporan Kinerja Berhasil Dibuat dan Menunggu Persetujuan.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kinerja  $kinerja
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Kinerja::with(['pegawai', 'tugas_jabatan'])->findOrFail($id);

        return view('laporan_kinerja.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kinerja  $kinerja
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Kinerja::findOrFail($id);
        $user = Auth::user();

        if ($user->role == 'admin') {
            $pegawai = Pegawai::orderBy('nama', 'asc')->get();
            $tugas_jabatan = TugasJabatan::orderBy('nama_tugas', 'asc')->get();
        } else {
            $pegawai = Pegawai::where('id', $user->pegawai_id)->get();
            $id_jabatan = $pegawai->first()->jabatan_id; 
            $tugas_jabatan = TugasJabatan::where('jabatan_id', $id_jabatan)->get();
        }

        return view('laporan_kinerja.edit', compact('data', 'tugas_jabatan', 'pegawai'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kinerja  $kinerja
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // 1. Validasi
        $request->validate([
            'pegawai_id' => 'required',
            'tugas_jabatan_id' => 'required',
            'tanggal_selesai' => 'required|date',
            'nilai' => 'nullable|numeric|min:0|max:100',
            'foto_bukti' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $data = Kinerja::findOrFail($id);
        
        // 2. Update Data Text
        $data->pegawai_id = $request->pegawai_id;
        $data->tugas_jabatan_id = $request->tugas_jabatan_id;
        $data->tanggal_selesai = $request->tanggal_selesai;
        $data->nilai = $request->nilai;
        $data->status = $request->status;
        $data->catatan_atasan = $request->catatan_atasan;

        // 3. Logika Update Foto
        if ($request->hasFile('foto_bukti')) {
            // Hapus foto lama jika ada
            if ($data->foto_bukti && file_exists(public_path('uploads/kinerja/' . $data->foto_bukti))) {
                unlink(public_path('uploads/kinerja/' . $data->foto_bukti));
            }

            // Upload foto baru
            $file = $request->file('foto_bukti');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('uploads/kinerja'), $nama_file);
            $data->foto_bukti = $nama_file;
        }

        $data->save();

        return redirect()->route("laporan_kinerja.index")
                        ->with("notice", "Laporan Kinerja Berhasil Diperbarui.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kinerja  $kinerja
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Kinerja::find($id);
        $data->delete();

        Session::flash("notice", "Laporan Kinerja terpilih berhasil dihapus");
        return redirect()->route("laporan_kinerja.index");
    }
}
