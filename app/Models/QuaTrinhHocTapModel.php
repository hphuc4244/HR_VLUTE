<?php

namespace App\Models;

use App\Traits\QuaTrinhHocTap;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class QuaTrinhHocTapModel extends Model
{
    use QuaTrinhHocTap;

    public function viewQuaTrinhHocTap(){
        $sql = "SELECT * FROM nhanvien WHERE manhanvien = :manhanvien";
        $data = [
            'manhanvien' => $this->manhanvien
        ];
        return db::selectOne($sql, $data);
    }

    public function thongTinQuaTrinhHocTap(){
        $sql = "SELECT quatrinhhoctap.*, tenloaibangcap,
                        (CASE WHEN TIMESTAMPDIFF(MONTH, ngaybatdauhoc, ngaycapbang) >= 1
                            THEN CONCAT(TIMESTAMPDIFF(MONTH, ngaybatdauhoc, ngaycapbang),' tháng')
                            ELSE CONCAT(DATEDIFF(ngaycapbang, ngaybatdauhoc),' ngày')
                        END) AS thoigian
                FROM quatrinhhoctap, loaibangcap
                WHERE quatrinhhoctap.maloaibangcap = loaibangcap.maloaibangcap
                AND manhanvien = :manhanvien ORDER BY ngaycapbang DESC";

        $data = [
            'manhanvien' => $this->manhanvien
        ];
        return db::select($sql, $data);
    }

    public function them(){
        $ma = Uuid::uuid4();
        $sql = "INSERT INTO quatrinhhoctap(maquatrinhhoctap, maloaibangcap, manhanvien, donvidaotao, chuyennganhdaotao, donxindihoc,
                      ngaybatdauhoc, noicapbang, ngaycapbang, sovaoso, hinhanh, ngaytao, ghichu)
                VALUES (:maquatrinhhoctap, :maloaibangcap, :manhanvien, :donvidaotao, :chuyennganhdaotao, :donxindihoc,
                      :ngaybatdauhoc, :noicapbang, :ngaycapbang, :sovaoso, :hinhanh, :ngaytao, :ghichu)";
        $data = [
            'maquatrinhhoctap' => $ma,
            'maloaibangcap' => $this->maloaibangcap,
            'manhanvien' => $this->manhanvien,
            'donvidaotao' => $this->donvidaotao,
            'chuyennganhdaotao' => $this->chuyennganhdaotao,
            'donxindihoc' => $this->donxindihoc,
            'ngaybatdauhoc' =>  $this->ngaybatdauhoc,
            'noicapbang' => $this->noicapbang,
            'ngaycapbang' => $this->ngaycapbang,
            'sovaoso' => $this->sovaoso,
            'hinhanh' => $this->hinhanh,
            'ghichu' => $this->ghichu,
            'ngaytao' => date('Y-m-d H:i:s')
        ];
        return db::insert($sql, $data);
    }

    public function sua(){
        $ma = Uuid::uuid4();
        $sql = "UPDATE quatrinhhoctap
                SET maloaibangcap=:maloaibangcap, manhanvien=:manhanvien, donvidaotao=:donvidaotao,
                    chuyennganhdaotao=:chuyennganhdaotao, donxindihoc=:donxindihoc, ngaybatdauhoc=:ngaybatdauhoc,
                    noicapbang=:noicapbang, ngaycapbang=:ngaycapbang, sovaoso=:sovaoso,
                    hinhanh=:hinhanh, ngaytao=:ngaytao, ghichu=:ghichu
                WHERE maquatrinhhoctap=:maquatrinhhoctap";
        $data = [
            'maquatrinhhoctap' => $this->maquatrinhhoctap,
            'maloaibangcap' => $this->maloaibangcap,
            'manhanvien' => $this->manhanvien,
            'donvidaotao' => $this->donvidaotao,
            'chuyennganhdaotao' => $this->chuyennganhdaotao,
            'donxindihoc' => $this->donxindihoc,
            'ngaybatdauhoc' =>  $this->ngaybatdauhoc,
            'noicapbang' => $this->noicapbang,
            'ngaycapbang' => $this->ngaycapbang,
            'sovaoso' => $this->sovaoso,
            'hinhanh' => $this->hinhanh,
            'ghichu' => $this->ghichu,
            'ngaytao' => date('Y-m-d H:i:s')
        ];
        return db::update($sql, $data);
    }

    public function xoa(){
        $sql = "DELETE FROM quatrinhhoctap WHERE maquatrinhhoctap = :maquatrinhhoctap";
        $data = [
            'maquatrinhhoctap' => $this->maquatrinhhoctap
        ];
        return db::delete($sql, $data);
    }
}
