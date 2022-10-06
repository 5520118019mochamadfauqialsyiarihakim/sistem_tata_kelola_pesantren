<?php

namespace App\Exports;

use App\Santri;
use Maatwebsite\Excel\Concerns\FromCollection;

class SantriExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $santri = Santri::join('kelas', 'kelas.id', '=', 'santri.kelas_id')->select('santri.nama_santri', 'santri.no_induk', 'santri.jk', 'kelas.nama_kelas')->get();
        return $santri;
    }
}
