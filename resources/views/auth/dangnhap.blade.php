<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Hệ thống quản lý Nhân sự | Log in</title>
    <link rel="shortcut icon" href="{{asset('images/favicon.ico')}}"/>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="robots" content="noindex">
    <meta name="googlebot" content="noindex">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/lte.css')}}">
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <style>
        body{
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .main {
            position: relative;
            width: 1000px;
            min-width: 1000px;
            min-height: 600px;
            height: 600px;
            padding: 25px;
            background-color: #ecf0f3;
            box-shadow: 10px 10px 10px #d1d9e6, -10px -10px 10px #f9f9f9;
            border-radius: 12px;
            overflow: hidden;
        }
        @media (max-width: 1200px) {
            .main {
                transform: scale(0.7);
            }
        }
        @media (max-width: 1000px) {
            .main {
                transform: scale(0.6);
            }
        }
        @media (max-width: 800px) {
            .main {
                transform: scale(0.5);
            }
        }
        @media (max-width: 600px) {
            .main {
                transform: scale(0.4);
            }
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            position: absolute;
            top: 0;
            width: 600px;
            height: 100%;
            padding: 25px;
            background-color: #ecf0f3;
            transition: 1.25s;
        }

        .form {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            width: 100%;
            height: 100%;
        }

        .form__input {
            width: 350px;
            height: 50px;
            margin: 10px 0;
            padding: 0px 25px;
            font-size: 15px;
            letter-spacing: 0.15px;
            border: none;
            outline: none;
            font-family: "Montserrat", sans-serif;
            transition: 0.25s ease;
            border-radius: 8px;
            box-shadow: inset 2px 2px 4px #d1d9e6, inset -2px -2px 4px #f9f9f9;
        }
        .form__input:focus {
            box-shadow: inset 4px 4px 4px #d1d9e6, inset -4px -4px 4px #f9f9f9;
        }
        .form__span {
            margin-bottom: 12px;
            font-size: 15px;
            color: #0d6aad;
        }

        .title {
            font-size: 34px;
            font-weight: 700;
            line-height: 3;
            color: #181818;
        }

        .description {
            font-size: 14px;
            letter-spacing: 0.25px;
            text-align: center;
            line-height: 1.6;
        }

        .button {
            width: 180px;
            height: 50px;
            border-radius: 25px;
            margin-top: 50px;
            font-weight: 700;
            font-size: 14px;
            letter-spacing: 1.15px;
            background-color: #4B70E2;
            color: #f9f9f9;
            box-shadow: 8px 8px 16px #d1d9e6, -8px -8px 16px #f9f9f9;
            border: none;
            outline: none;
        }

        /**/
        .a-container {
            z-index: 100;
            left: calc(100% - 600px );
        }

        .switch {
            display: flex;
            justify-content: center;
            align-items: center;
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 400px;
            padding: 50px;
            z-index: 200;
            transition: 1.25s;
            background-color: #ecf0f3;
            overflow: hidden;
            box-shadow: 4px 4px 10px #d1d9e6, -4px -4px 10px #f9f9f9;
        }
        .switch__circle {
            position: absolute;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            background-color: #ecf0f3;
            box-shadow: inset 8px 8px 12px #d1d9e6, inset -8px -8px 12px #f9f9f9;
            bottom: -60%;
            left: -60%;
            transition: 1.25s;
        }
        .switch__circle--t {
            top: -30%;
            left: 60%;
            width: 300px;
            height: 300px;
        }
        .switch__container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            position: absolute;
            width: 400px;
            padding: 50px 55px;
            transition: 1.25s;
        }
        .msg {
            margin-top: 15px;
            font-weight: bold;
            font-size: 16px;
            color: red;
            text-align: center;
            line-height: 1.6;
        }
    </style>
</head>
<body>
<div class="main">
    <div class="container a-container" id="a-container">
        <form action="{{ action('App\Http\Controllers\TaiKhoanController@postDangNhap') }}" class="form"
              method="post" id="form-dang-nhap">
            {{ csrf_field() }}
            <p class="form__title title">HR Login</p>
            <span class="form__span">Vui lòng đăng nhập để bắt đầu phiên làm việc</span>
            <input class="form__input" type="text" name="email" placeholder="Tên đăng nhập">
            <input class="form__input" type="password" name="password" placeholder="Mật khẩu">
            <button class="form__button button submit">Đăng nhập</button>
            @if(Session::has('msg'))
                    <p class="msg">{!! Session::get('msg') !!}</p>
            @endif
        </form>
    </div>
    <div class="switch" id="switch-cnt">
        <div class="switch__circle"></div>
        <div class="switch__circle switch__circle--t"></div>
        <div class="switch__container" id="switch-c1">
            <h2 class="switch__title title">Welcome to VLUTE!</h2>
            <img src="{{asset('images/logo.png')}}" height="150" alt="Quản lý nhân sự"
                 style="margin-bottom: 30px;">
            <p class="switch__description description">Chào mừng đến với Hệ thống quản lý nhân sự Trường Đại học Sư phạm Kỹ thuật Vĩnh Long</p>
        </div>
    </div>
</div>
</body>
</html>
