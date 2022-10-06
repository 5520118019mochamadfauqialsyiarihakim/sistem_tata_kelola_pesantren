<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $fillable = ['ustadz_id', 'kkm', 'deskripsi_a', 'deskripsi_b', 'deskripsi_c', 'deskripsi_d'];

    public function ustadz()
    {
        return $this->belongsTo('App\Ustadz')->withDefault();
    }

    protected $table = 'nilai';
}
