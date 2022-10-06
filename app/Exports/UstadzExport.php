<?php

namespace App\Exports;

use App\Ustadz;
use Maatwebsite\Excel\Concerns\FromCollection;

class UstadzExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $ustadz = Ustadz::join('mapel', 'mapel.id', '=', 'ustadz.mapel_id')->select('ustadz.nama_ustadz', 'ustadz.nip', 'ustadz.jk', 'mapel.nama_mapel')->get();
        return $ustadz;
    }
}
