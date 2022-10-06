<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    protected $fillable = ['ustadz_id', 'tanggal', 'kehadiran_id'];

    public function ustadz()
    {
        return $this->belongsTo('App\Ustadz')->withDefault();
    }

    public function kehadiran()
    {
        return $this->belongsTo('App\Kehadiran')->withDefault();
    }

    protected $table = 'absensi_ustadz';
}
