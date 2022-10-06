<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AbsensiSantri extends Model
{
    protected $fillable = ['santri_id', 'tanggal', 'kehadiran_id'];

    public function santri()
    {
        return $this->belongsTo('App\Santri')->withDefault();
    }

    public function kehadiran()
    {
        return $this->belongsTo('App\KehadiranSantri')->withDefault();
    }

    protected $table = 'absensi_santri';
}
