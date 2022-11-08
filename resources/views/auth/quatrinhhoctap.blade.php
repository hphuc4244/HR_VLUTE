@extends('auth.master')
@section('title') Quản lý nhân sự @endsection
@section('content')
    <div class="container-fluid no-padding">
        <section class="content-header">
            <h1 class="tieu-de">
                QUÁ TRÌNH HỌC TẬP - {{mb_strtoupper($qtht->hoten, "UTF-8")}}
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Quản lý nhân sự</a></li>
                <li class="active">Quá trình học vấn</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-xs-12" style="margin-bottom: 10px;">
                    <button class="btn btn-success btn-them">Thêm thông tin học vấn</button>
                </div>
            </div>
            <div class="row">
                @if(empty($ttbc))
                    <div class="col-xs-12" >
                        <h4 style="font-style: italic; font-weight: bold;">Chưa ghi nhận dữ liệu quá trình học tập</h4>
                    </div>
                @endif
                <div class="col-md-12">
                    <ul class="timeline">
                        @foreach($ttbc as $item)
                            <li class="time-label"><span class="bg-yellow">{{date("d/m/Y", strtotime($item->ngaycapbang))}}</span></li>
                            <li>
                                <i class="fa fa-info bg-blue"></i>
                                <div class="timeline-item">
                                    <span class="time" style="font-size: 16px;"><i class="fa fa-clock-o"></i> Thời gian cập nhật: {{date("d/m/Y - H:i:s", strtotime($item->ngaytao))}}</span>
                                    <h3 class="timeline-header" style="color: #367FA9; font-size: 22px;"><b>{{$item->tenloaibangcap}}</b></h3>
                                    <div class="timeline-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p>Đơn vị đào tạo: <b>{{ $item->donvidaotao  }}</b></p>
                                            </div>
                                            <div class="col-md-6">
                                                <p class="chuyennganhdaotao">Chuyên ngành, nội dung đào tạo: <b>{{$item->chuyennganhdaotao}}</b>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p  class="ngaybatdauhoc">Ngày bắt đầu học:
                                                    <b>{{\App\Models\ToolsModel::convertDMY($item->ngaybatdauhoc)}}</b></p>
                                            </div>
                                            <div class="col-md-6">
                                                <p class="ngaycapbang">Ngày cấp bằng: <b>{{ \App\Models\ToolsModel::convertDMY($item->ngaycapbang)}}</b></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p class="noicapbang">Nơi cấp bằng: <b>{{$item->noicapbang}}</b></p>
                                            </div>
                                            <div class="col-md-6">
                                                <p class="sovaoso">Số vào sổ: <b>{{$item->sovaoso}}</b></p>
                                            </div>
                                        </div>
                                        <p class="thoigiandaotao">Thời gian đào tạo: <b>{{$item->thoigian}}</b></p>
                                        <div class="form-group">
                                            <p>File đơn xin đi học (nếu có):</p>
                                            @php
                                                $arr = json_decode($item->donxindihoc);
                                            @endphp
                                            @if(!empty($arr))
                                                <ul>
                                                    @foreach($arr as $link)
                                                        <li><b><a target="_blank" href="{{$link}}">{{$link}}</a></b>
                                                            <br/></li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <p>File scan:</p>
                                            <ul>
                                                @php
                                                    $arr = json_decode($item->hinhanh)
                                                @endphp
                                                @foreach($arr as $link)
                                                    <li><b><a target="_blank" href="{{$link}}">{{$link}}</a></b>
                                                        <br/></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <p>Ghi chú: <b>{{$item->ghichu}}</b></p>
                                        @if(count($ttbc) > 1)
                                            <a class="btn btn-primary btn-sua" data="{{json_encode($item)}}">Cập nhật thông tin</a>
                                            <a class="btn btn-danger btn-xoa" data="{{$item->maquatrinhhoctap}}">Xóa thông tin</a>
                                        @endif
                                    </div>

                                </div>
                            </li>
                        @endforeach
                    </ul>
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
                    <h4 class="modal-title tieu-de">Thêm mới</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Tên nhân viên</label>
                        <input class="form-control" value="{{$qtht->hoten}}" disabled></input>
                        <span class="them-manhanvien" hidden>{{$qtht->manhanvien}}</span>
                    </div>
                    <div class="form-group">
                        <label class="required">Loại bằng cấp, chứng nhận, chứng chỉ</label>
                        <select class="form-control them-loaibangcap">
                            @foreach($bc as $item)
                                <option value="{{  $item->maloaibangcap }}">{{  $item->tenloaibangcap }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Đơn vị đào tạo</label>
                                <input type="text" class="form-control them-donvidaotao"
                                       placeholder="Nhập đơn vị đào tạo" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nội dung đào tạo</label>
                                <input type="text" class="form-control them-chuyennganhdaotao"
                                       placeholder="Nhập chuyên ngành, nội dung đào tạo" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Ngày bắt đầu học</label>
                                <input type="text" class="form-control pull-right them-ngaybatdauhoc"
                                       id="picker-ngaybatdau" placeholder="Chọn ngày bắt đầu học" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">File scan đơn xin đi học (nếu có)</label>
                        <div id="them-donxindihoc"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Số vào sổ</label>
                                <input type="text" class="form-control them-sovaoso" placeholder="Nhập số vào sổ"
                                       required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Ngày cấp bằng</label>
                                <input type="text" class="form-control pull-right them-ngaycapbang"
                                       id="picker-ngaycap" placeholder="Chọn ngày cấp" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nơi cấp bằng</label>
                                <input type="text" class="form-control them-noicapbang" placeholder="Nhập nơi cấp bằng">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile" class="required">File scan bằng cấp</label>
                        <div id="them-filescan"></div>
                    </div>
                    <div class="form-group">
                        <label>Ghi chú</label>
                        <input type="text" class="form-control them-ghichu" placeholder="Nhập ghi chú bằng cấp">
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
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title tieu-de">Cập nhật thông tin</h4>
                </div>
                <div class="modal-body">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Tên nhân viên</label>
                            <input class="form-control" value="{{$qtht->hoten}}" disabled></input>
                            <span class="sua-manhanvien" hidden>{{$qtht->manhanvien}}</span>
                        </div>
                        <div class="form-group">
                            <label class="required">Loại bằng cấp, chứng nhận, chứng chỉ</label>
                            <select class="form-control sua-loaibangcap">
                                @foreach($bc as $item)
                                    <option value="{{  $item->maloaibangcap }}">{{  $item->tenloaibangcap }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Đơn vị đào tạo</label>
                                    <input type="text" class="form-control sua-donvidaotao"
                                           placeholder="Nhập đơn vị đào tạo" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nội dung đào tạo</label>
                                    <input type="text" class="form-control sua-chuyennganhdaotao"
                                           placeholder="Nhập chuyên ngành, nội dung đào tạo" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Ngày bắt đầu học</label>
                                    <input type="text" class="form-control pull-right sua-ngaybatdauhoc"
                                           id="picker-ngaybatdau" placeholder="Chọn ngày bắt đầu học" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">File scan đơn xin đi học (nếu có)</label>
                            <div id="sua-donxindihoc"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Số vào sổ</label>
                                    <input type="text" class="form-control sua-sovaoso" placeholder="Nhập số vào sổ"
                                           required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Ngày cấp bằng</label>
                                    <input type="text" class="form-control pull-right sua-ngaycapbang"
                                           id="picker-ngaycap" placeholder="Chọn ngày cấp" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nơi cấp bằng</label>
                                    <input type="text" class="form-control sua-noicapbang" placeholder="Nhập nơi cấp bằng">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile" class="required">File scan bằng cấp</label>
                            <div id="sua-filescan"></div>
                        </div>
                        <div class="form-group">
                            <label>Ghi chú</label>
                            <input type="text" class="form-control sua-ghichu" placeholder="Nhập ghi chú bằng cấp">
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
            event_upload_error: function (res) {
                toastr.error(res, "Thao tác thất bại");
            },
            event_upload_success: function (res) {
                toastr.success("Tải lên tệp tin thành công", "Thành công");
            }
        });

        $filesdonxin = $('#them-donxindihoc').ptUploads({
            event_upload_error: function (res) {
                toastr.error(res, "Thao tác thất bại");
            },
            event_upload_success: function (res) {
                toastr.success("Tải lên tệp tin thành công", "Thành công");
            }
        });

        $suafilescan = $('#sua-filescan').ptUploads({
            event_upload_error: function (res) {
                toastr.error(res, "Thao tác thất bại");
            },
            event_upload_success: function (res) {
                toastr.success("Tải lên tệp tin thành công", "Thành công");
            }
        });

        $suafilesdonxin = $('#sua-donxindihoc').ptUploads({
            event_upload_error: function (res) {
                toastr.error(res, "Thao tác thất bại");
            },
            event_upload_success: function (res) {
                toastr.success("Tải lên tệp tin thành công", "Thành công");
            }
        });

        $(document).ready(function () {

            $('#table_id').DataTable();
            //Date picker
            $('#picker-ngaycap, #picker-ngaybatdau').datepicker({
                format: 'dd/mm/yyyy'
            });

            $('.btn-them').click(function () {
                $('.modal-them').modal("show");
            });

            $(document).on('click', '.btn-sua', function (){
                var data = $(this).attr("data");
                data=JSON.parse(data);
                $('.sua-loaibangcap').val(data.maloaibangcap).trigger('change');
                $('.sua-donvidaotao').val(data.donvidaotao);
                $('.sua-chuyennganhdaotao').val(data.chuyennganhdaotao);
                $('.sua-ngaybatdauhoc').val(data.ngaybatdauhoc);
                $('.sua-sovaoso').val(data.sovaoso);
                $('.sua-ngaycapbang').val(data.ngaycapbang);
                $('.sua-noicapbang').val(data.noicapbang);
                $('.sua-ghichu').val(data.ghichu);
                $('.btn-sua-thong-tin').data('ma',data.maquatrinhhoctap);
                $('.modal-sua').modal("show");
            });

            $(document).on('click', '.btn-xoa', function () {
                var data = $(this).attr("data");
                $('.btn-xoa-thong-tin').data('ma', data);
                $('.modal-xoa').modal("show");
            });

            $('.btn-them-thong-tin').click(function () {
                if ($themfilescan.isFile() === false) {
                    toastr.error("Vui lòng đính kèm tệp tin trước khi thực hiện thao tác", "Thất bại");
                    return;
                }
                $.ajax({
                    url: "{{action('App\Http\Controllers\QuaTrinhHocTapController@putBangCapNhanVien')}}",
                    type: "PUT",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'maloaibangcap': $('.them-loaibangcap').val(),
                        'manhanvien': $('.them-manhanvien').text(),
                        'donvidaotao': $('.them-donvidaotao').val(),
                        'chuyennganhdaotao': $('.them-chuyennganhdaotao').val(),
                        'donxindihoc': $filesdonxin.getURL(),
                        'ngaybatdauhoc': toYYYYMMDD($('.them-ngaybatdauhoc').val()),
                        'noicapbang': $('.them-noicapbang').val(),
                        'ngaycapbang': toYYYYMMDD($('.them-ngaycapbang').val()),
                        'sovaoso': $('.them-sovaoso').val(),
                        'hinhanh': $themfilescan.getURL(),
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

            $('.btn-xoa-thong-tin').click(function () {
                $.ajax({
                    url: "{{action('App\Http\Controllers\QuaTrinhHocTapController@deleteBangCapNhanVien')}}",
                    type: "DELETE",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'maquatrinhhoctap': $('.btn-xoa-thong-tin').data('ma')
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
                    url: "{{action('App\Http\Controllers\QuaTrinhHocTapController@updateBangCapNhanVien')}}",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'maquatrinhhoctap': $('.btn-sua-thong-tin').data('ma'),
                        'maloaibangcap': $('.sua-loaibangcap').val(),
                        'manhanvien': $('.sua-manhanvien').text(),
                        'donvidaotao': $('.sua-donvidaotao').val(),
                        'chuyennganhdaotao': $('.sua-chuyennganhdaotao').val(),
                        'donxindihoc': $suafilesdonxin.getURL(),
                        'ngaybatdauhoc': toYYYYMMDD($('.sua-ngaybatdauhoc').val()),
                        'noicapbang': $('.sua-noicapbang').val(),
                        'ngaycapbang': toYYYYMMDD($('.sua-ngaycapbang').val()),
                        'sovaoso': $('.sua-sovaoso').val(),
                        'hinhanh': $suafilescan.getURL(),
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


        });
    </script>
@endsection
