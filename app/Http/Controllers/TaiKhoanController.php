<?php

namespace App\Http\Controllers;

use App\Models\LoaiPhuCapModel;
use App\Models\TaiKhoanModel;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class TaiKhoanController extends Controller
{

    public function goToLogin(){
        return redirect()
            ->action('App\Http\Controllers\TaiKhoanController@getViewDangNhap');
    }

    public function blank(){
        return view('auth.trangchu');
    }

    public function getViewDangNhap(){
        return view('auth.dangnhap');
    }

    public function getViewDoiMatKhau(){
        return view('auth.doimatkhau');
    }

    public function getViewTaiKhoan(){
        $tk = new TaiKhoanModel();
        return view('auth.taikhoan', ['ds' => $tk->danhSach()]);
    }

    public function getDangXuat(Request $request){
        if($request->session()->has('id_tai_khoan')){
            $request->session()->forget('email');
            $request->session()->forget('quyen');
            $request->session()->forget('mataikhoan');
        }
        return redirect()
            ->action('App\Http\Controllers\TaiKhoanController@getViewDangNhap')
            ->with('msg', 'Đã đăng xuất thành công');
    }

    public function postDangNhap(Request $request){
        $taiKhoan = new TaiKhoanModel();
        $taiKhoan->tendangnhap = $request->input('email');
        $taiKhoan->matkhau = $request->input('password');
        $data = $taiKhoan->dangNhap();
        if($data != null){

            $request->session()->put('is_login', true);
            $request->session()->put('quyen', $data->quyen);
            $request->session()->put('hoten', $data->tenhienthi);
            $request->session()->put('mataikhoan', $data->mataikhoan);

            return redirect()->action('App\Http\Controllers\TaiKhoanController@blank');
        }
        return redirect()
            ->action('App\Http\Controllers\TaiKhoanController@getViewDangNhap')
            ->with('msg', 'Tên đăng nhập hoặc mật khẩu không đúng');
    }

    public function postDoiMatKhau(Request $request){
        $taiKhoan = new TaiKhoanModel();
        $taiKhoan->matkhau = $request->input('passwordCu');
        $taiKhoan->mataikhoan = $request->session()->get('mataikhoan');
        $mk_moi = $request->input('passwordMoi');
        $mk_moi_nhap_lai = $request->input('passwordNhapLai');

        if($mk_moi != $mk_moi_nhap_lai){
            return redirect()
                ->action('App\Http\Controllers\TaiKhoanController@getViewDoiMatKhau')
                ->with('msg', 'Mật khẩu mới không khớp');
        }

        if($mk_moi == $taiKhoan->mat_khau){
            return redirect()
                ->action('App\Http\Controllers\TaiKhoanController@getViewDoiMatKhau')
                ->with('msg', 'Mật khẩu cũ và mật khẩu mới không được giống nhau.');
        }

        $data = $taiKhoan->DoiMatKhau($mk_moi);
        if($data > 0){
            return redirect()->action('App\Http\Controllers\TaiKhoanController@blank');
        }

        return redirect()
            ->action('App\Http\Controllers\TaiKhoanController@getViewDoiMatKhau')
            ->with('msg', 'Mật khẩu cũ không đúng hoặc không hợp lệ.');
    }

    public function putTaiKhoan(Request $request){
        $tk = new TaiKhoanModel();
        $tk->tenhienthi = $request->input("tenhienthi");
        $tk->matkhau = $request->input("matkhau");
        $tk->quyen = $request->input("quyen");
        $tk->tendangnhap = $request->input("tendangnhap");
        $tk->mataikhoan = Uuid::uuid1();
        return $tk->them();
    }

    public function postTaiKhoan(Request $request){
        $tk = new TaiKhoanModel();
        $tk->mataikhoan = $request->input("mataikhoan");
        $tk->tenhienthi = $request->input("tenhienthi");
        $tk->quyen = $request->input("quyen");
        return $tk->capNhat();
    }

    public function deleteTaiKhoan(Request $request){
        $tk = new TaiKhoanModel();
        $tk->mataikhoan = $request->input("mataikhoan");
        return $tk->xoa();
    }

    public function postQuenMatKhau(Request $request){
        $tk = new TaiKhoanModel();
        $tk->mataikhoan = $request->input("mataikhoan");
        return $tk->quenMatKhau();
    }
}
