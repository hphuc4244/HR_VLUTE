<?php

namespace App\Models;

use App\Traits\TaiKhoan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TaiKhoanModel extends Model
{
    use TaiKhoan;

    public function dangNhap(){
        $sql = "SELECT * FROM taikhoan WHERE tendangnhap=:tendangnhap AND matkhau=:matkhau;";
        $data = [
            'tendangnhap' => $this->tendangnhap,
            'matkhau' => hash("sha512", $this->matkhau),
        ];
        return DB::selectOne($sql, $data);
    }

    public function doiMatKhau($matkhaumoi) {
        $sql = "UPDATE taikhoan SET matkhau=:matkhaumoi WHERE mataikhoan=:mataikhoan and matkhau=:matkhau;";
        $data = [
            'mataikhoan' => $this->mataikhoan,
            'matkhau' => hash("sha512", $this->matkhau),
            'matkhaumoi' => hash("sha512", $matkhaumoi),
        ];
        return DB::update($sql, $data);
    }

    public function danhSach() {
        $sql = "SELECT * FROM taikhoan ORDER BY ngaytao;";
        return DB::select($sql);
    }

    public function them() {
        $sql = "INSERT INTO taikhoan (mataikhoan, tendangnhap, matkhau, quyen, tenhienthi) VALUES (:mataikhoan, :tendangnhap, :matkhau, :quyen, :tenhienthi)";
        $data = [
            'mataikhoan' => $this->mataikhoan,
            'tenhienthi' => $this->tenhienthi,
            'tendangnhap' => $this->tendangnhap,
            'quyen' => $this->quyen,
            'matkhau' => hash("sha512", $this->matkhau),
        ];
        return DB::insert($sql, $data);
    }

    public function capNhat() {
        $sql = "UPDATE taikhoan SET tenhienthi=:tenhienthi, quyen=:quyen WHERE mataikhoan=:mataikhoan";
        $data = [
            'mataikhoan' => $this->mataikhoan,
            'tenhienthi' => $this->tenhienthi,
            'quyen' => $this->quyen,
        ];
        return DB::update($sql, $data);
    }

    public function quenMatKhau() {
        $sql = "UPDATE taikhoan SET matkhau=SHA2(tendangnhap, 512) WHERE mataikhoan=:mataikhoan";
        $data = [
            'mataikhoan' => $this->mataikhoan,
        ];
        return DB::update($sql, $data);
    }

    public function xoa() {
        $sql = "DELETE FROM taikhoan WHERE mataikhoan=:mataikhoan;";
        $data = [
            'mataikhoan' => $this->mataikhoan,
        ];
        return DB::delete($sql, $data);
    }
}
