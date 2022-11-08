<?php

namespace App\Http\Controllers;

use App\Models\ChucVuModel;
use Illuminate\Http\Request;

class ChucVuController extends Controller
{
    public function getDanhSach(){
        $cv = new ChucVuModel();
        return view('auth.chucvu', ['ds' => $cv->danhsach()]);
    }

    public function putDuLieu(Request $request){
        $cv = new ChucVuModel();
        $cv->tenchucvu = $request->input("tenchucvu");
        $cv->phucapchucvu = $request->input("phucapchucvu");
        $cv->ghichu = $request->input("ghichu");
        return $cv->them();
    }

    public function postDuLieu(Request $request){
        $cv = new ChucVuModel();
        $cv->machucvu = $request->input("machucvu");
        $cv->tenchucvu = $request->input("tenchucvu");
        $cv->phucapchucvu = $request->input("phucapchucvu");
        $cv->ghichu = $request->input("ghichu");
        return $cv->sua();
    }

    public function deleteDuLieu(Request $request){
        $cv = new ChucVuModel();
        $cv->machucvu = $request->input("machucvu");
        return $cv->xoa();
    }

    public function getLog(Request $request){
        $cv = new ChucVuModel();
        $cv->machucvu = $request->input("machucvu");
        return $cv->xemLog();
    }
}
