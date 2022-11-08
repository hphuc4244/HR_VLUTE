@extends('auth.master')
@section('title') Quản lý nhân sự @endsection
@section('content')
    <div class="container-fluid no-padding">
        <section class="content-header">
            <h1 class="tieu-de">
                NGẠCH LƯƠNG
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Thông tin khác</a></li>
                <li class="active">Ngạch lương</li>
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
                            <h3 class="box-title" style="font-weight: bold; ">Danh sách ngạch lương</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table class="table table-bordered" id="table_id">
                                <thead>
                                <tr>
                                    <th>Mã số</th>
                                    <th>Ngạch</th>
                                    <th>Bậc lương</th>
                                    <th>Hệ số</th>
                                    <th>Ghi chú</th>
                                    <th>Ngày cập nhật</th>
                                    <th style="width: 190px">Thao tác</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($ds as $item)
                                <tr>
                                    <td>{{  $item->maso }}</td>
                                    <td>{{  $item->ngach }}</td>
                                    <td>{{  $item->bacluong }}</td>
                                    <td>{{  $item->heso }}</td>
                                    <td>{{  $item->ghichu }}</td>
                                    <td>{{  date("d/m/Y - H:i:s", strtotime($item->ngaycapnhat)) }}</td>
                                    <td>
                                        <button class="btn btn-warning btn-xem-ls" data="{{$item->mangachluong}}" dataten="{{$item->maso}}" >Xem lịch sử</button>
                                        <button class="btn btn-primary btn-sua" data="{{json_encode($item)}}">Sửa</button>
                                        <button class="btn btn-danger btn-xoa" data="{{$item->mangachluong}}">Xóa</button>
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
                        <label>Mã số</label>
                        <input type="text" class="form-control them-maso" placeholder="Nhập mã số lương">
                    </div>
                    <div class="form-group">
                        <label>Mã ngạch</label>
                        <input type="text" class="form-control them-ngach" placeholder="Nhập mã ngạch">
                    </div>
                    <div class="form-group">
                        <label>Bậc lương</label>
                        <input type="text" class="form-control them-bacluong" placeholder="Nhập bậc lương">
                    </div>
                    <div class="form-group">
                        <label>Hệ số</label>
                        <input type="number" step="0.1" min="0" max="10.0" value="0" class="form-control them-heso" placeholder="Nhập hệ số lương">
                    </div>
                    <div class="form-group">
                        <label>Ghi chú</label>
                        <input type="text" class="form-control them-ghichu" placeholder="Nhập ghi chú ngạch lương">
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
                    <h4 class="modal-title tieu-de">Cập nhật thông tin</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Mã số</label>
                        <input type="text" class="form-control sua-maso" placeholder="Nhập mã số lương">
                    </div>
                    <div class="form-group">
                        <label>Mã ngạch</label>
                        <input type="text" class="form-control sua-ngach" placeholder="Nhập mã ngạch">
                    </div>
                    <div class="form-group">
                        <label>Bậc lương</label>
                        <input type="text" class="form-control sua-bacluong" placeholder="Nhập bậc lương">
                    </div>
                    <div class="form-group">
                        <label>Hệ số</label>
                        <input type="number" step="0.1" min="0" max="10.0" value="0" class="form-control sua-heso" placeholder="Nhập hệ số lương">
                    </div>
                    <div class="form-group">
                        <label>Ghi chú</label>
                        <input type="text" class="form-control sua-ghichu" placeholder="Nhập ghi chú ngạch lương">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success btn-sua-thong-tin">Lưu thông tin</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
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

    <div class="modal fade in modal-xem-ls" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title tieu-de tieu-de-ls">Lịch sử thay đổi dữ liệu</h4>
                </div>
                <div class="modal-body body-xem-ls">
                    <table class="table ls-table  table-bordered">
                        <tr>
                            <th>Mã số</th>
                            <th>Ngạch</th>
                            <th>Bậc</th>
                            <th>Hệ số</th>
                            <th>Ghi chú</th>
                            <th>Ngày cập nhật</th>
                        </tr>
                        <tbody class="chen-ls">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {

            $('#table_id').DataTable();
            $('.btn-them').click(function () {
                $('.modal-them').modal("show");
            });

            $(document).on('click', '.btn-xem-ls', function (){
                var data = $(this).attr("data");
                var dataten = $(this).attr("dataten");
                $.ajax({
                    url: "{{action('App\Http\Controllers\NgachLuongController@getLog')}}",
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'mangachluong': data,
                    },
                    success: function (result) {
                        $('.tieu-de-ls').text('Lịch sử thay đổi dữ liệu ngạch lương ' + dataten );
                        $('.chen-ls').empty();
                        if(result.length > 0) {
                            result.forEach(function (item){
                                $('.chen-ls').append("<tr>" +
                                    "<td>"+item.maso+"</td>" +
                                    "<td>"+item.ngach+"</td>" +
                                    "<td>"+item.bacluong+"</td>" +
                                    "<td>"+item.heso+"</td>" +
                                    "<td>"+item.ghichu+"</td>" +
                                    "<td>"+toDDMMYYYY_HHMMSS(item.ngaycapnhat)+"</td>" +
                                    "</tr>");
                            })
                        }
                        else {
                            $('.body-xem-ls').empty();
                            $('.body-xem-ls').append("<p>Chưa ghi nhận lịch sử thay đổi dữ liệu</p>");
                        }
                    }
                });
                $('.modal-xem-ls').modal('show');
            });

            $(document).on('click', '.btn-sua', function (){
                var data = $(this).attr("data");
                data=JSON.parse(data);
                $('.sua-maso').val(data.maso);
                $('.sua-ngach').val(data.ngach);
                $('.sua-bacluong').val(data.bacluong);
                $('.sua-heso').val(data.heso);
                $('.sua-ghichu').val(data.ghichu);
                $('.btn-sua-thong-tin').data('ma',data.mangachluong);
                $('.modal-sua').modal("show");
            });

            $(document).on('click', '.btn-xoa', function (){
                var data = $(this).attr("data");
                $('.btn-xoa-thong-tin').data('ma',data);
                $('.modal-xoa').modal("show");
            });


            $('.btn-them-thong-tin').click(function () {
                $.ajax({
                    url: "{{action('App\Http\Controllers\NgachLuongController@putDuLieu')}}",
                    type: "PUT",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'maso': $('.them-maso').val(),
                        'ngach': $('.them-ngach').val(),
                        'bacluong': $('.them-bacluong').val(),
                        'heso': $('.them-heso').val(),
                        'ghichu': $('.them-ghichu').val()
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
                    url: "{{action('App\Http\Controllers\NgachLuongController@postDuLieu')}}",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'mangachluong': $('.btn-sua-thong-tin').data('ma'),
                        'maso': $('.sua-maso').val(),
                        'ngach': $('.sua-ngach').val(),
                        'bacluong': $('.sua-bacluong').val(),
                        'heso': $('.sua-heso').val(),
                        'ghichu': $('.sua-ghichu').val()
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
                    url: "{{action('App\Http\Controllers\NgachLuongController@deleteDuLieu')}}",
                    type: "DELETE",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'mangachluong': $('.btn-xoa-thong-tin').data('ma')
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
