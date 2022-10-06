<?php

namespace App\Http\Controllers;

use App\Jadwal;
use App\Ustadz;
use App\Kehadiran;
use App\Kelas;
use App\Santri;
use App\Mapel;
use App\User;
use App\Paket;
use App\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $hari = date('w');
        $jam = date('H:i');
        $jadwal = Jadwal::OrderBy('kelas_id')->get();
        $pengumuman = Pengumuman::first();
        $kehadiran = Kehadiran::all();
        return view('home', compact('jadwal', 'pengumuman', 'kehadiran'));
    }

    public function admin()
    {
        $jadwal = Jadwal::count();
        $ustadz = Ustadz::count();
        $ustadzlk = Ustadz::where('jk', 'L')->count();
        $ustadzpr = Ustadz::where('jk', 'P')->count();
        $santri = Santri::count();
        $santrilk = Santri::where('jk', 'L')->count();
        $santripr = Santri::where('jk', 'P')->count();
        $kelas = Kelas::count();
        $thp = Kelas::where('paket_id', '1')->count();
        $kk = Kelas::where('paket_id', '2')->count();
        $bhs = Kelas::where('paket_id', '3')->count();
        $sm = Kelas::where('paket_id', '9')->count();
        $mapel = Mapel::count();
        $user = User::count();
        $paket = Paket::all();
        return view('admin.index', compact(
            'jadwal',
            'ustadz',
            'ustadzlk',
            'ustadzpr',
            'santrilk',
            'santripr',
            'santri',
            'kelas',
            'thp',
            'kk',
            'bhs',
            'sm',
            'mapel',
            'user',
            'paket'
        ));
    }
}
