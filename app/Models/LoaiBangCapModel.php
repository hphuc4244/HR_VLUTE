<?php

namespace App\Models;

use App\Traits\LoaiBangCap;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class LoaiBangCapModel extends Model
{
    use LoaiBangCap;

    function luuLog(){
        $sql = "SELECT * FROM loaibangcap WHERE maloaibangcap=:maloaibangcap;";
        $data = DB::selectOne($sql, ['maloaibangcap'=>$this->maloaibangcap]);
        if(ToolsModel::isJson($data->log))
            $log_old = json_decode($data->log);
        else
            $log_old = [];
        unset($data->log);
        array_push($log_old, $data);

        $sql = "UPDATE loaibangcap SET log=:log WHERE maloaibangcap=:maloaibangcap;";
        DB::update($sql,['maloaibangcap'=>$this->maloaibangcap, 'log'=>json_encode($log_old, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)]);
    }

    public function danhsach(){
        $sql = "SELECT * FROM loaibangcap";
        return DB::select($sql);
    }

    public function them(){
        $ma = Uuid::uuid1();
        $sql = "INSERT INTO loaibangcap (maloaibangcap, tenloaibangcap, ghichu, ngaycapnhat) VALUES (:maloaibangcap, :tenloaibangcap, :ghichu, :ngaycapnhat)";
        $data = [
            'maloaibangcap' => $ma,
            'tenloaibangcap' => $this->tenloaibangcap,
            'ghichu' => $this->ghichu,
            'ngaycapnhat' => date('Y-m-d H:i:s')
        ];
        return db::insert($sql, $data);
    }

    public function sua(){
        $sql = "UPDATE loaibangcap SET tenloaibangcap = :tenloaibangcap, ghichu = :ghichu, ngaycapnhat = :ngaycapnhat WHERE maloaibangcap = :maloaibangcap";
        $data = [
            'maloaibangcap' => $this->maloaibangcap,
            'tenloaibangcap' => $this->tenloaibangcap,
            'ghichu' => $this->ghichu,
            'ngaycapnhat' => date('Y-m-d H:i:s')
        ];
        $this->luuLog();
        return db::update($sql, $data);
    }

    public function xoa(){
        $sql = "DELETE FROM loaibangcap WHERE maloaibangcap = :maloaibangcap";
        $data = [
            'maloaibangcap' => $this->maloaibangcap
        ];
        return db::delete($sql, $data);
    }

    public function xemLog(){
        $sql = "SELECT * FROM loaibangcap WHERE maloaibangcap = :maloaibangcap";
        $data = [
            'maloaibangcap' => $this->maloaibangcap
        ];
        $data = db::selectOne($sql, $data);
        if($data)
            return json_decode($data->log);
        return [];
    }
}
