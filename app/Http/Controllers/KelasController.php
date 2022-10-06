<?php

namespace App\Http\Controllers;

use App\Kelas;
use App\Ustadz;
use App\Paket;
use App\Jadwal;
use App\Santri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelas = Kelas::OrderBy('nama_kelas', 'asc')->get();
        $ustadz = Ustadz::OrderBy('nama_ustadz', 'asc')->get();
        $paket = Paket::all();
        return view('admin.kelas.index', compact('kelas', 'ustadz', 'paket'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ustadz = Ustadz::OrderBy('nama_ustadz', 'asc')->get();
        return view('admin.kelas.create', compact('ustadz'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->id != '') {
            $this->validate($request, [
                'nama_kelas' => 'required|min:6|max:10',
                'paket_id' => 'required',
                'ustadz_id' => 'required|unique:kelas',
            ]);
        } else {
            $this->validate($request, [
                'nama_kelas' => 'required|unique:kelas|min:6|max:10',
                'paket_id' => 'required',
                'ustadz_id' => 'required|unique:kelas',
            ]);
        }

        Kelas::updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'nama_kelas' => $request->nama_kelas,
                'paket_id' => $request->paket_id,
                'ustadz_id' => $request->ustadz_id,
            ]
        );

        return redirect()->back()->with('success', 'Data kelas berhasil diperbarui!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // 
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
        $kelas = Kelas::findorfail($id);
        $countJadwal = Jadwal::where('kelas_id', $kelas->id)->count();
        if ($countJadwal >= 1) {
            Jadwal::where('kelas_id', $kelas->id)->delete();
        } else {
        }
        $countSantri = Santri::where('kelas_id', $kelas->id)->count();
        if ($countSantri >= 1) {
            Santri::where('kelas_id', $kelas->id)->delete();
        } else {
        }
        $kelas->delete();
        return redirect()->back()->with('warning', 'Data kelas berhasil dihapus! (Silahkan cek trash data kelas)');
    }

    public function trash()
    {
        $kelas = Kelas::onlyTrashed()->get();
        return view('admin.kelas.trash', compact('kelas'));
    }

    public function restore($id)
    {
        $id = Crypt::decrypt($id);
        $kelas = Kelas::withTrashed()->findorfail($id);
        $countJadwal = Jadwal::withTrashed()->where('kelas_id', $kelas->id)->count();
        if ($countJadwal >= 1) {
            Jadwal::withTrashed()->where('kelas_id', $kelas->id)->restore();
        } else {
        }
        $countSantri = Santri::withTrashed()->where('kelas_id', $kelas->id)->count();
        if ($countSantri >= 1) {
            Santri::withTrashed()->where('kelas_id', $kelas->id)->restore();
        } else {
        }
        $kelas->restore();
        return redirect()->back()->with('info', 'Data kelas berhasil direstore! (Silahkan cek data kelas)');
    }

    public function kill($id)
    {
        $kelas = Kelas::withTrashed()->findorfail($id);
        $countJadwal = Jadwal::withTrashed()->where('kelas_id', $kelas->id)->count();
        if ($countJadwal >= 1) {
            Jadwal::withTrashed()->where('kelas_id', $kelas->id)->forceDelete();
        } else {
        }
        $countSantri = Santri::withTrashed()->where('kelas_id', $kelas->id)->count();
        if ($countSantri >= 1) {
            Santri::withTrashed()->where('kelas_id', $kelas->id)->forceDelete();
        } else {
        }
        $kelas->forceDelete();
        return redirect()->back()->with('success', 'Data kelas berhasil dihapus secara permanent');
    }

    public function getEdit(Request $request)
    {
        $kelas = Kelas::where('id', $request->id)->get();
        foreach ($kelas as $val) {
            $newForm[] = array(
                'id' => $val->id,
                'nama' => $val->nama_kelas,
                'paket_id' => $val->paket_id,
                'ustadz_id' => $val->ustadz_id,
            );
        }
        return response()->json($newForm);
    }
}
