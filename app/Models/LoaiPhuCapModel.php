<?php

namespace App\Models;

use App\Traits\LoaiPhuCap;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class LoaiPhuCapModel extends Model
{
    use LoaiPhuCap;

    function luuLog(){
        $sql = "SELECT * FROM loaiphucap WHERE maphucap=:maphucap;";
        $data = DB::selectOne($sql, ['maphucap'=>$this->maphucap]);
        if(ToolsModel::isJson($data->log))
            $log_old = json_decode($data->log);
        else
            $log_old = [];
        unset($data->log);
        array_push($log_old, $data);

        $sql = "UPDATE loaiphucap SET log=:log WHERE maphucap=:maphucap;";
        DB::update($sql,['maphucap'=>$this->maphucap, 'log'=>json_encode($log_old, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)]);
    }

    public function danhsach(){
        $sql = "SELECT * FROM loaiphucap";
        return DB::select($sql);
    }

    public function them(){
        $ma = Uuid::uuid1();
        $sql = "INSERT INTO loaiphucap (maphucap, tenphucap, hesophucap, ghichu, ngaycapnhat) VALUES (:maphucap, :tenphucap, :hesophucap, :ghichu, :ngaycapnhat)";
        $data = [
            'maphucap' => $ma,
            'tenphucap' => $this->tenphucap,
            'hesophucap' => $this->hesophucap,
            'ghichu' => $this->ghichu,
            'ngaycapnhat' => date('Y-m-d H:i:s')
        ];
        return db::insert($sql, $data);
    }

    public function sua(){
        $sql = "UPDATE loaiphucap SET tenphucap = :tenphucap, hesophucap = :hesophucap, ghichu = :ghichu, ngaycapnhat = :ngaycapnhat WHERE maphucap = :maphucap";
        $data = [
            'maphucap' => $this->maphucap,
            'tenphucap' => $this->tenphucap,
            'hesophucap' => $this->hesophucap,
            'ghichu' => $this->ghichu,
            'ngaycapnhat' => date('Y-m-d H:i:s')
        ];
        $this->luuLog();
        return db::update($sql, $data);
    }

    public function xoa(){
        $sql = "DELETE FROM loaiphucap WHERE maphucap = :maphucap";
        $data = [
            'maphucap' => $this->maphucap
        ];
        return db::delete($sql, $data);
    }

    public function xemLog(){
        $sql = "SELECT * FROM loaiphucap WHERE maphucap = :maphucap";
        $data = [
            'maphucap' => $this->maphucap
        ];
        $data = db::selectOne($sql, $data);
        if($data)
            return json_decode($data->log);
        return [];
    }
}
