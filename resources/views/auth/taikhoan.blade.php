@extends('auth.master')
@section('title') Quản lý nhân sự @endsection
@section('content')
    <div class="container-fluid no-padding">
        <section class="content-header">
            <h1 class="tieu-de">
                TÀI KHOẢN ĐĂNG NHẬP
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
                <li><a href="#">Thông tin khác</a></li>
                <li class="active">Tài khoản đăng nhập</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-xs-12" style="margin-bottom: 10px;">
                    <button class="btn btn-success btn-them">Thêm mới</button>
                </div>
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title" style="font-weight: bold; ">Danh sách tài khoản</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table class="table table-bordered" id="table_id">
                                <thead>
                                <tr>
                                    <th>Tên đăng nhập</th>
                                    <th>Tên hiển thị</th>
                                    <th>Ngày tạo</th>
                                    <th style="width: 230px">Thao tác</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($ds as $item)
                                <tr>
                                    <td>{{  $item->tendangnhap }}</td>
                                    <td>{{  $item->tenhienthi }}</td>
                                    <td>{{ date("d/m/Y - H:i:s", strtotime($item->ngaytao))   }}</td>
                                    <td>
                                        <button class="btn btn-warning btn-quen-mk" data="{{$item->mataikhoan}}">Quên mật khẩu</button>
                                        <button class="btn btn-primary btn-sua" data="{{json_encode($item)}}">Sửa</button>
                                        <button class="btn btn-danger btn-xoa" data="{{$item->mataikhoan}}">Xóa</button>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="modal fade in modal-them" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title tieu-de">Thêm mới</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Tên hiển thị</label>
                        <input type="text" class="form-control tenhienthi" placeholder="Nhập tên hiển thị">
                    </div>
                    <div class="form-group">
                        <label>Tên đăng nhập</label>
                        <input type="text" class="form-control tendangnhap" placeholder="Nhập tên đăng nhập">
                    </div>
                    <div class="form-group">
                        <label>Quyền</label>
                        <select class="form-control quyen">
                            <option value="Quản trị viên">Quản trị viên</option>
                            <option value="Quản lý đơn vị">Quản lý đơn vị</option>
                            <option value="Nhân viên">Nhân viên</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Mật khẩu</label>
                        <input type="password" class="form-control matkhau" placeholder="Nhập mật khẩu">
                        <a style="margin-top: 5px; display: block" href="https://www.lastpass.com/features/password-generator" target="_blank">Tạo mật khẩu ngẫu nhiên</a>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success btn-them-thong-tin">Lưu thông tin</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade in modal-sua" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title tieu-de">Cập nhật</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Tên hiển thị</label>
                        <input type="text" class="form-control sua-tenhienthi" placeholder="Nhập tên hiển thị">
                    </div>
                    <div class="form-group">
                        <label>Quyền</label>
                        <select class="form-control sua-quyen">
                            <option value="Quản trị viên">Quản trị viên</option>
                            <option value="Quản lý đơn vị">Quản lý đơn vị</option>
                            <option value="Nhân viên">Nhân viên</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success btn-sua-thong-tin">Lưu thông tin</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade in modal-xoa" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title tieu-de">Xóa thông tin</h4>
                </div>
                <div class="modal-body">
                    <p>Bạn có muốn xóa thông tin không?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-xoa-thong-tin">Xóa thông tin</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade in modal-khoi-phuc-mk" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title tieu-de">Xác nhận khôi phục mật khẩu</h4>
                </div>
                <div class="modal-body">
                    <p>Bạn đang thực hiện tạo tác khôi phục mật khẩu về mặc định.</p>
                    <p>Nếu nhấn vào <b>Khôi phục</b> mật khẩu và tên đăng nhập sẽ giống nhau.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-khoiphuc">Khôi phục</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@endsection

@section('script')
    <script>
        $(document).ready(function () {

            $('#table_id').DataTable();
            $('.btn-them').click(function () {
                $('.modal-them').modal("show");
            });

            $(document).on('click', '.btn-sua', function (){
                var data = $(this).attr("data");
                data=JSON.parse(data);
                $('.sua-tenhienthi').val(data.tenhienthi);
                $('.sua-quyen').val(data.quyen);
                $('.btn-sua-thong-tin').data('ma',data.mataikhoan);
                $('.modal-sua').modal("show");
            });

            $(document).on('click', '.btn-xoa', function (){
                var data = $(this).attr("data");
                $('.btn-xoa-thong-tin').data('ma',data);
                $('.modal-xoa').modal("show");
            });


            $('.btn-them-thong-tin').click(function () {
                $.ajax({
                    url: "{{action('App\Http\Controllers\TaiKhoanController@putTaiKhoan')}}",
                    type: "PUT",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'tenhienthi': $('.tenhienthi').val(),
                        'quyen': $('.quyen').val(),
                        'matkhau': $('.matkhau').val(),
                        'tendangnhap': $('.tendangnhap').val()
                    },
                    success: function (result) {
                        if (result === "1") {
                            toastr.success("Kết quả", "Thao tác thành công");
                            setTimeout(function () {
                                window.location.reload();
                            }, 500);
                        } else {
                            toastr.error("Kết quả", "Thao tác thất bại");
                        }
                    }
                });
            });

            $('.btn-sua-thong-tin').click(function () {
                $.ajax({
                    url: "{{action('App\Http\Controllers\TaiKhoanController@postTaiKhoan')}}",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'mataikhoan': $('.btn-sua-thong-tin').data('ma'),
                        'tenhienthi': $('.sua-tenhienthi').val(),
                        'quyen': $('.sua-quyen').val(),
                    },
                    success: function (result) {
                        if (result === "1") {
                            toastr.success("Kết quả", "Thao tác thành công");
                            setTimeout(function () {
                                window.location.reload();
                            }, 500);
                        } else {
                            toastr.error("Kết quả", "Thao tác thất bại");
                        }
                    }
                });
            });

            $('.btn-xoa-thong-tin').click(function () {
                $.ajax({
                    url: "{{action('App\Http\Controllers\TaiKhoanController@deleteTaiKhoan')}}",
                    type: "DELETE",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'mataikhoan': $('.btn-xoa-thong-tin').data('ma')
                    },
                    success: function (result) {
                        if (result === "1") {
                            toastr.success("Kết quả", "Thao tác thành công");
                            setTimeout(function () {
                                window.location.reload();
                            }, 500);
                        } else {
                            toastr.error("Kết quả", "Thao tác thất bại");
                        }
                    }
                });
            });

            $('.btn-quen-mk').click(function () {
                $('.btn-khoiphuc').attr('data', $(this).attr("data"));
                $('.modal-khoi-phuc-mk').modal('show');
            });

            $('.btn-khoiphuc').click(function () {
                var data = $(this).attr("data");
                $.ajax({
                    url: "{{action('App\Http\Controllers\TaiKhoanController@postQuenMatKhau')}}",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'mataikhoan': data
                    },
                    success: function (result) {
                        if (result === "1") {
                            toastr.success("Kết quả", "Thao tác thành công");
                            setTimeout(function () {
                                window.location.reload();
                            }, 500);
                        } else {
                            toastr.error("Kết quả", "Thao tác thất bại");
                        }
                    }
                });
            });

        });
    </script>
@endsection
