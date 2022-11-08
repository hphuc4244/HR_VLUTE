<?php

namespace App\Http\Controllers;

use App\Models\ChucVuModel;
use App\Models\DonViModel;
use App\Models\QuaTrinhLamViecModel;
use Illuminate\Http\Request;

class QuaTrinhLamViecController extends Controller
{
    public function getQuaTrinhLamViec(Request $request, $idnhanvien){
        $item = new QuaTrinhLamViecModel();
        $item->manhanvien = $idnhanvien;
        $donvi = new DonViModel();
        $chucvu = new ChucVuModel();
        return view('auth.quatrinhlamviec',['ds' => $item->danhSach(),
                        'dv' => $item->dsDonViKhongPhaiNhanVienDangLamViec(),
                        'cv' => $chucvu->danhsach()]);
    }

    public function putQuaTrinhLamViec(Request $request){
        $item = new QuaTrinhLamViecModel();
        $item->manhanvien = $request->input("manhanvien");
        $item->madonvi = $request->input("madonvi");
        $item->machucvu = $request->input("machucvu");
        $item->ngayquyetdinh = $request->input("ngayquyetdinh");
        $item->soquyetdinh = $request->input("soquyetdinh");
        $item->hinhanh = $request->input("hinhanh");
        $item->coquanbanhanh = $request->input("coquanbanhanh");
        $item->trangthailamviec = $request->input("trangthailamviec");
        $item->loainhanvien = $request->input("loainhanvien");
        $item->tgvaovienchuc = $request->input("tgvaovienchuc");
        $item->ghichu = $request->input("ghichu");
        return $item->them();
    }

    public function deleteQuaTrinhLamViec(Request $request){
        $item = new QuaTrinhLamViecModel();
        $item->maquatrinhlamviec = $request->input("maquatrinhlamviec");
        return $item->xoa();
    }
}
