<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Hệ thống quản lý Nhân sự | Đổi mật khẩu đăng nhập</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="robots" content="noindex">
    <meta name="googlebot" content="noindex">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/lte.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>HR </b>ĐỔI MẬT KHẨU</a>
    </div>
    <div class="login-box-body">
        <form action="{{ action('App\Http\Controllers\TaiKhoanController@postDoiMatKhau') }}" method="post">
            {{ csrf_field() }}
            <div class="form-group has-feedback">
                <input type="password" name="passwordCu" class="form-control" placeholder="Mật khẩu cũ" value="">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" name="passwordMoi" class="form-control" placeholder="Mật khẩu mới" value="">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>  <div class="form-group has-feedback">
                <input type="password" name="passwordNhapLai" class="form-control" placeholder="Nhập lại khẩu mới" value="">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-danger btn-block btn-flat">Đổi mật khẩu</button>
                </div>
            </div>
            <br>
            <div class="col-12">
                @if(Session::has('msg'))
                    <div class="alert alert-danger" role="alert">
                        <p>{!! Session::get('msg') !!}</p>
                    </div>
                @endif
            </div>
        </form>
    </div>
</div>
</body>
</html>
