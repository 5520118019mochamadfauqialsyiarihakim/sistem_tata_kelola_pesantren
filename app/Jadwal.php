<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jadwal extends Model
{
  use SoftDeletes;

  protected $fillable = ['hari_id', 'kelas_id', 'mapel_id', 'ustadz_id', 'jam_mulai', 'jam_selesai', 'ruang_id'];

  public function hari()
  {
    return $this->belongsTo('App\Hari')->withDefault();
  }

  public function kelas()
  {
    return $this->belongsTo('App\Kelas')->withDefault();
  }

  public function mapel()
  {
    return $this->belongsTo('App\Mapel')->withDefault();
  }

  public function ustadz()
  {
    return $this->belongsTo('App\Ustadz')->withDefault();
  }

  public function ruang()
  {
    return $this->belongsTo('App\Ruang')->withDefault();
  }

  public function rapot($id)
  {
    $kelas = Kelas::where('id', $id)->first();
    return $kelas;
  }

  public function pengajar($id)
  {
    $ustadz = Ustadz::where('id', $id)->first();
    return $ustadz;
  }

  public function ulangan($id)
  {
    $santri = Santri::where('no_induk', Auth::user()->no_induk)->first();
    $nilai = Ulangan::where('santri_id', $santri->id)->where('mapel_id', $id)->first();
    return $nilai;
  }

  public function nilai($id)
  {
    $santri = Santri::where('no_induk', Auth::user()->no_induk)->first();
    $nilai = Rapot::where('santri_id', $santri->id)->where('mapel_id', $id)->first();
    return $nilai;
  }

  public function kkm($id)
  {
    $kkm = Nilai::where('ustadz_id', $id)->first();
    return $kkm['kkm'];
  }

  public function absen($id)
  {
    $absen = Absen::where('tanggal', date('Y-m-d'))->where('ustadz_id', $id)->first();
    $ket = Kehadiran::where('id', $absen['kehadiran_id'])->first();
    return $ket['color'];
  }

  public function cekUlangan($id)
  {
    $data = json_decode($id, true);
    $ulangan = Ulangan::where('santri_id', $data['santri'])->where('mapel_id', $data['mapel'])->first();
    return $ulangan;
  }

  public function cekRapot($id)
  {
    $data = json_decode($id, true);
    $rapot = Rapot::where('santri_id', $data['santri'])->where('mapel_id', $data['mapel'])->first();
    return $rapot;
  }

  protected $table = 'jadwal';
}
