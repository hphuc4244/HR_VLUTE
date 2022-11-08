<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

require 'truongtpa-router.php';

Route::group(['prefix' => '/', 'middleware' => 'isLogin'], function() {
    Route::get('/', 'App\Http\Controllers\TaiKhoanController@goToLogin');
    Route::get('/home', 'App\Http\Controllers\TaiKhoanController@blank');
});

Route::group(['prefix' => '/quanlynhansu', 'middleware' => 'isLogin'], function() {
    Route::get('/', 'App\Http\Controllers\NhanVienController@getDanhSach');
    Route::put('/', 'App\Http\Controllers\NhanVienController@putDuLieu');
    Route::post('/', 'App\Http\Controllers\NhanVienController@postDuLieu' );
    Route::delete('/', 'App\Http\Controllers\NhanVienController@deleteDuLieu' );
    Route::get('/chitiet/{idnhanvien}', 'App\Http\Controllers\NhanVienController@getThongTinNhanVien');
    Route::get('/log/{idnhanvien}', 'App\Http\Controllers\NhanVienController@getLog' );
    Route::get('/quanhuyen', 'App\Http\Controllers\NhanVienController@getDanhSachQuanHuyen');
    Route::get('/xaphuong', 'App\Http\Controllers\NhanVienController@getDanhSachXaPhuong');
    Route::get('/xuatfile/{iddonvi}', 'App\Http\Controllers\BMDonViController@getBMNhanSuTheoDV');

    Route::get('/exports/cb-toan-truong', 'App\Http\Controllers\ThongKeController@dsCanBoToanTruong');
});

Route::group(['prefix' => '/quatrinhhoctap', 'middleware' => 'isLogin'], function() {
    Route::get('/quatrinhhoctap/{idnhanvien}', 'App\Http\Controllers\QuaTrinhHocTapController@hoSoQuaTrinhHocTap');
    Route::put('/quatrinhhoctap', 'App\Http\Controllers\QuaTrinhHocTapController@putBangCapNhanVien');
    Route::post('/quatrinhhoctap', 'App\Http\Controllers\QuaTrinhHocTapController@updateBangCapNhanVien');
    Route::delete('/quatrinhhoctap', 'App\Http\Controllers\QuaTrinhHocTapController@deleteBangCapNhanVien');
});

Route::group(['prefix' => '/quatrinhlamviec', 'middleware' => 'isLogin'], function() {
    Route::get('/quatrinhlamviec/{idnhanvien}', 'App\Http\Controllers\QuaTrinhLamViecController@getQuaTrinhLamViec');
    Route::put('/quatrinhlamviec', 'App\Http\Controllers\QuaTrinhLamViecController@putQuaTrinhLamViec');
    Route::delete('/quatrinhlamviec', 'App\Http\Controllers\QuaTrinhLamViecController@deleteQuaTrinhLamViec');
});

Route::group(['prefix' => '/luongphucap', 'middleware' => 'isLogin'], function() {
    Route::get('/{idnhanvien}', 'App\Http\Controllers\LuongPhuCapController@getDanhSach');
    Route::put('/luong', 'App\Http\Controllers\LuongPhuCapController@putLuong');
    Route::delete('/luong', 'App\Http\Controllers\LuongPhuCapController@deleteLuong');
    Route::put('/phucap', 'App\Http\Controllers\LuongPhuCapController@putPhuCap');
    Route::delete('/phucap', 'App\Http\Controllers\LuongPhuCapController@deletePhuCap');
});

Route::group(['prefix' => '/loaiphucap', 'middleware' => 'isLogin'], function() {
    Route::get('/', 'App\Http\Controllers\LoaiPhuCapController@getDanhSach');
    Route::put('/', 'App\Http\Controllers\LoaiPhuCapController@putDuLieu' );
    Route::post('/', 'App\Http\Controllers\LoaiPhuCapController@postDuLieu' );
    Route::delete('/', 'App\Http\Controllers\LoaiPhuCapController@deleteDuLieu' );
    Route::get('/log', 'App\Http\Controllers\LoaiPhuCapController@getLog' );
});

Route::group(['prefix' => '/ngachluong', 'middleware' => 'isLogin'], function() {
    Route::get('/', 'App\Http\Controllers\NgachLuongController@getDanhSach');
    Route::put('/', 'App\Http\Controllers\NgachLuongController@putDuLieu' );
    Route::post('/', 'App\Http\Controllers\NgachLuongController@postDuLieu' );
    Route::delete('/', 'App\Http\Controllers\NgachLuongController@deleteDuLieu' );
    Route::get('/log', 'App\Http\Controllers\NgachLuongController@getLog' );
});

Route::group(['prefix' => '/loaibangcap', 'middleware' => 'isLogin'], function() {
    Route::get('/', 'App\Http\Controllers\LoaiBangCapController@getDanhSach');
    Route::put('/', 'App\Http\Controllers\LoaiBangCapController@putDuLieu' );
    Route::post('/', 'App\Http\Controllers\LoaiBangCapController@postDuLieu' );
    Route::delete('/', 'App\Http\Controllers\LoaiBangCapController@deleteDuLieu' );
    Route::get('/log', 'App\Http\Controllers\LoaiBangCapController@getLog' );
});

Route::group(['prefix' => '/loaikhenthuong', 'middleware' => 'isLogin'], function() {
    Route::get('/', 'App\Http\Controllers\LoaiKhenThuongController@getDanhSach');
    Route::put('/', 'App\Http\Controllers\LoaiKhenThuongController@putDuLieu' );
    Route::post('/', 'App\Http\Controllers\LoaiKhenThuongController@postDuLieu' );
    Route::delete('/', 'App\Http\Controllers\LoaiKhenThuongController@deleteDuLieu' );
    Route::get('/log', 'App\Http\Controllers\LoaiKhenThuongController@getLog' );
});

Route::group(['prefix' => '/loaithanhtich', 'middleware' => 'isLogin'], function() {
    Route::get('/', 'App\Http\Controllers\LoaiThanhTichController@getDanhSach');
    Route::put('/', 'App\Http\Controllers\LoaiThanhTichController@putDuLieu' );
    Route::post('/', 'App\Http\Controllers\LoaiThanhTichController@postDuLieu' );
    Route::delete('/', 'App\Http\Controllers\LoaiThanhTichController@deleteDuLieu' );
    Route::get('/log', 'App\Http\Controllers\LoaiThanhTichController@getLog' );
});

Route::group(['prefix' => '/chucvu', 'middleware' => 'isLogin'], function() {
    Route::get('/', 'App\Http\Controllers\ChucVuController@getDanhSach');
    Route::put('/', 'App\Http\Controllers\ChucVuController@putDuLieu' );
    Route::post('/', 'App\Http\Controllers\ChucVuController@postDuLieu' );
    Route::delete('/', 'App\Http\Controllers\ChucVuController@deleteDuLieu' );
    Route::get('/log', 'App\Http\Controllers\ChucVuController@getLog' );
});

Route::group(['prefix' => '/donvi', 'middleware' => 'isLogin'], function() {
    Route::get('/', 'App\Http\Controllers\DonViController@getDSDonVi');
    Route::put('/', 'App\Http\Controllers\DonViController@putDonVi');
    Route::post('/', 'App\Http\Controllers\DonViController@postDonVi' );
    Route::delete('/', 'App\Http\Controllers\DonViController@deleteDonVi');
    Route::get('/{iddonvi}', 'App\Http\Controllers\DonViController@getThongTinDonVi');
    Route::put('/thongtindonvi', 'App\Http\Controllers\DonViController@putThongTinDonVi' );
    Route::delete('/thongtindonvi', 'App\Http\Controllers\DonViController@deleteThongTinDonVi');
});

Route::group(['prefix'=>'/thongke','middleware'=>'isLogin'],function () {
    Route::get('/','App\Http\Controllers\ThongKeController@getDSCanBoChart');
});
