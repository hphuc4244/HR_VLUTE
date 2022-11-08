@extends('auth.master')
@section('title') Quản lý nhân sự @endsection
@section('content')
    <div class="container-fluid no-padding">
        <section class="content-header">
            <h1 class="tieu-de">
                LOẠI BẰNG CẤP, CHỨNG CHỈ, CHỨNG NHẬN
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Thông tin khác</a></li>
                <li class="active">Loại bằng cấp, chứng chỉ, chứng nhận</li>
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
                            <h3 class="box-title" style="font-weight: bold; ">Danh sách loại bằng cấp, chứng chỉ, chứng nhận</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table class="table table-bordered" id="table_id">
                                <thead>
                                <tr>
                                    <th>Tên loại bằng cấp, chứng chỉ, chứng nhận</th>
                                    <th>Ghi chú</th>
                                    <th>Ngày cập nhật</th>
                                    <th style="width: 190px">Thao tác</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($ds as $item)
                                <tr>
                                    <td>{{  $item->tenloaibangcap }}</td>
                                    <td>{{  $item->ghichu }}</td>
                                    <td>{{  date("d/m/Y - H:i:s", strtotime($item->ngaycapnhat)) }}</td>
                                    <td>
                                        <button class="btn btn-warning btn-xem-ls" data="{{$item->maloaibangcap}}" dataten="{{$item->tenloaibangcap}}" >Xem lịch sử</button>
                                        <button class="btn btn-primary btn-sua" data="{{json_encode($item)}}">Sửa</button>
                                        <button class="btn btn-danger btn-xoa" data="{{$item->maloaibangcap}}">Xóa</button>
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
                        <label>Tên loại bằng cấp</label>
                        <input type="text" class="form-control them-tenloaibangcap" placeholder="Nhập tên loại bằng cấp">
                    </div>
                    <div class="form-group">
                        <label>Ghi chú loại bằng cấp</label>
                        <input type="text" class="form-control them-ghichuloaibangcap" placeholder="Nhập ghi chú loại bằng cấp">
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
                        <label>Tên loại bằng cấp</label>
                        <input type="text" class="form-control sua-tenloaibangcap" placeholder="Nhập tên loại bằng cấp">
                    </div>
                    <div class="form-group">
                        <label>Ghi chú loại bằng cấp</label>
                        <input type="text" class="form-control sua-ghichuloaibangcap" placeholder="Nhập ghi chú loại bằng cấp">
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
                            <th>Tên loại bằng cấp</th>
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
                    url: "{{action('App\Http\Controllers\LoaiBangCapController@getLog')}}",
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'maloaibangcap': data,
                    },
                    success: function (result) {
                        $('.tieu-de-ls').text('Lịch sử thay đổi dữ liệu loại bằng cấp ' + dataten );
                        $('.chen-ls').empty();
                        if(result.length > 0) {
                            result.forEach(function (item){
                                $('.chen-ls').append("<tr>" +
                                    "<td>"+item.tenloaibangcap+"</td>" +
                                    "<td>"+item.ghichu+"</td>" +
                                    "<td>"+ toDDMMYYYY_HHMMSS(item.ngaycapnhat)+"</td>" +
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
                $('.sua-tenloaibangcap').val(data.tenloaibangcap);
                $('.sua-ghichuloaibangcap').val(data.ghichu);
                $('.btn-sua-thong-tin').data('ma',data.maloaibangcap);
                $('.modal-sua').modal("show");
            });

            $(document).on('click', '.btn-xoa', function (){
                var data = $(this).attr("data");
                $('.btn-xoa-thong-tin').data('ma',data);
                $('.modal-xoa').modal("show");
            });


            $('.btn-them-thong-tin').click(function () {
                $.ajax({
                    url: "{{action('App\Http\Controllers\LoaiBangCapController@putDuLieu')}}",
                    type: "PUT",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'tenloaibangcap': $('.them-tenloaibangcap').val(),
                        'ghichu': $('.them-ghichuloaibangcap').val()
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
                    url: "{{action('App\Http\Controllers\LoaiBangCapController@postDuLieu')}}",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'maloaibangcap': $('.btn-sua-thong-tin').data('ma'),
                        'tenloaibangcap': $('.sua-tenloaibangcap').val(),
                        'ghichu': $('.sua-ghichuloaibangcap').val()
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
                    url: "{{action('App\Http\Controllers\LoaiBangCapController@deleteDuLieu')}}",
                    type: "DELETE",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'maloaibangcap': $('.btn-xoa-thong-tin').data('ma')
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
