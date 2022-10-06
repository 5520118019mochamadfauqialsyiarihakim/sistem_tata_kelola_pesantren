<?php

namespace App\Http\Controllers;

use Auth;
use App\Ustadz;
use App\Santri;
use App\Kelas;
use App\Jadwal;
use App\Nilai;
use App\Ulangan;
use App\Rapot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

class UlanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ustadz = Ustadz::where('id_card', Auth::user()->id_card)->first();
        $jadwal = Jadwal::where('ustadz_id', $ustadz->id)->orderBy('kelas_id')->get();
        $kelas = $jadwal->groupBy('kelas_id');
        return view('ustadz.ulangan.kelas', compact('kelas', 'ustadz'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelas = Kelas::orderBy('nama_kelas')->get();
        return view('admin.ulangan.home', compact('kelas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $ustadz = Ustadz::findorfail($request->ustadz_id);
        $cekJadwal = Jadwal::where('ustadz_id', $ustadz->id)->where('kelas_id', $request->kelas_id)->count();

        if ($cekJadwal >= 1) {
            if ($request->ulha_1 && $request->ulha_2 && $request->uts && $request->ulha_3 && $request->uas) {
                $nilai = ($request->ulha_1 + $request->ulha_2 + $request->uts + $request->ulha_3 + (2 * $request->uas)) / 6;
                $nilai = (int) $nilai;
                $deskripsi = Nilai::where('ustadz_id', $request->ustadz_id)->first();
                $isi = Nilai::where('ustadz_id', $request->ustadz_id)->count();
                if ($isi >= 1) {
                    if ($nilai > 90) {
                        Rapot::create([
                            'santri_id' => $request->santri_id,
                            'kelas_id' => $request->kelas_id,
                            'ustadz_id' => $request->ustadz_id,
                            'mapel_id' => $ustadz->mapel_id,
                            'p_nilai' => $nilai,
                            'p_predikat' => 'A',
                            'p_deskripsi' => $deskripsi->deskripsi_a,
                        ]);
                    } else if ($nilai > 80) {
                        Rapot::create([
                            'santri_id' => $request->santri_id,
                            'kelas_id' => $request->kelas_id,
                            'ustadz_id' => $request->ustadz_id,
                            'mapel_id' => $ustadz->mapel_id,
                            'p_nilai' => $nilai,
                            'p_predikat' => 'B',
                            'p_deskripsi' => $deskripsi->deskripsi_b,
                        ]);
                    } else if ($nilai > 70) {
                        Rapot::create([
                            'santri_id' => $request->santri_id,
                            'kelas_id' => $request->kelas_id,
                            'ustadz_id' => $request->ustadz_id,
                            'mapel_id' => $ustadz->mapel_id,
                            'p_nilai' => $nilai,
                            'p_predikat' => 'C',
                            'p_deskripsi' => $deskripsi->deskripsi_c,
                        ]);
                    } else {
                        Rapot::create([
                            'santri_id' => $request->santri_id,
                            'kelas_id' => $request->kelas_id,
                            'ustadz_id' => $request->ustadz_id,
                            'mapel_id' => $ustadz->mapel_id,
                            'p_nilai' => $nilai,
                            'p_predikat' => 'D',
                            'p_deskripsi' => $deskripsi->deskripsi_d,
                        ]);
                    }
                } else {
                    return response()->json(['error' => 'Tolong masukkan deskripsi predikat anda terlebih dahulu!']);
                }
            } else {
            }
            Ulangan::updateOrCreate(
                [
                    'id' => $request->id
                ],
                [
                    'santri_id' => $request->santri_id,
                    'kelas_id' => $request->kelas_id,
                    'ustadz_id' => $request->ustadz_id,
                    'mapel_id' => $ustadz->mapel_id,
                    'ulha_1' => $request->ulha_1,
                    'ulha_2' => $request->ulha_2,
                    'uts' => $request->uts,
                    'ulha_3' => $request->ulha_3,
                    'uas' => $request->uas,
                ]
            );
            return response()->json(['success' => 'Nilai ulangan santri berhasil ditambahkan!']);
        } else {
            return response()->json(['error' => 'Maaf ustadz ini tidak mengajar kelas ini!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = Crypt::decrypt($id);
        $ustadz = Ustadz::where('id_card', Auth::user()->id_card)->first();
        $kelas = Kelas::findorfail($id);
        $santri = Santri::where('kelas_id', $id)->get();
        return view('ustadz.ulangan.nilai', compact('ustadz', 'kelas', 'santri'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $kelas = Kelas::findorfail($id);
        $santri = Santri::orderBy('nama_santri')->where('kelas_id', $id)->get();
        return view('admin.ulangan.index', compact('kelas', 'santri'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ulangan = Ulangan::findorfail($id);
        //$ulangan->delete();
        $ulangan->where('id',$id)->delete();
        return redirect()->back()->with('warning', 'Data ulangan berhasil dihapus!');
    }

    public function ulangan($id)
    {
        $id = Crypt::decrypt($id);
        $santri = Santri::findorfail($id);
        $kelas = Kelas::findorfail($santri->kelas_id);
        $jadwal = Jadwal::orderBy('mapel_id')->where('kelas_id', $kelas->id)->get();
        $mapel = $jadwal->groupBy('mapel_id');
        return view('admin.ulangan.show', compact('mapel', 'santri', 'kelas'));
    }

    public function santri()
    {
        $santri = Santri::where('no_induk', Auth::user()->no_induk)->first();
        $kelas = Kelas::findorfail($santri->kelas_id);
        $jadwal = Jadwal::where('kelas_id', $kelas->id)->orderBy('mapel_id')->get();
        $mapel = $jadwal->groupBy('mapel_id');
        return view('santri.ulangan', compact('santri', 'kelas', 'mapel'));
    }
}
