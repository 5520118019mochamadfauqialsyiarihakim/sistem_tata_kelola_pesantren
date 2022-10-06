<?php

namespace App\Http\Controllers;

use App\AbsensiSantri2;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AbsensiSantri2Controller extends Controller
{
    public function index()
    {
        return view('santri.absen');
    }
}
