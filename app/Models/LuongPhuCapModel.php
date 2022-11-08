<?php

namespace App\Models;

use App\Traits\LuongNhanVien;
use App\Traits\PhuCapNhanVien;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class LuongPhuCapModel extends Model
{
    use LuongNhanVien;
    use PhuCapNhanVien;

    public function thongTinNhanVien(){
        $sql = "SELECT * FROM nhanvien WHERE manhanvien = :manhanvien";
        $data = [
            'manhanvien' => $this->manhanvien
        ];
        return DB::selectOne($sql, $data);
    }

    public function danhSachLuong(){
        $sql = "SELECT luongnhanvien.*, maso, heso, bacluong FROM luongnhanvien, ngachluong
                WHERE luongnhanvien.mangachluong = ngachluong.mangachluong
                AND manhanvien = :manhanvien
                ORDER BY ngayhuong DESC";
        $data = [
            'manhanvien' => $this->manhanvien
        ];
        return DB::select($sql, $data);
    }

    public function danhSachPhuCap(){
        $sql = "SELECT phucapnhanvien.*, tenphucap, hesophucap FROM phucapnhanvien, loaiphucap
                WHERE phucapnhanvien.maphucap = loaiphucap.maphucap
                AND manhanvien = :manhanvien
                ORDER BY ngayhuongphucap DESC";
        $data = [
            'manhanvien' => $this->manhanvien
        ];
        return DB::select($sql, $data);
    }

    public function themLuong(){
        $ma = Uuid::uuid4();
        $sql = "INSERT INTO luongnhanvien(maluong, manhanvien, mangachluong, ngayhuong,
                          soquyetdinh, hinhanh, coquanbanhanh, vuotkhung, ngaytao, ghichu)
                VALUES ( :maluong, :manhanvien, :mangachluong, :ngayhuong,
                        :soquyetdinh, :hinhanh, :coquanbanhanh, :vuotkhung, :ngaytao, :ghichu)";
        $data = [
            'maluong' => $ma,
            'manhanvien' => $this->manhanvien,
            'mangachluong' => $this->mangachluong,
            'ngayhuong' => $this->ngayhuong,
            'soquyetdinh' => $this->soquyetdinh,
            'hinhanh' => $this->hinhanh,
            'coquanbanhanh' => $this->coquanbanhanh,
            'vuotkhung' => $this->vuotkhung,
            'ghichu' => $this->ghichu,
            'ngaytao' => date('Y-m-d H:i:s')
        ];
        return db::insert($sql, $data);
    }

    public function xoaLuong(){
        $sql = "DELETE FROM luongnhanvien WHERE maluong = :maluong";
        $data = [
            'maluong' => $this->maluong
        ];
        return db::delete($sql, $data);
    }

    public function themPhuCap(){
        $ma = Uuid::uuid4();
        $sql = "INSERT INTO phucapnhanvien(maphucapnhanvien, maphucap, manhanvien, ngayhuongphucap,
                          soquyetdinh, hinhanh, coquanbanhanh, ngaytao, ghichu)
                VALUES ( :maphucapnhanvien, :maphucap, :manhanvien, :ngayhuongphucap,
                        :soquyetdinh, :hinhanh, :coquanbanhanh, :ngaytao, :ghichu)";
        $data = [
            'maphucapnhanvien' => $ma,
            'maphucap' => $this->maphucap,
            'manhanvien' => $this->manhanvien,
            'ngayhuongphucap' => $this->ngayhuongphucap,
            'soquyetdinh' => $this->soquyetdinh,
            'hinhanh' => $this->hinhanh,
            'coquanbanhanh' => $this->coquanbanhanh,
            'ghichu' => $this->ghichu,
            'ngaytao' => date('Y-m-d H:i:s')
        ];
        return db::insert($sql, $data);
    }

    public function xoaPhuCap(){
        $sql = "DELETE FROM phucapnhanvien WHERE maphucapnhanvien = :maphucapnhanvien";
        $data = [
            'maphucapnhanvien' => $this->maphucapnhanvien
        ];
        return db::delete($sql, $data);
    }
}
