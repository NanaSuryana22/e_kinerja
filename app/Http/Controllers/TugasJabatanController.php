<?php

namespace App\Http\Controllers;

use App\Models\TugasJabatan;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use Session;

class TugasJabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = TugasJabatan::orderBy('created_at', 'desc')->paginate(10);
        return view('tugas_jabatan.index')->with('datas', $datas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jabatan = Jabatan::orderBy('nama', 'asc')->get();

        return view('tugas_jabatan.create')->with('jabatan', $jabatan);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new TugasJabatan();
        $data->nama_tugas = $request->nama_tugas;
        $data->jabatan_id = $request->jabatan_id;
        $data->bobot_penilaian = $request->bobot_penilaian;
        $data->save();

        Session::flash("notice", "Tugas Jabatan $data->nama Berhasil Dibuat.");
        return redirect()->route("tugas_jabatan.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TugasJabatan  $tugasJabatan
     * @return \Illuminate\Http\Response
     */
    public function show(TugasJabatan $tugasJabatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TugasJabatan  $tugasJabatan
     * @return \Illuminate\Http\Response
     */
    public function edit(TugasJabatan $tugasJabatan)
    {
        $jabatan = Jabatan::orderBy('nama', 'asc')->get();

        return view('tugas_jabatan.edit', compact('tugasJabatan'))->with('jabatan', $jabatan);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TugasJabatan  $tugasJabatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = TugasJabatan::find($id);
        $data->nama_tugas = $request->nama_tugas;
        $data->jabatan_id = $request->jabatan_id;
        $data->bobot_penilaian = $request->bobot_penilaian;
        $data->save();

        Session::flash("notice", "Tugas Jabatan $data->nama Berhasil Diubah.");
        return redirect()->route("tugas_jabatan.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TugasJabatan  $tugasJabatan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = TugasJabatan::find($id);
        $data->delete();

        Session::flash("notice", "Tugas Jabatan terpilih berhasil dihapus");
        return redirect()->route("tugas_jabatan.index");
    }
}
