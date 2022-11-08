<?php

namespace App\Models;

use App\Traits\LoaiKhenThuong;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class LoaiKhenThuongModel extends Model
{
    use LoaiKhenThuong;

    function luuLog(){
        $sql = "SELECT * FROM loaikhenthuong WHERE makhenthuong=:makhenthuong;";
        $data = DB::selectOne($sql, ['makhenthuong'=>$this->makhenthuong]);
        if(ToolsModel::isJson($data->log))
            $log_old = json_decode($data->log);
        else
            $log_old = [];
        unset($data->log);
        array_push($log_old, $data);

        $sql = "UPDATE loaikhenthuong SET log=:log WHERE makhenthuong=:makhenthuong;";
        DB::update($sql,['makhenthuong'=>$this->makhenthuong, 'log'=>json_encode($log_old, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)]);
    }

    public function danhsach(){
        $sql = "SELECT * FROM loaikhenthuong";
        return DB::select($sql);
    }

    public function them(){
        $ma = Uuid::uuid4();
        $sql = "INSERT INTO loaikhenthuong (makhenthuong, tenkhenthuong, mucchikhenthuong, ghichu, ngaycapnhat)
                VALUES (:makhenthuong, :tenkhenthuong, :mucchikhenthuong, :ghichu, :ngaycapnhat)";
        $data = [
            'makhenthuong' => $ma,
            'tenkhenthuong' => $this->tenkhenthuong,
            'mucchikhenthuong' => $this->mucchikhenthuong,
            'ghichu' => $this->ghichu,
            'ngaycapnhat' => date('Y-m-d H:i:s')
        ];
        return db::insert($sql, $data);
    }

    public function sua(){
        $sql = "UPDATE loaikhenthuong
                SET tenkhenthuong = :tenkhenthuong, mucchikhenthuong = :mucchikhenthuong,
                    ghichu = :ghichu, ngaycapnhat = :ngaycapnhat
                WHERE makhenthuong = :makhenthuong";
        $data = [
            'makhenthuong' => $this->makhenthuong,
            'tenkhenthuong' => $this->tenkhenthuong,
            'mucchikhenthuong' => $this->mucchikhenthuong,
            'ghichu' => $this->ghichu,
            'ngaycapnhat' => date('Y-m-d H:i:s')
        ];
        $this->luuLog();
        return db::update($sql, $data);
    }

    public function xoa(){
        $sql = "DELETE FROM loaikhenthuong WHERE makhenthuong = :makhenthuong";
        $data = [
            'makhenthuong' => $this->makhenthuong
        ];
        return db::delete($sql, $data);
    }

    public function xemLog(){
        $sql = "SELECT * FROM loaikhenthuong WHERE makhenthuong = :makhenthuong";
        $data = [
            'makhenthuong' => $this->makhenthuong
        ];
        $data = db::selectOne($sql, $data);
        if($data)
            return json_decode($data->log);
        return [];
    }
}
