<?php

namespace App\Models;

use App\Traits\QuaTrinhLamViec;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class QuaTrinhLamViecModel extends Model
{
    use QuaTrinhLamViec;

    public function danhSach(){
        $sql = "SELECT quatrinhlamviec.*, hoten, tendonvi, tenchucvu
                FROM quatrinhlamviec, nhanvien, donvilamviec, chucvu
                WHERE nhanvien.manhanvien = quatrinhlamviec.manhanvien
                AND donvilamviec.madonvi = quatrinhlamviec.madonvi
                AND chucvu.machucvu = quatrinhlamviec.machucvu
                AND nhanvien.manhanvien =:manhanvien
                ORDER BY ngayquyetdinh DESC";
        $data = [
          'manhanvien' => $this->manhanvien
        ];
        return DB::select($sql, $data);
    }

    public function dsDonViKhongPhaiNhanVienDangLamViec(){
        $sql = "SELECT * FROM donvilamviec
                where madonvi not in (SELECT madonvi
                                        FROM quatrinhlamviec
                                        WHERE manhanvien = :manhanvien
                                        AND trangthailamviec = N'Đang làm việc')";
        $data = [
            'manhanvien' => $this->manhanvien
        ];
        return DB::select($sql, $data);
    }

    public function them(){
        $ma = Uuid::uuid4();


        if($this->trangthailamviec == "Đang làm việc")
        {
            $sql1 = "UPDATE `quatrinhlamviec`
                    SET `trangthailamviec`= N'Đã chuyển công tác'
                    WHERE trangthailamviec = N'Đang làm việc'
                    AND manhanvien=:manhanvien";
            $data1 = [
                'manhanvien' => $this->manhanvien
            ];
            db::update($sql1, $data1);
        }
        $sql = "INSERT INTO quatrinhlamviec(maquatrinhlamviec, manhanvien, madonvi, machucvu, ngayquyetdinh, soquyetdinh,
                      hinhanh, coquanbanhanh, trangthailamviec, loainhanvien, tgvaovienchuc, ngaytao, ghichu)
                VALUES (:maquatrinhlamviec, :manhanvien, :madonvi, :machucvu, :ngayquyetdinh, :soquyetdinh,
                      :hinhanh, :coquanbanhanh, :trangthailamviec, :loainhanvien, :tgvaovienchuc, :ngaytao, :ghichu)";
        $data = [
            'maquatrinhlamviec' => $ma,
            'manhanvien' => $this->manhanvien,
            'madonvi' => $this->madonvi,
            'machucvu' => $this->machucvu,
            'ngayquyetdinh' => $this->ngayquyetdinh,
            'soquyetdinh' => $this->soquyetdinh,
            'hinhanh' =>  $this->hinhanh,
            'coquanbanhanh' => $this->coquanbanhanh,
            'trangthailamviec' => $this->trangthailamviec,
            'loainhanvien' => $this->loainhanvien,
            'tgvaovienchuc' => $this->tgvaovienchuc,
            'ghichu' => $this->ghichu,
            'ngaytao' => date('Y-m-d H:i:s')
        ];
        return db::insert($sql, $data);
    }

    public function xoa(){
        $sql = "DELETE FROM quatrinhlamviec WHERE maquatrinhlamviec = :maquatrinhlamviec";
        $data = [
            'maquatrinhlamviec' => $this->maquatrinhlamviec
        ];
        return db::delete($sql, $data);
    }

}
