<?php

namespace App\Models;

use App\Traits\ChucVu;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class ChucVuModel extends Model
{
    use ChucVu;

    function luuLog(){
        $sql = "SELECT * FROM chucvu WHERE machucvu=:machucvu;";
        $data = DB::selectOne($sql, ['machucvu'=>$this->machucvu]);
        if(ToolsModel::isJson($data->log))
            $log_old = json_decode($data->log);
        else
            $log_old = [];
        unset($data->log);
        array_push($log_old, $data);
        $sql = "UPDATE chucvu SET log=:log WHERE machucvu=:machucvu;";
        DB::update($sql,['machucvu'=>$this->machucvu, 'log'=>json_encode($log_old, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)]);
    }


    public function danhsach(){
        $sql = "SELECT * FROM chucvu";
        return DB::select($sql);
    }

    public function them(){
        $ma = Uuid::uuid1();
        $sql = "INSERT INTO chucvu(machucvu, tenchucvu, phucapchucvu, ghichu, ngaycapnhat) VALUES ( :machucvu, :tenchucvu, :phucapchucvu, :ghichu, :ngaycapnhat)";
        $data = [
            'machucvu' => $ma,
            'tenchucvu' => $this->tenchucvu,
            'phucapchucvu' => $this->phucapchucvu,
            'ghichu' => $this->ghichu,
            'ngaycapnhat' => date('Y-m-d H:i:s')
        ];
        return db::insert($sql, $data);
    }

    public function sua(){
        $sql = "UPDATE chucvu SET tenchucvu = :tenchucvu, phucapchucvu = :phucapchucvu, ghichu = :ghichu, ngaycapnhat = :ngaycapnhat WHERE machucvu = :machucvu";
        $data = [
            'machucvu' => $this->machucvu,
            'tenchucvu' => $this->tenchucvu,
            'phucapchucvu' => $this->phucapchucvu,
            'ghichu' => $this->ghichu,
            'ngaycapnhat' => date('Y-m-d H:i:s')
        ];
        $this->luuLog();
        return db::update($sql, $data);
    }

    public function xoa(){
        $sql = "DELETE FROM chucvu WHERE machucvu = :machucvu";
        $data = [
            'machucvu' => $this->machucvu
        ];
        return db::delete($sql, $data);
    }

    public function xemLog(){
        $sql = "SELECT * FROM chucvu WHERE machucvu = :machucvu";
        $data = [
            'machucvu' => $this->machucvu
        ];
        $data = db::selectOne($sql, $data);
        if($data)
            return json_decode($data->log);
        return [];
    }


}
