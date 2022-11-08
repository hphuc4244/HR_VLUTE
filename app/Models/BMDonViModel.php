<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BMDonViModel extends Model
{
    public static function DSNhanSu($madonvi){
        $sql = "SELECT tendonvi, tenchucvu, hoten, chucdanh, DATE_FORMAT(ngaysinh,'%d/%m/%Y') AS ngaysinh,
                        gioitinh, quequan, sodienthoai,
                        cmnd, DATE_FORMAT(ngaycapcmnd,'%d/%m/%Y') AS ngaycapcmnd, noicapcmnd
                FROM nhanvien, donvilamviec, quatrinhlamviec, chucvu
                WHERE nhanvien.manhanvien = quatrinhlamviec.manhanvien
                AND chucvu.machucvu = quatrinhlamviec.machucvu
                AND donvilamviec.madonvi = quatrinhlamviec.madonvi
                AND trangthailamviec = N'Đang làm việc'
                AND donvilamviec.madonvi=:madonvi";
        return DB::select($sql, ['madonvi' => $madonvi]);
    }
}
