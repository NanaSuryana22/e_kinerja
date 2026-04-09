<html>
<head>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        .header { text-align: center; margin-bottom: 30px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>RAPOR KINERJA PEGAWAI</h2>
        <p>Periode: {{ $bulan }}/{{ $tahun }}</p>
    </div>
    <p>Nama: {{ $pegawai->nama }}</p>
    <p>Jabatan: {{ $pegawai->jabatan->nama }}</p>

    <table>
        <thead>
            <tr>
                <th>Tugas</th>
                <th>Bobot</th>
                <th>Nilai</th>
                <th>Skor</th>
            </tr>
        </thead>
        <tbody>
            @foreach($datas as $d)
            <tr>
                <td>{{ $d->tugas_jabatan->nama_tugas }}</td>
                <td>{{ $d->tugas_jabatan->bobot_penilaian }}</td>
                <td>{{ $d->nilai }}</td>
                <td>{{ $d->total_skor }}</td> </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3">Total Skor Keseluruhan</th>
                <th>{{ $datas->sum(fn($i) => $i->total_skor) }}</th>
            </tr>
        </tfoot>
    </table>
</body>
</html>