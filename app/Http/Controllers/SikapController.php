<?php

namespace App\Http\Controllers;

use Auth;
use App\Mapel;
use App\Ustadz;
use App\Santri;
use App\Kelas;
use App\Jadwal;
use App\Sikap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use DB;

class SikapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ustadz = Ustadz::where('id_card', Auth::user()->id_card)->first();
        /*if (
            $ustadz->mapel->nama_mapel == "Pendidikan Agama dan Budi Pekerti" ||
            $ustadz->mapel->nama_mapel == "Pendidikan Pancasila dan Kewarganegaraan"
        ) {*/
            $jadwal = Jadwal::where('ustadz_id', $ustadz->id)->orderBy('kelas_id')->get();
            $kelas = $jadwal->groupBy('kelas_id');
            return view('ustadz.sikap.index', compact('kelas', 'ustadz'));
        /*} else {
            return redirect()->back()->with('error', 'Maaf ustadz/ustadzah ini tidak dapat menambahkan nilai sikap!');
        }*/
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelas = Kelas::orderBy('nama_kelas')->get();
        return view('admin.sikap.home', compact('kelas'));
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
            /*if (
                $ustadz->mapel->nama_mapel == "Pendidikan Agama dan Budi Pekerti" ||
                $ustadz->mapel->nama_mapel == "Pendidikan Pancasila dan Kewarganegaraan"
            ) {*/
                Sikap::updateOrCreate(
                    [
                        'id' => $request->id
                    ],
                    [
                        'santri_id' => $request->santri_id,
                        'kelas_id' => $request->kelas_id,
                        'ustadz_id' => $request->ustadz_id,
                        'mapel_id' => $ustadz->mapel_id,
                        'sikap_1' => $request->sikap_1,
                        'sikap_2' => $request->sikap_2,
                        'sikap_3' => $request->sikap_3
                    ]
                );
                return response()->json(['success' => 'Nilai sikap santri berhasil ditambahkan!']);
            /*} else {
                return redirect()->json(['error' => 'Maaf ustadz ini tidak dapat menambahkan nilai sikap!']);
            }*/
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
        return view('ustadz.sikap.show', compact('ustadz', 'kelas', 'santri'));
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
        return view('admin.sikap.index', compact('kelas', 'santri'));
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
        $sikaps = Sikap::findorfail($id);
        $sikaps->delete();
        return redirect()->back()->with('warning', 'Data sikap berhasil dihapus!');
    }

    public function sikap($id)
    {
        $id = Crypt::decrypt($id);
        $santri = Santri::findorfail($id);
        $kelas = Kelas::findorfail($santri->kelas_id);
        //$mapel = Mapel::where('nama_mapel', 'Pendidikan Agama dan Budi Pekerti')->orWhere('nama_mapel', 'Pendidikan Pancasila dan Kewarganegaraan')->get();
        $mapel = Mapel::OrderBy('kelompok', 'asc')->OrderBy('nama_mapel', 'asc')->get();
        return view('admin.sikap.show', compact('mapel', 'santri', 'kelas'));
    }

    public function santri()
    {
        $santri = Santri::where('no_induk', Auth::user()->no_induk)->first();
        $kelas = Kelas::findorfail($santri->kelas_id);
        //$mapel = Mapel::where('nama_mapel', 'Pendidikan Agama dan Budi Pekerti')->orWhere('nama_mapel', 'Pendidikan Pancasila dan Kewarganegaraan')->get();
        $mapel = Mapel::OrderBy('kelompok', 'asc')->OrderBy('nama_mapel', 'asc')->get();
        return view('santri.sikap', compact('santri', 'kelas', 'mapel'));
    }
}
