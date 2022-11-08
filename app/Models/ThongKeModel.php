<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ThongKeModel extends Model
{
    public static function danhsachNhanVien(){
        $sql = "SELECT donvilamviec.madonvi,
                       chucvu.machucvu,
                       tendonvi,
                       tenchucvu,
                       trangthailamviec,
                       loainhanvien,
                       nhanvien.*,
                       (SELECT ngachluong.ngach FROM luongnhanvien, ngachluong WHERE ngachluong.mangachluong = luongnhanvien.mangachluong AND nhanvien.manhanvien=luongnhanvien.mangachluong ORDER BY luongnhanvien.ngaytao DESC LIMIT 1) as ngach
                FROM nhanvien,
                     donvilamviec,
                     quatrinhlamviec,
                     chucvu,
                     (SELECT manhanvien, MAX(ngayquyetdinh) as ngayquyetdinh FROM quatrinhlamviec GROUP BY manhanvien) AS temp
                WHERE nhanvien.manhanvien = quatrinhlamviec.manhanvien
                  AND chucvu.machucvu = quatrinhlamviec.machucvu
                  AND donvilamviec.madonvi = quatrinhlamviec.madonvi
                  AND nhanvien.manhanvien = temp.manhanvien
                  AND quatrinhlamviec.ngayquyetdinh = temp.ngayquyetdinh";
        return DB::select($sql);
    }

    public static function thongKe_HocVi(){
        $sql = "SELECT hocvi, count(hocvi) as tong FROM nhanvien group by hocvi";
        return DB::select($sql);
    }

    public static function thongKe_ChucDanh(){
        $sql = "SELECT chucdanh, count(chucdanh)  as tong FROM nhanvien group by chucdanh";
        return DB::select($sql);
    }

    public static function thongKe_LoaiNhanVien(){
        $sql = "SELECT loainhanvien, count(loainhanvien) as tong FROM (
                    SELECT manhanvien,
                           (SELECT loainhanvien
                            FROM quatrinhlamviec
                            WHERE nhanvien.manhanvien = quatrinhlamviec.manhanvien
                            ORDER BY quatrinhlamviec.ngaytao DESC
                            LIMIT 1) as loainhanvien
                    FROM nhanvien) as tmp GROUP BY loainhanvien";
        return DB::select($sql);
    }

    public function thongke_Chart(){
        $sql = 'SELECT donvilamviec.tendonvi as TenDonVi, COUNT(nhanvien.manhanvien) as SoLuong
                FROM nhanvien, donvilamviec, quatrinhlamviec, chucvu
                WHERE nhanvien.manhanvien = quatrinhlamviec.manhanvien
                AND chucvu.machucvu = quatrinhlamviec.machucvu
                AND donvilamviec.madonvi = quatrinhlamviec.madonvi
                AND quatrinhlamviec.trangthailamviec ='.'"Đang làm việc"'.'
                GROUP BY donvilamviec.madonvi';
        return DB::select($sql);
    }
}
