<?php

use App\Models\ToolsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('upload/file', function (Request $request){
    if($request->hasFile('teptin')) {
        $file = $request->file('teptin');

        $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);

        if(in_array($extension, ['pdf', 'docx', 'doc', 'xlsx', 'xls'])){
            $name = $filename . "_" . uniqid() . "." . $extension;
            $file->move(public_path().'/files/', $name);
            return ToolsModel::status(200, '/files/'. $name);
        }

        return ToolsModel::status(500, "Chỉ chấp nhận các tệp tin có phần mở rộng pdf, docx, doc, xlsx, xls.");

    }
    return ToolsModel::status(500, "Không tải lên được tệp tin");
});

Route::post('delete/file', function (Request $request){
    $File = pathinfo($request->input('duongdan'));
    Log::info($File);
    $filename = public_path().'/files/' . $File['basename'];
    if(File::exists($filename)){
        File::delete($filename);
        return ToolsModel::status(200, "Xóa tệp tin thành công");
    }else{
        return ToolsModel::status(500, "Tệp tin không tồn tại");
    }
});
