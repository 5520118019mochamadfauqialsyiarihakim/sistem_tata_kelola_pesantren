<?php

namespace App\Http\Controllers;

use PDF;
use Auth;
use App\User;
use App\Kelas;
use App\Santri;
use App\Absen;
use App\Kehadiran;
use App\Exports\SantriExport;
use App\Imports\SantriImport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Crypt;

class SantriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelas = Kelas::OrderBy('nama_kelas', 'asc')->get();
        return view('admin.santri.index', compact('kelas'));
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
            'no_induk' => 'required|string|unique:santri',
            'nama_santri' => 'required',
            'jk' => 'required',
            'kelas_id' => 'required'
        ]);

        if ($request->foto) {
            $foto = $request->foto;
            $new_foto = date('siHdmY') . "_" . $foto->getClientOriginalName();
            $foto->move('uploads/santri/', $new_foto);
            $nameFoto = 'uploads/santri/' . $new_foto;
        } else {
            if ($request->jk == 'L') {
                $nameFoto = 'uploads/santri/52471919042020_male.jpg';
            } else {
                $nameFoto = 'uploads/santri/50271431012020_female.jpg';
            }
        }

        Santri::create([
            'no_induk' => $request->no_induk,
            'nis' => $request->nis,
            'nama_santri' => $request->nama_santri,
            'jk' => $request->jk,
            'kelas_id' => $request->kelas_id,
            'telp' => $request->telp,
            'tmp_lahir' => $request->tmp_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'tahun_masuk' => $request->tahun_masuk,
            'smt' => $request->smt,
            'id_kamar' => $request->id_kamar,
            'foto' => $nameFoto
        ]);

        return redirect()->back()->with('success', 'Berhasil menambahkan data santri baru!');
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
        $santri = Santri::findorfail($id);
        return view('admin.santri.details', compact('santri'));
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
        $santri = Santri::findorfail($id);
        $kelas = Kelas::all();
        return view('admin.santri.edit', compact('santri', 'kelas'));
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
            'nama_santri' => 'required',
            'jk' => 'required',
            'kelas_id' => 'required'
        ]);

        $santri = Santri::findorfail($id);
        $user = User::where('no_induk', $santri->no_induk)->first();
        if ($user) {
            $user_data = [
                'name' => $request->nama_santri
            ];
            $user->update($user_data);
        } else {
        }
        $santri_data = [
            'nis' => $request->nis,
            'nama_santri' => $request->nama_santri,
            'jk' => $request->jk,
            'kelas_id' => $request->kelas_id,
            'telp' => $request->telp,
            'tmp_lahir' => $request->tmp_lahir,
            'tgl_lahir' => $request->tgl_lahir,
        ];
        $santri->update($santri_data);

        return redirect()->route('santri.index')->with('success', 'Data santri berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $santri = Santri::findorfail($id);
        $countUser = User::where('no_induk', $santri->no_induk)->count();
        if ($countUser >= 1) {
            $user = User::where('no_induk', $santri->no_induk)->first();
            $santri->delete();
            $user->delete();
            return redirect()->back()->with('warning', 'Data santri berhasil dihapus! (Silahkan cek trash data santri)');
        } else {
            $santri->delete();
            return redirect()->back()->with('warning', 'Data santri berhasil dihapus! (Silahkan cek trash data santri)');
        }
    }

    public function trash()
    {
        $santri = Santri::onlyTrashed()->get();
        return view('admin.santri.trash', compact('santri'));
    }

    public function restore($id)
    {
        $id = Crypt::decrypt($id);
        $santri = Santri::withTrashed()->findorfail($id);
        $countUser = User::withTrashed()->where('no_induk', $santri->no_induk)->count();
        if ($countUser >= 1) {
            $user = User::withTrashed()->where('no_induk', $santri->no_induk)->first();
            $santri->restore();
            $user->restore();
            return redirect()->back()->with('info', 'Data santri berhasil direstore! (Silahkan cek data santri)');
        } else {
            $santri->restore();
            return redirect()->back()->with('info', 'Data santri berhasil direstore! (Silahkan cek data santri)');
        }
    }

    public function kill($id)
    {
        $santri = Santri::withTrashed()->findorfail($id);
        $countUser = User::withTrashed()->where('no_induk', $santri->no_induk)->count();
        if ($countUser >= 1) {
            $user = User::withTrashed()->where('no_induk', $santri->no_induk)->first();
            $santri->forceDelete();
            $user->forceDelete();
            return redirect()->back()->with('success', 'Data santri berhasil dihapus secara permanent');
        } else {
            $santri->forceDelete();
            return redirect()->back()->with('success', 'Data santri berhasil dihapus secara permanent');
        }
    }

    public function ubah_foto($id)
    {
        $id = Crypt::decrypt($id);
        $santri = Santri::findorfail($id);
        return view('admin.santri.ubah-foto', compact('santri'));
    }

    public function update_foto(Request $request, $id)
    {
        $this->validate($request, [
            'foto' => 'required'
        ]);

        $santri = Santri::findorfail($id);
        $foto = $request->foto;
        $new_foto = date('s' . 'i' . 'H' . 'd' . 'm' . 'Y') . "_" . $foto->getClientOriginalName();
        $santri_data = [
            'foto' => 'uploads/santri/' . $new_foto,
        ];
        $foto->move('uploads/santri/', $new_foto);
        $santri->update($santri_data);

        return redirect()->route('santri.index')->with('success', 'Berhasil merubah foto!');
    }

    public function view(Request $request)
    {
        $santri = Santri::OrderBy('nama_santri', 'asc')->where('kelas_id', $request->id)->get();

        foreach ($santri as $val) {
            $newForm[] = array(
                'kelas' => $val->kelas->nama_kelas,
                'no_induk' => $val->no_induk,
                'nama_santri' => $val->nama_santri,
                'jk' => $val->jk,
                'foto' => $val->foto
            );
        }

        return response()->json($newForm);
    }

    public function cetak_pdf(Request $request)
    {
        $santri = santri::OrderBy('nama_santri', 'asc')->where('kelas_id', $request->id)->get();
        $kelas = Kelas::findorfail($request->id);

        $pdf = PDF::loadView('santri-pdf', ['santri' => $santri, 'kelas' => $kelas]);
        return $pdf->stream();
        // return $pdf->stream('jadwal-pdf.pdf');
    }

    public function kelas($id)
    {
        $id = Crypt::decrypt($id);
        $santri = Santri::where('kelas_id', $id)->OrderBy('nama_santri', 'asc')->get();
        $kelas = Kelas::findorfail($id);
        return view('admin.santri.show', compact('santri', 'kelas'));
    }

    public function export_excel()
    {
        return Excel::download(new SantriExport, 'santri.xlsx');
    }

    public function import_excel(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);
        $file = $request->file('file');
        $nama_file = rand() . $file->getClientOriginalName();
        $file->move('file_santri', $nama_file);
        Excel::import(new SantriImport, public_path('/file_santri/' . $nama_file));
        return redirect()->back()->with('success', 'Data Santri Berhasil Diimport!');
    }

    public function deleteAll()
    {
        $santri = Santri::all();
        if ($santri->count() >= 1) {
            Santri::whereNotNull('id')->delete();
            Santri::withTrashed()->whereNotNull('id')->forceDelete();
            return redirect()->back()->with('success', 'Data table santri berhasil dihapus!');
        } else {
            return redirect()->back()->with('warning', 'Data table santri kosong!');
        }
    }



    public function absen()
    {
        $absen = Absen::where('tanggal', date('Y-m-d'))->get();
        $kehadiran = Kehadiran::limit(4)->get();
        return view('santri.absen', compact('absen', 'kehadiran'));
    }

    public function simpan(Request $request)
    {
        $this->validate($request, [
            'id_card' => 'required',
            'kehadiran_id' => 'required'
        ]);
        $cekSantri = Santri::where('id_card', $request->id_card)->count();
        if ($cekSantri >= 1) {
            $santri = Santri::where('id_card', $request->id_card)->first();
            if ($santri->id_card == Auth::user()->id_card) {
                $cekAbsen = Absen::where('santri_id', $santri->id)->where('tanggal', date('Y-m-d'))->count();
                if ($cekAbsen == 0) {
                    if (date('w') != '0' && date('w') != '6') {
                        if (date('H:i:s') >= '06:00:00') {
                            if (date('H:i:s') >= '09:00:00') {
                                if (date('H:i:s') >= '16:15:00') {
                                    Absen::create([
                                        'tanggal' => date('Y-m-d'),
                                        'santri_id' => $santri->id,
                                        'kehadiran_id' => '6',
                                    ]);
                                    return redirect()->back()->with('info', 'Maaf sekarang sudah waktunya pulang!');
                                } else {
                                    if ($request->kehadiran_id == '1') {
                                        $terlambat = date('H') - 9 . ' Jam ' . date('i') . ' Menit';
                                        if (date('H') - 9 == 0) {
                                            $terlambat = date('i') . ' Menit';
                                        }
                                        Absen::create([
                                            'tanggal' => date('Y-m-d'),
                                            'santri_id' => $santri->id,
                                            'kehadiran_id' => '5',
                                        ]);
                                        return redirect()->back()->with('warning', 'Maaf anda terlambat ' . $terlambat . '!');
                                    } else {
                                        Absen::create([
                                            'tanggal' => date('Y-m-d'),
                                            'santri_id' => $santri->id,
                                            'kehadiran_id' => $request->kehadiran_id,
                                        ]);
                                        return redirect()->back()->with('success', 'Anda hari ini berhasil absen!');
                                    }
                                }
                            } else {
                                Absen::create([
                                    'tanggal' => date('Y-m-d'),
                                    'santri_id' => $santri->id,
                                    'kehadiran_id' => $request->kehadiran_id,
                                ]);
                                return redirect()->back()->with('success', 'Anda hari ini berhasil absen tepat waktu!');
                            }
                        } else {
                            return redirect()->back()->with('info', 'Maaf absensi di mulai jam 6 pagi!');
                        }
                    } else {
                        $namaHari = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu"];
                        $d = date('w');
                        $hari = $namaHari[$d];
                        return redirect()->back()->with('info', 'Maaf sekolah hari ' . $hari . ' libur!');
                    }
                } else {
                    return redirect()->back()->with('warning', 'Maaf absensi tidak bisa dilakukan 2x!');
                }
            } else {
                return redirect()->back()->with('error', 'Maaf no induk ini bukan milik anda!');
            }
        } else {
            return redirect()->back()->with('error', 'Maaf no induk ini tidak terdaftar!');
        }
    }

    public function absensi()
    {
        $santri = Santri::all();
        return view('admin.santri.absen', compact('santri'));
    }

    public function kehadiran($id)
    {
        $id = Crypt::decrypt($id);
        $santri = Santri::findorfail($id);
        $absen = AbsenSantri::orderBy('tanggal', 'desc')->where('santri_id', $id)->get();
        return view('admin.santri.kehadiran', compact('santri', 'absen'));
    }
}
