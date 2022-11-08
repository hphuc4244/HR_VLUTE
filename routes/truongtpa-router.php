<?php

Route::get('/dang-nhap', 'App\Http\Controllers\TaiKhoanController@getViewDangNhap');
Route::get('/doi-mat-khau', 'App\Http\Controllers\TaiKhoanController@getViewDoiMatKhau');
Route::get('/dang-xuat', 'App\Http\Controllers\TaiKhoanController@getDangXuat');
Route::post('/dang-nhap', 'App\Http\Controllers\TaiKhoanController@postDangNhap');
Route::post('/doi-mat-khau', 'App\Http\Controllers\TaiKhoanController@postDoiMatKhau');

Route::group(['prefix' => '/taikhoan', 'middleware' => 'isLogin'], function() {
    Route::get('/', 'App\Http\Controllers\TaiKhoanController@getViewTaiKhoan');
    Route::put('/', 'App\Http\Controllers\TaiKhoanController@putTaiKhoan');
    Route::post('/', 'App\Http\Controllers\TaiKhoanController@postTaiKhoan');
    Route::delete('/', 'App\Http\Controllers\TaiKhoanController@deleteTaiKhoan');
    Route::post('/doi-mat-khau', 'App\Http\Controllers\TaiKhoanController@postQuenMatKhau');
});

Route::group(['prefix' => '/donvi/v2', 'middleware' => 'isLogin'], function() {
    Route::get('/', 'App\Http\Controllers\DonViv2Controller@getDSDonVi');
    Route::get('/{iddonvi}', 'App\Http\Controllers\DonViv2Controller@getCTDonVi');
});

Route::get('/uploads', function (){
    return view('pt-uploads');
});
