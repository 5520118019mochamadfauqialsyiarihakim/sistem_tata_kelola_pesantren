<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Ustadz;
use App\Mapel;
use App\Jadwal;
use App\Absen;
use App\Kehadiran;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Exports\UstadzExport;
use App\Imports\UstadzImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Nilai;

class UstadzController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mapel = Mapel::orderBy('nama_mapel')->get();
        $max = Ustadz::max('id_card');
        return view('admin.ustadz.index', compact('mapel', 'max'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'id_card' => 'required',
            'nama_ustadz' => 'required',
            'mapel_id' => 'required',
            'kode' => 'required|string|unique:ustadz|min:2|max:3',
            'jk' => 'required'
        ]);

        if ($request->foto) {
            $foto = $request->foto;
            $new_foto = date('siHdmY') . "_" . $foto->getClientOriginalName();
            $foto->move('uploads/ustadz/', $new_foto);
            $nameFoto = 'uploads/ustadz/' . $new_foto;
        } else {
            if ($request->jk == 'L') {
                $nameFoto = 'uploads/ustadz/35251431012020_male.jpg';
            } else {
                $nameFoto = 'uploads/ustadz/23171022042020_female.jpg';
            }
        }

        $ustadz = Ustadz::create([
            'id_card' => $request->id_card,
            'nip' => $request->nip,
            'nama_ustadz' => $request->nama_ustadz,
            'mapel_id' => $request->mapel_id,
            'kode' => $request->kode,
            'jk' => $request->jk,
            'telp' => $request->telp,
            'tmp_lahir' => $request->tmp_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'foto' => $nameFoto
        ]);

        Nilai::create([
            'ustadz_id' => $ustadz->id
        ]);

        return redirect()->back()->with('success', 'Berhasil menambahkan data ustadz baru!');
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
        $ustadz = Ustadz::findorfail($id);
        return view('admin.ustadz.details', compact('ustadz'));
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
        $ustadz = Ustadz::findorfail($id);
        $mapel = Mapel::all();
        return view('admin.ustadz.edit', compact('ustadz', 'mapel'));
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
        $this->validate($request, [
            'nama_ustadz' => 'required',
            'mapel_id' => 'required',
            'jk' => 'required',
        ]);

        $ustadz = Ustadz::findorfail($id);
        $user = User::where('id_card', $ustadz->id_card)->first();
        if ($user) {
            $user_data = [
                'name' => $request->nama_ustadz
            ];
            $user->update($user_data);
        } else {
        }
        $ustadz_data = [
            'nama_ustadz' => $request->nama_ustadz,
            'mapel_id' => $request->mapel_id,
            'jk' => $request->jk,
            'telp' => $request->telp,
            'tmp_lahir' => $request->tmp_lahir,
            'tgl_lahir' => $request->tgl_lahir
        ];
        $ustadz->update($ustadz_data);

        return redirect()->route('ustadz.index')->with('success', 'Data ustadz berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ustadz = Ustadz::findorfail($id);
        $countJadwal = Jadwal::where('ustadz_id', $ustadz->id)->count();
        if ($countJadwal >= 1) {
            $jadwal = Jadwal::where('ustadz_id', $ustadz->id)->delete();
        } else {
        }
        $countUser = User::where('id_card', $ustadz->id_card)->count();
        if ($countUser >= 1) {
            $user = User::where('id_card', $ustadz->id_card)->delete();
        } else {
        }
        $ustadz->delete();
        return redirect()->route('ustadz.index')->with('warning', 'Data ustadz berhasil dihapus! (Silahkan cek trash data ustadz)');
    }

    public function trash()
    {
        $ustadz = Ustadz::onlyTrashed()->get();
        return view('admin.ustadz.trash', compact('ustadz'));
    }

    public function restore($id)
    {
        $id = Crypt::decrypt($id);
        $ustadz = Ustadz::withTrashed()->findorfail($id);
        $countJadwal = Jadwal::withTrashed()->where('ustadz_id', $ustadz->id)->count();
        if ($countJadwal >= 1) {
            $jadwal = Jadwal::withTrashed()->where('ustadz_id', $ustadz->id)->restore();
        } else {
        }
        $countUser = User::withTrashed()->where('id_card', $ustadz->id_card)->count();
        if ($countUser >= 1) {
            $user = User::withTrashed()->where('id_card', $ustadz->id_card)->restore();
        } else {
        }
        $ustadz->restore();
        return redirect()->back()->with('info', 'Data ustadz berhasil direstore! (Silahkan cek data ustadz)');
    }

    public function kill($id)
    {
        $ustadz = Ustadz::withTrashed()->findorfail($id);
        $countJadwal = Jadwal::withTrashed()->where('ustadz_id', $ustadz->id)->count();
        if ($countJadwal >= 1) {
            $jadwal = Jadwal::withTrashed()->where('ustadz_id', $ustadz->id)->forceDelete();
        } else {
        }
        $countUser = User::withTrashed()->where('id_card', $ustadz->id_card)->count();
        if ($countUser >= 1) {
            $user = User::withTrashed()->where('id_card', $ustadz->id_card)->forceDelete();
        } else {
        }
        $ustadz->forceDelete();
        return redirect()->back()->with('success', 'Data ustadz berhasil dihapus secara permanent');
    }

    public function ubah_foto($id)
    {
        $id = Crypt::decrypt($id);
        $ustadz = Ustadz::findorfail($id);
        return view('admin.ustadz.ubah-foto', compact('ustadz'));
    }

    public function update_foto(Request $request, $id)
    {
        $this->validate($request, [
            'foto' => 'required'
        ]);

        $ustadz = Ustadz::findorfail($id);
        $foto = $request->foto;
        $new_foto = date('s' . 'i' . 'H' . 'd' . 'm' . 'Y') . "_" . $foto->getClientOriginalName();
        $ustadz_data = [
            'foto' => 'uploads/ustadz/' . $new_foto,
        ];
        $foto->move('uploads/ustadz/', $new_foto);
        $ustadz->update($ustadz_data);

        return redirect()->route('ustadz.index')->with('success', 'Berhasil merubah foto!');
    }

    public function mapel($id)
    {
        $id = Crypt::decrypt($id);
        $mapel = Mapel::findorfail($id);
        $ustadz = Ustadz::where('mapel_id', $id)->orderBy('kode', 'asc')->get();
        return view('admin.ustadz.show', compact('mapel', 'ustadz'));
    }

    public function absen()
    {
        $absen = Absen::where('tanggal', date('Y-m-d'))->get();
        $kehadiran = Kehadiran::limit(4)->get();
        return view('ustadz.absen', compact('absen', 'kehadiran'));
    }

    public function simpan(Request $request)
    {
        $this->validate($request, [
            'id_card' => 'required',
            'kehadiran_id' => 'required'
        ]);
        $cekUstadz = Ustadz::where('id_card', $request->id_card)->count();
        if ($cekUstadz >= 1) {
            $ustadz = Ustadz::where('id_card', $request->id_card)->first();
            if ($ustadz->id_card == Auth::user()->id_card) {
                $cekAbsen = Absen::where('ustadz_id', $ustadz->id)->where('tanggal', date('Y-m-d'))->count();
                if ($cekAbsen == 0) {
                    if (date('w') != '0' && date('w') != '7') {
                        Absen::create([
                            'tanggal' => date('Y-m-d'),
                            'ustadz_id' => $ustadz->id,
                            'kehadiran_id' => $request->kehadiran_id,
                        ]);
                        return redirect()->back()->with('success', 'Anda hari ini berhasil absen!');
                    } else {
                        $namaHari = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu"];
                        $d = date('w');
                        $hari = $namaHari[$d];
                        return redirect()->back()->with('info', 'Maaf pesantren hari ' . $hari . ' libur!');
                    }
                } else {
                    return redirect()->back()->with('warning', 'Maaf absensi tidak bisa dilakukan 2x!');
                }
            } else {
                return redirect()->back()->with('error', 'Maaf id card ini bukan milik anda!');
            }
        } else {
            return redirect()->back()->with('error', 'Maaf id card ini tidak terdaftar!');
        }
    }

    public function absensi()
    {
        $ustadz = Santri::all();
        return view('admin.ustadz.absen', compact('ustadz'));
    }

    public function kehadiran($id)
    {
        $id = Crypt::decrypt($id);
        $ustadz = Santri::findorfail($id);
        $absen = Absen::orderBy('tanggal', 'desc')->where('santri_id', $id)->get();
        return view('admin.ustadz.kehadiran', compact('ustadz', 'absen'));
    }

    public function export_excel()
    {
        return Excel::download(new UstadzExport, 'ustadz.xlsx');
    }

    public function import_excel(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);
        $file = $request->file('file');
        $nama_file = rand() . $file->getClientOriginalName();
        $file->move('file_ustadz', $nama_file);
        Excel::import(new UstadzImport, public_path('/file_ustadz/' . $nama_file));
        return redirect()->back()->with('success', 'Data Ustadz Berhasil Diimport!');
    }

    public function deleteAll()
    {
        $ustadz = Ustadz::all();
        if ($ustadz->count() >= 1) {
            Ustadz::whereNotNull('id')->delete();
            Ustadz::withTrashed()->whereNotNull('id')->forceDelete();
            return redirect()->back()->with('success', 'Data table ustadz berhasil dihapus!');
        } else {
            return redirect()->back()->with('warning', 'Data table ustadz kosong!');
        }
    }
}
