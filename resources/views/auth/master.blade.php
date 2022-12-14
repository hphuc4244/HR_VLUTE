<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="{{asset('images/favicon.ico')}}"/>
    <title>@yield('title')</title>

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/lte.css')}}">
    <link rel="stylesheet" href="{{asset('css/toastr.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/dataTables.bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/skins.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <style>@yield('style')</style>
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('js/toastr.min.js')}}"></script>
    <script src="{{asset('js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('js/push-menu-left.js')}}"></script>
    <script src="{{asset('js/tree-menu.js')}}"></script>
    <script src="{{asset('js/js.cookie.min.js')}}"></script>
    <script src="{{asset('js/jquery.highlight-5.js')}}"></script>
    <script src="{{asset('js/select2.min.js')}}"></script>
    <script src="{{asset('js/pt-uploads-multiple.js')}}"></script>
    <script src="{{asset('js/script.js')}}?v=8.6"></script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    <header class="main-header">
        <a href="#" class="logo">
            <span class="logo-lg">
                <img src="{{asset('images/logo.png')}}" height="35" alt="Qu???n l?? nh??n s???">
                <b style="padding-left: 10px;">VLUTE HR</b>
            </span>
        </a>
        <nav class="navbar navbar-static-top">
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{asset('images/logo.png')}}" class="user-image"
                                 alt="User Image">
                            <span class="hidden-xs">{{ Session::get('hoten') }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="user-header">
                                <img src="{{asset('images/logo.png')}}" class="img-circle"
                                     alt="User Image">
                                <p>
                                    {{ Session::get('hoten') }}
                                    <small>Email</small>
                                </p>
                            </li>
                            <li class="user-footer">
                                <div class="pull-right">
                                    <a href="{{ action('App\Http\Controllers\TaiKhoanController@getDangXuat') }}"
                                       class="btn btn-default btn-flat">????ng xu???t</a>
                                </div>
                                <div class="pull-left">
                                    <a href="{{ action('App\Http\Controllers\TaiKhoanController@getViewDoiMatKhau') }}"
                                       class="btn btn-default btn-flat">?????i m???t kh???u</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <aside class="main-sidebar">
        @if(true)
        <section class="sidebar">
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">CH???C N??NG</li>
{{--                @if(Session::get('quyen') == 'Qu???n tr??? vi??n')--}}
                    <li>
                        <a href="{{action('App\Http\Controllers\TaiKhoanController@getViewTaiKhoan')}}">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            <span>Qu???n l?? t??i kho???n</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{action('App\Http\Controllers\DonViController@getDSDonVi')}}">
                            <i class="fa fa-cubes"></i>
                            Qu???n l?? ????n v??? l??m vi???c
                        </a>
                    </li>
{{--                @endif--}}
                <li>
                    <a href="{{action('App\Http\Controllers\ThongKeController@getDSCanBoChart')}}">
                        <i class="fa fa-bar-chart"></i>
                        <span>Th???ng k?? nh??n s???</span>
                    </a>
                </li>
                <li>
                    <a href="{{action('App\Http\Controllers\NhanVienController@getDanhSach')}}">
                        <i class="fa fa-users"></i>
                        <span>Qu???n l?? nh??n s???</span>
                    </a>
                </li>
                <li>
                    <a href="{{action('App\Http\Controllers\HoSoController@showTuHoSo')}}">
                        <i class="fa fa-archive"></i>
                        <span>V??? tr?? l??u tr??? h??? s??</span>
                    </a>
                </li>
{{--                <li>--}}
{{--                    <a href="#">--}}
{{--                        <i class="fa fa-trophy"></i>--}}
{{--                        <span>Khen th?????ng</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <a href="#">--}}
{{--                        <i class="fa fa-star"></i>--}}
{{--                        <span>Th??nh t??ch</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <a href="#">--}}
{{--                        <i class="fa fa-exclamation-triangle"></i>--}}
{{--                        <span>K??? lu???t</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <a href="#">--}}
{{--                        <i class="fa fa-line-chart"></i>--}}
{{--                        <span>X??t n??ng l????ng</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <a href="#">--}}
{{--                        <i class="fa fa-external-link-square"></i>--}}
{{--                        <span>X??t n??ng ph??? c???p th??m ni??n</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <a href="#">--}}
{{--                        <i class="fa fa-street-view"></i>--}}
{{--                        <span>X??t ngh??? h??u</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
                <li class="treeview" style="height: auto;">
                    <a href="#">
                        <i class="fa fa-book"></i>
                        <span>C??c danh m???c chung</span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="{{action('App\Http\Controllers\ChucVuController@getDanhSach')}}">
                                <i class="fa fa-circle-o"></i>
                                Danh m???c ch???c v???
                            </a>
                        </li>
                        <li>
                            <a href="{{action('App\Http\Controllers\LoaiBangCapController@getDanhSach')}}">
                                <i class="fa fa-circle-o"></i>
                                Danh m???c b???ng, ch???ng ch???, ...
                            </a>
                        </li>
                        <li>
                            <a href="{{action('App\Http\Controllers\NgachLuongController@getDanhSach')}}">
                                <i class="fa fa-circle-o"></i>
                                Danh m???c ng???ch l????ng
                            </a>
                        </li>
                        <li>
                            <a href="{{action('App\Http\Controllers\LoaiPhuCapController@getDanhSach')}}">
                                <i class="fa fa-circle-o"></i>
                                Danh m???c lo???i ph??? c???p
                            </a>
                        </li>
                        <li>
                            <a href="{{action('App\Http\Controllers\LoaiKhenThuongController@getDanhSach')}}">
                                <i class="fa fa-circle-o"></i>
                                Danh m???c lo???i khen th?????ng
                            </a>
                        </li>
                        <li>
                            <a href="{{action('App\Http\Controllers\LoaiThanhTichController@getDanhSach')}}">
                                <i class="fa fa-circle-o"></i>
                                Danh m???c lo???i th??nh t??ch
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </section>
        @else
            <script type="text/javascript">
                $(document).ready(function () {
                    $('.sidebar-toggle').trigger('click');
                });
            </script>
        @endif
    </aside>

    <div class="content-wrapper">
        @yield('content')
    </div>

    <footer class="main-footer">
        <strong>
            <a href="#">@2021 | Ph??ng T??? ch???c - H??nh ch??nh</a>
        </strong>
    </footer>
</div>
</body>
</html>
<script type="text/javascript">
    $.fn.modal.prototype.constructor.Constructor.DEFAULTS.backdrop = 'static';
    $.extend( true, $.fn.dataTable.defaults, {
        "sScrollX": "100%",
        "sScrollXInner": "100%",
        "bScrollCollapse": true,
        "autoWidth": true,
        'stateSave': true
    });

    $(document).ready(function () {

        $('select').select2();

        $('.treeview-menu li').each(function () {
            var tmp = localStorage.getItem('menu');
            if (tmp === $(this).text()) {
                $(this).addClass('active');
                $(this).parent().parent().addClass('active menu-open');
            }
        });

        $('.treeview-menu li').click(function () {
            localStorage.setItem('menu', $(this).text())
        });

    });
</script>
@yield('script')
