<?php

namespace App\Models;

use App\Traits\NhanVien;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Ramsey\Uuid\Uuid;

class NhanVienModel extends Model
{
    use NhanVien;

    function luuLog(){
        $sql = "SELECT * FROM nhanvien WHERE manhanvien=:manhanvien;";
        $data = DB::selectOne($sql, ['manhanvien'=>$this->manhanvien]);
        if(ToolsModel::isJson($data->log))
            $log_old = json_decode($data->log);
        else
            $log_old = [];
        unset($data->log);
        array_push($log_old, $data);

        $sql = "UPDATE nhanvien SET log=:log WHERE manhanvien=:manhanvien;";
        DB::update($sql,['manhanvien'=>$this->manhanvien, 'log'=>json_encode($log_old, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)]);
    }

    public function danhsachDanToc(){
        $sql = "SELECT * FROM ds_dantoc";
        return DB::select($sql);
    }

    public function danhsachTinhThanhPho(){
        $sql = "SELECT * FROM ds_tinhthanhpho";
        return DB::select($sql);
    }

    public function danhsachQuanHuyen(){
        $sql = "SELECT * FROM ds_quanhuyen WHERE matp=:matp";
        $data = [
            'matp' => $this->matp
        ];
        return DB::select($sql, $data);
    }

    public function danhsachXaPhuong(){
        $sql = "SELECT * FROM ds_xaphuongthitran WHERE maqh=:maqh";
        $data = [
            'maqh' => $this->maqh
        ];
        return DB::select($sql, $data);
    }

    public function danhsachNhanVien(){
        $sql = "SELECT donvilamviec.madonvi, chucvu.machucvu, tendonvi, tenchucvu, trangthailamviec,
                       nhanvien.*
                FROM nhanvien, donvilamviec, quatrinhlamviec, chucvu,
                     (SELECT manhanvien, MAX(ngayquyetdinh) as ngayquyetdinh FROM quatrinhlamviec GROUP BY manhanvien) AS temp
                WHERE nhanvien.manhanvien = quatrinhlamviec.manhanvien
                AND chucvu.machucvu = quatrinhlamviec.machucvu
                AND donvilamviec.madonvi = quatrinhlamviec.madonvi
				AND nhanvien.manhanvien = temp.manhanvien
                AND quatrinhlamviec.ngayquyetdinh = temp.ngayquyetdinh";
        return DB::select($sql);
    }

    public function thongTinNhanVien(){
        $sql = "SELECT donvilamviec.madonvi, chucvu.machucvu, tendonvi, tenchucvu,
                loainhanvien, tgvaovienchuc, trangthailamviec, nhanvien.*
                FROM nhanvien, donvilamviec, quatrinhlamviec, chucvu
                where nhanvien.manhanvien = quatrinhlamviec.manhanvien
                AND chucvu.machucvu = quatrinhlamviec.machucvu
                AND donvilamviec.madonvi = quatrinhlamviec.madonvi
                AND nhanvien.manhanvien = :manhanvien";
        $data = [
            'manhanvien' => $this->manhanvien
        ];
        return DB::selectOne($sql, $data);
    }

    public function them(){
        $manv = Uuid::uuid1();
        $sql = "INSERT INTO nhanvien (manhanvien, hoten, chucdanh, ngaysinh, noisinh, quequan, gioitinh, sodienthoai,
                      email, cmnd, ngaycapcmnd, noicapcmnd, ngaytuyendung, nghenghieptuyendung, bhxh, dantoc, tongiao,
                      trinhdovanhoa, trinhdochuyenmon, hocham, hocvi, hokhauthuongtru,
                      noiohiennay, ghichu, ngaycapnhat)
                VALUES (:manhanvien, :hoten, :chucdanh, :ngaysinh, :noisinh, :quequan, :gioitinh, :sodienthoai,
                      :email, :cmnd, :ngaycapcmnd, :noicapcmnd, :ngaytuyendung, :nghenghieptuyendung, :bhxh, :dantoc, :tongiao,
                      :trinhdovanhoa, :trinhdochuyenmon, :hocham, :hocvi, :hokhauthuongtru,
                      :noiohiennay, :ghichu, :ngaycapnhat)";
        $data = [
            'manhanvien' => $manv,
            'chucdanh' => $this->chucdanh,
            'hoten' => $this->hoten,
            'ngaysinh' => $this->ngaysinh,
            'noisinh' => $this->noisinh,
            'quequan' => $this->quequan,
            'gioitinh' => $this->gioitinh,
            'sodienthoai' => $this->sodienthoai,
            'email' => $this->email,
            'cmnd' => $this->cmnd,
            'ngaycapcmnd' => $this->ngaycapcmnd,
            'noicapcmnd' => $this->noicapcmnd,
            'ngaytuyendung' => $this->ngaytuyendung,
            'nghenghieptuyendung' => $this->nghenghieptuyendung,
            'bhxh' => $this->bhxh,
            'dantoc' => $this->dantoc,
            'tongiao' => $this->tongiao,
            'trinhdovanhoa' => $this->trinhdovanhoa,
            'trinhdochuyenmon' => $this->trinhdochuyenmon,
            'hocham' => $this->hocham,
            'hocvi' => $this->hocvi,
            'hokhauthuongtru' => $this->hokhauthuongtru,
            'noiohiennay' => $this->noiohiennay,
            'ghichu' => $this->ghichu,
            'ngaycapnhat' => date('Y-m-d H:i:s')
        ];
        $kq = db::insert($sql, $data);
        if($kq)
        {
            $kqttdv = $this->themTTNV($manv);
            return $kqttdv;
        }
        else  return 0;
    }

    public function themTTNV($manv){
        $maqtlv = Uuid::uuid1();
        $sql1 = "INSERT INTO quatrinhlamviec(maquatrinhlamviec, manhanvien, madonvi, machucvu,
                              ngaytao, soquyetdinh, hinhanh, ngayquyetdinh, coquanbanhanh,
                              trangthailamviec, loainhanvien, tgvaovienchuc)
                        VALUES (:maquatrinhlamviec, :manhanvien, :madonvi, :machucvu,
                              :ngaytao, :soquyetdinh, :hinhanh, :ngayquyetdinh, :coquanbanhanh,
                              :trangthailamviec, :loainhanvien, :tgvaovienchuc)";
        $data1 = [
            'maquatrinhlamviec' => $maqtlv,
            'manhanvien' => $manv,
            'madonvi' => $this->madonvi,
            'machucvu' => $this->machucvu,
            'ngaytao' => date('Y-m-d H:i:s'),
            'ngayquyetdinh' => $this->ngayquyetdinh,
            'soquyetdinh' => $this->soquyetdinh,
            'hinhanh' => $this->hinhanh,
            'coquanbanhanh' => $this->coquanbanhanh,
            'trangthailamviec' => $this->trangthailamviec,
            'loainhanvien' => $this->loainhanvien,
            'tgvaovienchuc' => $this->tgvaovienchuc
        ];
        return db::insert($sql1, $data1);
    }

    public function sua(){
        $sql = "UPDATE nhanvien
                SET hoten=:hoten, chucdanh=:chucdanh, ngaysinh=:ngaysinh, noisinh=:noisinh,
                    quequan=:quequan, gioitinh=:gioitinh, sodienthoai=:sodienthoai, email=:email, cmnd=:cmnd,
                    ngaycapcmnd=:ngaycapcmnd, noicapcmnd=:noicapcmnd, ngaytuyendung=:ngaytuyendung,
                    nghenghieptuyendung=:nghenghieptuyendung, bhxh=:bhxh, dantoc=:dantoc, tongiao=:tongiao,
                    trinhdovanhoa=:trinhdovanhoa, trinhdochuyenmon=:trinhdochuyenmon, hocham=:hocham, hocvi=:hocvi,
                    hokhauthuongtru=:hokhauthuongtru, noiohiennay=:noiohiennay, ghichu=:ghichu, ngaycapnhat=:ngaycapnhat
                WHERE manhanvien = :manhanvien";
        $data = [
            'manhanvien' => $this->manhanvien,
            'chucdanh' => $this->chucdanh,
            'hoten' => $this->hoten,
            'ngaysinh' => $this->ngaysinh,
            'noisinh' => $this->noisinh,
            'quequan' => $this->quequan,
            'gioitinh' => $this->gioitinh,
            'sodienthoai' => $this->sodienthoai,
            'email' => $this->email,
            'cmnd' => $this->cmnd,
            'ngaycapcmnd' => $this->ngaycapcmnd,
            'noicapcmnd' => $this->noicapcmnd,
            'ngaytuyendung' => $this->ngaytuyendung,
            'nghenghieptuyendung' => $this->nghenghieptuyendung,
            'bhxh' => $this->bhxh,
            'dantoc' => $this->dantoc,
            'tongiao' => $this->tongiao,
            'trinhdovanhoa' => $this->trinhdovanhoa,
            'trinhdochuyenmon' => $this->trinhdochuyenmon,
            'hocham' => $this->hocham,
            'hocvi' => $this->hocvi,
            'hokhauthuongtru' => $this->hokhauthuongtru,
            'noiohiennay' => $this->noiohiennay,
            'ghichu' => $this->ghichu,
            'ngaycapnhat' => date('Y-m-d H:i:s')
        ];
        $this->luuLog();
        return db::update($sql, $data);
    }

    public function xoa(){
        $sql = "DELETE FROM nhanvien WHERE manhanvien = :manhanvien";
        $data = [
            'manhanvien' => $this->manhanvien
        ];
        $kq = db::delete($sql, $data);
        if($kq)
        {
            $sql1 = "DELETE FROM quatrinhlamviec WHERE manhanvien = :manhanvien";
            return db::delete($sql1, $data);
        }
        else  return 0;
    }

    public function xemLog(){
        $sql = "SELECT * FROM nhanvien WHERE manhanvien = :manhanvien";
        $data = [
            'manhanvien' => $this->manhanvien
        ];
        return db::selectOne($sql, $data);
    }


}
