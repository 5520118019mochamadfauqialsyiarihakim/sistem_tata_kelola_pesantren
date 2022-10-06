<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mapel extends Model
{
    use SoftDeletes;

    protected $fillable = ['id', 'nama_mapel', 'paket_id', 'kelompok'];

    public function paket()
    {
        return $this->belongsTo('App\Paket')->withDefault();
    }

    public function sikap($id)
    {
        $santri = Santri::where('no_induk', Auth::user()->no_induk)->first();
        $nilai = Sikap::where('santri_id', $santri->id)->where('mapel_id', $id)->first();
        return $nilai;
    }

    public function cekSikap($id)
    {
        $data = json_decode($id, true);
        $sikap = Sikap::where('santri_id', $data['santri'])->where('mapel_id', $data['mapel'])->first();
        return $sikap;
    }

    protected $table = 'mapel';
}
