@extends('auth.master')
@section('title') Quản lý nhân sự @endsection
@section('style')
    .tab-name{
    font-size: 18px;
    }
    .nav-tabs-custom>.nav-tabs>li.active>a{
    color: #f0932b;
    }
@endsection
@section('content')
    <div class="container-fluid no-padding">
        <section class="content-header">
            <h1 class="tieu-de">
                DIỄN BIẾN LƯƠNG VÀ PHỤ CẤP - {{mb_strtoupper($tt->hoten, "UTF-8")}}
            </h1>
            <span class="manhanvien" hidden>{{$tt->manhanvien}}</span>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Quản lý nhân sự</a></li>
                <li class="active">Lương, phụ cấp nhân viên</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <!-- Custom Tabs -->
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="false"><b
                                        class="tab-name">Thông tin lương nhân viên</b></a></li>
                            <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false"><b class="tab-name">Thông
                                        tin phụ cấp nhân viên</b></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <!-- /.tab-pane -->
                            <div class="tab-pane active" id="tab_1">
                                <div class="row">
                                    <div class="col-xs-12" style="margin-bottom: 10px;">
                                        <button class="btn btn-success btn-themluong">Thêm lương nhân viên</button>
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <table class="table table-bordered" id="table_luong">
                                            <thead>
                                            <tr>
                                                <th>Ngạch lương</th>
                                                <th>Bậc lương</th>
                                                <th>Hệ số</th>
                                                <th>Ngày hưởng</th>
                                                <th>Quyết định</th>
                                                <th>Vượt khung</th>
                                                <th>Ghi chú</th>
                                                <th>Ngày cập nhật</th>
                                                <th style="width: 80px">Thao tác</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($luong as $item)
                                                <tr>
                                                    <td>{{$item->maso}}</td>
                                                    <td>{{$item->bacluong}}</td>
                                                    <td>{{$item->heso}}</td>
                                                    <td>{{ date("d/m/Y", strtotime($item->ngayhuong))}}</td>
                                                    <td>
                                                        <ul>
                                                            <li><b>Số quyết định: </b>{{$item->soquyetdinh}}</li>
                                                            <li><b>Cơ quan ban hành: </b>{{$item->coquanbanhanh}}</li>
                                                            <li><b>File scan: </b>
                                                                @php
                                                                    $arr = json_decode($item->hinhanh);
                                                                @endphp
                                                                @if(!empty($arr))
                                                                    <ul>
                                                                        @foreach($arr as $link)
                                                                            <li><b><a target="_blank"
                                                                                      href="{{$link}}">{{$link}}</a></b>
                                                                                <br/></li>
                                                                        @endforeach
                                                                    </ul>
                                                                @endif
                                                            </li>
                                                        </ul>
                                                    </td>
                                                    <td>{{$item->vuotkhung}}</td>
                                                    <td>{{$item->ghichu}}</td>
                                                    <td>{{  date("d/m/Y - H:i:s", strtotime($item->ngaytao)) }}</td>
                                                    <td>
                                                        <button class="btn btn-danger btn-xoa-luong"
                                                                data="{{$item->maluong}}">Xóa
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_2">
                                <div class="row">
                                    <div class="col-xs-12" style="margin-bottom: 10px;">
                                        <button class="btn btn-success btn-them-phu-cap">Thêm phụ cấp nhân viên</button>
                                    </div>
                                    <div class="box-body">
                                        <table class="table table-bordered" id="table_phucap">
                                            <thead>
                                            <tr>
                                                <th>Loại phụ cấp</th>
                                                <th>Hệ số phụ cấp</th>
                                                <th>Ngày hưởng</th>
                                                <th>Quyết định</th>
                                                <th>Ghi chú</th>
                                                <th>Ngày cập nhật</th>
                                                <th style="width: 60px">Thao tác</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($phucap as $item)
                                                <tr>
                                                    <td>{{$item->tenphucap}}</td>
                                                    <td>{{$item->hesophucap}}</td>
                                                    <td>{{ date("d/m/Y", strtotime($item->ngayhuongphucap))}}</td>
                                                    <td>
                                                        <ul>
                                                            <li><b>Số quyết định: </b>{{$item->soquyetdinh}}</li>
                                                            <li><b>Cơ quan ban hành: </b>{{$item->coquanbanhanh}}</li>
                                                            <li><b>File scan: </b>
                                                                @php
                                                                    $arr = json_decode($item->hinhanh);
                                                                @endphp
                                                                @if(!empty($arr))
                                                                    <ul>
                                                                        @foreach($arr as $link)
                                                                            <li><b><a target="_blank"
                                                                                      href="{{$link}}">{{$link}}</a></b>
                                                                                <br/></li>
                                                                        @endforeach
                                                                    </ul>
                                                                @endif
                                                            </li>
                                                        </ul>
                                                    </td>
                                                    <td>{{$item->ghichu}}</td>
                                                    <td>{{  date("d/m/Y - H:i:s", strtotime($item->ngaytao)) }}</td>
                                                    <td>
                                                        <button class="btn btn-danger btn-xoa-phu-cap"
                                                                data="{{$item->maphucapnhanvien}}">Xóa
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <!-- nav-tabs-custom -->
                </div>
            </div>
        </section>
    </div>

    <div class="modal fade in modal-them-luong" id="modal-default">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title tieu-de">Thêm mới</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="required">Ngạch lương</label>
                        <select class="form-control them-ngachluong">
                            @foreach($ngachluong as $item)
                                <option value="{{  $item->mangachluong }}">Ngạch: {{  $item->maso }} ---- Bậc lương: {{  $item->bacluong }} ---- Hệ số: {{ $item->heso }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Ngày hưởng</label>
                                <input type="text" class="form-control pull-right them-ngayhuong-luong"
                                       id="picker-ngayhuongluong" placeholder="Chọn ngày hưởng" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Số quyết định</label>
                                <input type="text" class="form-control them-soquyetdinh-luong"
                                       placeholder="Nhập số quyết định" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Cơ quan ban hành</label>
                                <input type="text" class="form-control them-coquanbanhanh-luong"
                                       placeholder="Nhập cơ quan ban hành" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Vượt khung</label>
                                <input type="number" class="form-control them-vuotkhung-luong" placeholder="Nhập số vượt khung (nếu có)"
                                       required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">File scan quyết định</label>
                        <div id="them-fileluong"></div>
                    </div>
                    <div class="form-group">
                        <label>Ghi chú</label>
                        <input type="text" class="form-control them-ghichu-luong" placeholder="Nhập ghi chú">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success btn-them-thong-tin-luong">Lưu thông tin</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade in modal-xoa-luong" id="modal-default">
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
                    <button type="button" class="btn btn-danger btn-xoa-thong-tin-luong">Xóa thông tin</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade in modal-them-phu-cap" id="modal-default">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title tieu-de">Thêm mới</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="required">Loại phụ cấp</label>
                        <select class="form-control them-loaiphucap">
                            @foreach($loaiphucap as $item)
                                <option value="{{  $item->maphucap }}">Tên loại: {{  $item->tenphucap }} ---- Hệ số: {{ $item->hesophucap }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Ngày hưởng</label>
                                <input type="text" class="form-control pull-right them-ngayhuong-phucap"
                                       id="picker-ngayhuongphucap" placeholder="Chọn ngày hưởng" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Số quyết định</label>
                                <input type="text" class="form-control them-soquyetdinh-phucap"
                                       placeholder="Nhập số quyết định" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Cơ quan ban hành</label>
                                <input type="text" class="form-control them-coquanbanhanh-phucap"
                                       placeholder="Nhập cơ quan ban hành" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">File scan quyết định</label>
                        <div id="them-filephucap"></div>
                    </div>
                    <div class="form-group">
                        <label>Ghi chú</label>
                        <input type="text" class="form-control them-ghichu-phucap" placeholder="Nhập ghi chú">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success btn-them-thong-tin-phu-cap">Lưu thông tin</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade in modal-xoa-phu-cap" id="modal-default">
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
                    <button type="button" class="btn btn-danger btn-xoa-thong-tin-phu-cap">Xóa thông tin</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@endsection

@section('script')
    <script>

        $themfileluong = $('#them-fileluong').ptUploads({
            event_upload_error: function (res) {
                toastr.error(res, "Thao tác thất bại");
            },
            event_upload_success: function (res) {
                toastr.success("Tải lên tệp tin thành công", "Thành công");
            }
        });

        $themfilephucap = $('#them-filephucap').ptUploads({
            event_upload_error: function (res) {
                toastr.error(res, "Thao tác thất bại");
            },
            event_upload_success: function (res) {
                toastr.success("Tải lên tệp tin thành công", "Thành công");
            }
        });

        $(document).ready(function () {


            //Date picker
            $('#picker-ngayhuongluong, #picker-ngayhuongphucap').datepicker({
                format: 'dd/mm/yyyy'
            });

            $('.btn-themluong').click(function () {
                $('.modal-them-luong').modal("show");
            });

            $('.btn-them-phu-cap').click(function () {
                $('.modal-them-phu-cap').modal("show");
            });

            $(document).on('click', '.btn-xoa-luong', function () {
                var data = $(this).attr("data");
                $('.btn-xoa-thong-tin-luong').data('ma', data);
                $('.modal-xoa-luong').modal("show");
            });

            $(document).on('click', '.btn-xoa-phu-cap', function () {
                var data = $(this).attr("data");
                $('.btn-xoa-thong-tin-phu-cap').data('ma', data);
                $('.modal-xoa-phu-cap').modal("show");
            });

            $('.btn-them-thong-tin-luong').click(function () {
                if ($themfileluong.isFile() === false) {
                    toastr.error("Vui lòng đính kèm tệp tin trước khi thực hiện thao tác", "Thất bại");
                    return;
                }
                $.ajax({
                    url: "{{action('App\Http\Controllers\LuongPhuCapController@putLuong')}}",
                    type: "PUT",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'manhanvien': $('.manhanvien').text(),
                        'mangachluong': $('.them-ngachluong').val(),
                        'ngayhuong': toYYYYMMDD($('.them-ngayhuong-luong').val()),
                        'soquyetdinh': $('.them-soquyetdinh-luong').val(),
                        'coquanbanhanh': $('.them-coquanbanhanh-luong').val(),
                        'vuotkhung': $('.them-vuotkhung-luong').val(),
                        'hinhanh': $themfileluong.getURL(),
                        'ghichu': $('.them-ghichu-luong').val()
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

            $('.btn-xoa-thong-tin-luong').click(function () {
                $.ajax({
                    url: "{{action('App\Http\Controllers\LuongPhuCapController@deleteLuong')}}",
                    type: "DELETE",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'maluong': $('.btn-xoa-thong-tin-luong').data('ma')
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

            $('.btn-them-thong-tin-phu-cap').click(function () {
                if ($themfilephucap.isFile() === false) {
                    toastr.error("Vui lòng đính kèm tệp tin trước khi thực hiện thao tác", "Thất bại");
                    return;
                }
                $.ajax({
                    url: "{{action('App\Http\Controllers\LuongPhuCapController@putPhuCap')}}",
                    type: "PUT",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'manhanvien': $('.manhanvien').text(),
                        'maphucap': $('.them-loaiphucap').val(),
                        'ngayhuongphucap': toYYYYMMDD($('.them-ngayhuong-phucap').val()),
                        'soquyetdinh': $('.them-soquyetdinh-phucap').val(),
                        'coquanbanhanh': $('.them-coquanbanhanh-phucap').val(),
                        'hinhanh': $themfilephucap.getURL(),
                        'ghichu': $('.them-ghichu-phucap').val()
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

            $('.btn-xoa-thong-tin-phu-cap').click(function () {
                $.ajax({
                    url: "{{action('App\Http\Controllers\LuongPhuCapController@deletePhuCap')}}",
                    type: "DELETE",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'maphucapnhanvien': $('.btn-xoa-thong-tin-phu-cap').data('ma')
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
