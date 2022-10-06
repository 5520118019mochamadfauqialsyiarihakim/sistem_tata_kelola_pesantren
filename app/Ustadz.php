<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ustadz extends Model
{
    use SoftDeletes;

    protected $fillable = ['id_card', 'nip', 'nama_ustadz', 'mapel_id', 'kode', 'jk', 'telp', 'tmp_lahir', 'tgl_lahir', 'foto'];

    public function mapel()
    {
        return $this->belongsTo('App\Mapel')->withDefault();
    }

    public function nilai()
    {
        return $this->belongsTo('App\Nilai')->withDefault();
    }

    protected $table = 'ustadz';
}
