<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class isLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->session()->get('is_login')) {
//            $quyen = trim($request->session()->get("quyen"));
//
//            if(strpos(url()->full(), 'donvi')){
//                if($quyen != "Quản lý đơn vị"){
//
//                    Log::info("khon có quyen");
//
//                    return redirect()
//                        ->action('App\Http\Controllers\TaiKhoanController@getViewDangNhap')
//                        ->with('msg', 'Vui lòng đăng nhập để bắt đầu phiên làm việc');
//                }else{
//                    Log::info("có quyen");
//                }
//            }
            return $next($request);
        } else {
            $request->session()->put('url',  $request->fullUrl());
            return redirect()
                ->action('App\Http\Controllers\TaiKhoanController@getViewDangNhap')
                ->with('msg', 'Vui lòng đăng nhập để bắt đầu phiên làm việc');
        }

    }
}
