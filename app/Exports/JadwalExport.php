<?php

namespace App\Exports;

use App\Jadwal;
use Maatwebsite\Excel\Concerns\FromCollection;

class JadwalExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $jadwal = Jadwal::join('hari', 'hari.id', '=', 'jadwal.hari_id')
            ->join('kelas', 'kelas.id', '=', 'jadwal.kelas_id')
            ->join('mapel', 'mapel.id', '=', 'jadwal.mapel_id')
            ->join('ustadz', 'ustadz.id', '=', 'jadwal.ustadz_id')
            ->join('ruang', 'ruang.id', '=', 'jadwal.ruang_id')
            ->select('hari.nama_hari', 'kelas.nama_kelas', 'mapel.nama_mapel', 'ustadz.nama_ustadz', 'jadwal.jam_mulai', 'jadwal.jam_selesai', 'ruang.nama_ruang')
            ->get();
        return $jadwal;
    }
}
