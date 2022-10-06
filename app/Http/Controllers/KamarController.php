<?php

namespace App\Http\Controllers;

//use App\KamarController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KamarController extends Controller
{
    public function index()
    {
        return view('admin.kamar.index');
    }
}
