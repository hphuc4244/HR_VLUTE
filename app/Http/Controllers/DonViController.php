<?php

namespace App\Http\Controllers;

use App\Models\DonViModel;
use App\Models\ThongTinDonViModel;
use Illuminate\Http\Request;

class DonViController extends Controller
{
    public function getDSDonVi(){
        $dv = new DonViModel();
        return view('auth.donvi',['ds' => $dv->dsDonVi()]);
    }

    public function getThongTinDonVi($iddonvi){
        $dv = new DonViModel();
        $dv->madonvi = $iddonvi;
        return view('auth.thongtindonvi',['ct' =>$dv->ctDonVi(), 'nv' => $dv->danhsachNhanVienTheoDonVi() ]);
    }

    public function putDonVi(Request $request){
        $dv = new DonViModel();
        $dv->tendonvi = $request->input("them-tendonvi");
        $dv->tentienganh = $request->input("them-tentienganh");
        $dv->vitridonvi = $request->input("them-vitridonvi");
        $dv->trangthaidonvi = $request->input("them-trangthaidonvi");

        $dv->tentrongquyetdinh = $request->input("them-tentrongquyetdinh");
        $dv->ngayquyetdinh = $request->input("them-ngayquyetdinh");
        $dv->soquyetdinh = $request->input("them-soquyetdinh");
        $dv->hinhanh = $request->input("them-hinhanh");
        $dv->ghichu = $request->input("them-ghichu");
        return $dv->them();
    }

    public function putThongTinDonVi(Request $request){
        $dv = new DonViModel();
        $iddonvi = $request->input("madonvi");
        $dv->tentrongquyetdinh = $request->input("tentrongquyetdinh");
        $dv->ngayquyetdinh = $request->input("ngayquyetdinh");
        $dv->soquyetdinh = $request->input("soquyetdinh");
        $dv->hinhanh = $request->input("hinhanh");
        $dv->ghichu = $request->input("ghichu");
        return $dv->themTTDV($iddonvi);
    }

    public function postDonVi(Request $request){
        $dv = new DonViModel();
        $dv->madonvi = $request->input("madonvi");
        $dv->tendonvi = $request->input("tendonvi");
        $dv->tentienganh = $request->input("tentienganh");
        $dv->vitridonvi = $request->input("vitridonvi");
        $dv->trangthaidonvi = $request->input("trangthaidonvi");
        return $dv->sua();
    }

    public function deleteDonVi(Request $request){
        $dv = new DonViModel();
        $dv->madonvi = $request->input("madonvi");
        return $dv->xoa();
    }

    public function deleteThongTinDonVi(Request $request){
        $dv = new DonViModel();
        $dv->mathongtindonvi = $request->input("mathongtindonvi");
        return $dv->xoaTTDV();
    }
}
