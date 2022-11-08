@extends('auth.master')
@section('title') Quản lý nhân sự @endsection
@section('content')
    <div class="container-fluid no-padding">
        <section class="content-header">
            <h1 class="tieu-de">
                ĐƠN VỊ LÀM VIỆC
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Thông tin khác</a></li>
                <li class="active">Đơn vị làm việc</li>
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
                            <h3 class="box-title" style="font-weight: bold; ">Danh sách đơn vị</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table class="table table-bordered" id="table_id" >
                                <thead>
                                <tr>
                                    <th>Tên đơn vị</th>
                                    <th>Tên tiếng anh</th>
                                    <th>Vị trí đơn vị</th>
                                    <th style="width: 120px">Trạng thái đơn vị</th>
                                    <th style="width: 190px">Thao tác</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($ds as $item)
                                    <tr>
                                        <td>{{  $item->tendonvi }}</td>
                                        <td>{{  $item->tentienganh }}</td>
                                        <td>{{  $item->vitridonvi }}</td>
                                        <td class="{{$item->trangthaidonvi == 'Đang hoạt động' ? 'text-green' : 'text-red'}}" style="font-weight: bold">{{$item->trangthaidonvi}}</td>
                                        <td>
                                            <a class="btn btn-warning btn-chi-tiet" href="{{action('App\Http\Controllers\DonViController@getThongTinDonVi', $item->madonvi)}}">Xem chi tiết</a>
                                            <button class="btn btn-primary btn-sua" data="{{json_encode($item)}}">Sửa</button>
                                            <button class="btn btn-danger btn-xoa" data="{{$item->madonvi}}">Xóa</button>
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
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title tieu-de">THÊM MỚI</h4>
                </div>
                <div class="modal-body">
                    <div>
                        <h4 class="text-yellow text-bold">Thông tin cơ bản</h4>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tên đơn vị</label>
                                <input type="text" class="form-control them-tendonvi" placeholder="Nhập tên đơn vị">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tên tiếng anh</label>
                                <input type="text" class="form-control them-tentienganh" placeholder="Nhập tên tiếng anh đơn vị">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Vị trí</label>
                                <input type="text" class="form-control them-vitridonvi" placeholder="Nhập vị trí đơn vị">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" >
                                <label>Trạng thái đơn vị</label>
                                <select class="form-control them-trangthaidonvi" style="font-weight: bold">
                                    <option class="text-green" style="font-weight: bold" value="Đang hoạt động">Đang hoạt động</option>
                                    <option class="text-red" style="font-weight: bold" value="Không hoạt động">Không hoạt động</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h4 class="text-red text-bold">Thông tin chi tiết đơn vị</h4>
                    </div>
                    <div class="form-group">
                        <label>Tên đơn vị trong quyết định</label>
                        <input type="text" class="form-control them-tentrongquyetdinh" placeholder="Nhập tên đơn vị trong quyết định">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Số quyết định</label>
                                <input type="text" class="form-control them-soquyetdinh" placeholder="Nhập số quyết định">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Ngày ký quyết định</label>
                                <input type="text" class="form-control pull-right them-ngayquyetdinh" id="datepicker1" placeholder="Chọn ngày quyết định">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Ghi chú</label>
                        <input type="text" class="form-control them-ghichu" placeholder="Nhập nội dung hoặc lý do cập nhật thông tin đơn vị" spellcheck="false"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile" class="required">File scan quyết định</label>
                        <div id="them-filescan"></div>
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
                        <label>Tên đơn vị</label>
                        <input type="text" class="form-control sua-tendonvi" placeholder="Nhập tên đơn vị">
                    </div>
                    <div class="form-group">
                        <label>Tên tiếng anh</label>
                        <input type="text" class="form-control sua-tentienganh" placeholder="Nhập tên tiếng anh đơn vị">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Vị trí</label>
                                <input type="text" class="form-control sua-vitridonvi" placeholder="Nhập vị trí đơn vị">
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Trạng thái đơn vị</label>
                                <select class="form-control sua-trangthaidonvi" style="font-weight: bold">
                                    <option class="text-green" style="font-weight: bold">Đang hoạt động</option>
                                    <option class="text-red" style="font-weight: bold">Không hoạt động</option>
                                </select>
                            </div>
                        </div>
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

@endsection

@section('script')
    <script>
        $themfilescan = $('#them-filescan').ptUploads({
            event_upload_error: function (res){
                toastr.error(res, "Thao tác thất bại");
            },
            event_upload_success: function (res){
                toastr.success("Tải lên tệp tin thành công", "Thành công");
            }
        });

        $(document).ready(function () {

            //Date picker
            $('#datepicker1').datepicker({
                format: 'dd/mm/yyyy',
                autoclose: true
            });

            $('#table_id').DataTable();

            $('.btn-them').click(function () {
                $('.modal-them').modal("show");
            });

            $('.btn-sua').click(function () {
                var data = $(this).attr("data");
                data=JSON.parse(data);
                $('.sua-tendonvi').val(data.tendonvi);
                $('.sua-tentienganh').val(data.tentienganh);
                $('.sua-vitridonvi').val(data.vitridonvi);
                $(".sua-trangthaidonvi option").each(function() { this.selected = (this.text === data.trangthaidonvi); });
                $('.btn-sua-thong-tin').data('ma',data.madonvi);
                $('.modal-sua').modal("show");
            });

            $('.btn-xoa').click(function () {
                var data = $(this).attr("data");
                $('.btn-xoa-thong-tin').data('ma',data);
                $('.modal-xoa').modal("show");
            });

            $('.btn-them-thong-tin').click(function () {
                $.ajax({
                    url: "{{action('App\Http\Controllers\DonViController@putDonVi')}}",
                    type: "PUT",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'them-tendonvi': $('.them-tendonvi').val(),
                        'them-tentienganh': $('.them-tentienganh').val(),
                        'them-vitridonvi': $('.them-vitridonvi').val(),
                        'them-trangthaidonvi': $('.them-trangthaidonvi option:selected' ).text(),
                        'them-tentrongquyetdinh': $('.them-tentrongquyetdinh').val(),
                        'them-ngayquyetdinh': $('.them-ngayquyetdinh').val(),
                        'them-soquyetdinh': $('.them-soquyetdinh').val(),
                        'them-hinhanh': $themfilescan.getURL(),
                        'them-ghichu': $('.them-ghichu').val()
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
                    url: "{{action('App\Http\Controllers\DonViController@postDonVi')}}",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'madonvi': $('.btn-sua-thong-tin').data('ma'),
                        'tendonvi': $('.sua-tendonvi').val(),
                        'tentienganh': $('.sua-tentienganh').val(),
                        'vitridonvi': $('.sua-vitridonvi').val(),
                        'trangthaidonvi': $('.sua-trangthaidonvi option:selected' ).text()
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
                    url: "{{action('App\Http\Controllers\DonViController@deleteDonVi')}}",
                    type: "DELETE",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'madonvi': $('.btn-xoa-thong-tin').data('ma')
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
