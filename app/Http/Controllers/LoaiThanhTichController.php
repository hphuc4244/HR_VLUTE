<?php

namespace App\Http\Controllers;

use App\Models\LoaiThanhTichModel;
use Illuminate\Http\Request;

class LoaiThanhTichController extends Controller
{
    public function getDanhSach(){
        $item = new LoaiThanhTichModel();
        return view('auth.loaithanhtich',['ds' => $item->danhsach()]);
    }

    public function putDuLieu(Request $request){
        $item = new LoaiThanhTichModel();
        $item->tenthanhtich = $request->input("tenthanhtich");
        $item->ghichu = $request->input("ghichu");
        return $item->them();
    }

    public function postDuLieu(Request $request){
        $item = new LoaiThanhTichModel();
        $item->mathanhtich = $request->input("mathanhtich");
        $item->tenthanhtich = $request->input("tenthanhtich");
        $item->ghichu = $request->input("ghichu");
        return $item->sua();
    }

    public function deleteDuLieu(Request $request){
        $item = new LoaiThanhTichModel();
        $item->mathanhtich = $request->input("mathanhtich");
        return $item->xoa();
    }

    public function getLog(Request $request){
        $item = new LoaiThanhTichModel();
        $item->mathanhtich = $request->input("mathanhtich");
        return $item->xemLog();
    }
}
