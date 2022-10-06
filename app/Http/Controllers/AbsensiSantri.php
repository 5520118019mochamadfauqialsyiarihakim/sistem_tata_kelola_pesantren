<?php

namespace App\Http\Controllers;

use App\AbsensiSantri;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AbsensiSantriController extends Controller
{
    public function index()
    {
        $absensisantri = AbsensiSantri::where('opsi', 'absensisantri')->first();
        return view('admin.absensisantri', compact('absensisantri'));
    }
}
