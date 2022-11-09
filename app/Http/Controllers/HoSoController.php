<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HoSoController extends Controller
{
    //
    public function showTuHoSo()
    {
        return view('auth.tuhoso');
    }
}
