<?php

namespace App\Http\Controllers;

use App\Models\LoaiPhuCapModel;
use App\Models\LuongPhuCapModel;
use App\Models\NgachLuongModel;
use Illuminate\Http\Request;

class LuongPhuCapController extends Controller
{
    public function getDanhSach(Request $request, $idnhanvien){
        $item = new LuongPhuCapModel();
        $item->manhanvien = $idnhanvien;
        $ngachluong = new NgachLuongModel();
        $phucap = new LoaiPhuCapModel();
        return view('auth.dienbienluongvaphucap', ['tt' => $item->thongTinNhanVien(),
                                                        'luong' => $item->danhSachLuong(), 'phucap' => $item->danhSachPhuCap(),
                                                        'ngachluong' => $ngachluong->danhsach(),
                                                        'loaiphucap' => $phucap->danhsach()]);
    }

    public function putLuong(Request $request){
    $item = new LuongPhuCapModel();
    $item->manhanvien = $request->input("manhanvien");
    $item->mangachluong = $request->input("mangachluong");
    $item->ngayhuong = $request->input("ngayhuong");
    $item->soquyetdinh = $request->input("soquyetdinh");
    $item->hinhanh = $request->input("hinhanh");
    $item->coquanbanhanh = $request->input("coquanbanhanh");
    $item->vuotkhung = $request->input("vuotkhung");
    $item->ghichu = $request->input("ghichu");
    return $item->themLuong();
}

    public function deleteLuong(Request $request){
        $item = new LuongPhuCapModel();
        $item->maluong = $request->input("maluong");
        return $item->xoaLuong();
    }

    public function putPhuCap(Request $request){
        $item = new LuongPhuCapModel();
        $item->maphucap = $request->input("maphucap");
        $item->manhanvien = $request->input("manhanvien");
        $item->ngayhuongphucap = $request->input("ngayhuongphucap");
        $item->soquyetdinh = $request->input("soquyetdinh");
        $item->hinhanh = $request->input("hinhanh");
        $item->coquanbanhanh = $request->input("coquanbanhanh");
        $item->ghichu = $request->input("ghichu");
        return $item->themPhuCap();
    }

    public function deletePhuCap(Request $request){
        $item = new LuongPhuCapModel();
        $item->maphucapnhanvien = $request->input("maphucapnhanvien");
        return $item->xoaPhuCap();
    }
}
