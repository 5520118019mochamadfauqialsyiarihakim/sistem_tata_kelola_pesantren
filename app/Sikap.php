<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sikap extends Model
{
    protected $fillable = ['santri_id', 'kelas_id', 'ustadz_id', 'mapel_id', 'sikap_1', 'sikap_2', 'sikap_3'];

    protected $table = 'sikap';
}
