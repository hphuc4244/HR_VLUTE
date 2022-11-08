<?php

namespace App\Http\Controllers;

use App\Models\NgachLuongModel;
use Illuminate\Http\Request;

class NgachLuongController extends Controller
{
    public function getDanhSach(){
        $item = new NgachLuongModel();
        return view('auth.ngachluong',['ds' => $item->danhsach()]);
    }

    public function putDuLieu(Request $request){
        $item = new NgachLuongModel();
        $item->maso = $request->input("maso");
        $item->ngach = $request->input("ngach");
        $item->bacluong = $request->input("bacluong");
        $item->heso = $request->input("heso");
        $item->ghichu = $request->input("ghichu");
        return $item->them();
    }

    public function postDuLieu(Request $request){
        $item = new NgachLuongModel();
        $item->mangachluong = $request->input("mangachluong");
        $item->maso = $request->input("maso");
        $item->ngach = $request->input("ngach");
        $item->bacluong = $request->input("bacluong");
        $item->heso = $request->input("heso");
        $item->ghichu = $request->input("ghichu");
        return $item->sua();
    }

    public function deleteDuLieu(Request $request){
        $item = new NgachLuongModel();
        $item->mangachluong = $request->input("mangachluong");
        return $item->xoa();
    }

    public function getLog(Request $request){
        $item = new NgachLuongModel();
        $item->mangachluong = $request->input("mangachluong");
        return $item->xemLog();
    }
}
