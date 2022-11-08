<?php

namespace App\Models;

use App\Traits\NgachLuong;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class NgachLuongModel extends Model
{
    use NgachLuong;

    function luuLog(){
        $sql = "SELECT * FROM ngachluong WHERE mangachluong=:mangachluong;";
        $data = DB::selectOne($sql, ['mangachluong'=>$this->mangachluong]);
        if(ToolsModel::isJson($data->log))
            $log_old = json_decode($data->log);
        else
            $log_old = [];
        unset($data->log);
        array_push($log_old, $data);

        $sql = "UPDATE ngachluong SET log=:log WHERE mangachluong=:mangachluong;";
        DB::update($sql,['mangachluong'=>$this->mangachluong, 'log'=>json_encode($log_old, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)]);
    }

    public function danhsach(){
        $sql = "SELECT * FROM ngachluong";
        return DB::select($sql);
    }

    public function them(){
        $ma = Uuid::uuid1();
        $sql = "INSERT INTO ngachluong (mangachluong, maso, ngach, bacluong, heso, ghichu, ngaycapnhat) VALUES (:mangachluong, :maso, :ngach, :bacluong, :heso, :ghichu, :ngaycapnhat)";
        $data = [
            'mangachluong' => $ma,
            'maso' => $this->maso,
            'ngach' => $this->ngach,
            'bacluong' => $this->bacluong,
            'heso' => $this->heso,
            'ghichu' => $this->ghichu,
            'ngaycapnhat' => date('Y-m-d H:i:s')
        ];
        return db::insert($sql, $data);
    }

    public function sua(){
        $sql = "UPDATE ngachluong SET maso = :maso, ngach = :ngach, bacluong = :bacluong, heso = :heso, ghichu = :ghichu, ngaycapnhat = :ngaycapnhat
                WHERE mangachluong = :mangachluong";
        $data = [
            'mangachluong' => $this->mangachluong,
            'maso' => $this->maso,
            'ngach' => $this->ngach,
            'bacluong' => $this->bacluong,
            'heso' => $this->heso,
            'ghichu' => $this->ghichu,
            'ngaycapnhat' => date('Y-m-d H:i:s')
        ];
        $this->luuLog();
        return db::update($sql, $data);
    }

    public function xoa(){
        $sql = "DELETE FROM ngachluong WHERE mangachluong = :mangachluong";
        $data = [
            'mangachluong' => $this->mangachluong
        ];
        return db::delete($sql, $data);
    }

    public function xemLog(){
        $sql = "SELECT * FROM ngachluong WHERE mangachluong = :mangachluong";
        $data = [
            'mangachluong' => $this->mangachluong
        ];
        $data = db::selectOne($sql, $data);
        if($data)
            return json_decode($data->log);
        return [];
    }

}
