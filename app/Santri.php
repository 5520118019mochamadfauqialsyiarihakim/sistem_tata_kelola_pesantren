<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Santri extends Model
{
    use SoftDeletes;

    protected $fillable = ['no_induk', 'nis', 'nama_santri', 'kelas_id', 'jk', 'telp', 'tmp_lahir', 'tgl_lahir', 'foto', 'id_kamar', 'tahun_masuk', 'smt'];

    public function kelas()
    {
        return $this->belongsTo('App\Kelas')->withDefault();
    }

    public function ulangan($id)
    {
        $ustadz = Ustadz::where('id_card', Auth::user()->id_card)->first();
        $nilai = Ulangan::where('santri_id', $id)->where('ustadz_id', $ustadz->id)->first();
        return $nilai;
    }

    public function sikap($id)
    {
        $ustadz = Ustadz::where('id_card', Auth::user()->id_card)->first();
        $nilai = Sikap::where('santri_id', $id)->where('ustadz_id', $ustadz->id)->first();
        return $nilai;
    }

    public function nilai($id)
    {
        $ustadz = Ustadz::where('id_card', Auth::user()->id_card)->first();
        $nilai = Rapot::where('santri_id', $id)->where('ustadz_id', $ustadz->id)->first();
        return $nilai;
    }


    protected $table = 'santri';
}
