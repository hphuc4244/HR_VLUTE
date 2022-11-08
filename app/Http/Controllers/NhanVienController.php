<?php

namespace App\Http\Controllers;

use App\Models\ChucVuModel;
use App\Models\DonViModel;
use App\Models\LoaiBangCapModel;
use App\Models\NhanVienModel;
use Illuminate\Http\Request;

class NhanVienController extends Controller
{
    public function getDanhSach(){
        $nv = new NhanVienModel();
        $dv = new DonViModel();
        $cv = new ChucVuModel();
        return view('auth.quanlynhansu',['nv' => $nv->danhsachNhanVien(), 'dv' => $dv->danhsachDonViHoatDong(),
                                                'cv' => $cv->danhsach(), 'tinh' =>$nv->danhsachTinhThanhPho(),
                                                'dt' => $nv->danhsachDanToc()]);
    }

    public function getThongTinNhanVien($idnhanvien){
        $nv = new NhanVienModel();
        $nv->manhanvien = $idnhanvien;
        $dv = new DonViModel();
        $cv = new ChucVuModel();
        return view('auth.thongtinnhanvien',['tt' =>$nv->thongTinNhanVien(), 'dv' => $dv->danhsachDonViHoatDong(),
                                                'cv' => $cv->danhsach(), 'tinh' =>$nv->danhsachTinhThanhPho(),
                                                'dt' => $nv->danhsachDanToc()]);
    }

    public function getDanhSachQuanHuyen(Request $request){
        $nv = new NhanVienModel();
        $nv->matp = $request->input("matp");
        return $nv->danhsachQuanHuyen();
    }

    public function getDanhSachXaPhuong(Request $request){
        $nv = new NhanVienModel();
        $nv->maqh = $request->input("maqh");
        return $nv->danhsachXaPhuong();
    }

    public function putDuLieu(Request $request){
        $item = new NhanVienModel();
        $item->hoten = $request->input("hoten");
        $item->chucdanh = $request->input("chucdanh");
        $item->ngaysinh = $request->input("ngaysinh");
        $item->noisinh = $request->input("noisinh");
        $item->quequan = $request->input("quequan");
        $item->gioitinh = $request->input("gioitinh");
        $item->sodienthoai = $request->input("sodienthoai");
        $item->email = $request->input("email");
        $item->cmnd = $request->input("cmnd");
        $item->ngaycapcmnd = $request->input("ngaycapcmnd");
        $item->noicapcmnd = $request->input("noicapcmnd");
        $item->ngaytuyendung = $request->input("ngaytuyendung");
        $item->nghenghieptuyendung = $request->input("nghenghieptuyendung");
        $item->bhxh = $request->input("bhxh");
        $item->dantoc = $request->input("dantoc");
        $item->tongiao = $request->input("tongiao");
        $item->trinhdovanhoa = $request->input("trinhdovanhoa");
        $item->trinhdochuyenmon = $request->input("trinhdochuyenmon");
        $item->hocham = $request->input("hocham");
        $item->hocvi = $request->input("hocvi");
        $item->hokhauthuongtru = $request->input("hokhauthuongtru");
        $item->noiohiennay = $request->input("noiohiennay");
        $item->ghichu = $request->input("ghichu");

        $item->madonvi = $request->input("madonvi");
        $item->machucvu = $request->input("machucvu");
        $item->ngayquyetdinh = $request->input("ngayquyetdinh");
        $item->soquyetdinh = $request->input("soquyetdinh");
        $item->hinhanh = $request->input("hinhanh");
        $item->trangthailamviec = $request->input("trangthailamviec");
        $item->coquanbanhanh = $request->input("coquanbanhanh");
        $item->loainhanvien = $request->input("loainhanvien");
        $item->tgvaovienchuc = $request->input("tgvaovienchuc");
        return $item->them();
    }

    public function postDuLieu(Request $request){
        $item = new NhanVienModel();
        $item->manhanvien = $request->input("manhanvien");
        $item->hoten = $request->input("hoten");
        $item->chucdanh = $request->input("chucdanh");
        $item->ngaysinh = $request->input("ngaysinh");
        $item->noisinh = $request->input("noisinh");
        $item->quequan = $request->input("quequan");
        $item->gioitinh = $request->input("gioitinh");
        $item->sodienthoai = $request->input("sodienthoai");
        $item->email = $request->input("email");
        $item->cmnd = $request->input("cmnd");
        $item->ngaycapcmnd = $request->input("ngaycapcmnd");
        $item->noicapcmnd = $request->input("noicapcmnd");
        $item->ngaytuyendung = $request->input("ngaytuyendung");
        $item->nghenghieptuyendung = $request->input("nghenghieptuyendung");
        $item->bhxh = $request->input("bhxh");
        $item->dantoc = $request->input("dantoc");
        $item->tongiao = $request->input("tongiao");
        $item->trinhdovanhoa = $request->input("trinhdovanhoa");
        $item->trinhdochuyenmon = $request->input("trinhdochuyenmon");
        $item->hocham = $request->input("hocham");
        $item->hocvi = $request->input("hocvi");
        $item->hokhauthuongtru = $request->input("hokhauthuongtru");
        $item->noiohiennay = $request->input("noiohiennay");
        $item->ghichu = $request->input("ghichu");
        return $item->sua();
    }

    public function deleteDuLieu(Request $request){
        $item = new NhanVienModel();
        $item->manhanvien = $request->input("manhanvien");
        return $item->xoa();
    }

    public function getLog(Request $request, $idnhanvien){
        $item = new NhanVienModel();
        $item->manhanvien = $idnhanvien;
        return view('auth.lichsuthongtinnhanvien', ['nv' => $item->xemLog()]);
    }

}
