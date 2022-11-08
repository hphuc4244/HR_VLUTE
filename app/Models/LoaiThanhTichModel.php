<?php

namespace App\Models;

use App\Traits\LoaiThanhTich;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class LoaiThanhTichModel extends Model
{
    use LoaiThanhTich;

    function luuLog(){
        $sql = "SELECT * FROM loaithanhtich WHERE mathanhtich=:mathanhtich;";
        $data = DB::selectOne($sql, ['mathanhtich'=>$this->mathanhtich]);
        if(ToolsModel::isJson($data->log))
            $log_old = json_decode($data->log);
        else
            $log_old = [];
        unset($data->log);
        array_push($log_old, $data);

        $sql = "UPDATE loaithanhtich SET log=:log WHERE mathanhtich=:mathanhtich;";
        DB::update($sql,['mathanhtich'=>$this->mathanhtich, 'log'=>json_encode($log_old, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)]);
    }

    public function danhsach(){
        $sql = "SELECT * FROM loaithanhtich";
        return DB::select($sql);
    }

    public function them(){
        $ma = Uuid::uuid4();
        $sql = "INSERT INTO loaithanhtich (mathanhtich, tenthanhtich, ghichu, ngaycapnhat)
                VALUES (:mathanhtich, :tenthanhtich, :ghichu, :ngaycapnhat)";
        $data = [
            'mathanhtich' => $ma,
            'tenthanhtich' => $this->tenthanhtich,
            'ghichu' => $this->ghichu,
            'ngaycapnhat' => date('Y-m-d H:i:s')
        ];
        return db::insert($sql, $data);
    }

    public function sua(){
        $sql = "UPDATE loaithanhtich
                SET tenthanhtich = :tenthanhtich,
                    ghichu = :ghichu, ngaycapnhat = :ngaycapnhat
                WHERE mathanhtich = :mathanhtich";
        $data = [
            'mathanhtich' => $this->mathanhtich,
            'tenthanhtich' => $this->tenthanhtich,
            'ghichu' => $this->ghichu,
            'ngaycapnhat' => date('Y-m-d H:i:s')
        ];
        $this->luuLog();
        return db::update($sql, $data);
    }

    public function xoa(){
        $sql = "DELETE FROM loaithanhtich WHERE mathanhtich = :mathanhtich";
        $data = [
            'makhenthuong' => $this->makhenthuong
        ];
        return db::delete($sql, $data);
    }

    public function xemLog(){
        $sql = "SELECT * FROM loaithanhtich WHERE mathanhtich = :mathanhtich";
        $data = [
            'makhenthuong' => $this->makhenthuong
        ];
        $data = db::selectOne($sql, $data);
        if($data)
            return json_decode($data->log);
        return [];
    }
}
