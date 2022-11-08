<?php

namespace App\Models;

use App\Traits\DonVi;
use App\Traits\ThongTinDonVi;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class DonViModel extends Model
{
    use DonVi;
    use ThongTinDonVi;

    function luuLog(){
        $sql = "SELECT * FROM donvilamviec WHERE madonvi=:madonvi;";
        $data = DB::selectOne($sql, ['madonvi'=>$this->madonvi]);
        if(ToolsModel::isJson($data->log))
            $log_old = json_decode($data->log);
        else
            $log_old = [];
        unset($data->log);
        array_push($log_old, $data);

        $sql = "UPDATE donvilamviec SET log=:log WHERE madonvi=:madonvi;";
        DB::update($sql,['madonvi'=>$this->madonvi, 'log'=>json_encode($log_old, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)]);
    }

    public function danhsachNhanVienTheoDonVi(){
        $sql = "SELECT donvilamviec.madonvi, tendonvi, tenchucvu, trangthailamviec,
                       nhanvien.*
                FROM nhanvien, donvilamviec, quatrinhlamviec, chucvu
                WHERE nhanvien.manhanvien = quatrinhlamviec.manhanvien
                AND chucvu.machucvu = quatrinhlamviec.machucvu
                AND donvilamviec.madonvi = quatrinhlamviec.madonvi
                AND donvilamviec.madonvi=:madonvi";
        $data = [
            'madonvi' => $this->madonvi
        ];
        return DB::select($sql,$data);
    }

    public function dsDonVi(){
        $sql = "SELECT * FROM donvilamviec";
        return DB::select($sql);
    }

    public function danhsachDonViHoatDong(){
        $sql = "SELECT * FROM donvilamviec WHERE trangthaidonvi = N'Đang hoạt động'";
        return DB::select($sql);
    }

    public function ctDonVi(){
        $sql = "SELECT thongtindonvi.*, tendonvi FROM thongtindonvi, donvilamviec
                where donvilamviec.madonvi = thongtindonvi.madonvi
                and thongtindonvi.madonvi = :madonvi";
        $data = [
            'madonvi' => $this->madonvi
        ];
        return DB::select($sql, $data);
    }

    public function them(){
        $madv = Uuid::uuid1();
        $sql = "INSERT INTO donvilamviec (madonvi, tendonvi, tentienganh, vitridonvi, trangthaidonvi, ngaycapnhat)
                VALUES (:madonvi, :tendonvi, :tentienganh, :vitridonvi, :trangthaidonvi, :ngaycapnhat)";
        $data = [
            'madonvi' => $madv,
            'tendonvi' => $this->tendonvi,
            'tentienganh' => $this->tentienganh,
            'vitridonvi' => $this->vitridonvi,
            'trangthaidonvi' => $this->trangthaidonvi,
            'ngaycapnhat' => date('Y-m-d H:i:s')
        ];
        $kq = db::insert($sql, $data);
        if($kq)
        {
            $kqttdv = $this->themTTDV($madv);
            return $kqttdv;
        }
        else  return 0;
    }

    public function themTTDV($madv){
        $mattdv = Uuid::uuid1();
        $sqlttdv = "INSERT INTO thongtindonvi (mathongtindonvi, madonvi, tentrongquyetdinh, ngayquyetdinh, soquyetdinh, hinhanh, ngaytao, ghichu)
            VALUES (:mathongtindonvi, :madonvi, :tentrongquyetdinh, :ngayquyetdinh, :soquyetdinh, :hinhanh, :ngaytao, :ghichu)";
        $datattdv = [
            'mathongtindonvi' => $mattdv,
            'madonvi' => $madv,
            'tentrongquyetdinh' => $this->tentrongquyetdinh,
            'ngayquyetdinh' => date("Y-m-d", strtotime($this->ngayquyetdinh)),
            'soquyetdinh' => $this->soquyetdinh,
            'hinhanh' => $this->hinhanh,
            'ngaytao' => date('Y-m-d H:i:s'),
            'ghichu' => $this->ghichu
        ];
        return db::insert($sqlttdv, $datattdv);
    }

    public function sua(){
        $sql = "UPDATE donvilamviec SET tendonvi = :tendonvi, tentienganh = :tentienganh, vitridonvi = :vitridonvi, trangthaidonvi = :trangthaidonvi, ngaycapnhat = :ngaycapnhat WHERE madonvi = :madonvi";
        $data = [
            'madonvi' => $this->madonvi,
            'tendonvi' => $this->tendonvi,
            'tentienganh' => $this->tentienganh,
            'vitridonvi' => $this->vitridonvi,
            'trangthaidonvi' => $this->trangthaidonvi,
            'ngaycapnhat' => date('Y-m-d H:i:s')
        ];
        $this-> luuLog();
        return db::update($sql, $data);
    }

    public function xoa(){
        $sql = "DELETE FROM donvilamviec WHERE madonvi = :madonvi";
        $sqlTTDV = "DELETE FROM thongtindonvi WHERE madonvi = :madonvi";
        $data = [
            'madonvi' => $this->madonvi
        ];
        $kq = db::delete($sql, $data);
        if($kq)
        {
            return db::delete($sqlTTDV, $data);
        }
        else  return 0;
    }

    public function xoaTTDV(){
        $sql = "DELETE FROM thongtindonvi WHERE mathongtindonvi = :mathongtindonvi";
        $data = [
            'mathongtindonvi' => $this->mathongtindonvi
        ];
        return db::delete($sql, $data);
    }
}
