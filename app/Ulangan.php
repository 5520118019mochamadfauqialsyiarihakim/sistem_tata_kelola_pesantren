<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ulangan extends Model
{
    protected $fillable = ['santri_id', 'kelas_id', 'ustadz_id', 'mapel_id', 'ulha_1', 'ulha_2', 'uts', 'ulha_3', 'uas'];

    protected $table = 'ulangan';
}
