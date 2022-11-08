<?php

namespace App\Http\Controllers;

use App\Models\LoaiKhenThuongModel;
use Illuminate\Http\Request;

class LoaiKhenThuongController extends Controller
{
    public function getDanhSach(){
        $item = new LoaiKhenThuongModel();
        return view('auth.loaikhenthuong',['ds' => $item->danhsach()]);
    }

    public function putDuLieu(Request $request){
        $item = new LoaiKhenThuongModel();
        $item->tenkhenthuong = $request->input("tenkhenthuong");
        $item->mucchikhenthuong = $request->input("mucchikhenthuong");
        $item->ghichu = $request->input("ghichu");
        return $item->them();
    }

    public function postDuLieu(Request $request){
        $item = new LoaiKhenThuongModel();
        $item->makhenthuong = $request->input("makhenthuong");
        $item->tenkhenthuong = $request->input("tenkhenthuong");
        $item->mucchikhenthuong = $request->input("mucchikhenthuong");
        $item->ghichu = $request->input("ghichu");
        return $item->sua();
    }

    public function deleteDuLieu(Request $request){
        $item = new LoaiKhenThuongModel();
        $item->makhenthuong = $request->input("makhenthuong");
        return $item->xoa();
    }

    public function getLog(Request $request){
        $item = new LoaiKhenThuongModel();
        $item->makhenthuong = $request->input("makhenthuong");
        return $item->xemLog();
    }
}
