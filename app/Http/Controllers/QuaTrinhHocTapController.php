<?php

namespace App\Http\Controllers;

use App\Models\LoaiBangCapModel;
use App\Models\NhanVienModel;
use App\Models\QuaTrinhHocTapModel;
use Illuminate\Http\Request;

class QuaTrinhHocTapController extends Controller
{

    public function hoSoQuaTrinhHocTap(Request $request, $idnhanvien){
        $item = new QuaTrinhHocTapModel();
        $item->manhanvien = $idnhanvien;
        $loaibangcap = new LoaiBangCapModel();
        return view('auth.quatrinhhoctap', ['qtht' => $item->viewQuaTrinhHocTap(), 'ttbc' => $item->thongTinQuaTrinhHocTap(),
                                                    'bc' => $loaibangcap->danhsach()]);
    }

    public function putBangCapNhanVien(Request $request){
        $item = new QuaTrinhHocTapModel();
        $item->maloaibangcap = $request->input("maloaibangcap");
        $item->manhanvien = $request->input("manhanvien");
        $item->donvidaotao = $request->input("donvidaotao");
        $item->chuyennganhdaotao = $request->input("chuyennganhdaotao");
        $item->donxindihoc = $request->input("donxindihoc");
        $item->ngaybatdauhoc = $request->input("ngaybatdauhoc");
        $item->noicapbang = $request->input("noicapbang");
        $item->ngaycapbang = $request->input("ngaycapbang");
        $item->sovaoso = $request->input("sovaoso");
        $item->hinhanh = $request->input("hinhanh");
        $item->ghichu = $request->input("ghichu");
        return $item->them();
    }

    public function updateBangCapNhanVien(Request $request){
        $item = new QuaTrinhHocTapModel();
        $item->maquatrinhhoctap = $request->input("maquatrinhhoctap");
        $item->maloaibangcap = $request->input("maloaibangcap");
        $item->manhanvien = $request->input("manhanvien");
        $item->donvidaotao = $request->input("donvidaotao");
        $item->chuyennganhdaotao = $request->input("chuyennganhdaotao");
        $item->donxindihoc = $request->input("donxindihoc");
        $item->ngaybatdauhoc = $request->input("ngaybatdauhoc");
        $item->noicapbang = $request->input("noicapbang");
        $item->ngaycapbang = $request->input("ngaycapbang");
        $item->sovaoso = $request->input("sovaoso");
        $item->hinhanh = $request->input("hinhanh");
        $item->ghichu = $request->input("ghichu");
        return $item->sua();
    }

    public function deleteBangCapNhanVien(Request $request){
        $item = new QuaTrinhHocTapModel();
        $item->maquatrinhhoctap = $request->input("maquatrinhhoctap");
        return $item->xoa();
    }
}
