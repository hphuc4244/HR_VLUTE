<?php

namespace App\Http\Controllers;

use App\Models\LoaiPhuCapModel;
use Illuminate\Http\Request;

class LoaiPhuCapController extends Controller
{
    public function getDanhSach(){
        $item = new LoaiPhuCapModel();
        return view('auth.loaiphucap',['ds' => $item->danhsach()]);
    }

    public function putDuLieu(Request $request){
        $item = new LoaiPhuCapModel();
        $item->tenphucap = $request->input("tenphucap");
        $item->hesophucap = $request->input("hesophucap");
        $item->ghichu = $request->input("ghichu");
        return $item->them();
    }

    public function postDuLieu(Request $request){
        $item = new LoaiPhuCapModel();
        $item->maphucap = $request->input("maphucap");
        $item->tenphucap = $request->input("tenphucap");
        $item->hesophucap = $request->input("hesophucap");
        $item->ghichu = $request->input("ghichu");
        return $item->sua();
    }

    public function deleteDuLieu(Request $request){
        $item = new LoaiPhuCapModel();
        $item->maphucap = $request->input("maphucap");
        return $item->xoa();
    }


    public function getLog(Request $request){
        $item = new LoaiPhuCapModel();
        $item->maphucap = $request->input("maphucap");
        return $item->xemLog();
    }
}
