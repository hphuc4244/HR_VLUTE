<?php

namespace App\Http\Controllers;

use App\Models\LoaiBangCapModel;
use Illuminate\Http\Request;

class LoaiBangCapController extends Controller
{
    public function getDanhSach(){
        $item = new LoaiBangCapModel();
        return view('auth.loaibangcap',['ds' => $item->danhsach()]);
    }

    public function putDuLieu(Request $request){
        $item = new LoaiBangCapModel();
        $item->tenloaibangcap = $request->input("tenloaibangcap");
        $item->ghichu = $request->input("ghichu");
        return $item->them();
    }

    public function postDuLieu(Request $request){
        $item = new LoaiBangCapModel();
        $item->maloaibangcap = $request->input("maloaibangcap");
        $item->tenloaibangcap = $request->input("tenloaibangcap");
        $item->ghichu = $request->input("ghichu");
        return $item->sua();
    }

    public function deleteDuLieu(Request $request){
        $item = new LoaiBangCapModel();
        $item->maloaibangcap = $request->input("maloaibangcap");
        return $item->xoa();
    }

    public function getLog(Request $request){
        $item = new LoaiBangCapModel();
        $item->maloaibangcap = $request->input("maloaibangcap");
        return $item->xemLog();
    }
}
