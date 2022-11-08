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
                THÔNG TIN ĐƠN VỊ: {{mb_strtoupper($ct[0]->tendonvi, "UTF-8")}}
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Đơn vị làm việc</a></li>
                <li class="active">Lịch sử đơn vị làm việc</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <!-- Custom Tabs -->
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="false"><b class="tab-name">Danh sách nhân sự</b></a></li>
                            <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false"><b class="tab-name">Thông tin chi
                                        tiết đơn vị</b></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <!-- /.tab-pane -->
                            <div class="tab-pane active" id="tab_1">
                                <div class="row">
                                    <div class="col-xs-12" style="margin-bottom: 10px;">
                                        <a class="btn btn-success btn-excel"
                                           href="{{action('App\Http\Controllers\BMDonViController@getBMNhanSuTheoDV', $ct[0]->madonvi)}}">Xuất danh sách nhân sự thuộc đơn vị</a>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="box">
                                            <div class="box-header with-border">
                                                <h3 class="box-title" style="font-weight: bold; ">Danh sách nhân viên</h3>
                                            </div>
                                            <!-- /.box-header -->
                                            <div class="box-body">
                                                <table class="table table-bordered" id="table_id">
                                                    <thead>
                                                    <tr>
                                                        <th>Họ tên nhân viên</th>
                                                        <th>Đơn vị làm việc</th>
                                                        <th>Chức vụ</th>
                                                        <th>Ngày sinh</th>
                                                        <th>Giới tính</th>
                                                        <th style="width: 120px">Trạng thái làm việc</th>
                                                        <th style="width: 60px">Thao tác</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($nv as $item)
                                                        <tr>
                                                            <td>{{  $item->hoten }}</td>
                                                            <td>{{  $item->tendonvi }}</td>
                                                            <td>{{  $item->tenchucvu }}</td>
                                                            <td>{{ date("d/m/Y", strtotime($item->ngaysinh)) }}</td>
                                                            <td>{{  $item->gioitinh }}</td>
                                                            @if($item->trangthailamviec == "Đang làm việc")
                                                                <td class="text-green" style="font-weight: bold">Đang hoạt động</td>
                                                            @elseif($item->trangthailamviec == "Nghỉ hưu")
                                                                <td class="text-yellow" style="font-weight: bold">Đang hoạt động</td>
                                                            @else
                                                                <td class="text-red" style="font-weight: bold">Đã nghỉ việc</td>
                                                            @endif
                                                            <td>
                                                                <a class="btn btn-warning btn-chi-tiet"
                                                                   href="{{action('App\Http\Controllers\NhanVienController@getThongTinNhanVien', $item->manhanvien)}}">Xem
                                                                    chi tiết</a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_2">
                                <div class="row">
                                    <div class="col-xs-12" style="margin-bottom: 10px;">
                                        <button class="btn btn-success btn-them">Thêm lịch sử đơn vị</button>
                                    </div>
                                    <div class="col-xs-12">
                                        <section class="timeline_area section_padding_130">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <!-- Timeline Area-->
                                                        <div class="apland-timeline-area">
                                                            <!-- Single Timeline Content-->
                                                            @foreach($ct as $item)
                                                                <div class="single-timeline-area">
                                                                    <div class="timeline-date wow fadeInLeft"
                                                                         data-wow-delay="0.1s"
                                                                         style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInLeft;">
                                                                        <p>
                                                                            <b>{{ date("d/m/Y", strtotime($item->ngayquyetdinh))}}</b>
                                                                        </p>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div
                                                                                class="single-timeline-content d-flex wow fadeInLeft"
                                                                                data-wow-delay="0.3s"
                                                                                style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInLeft;">
                                                                                <div class="timeline-text">
                                                                                    <h3 style="margin-top: 0">
                                                                                        <b>{{$item->tentrongquyetdinh}}</b>
                                                                                    </h3>
                                                                                    <p>Số quyết định:
                                                                                        <b>{{$item->soquyetdinh}}</b>
                                                                                    </p>
                                                                                    <p>Ngày cập nhật:
                                                                                        <b>{{date("d/m/Y - H:i:s", strtotime($item->ngaytao))}}</b>
                                                                                    </p>
                                                                                    <p>Ghi chú: <b>{{$item->ghichu}}</b>
                                                                                    </p>
                                                                                    <div class="form-group">
                                                                                        <p>File scan quyết định:</p>
                                                                                        <ul>
                                                                                            @php
                                                                                                if(\App\Models\ToolsModel::isJson($item->hinhanh))
                                                                                                    $arr = json_decode($item->hinhanh);
                                                                                                else
                                                                                                    $arr = [];
                                                                                            @endphp
                                                                                            @foreach($arr as $link)
                                                                                                <li>
                                                                                                    <b><a target="_blank"
                                                                                                          href="{{$link}}">{{$link}}</a></b>
                                                                                                    <br/></li>
                                                                                            @endforeach
                                                                                        </ul>
                                                                                    </div>
                                                                                    @if(count($ct) > 1)
                                                                                        <div style="margin-top: 10px;">
                                                                                            <button
                                                                                                class="btn btn-danger btn-xoa"
                                                                                                data="{{$item->mathongtindonvi}}">
                                                                                                Xóa thông tin
                                                                                            </button>
                                                                                        </div>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
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
                        <label>Tên đơn vị hiện tại</label>
                        <p class="form-control them-madonvi" value="{{strtoupper($ct[0]->madonvi)}}"
                           disabled>{{strtoupper($ct[0]->tendonvi)}}</p>
                    </div>
                    <div class="form-group">
                        <label>Tên đơn vị trong quyết định</label>
                        <input type="text" class="form-control them-tentrongquyetdinh"
                               placeholder="Nhập tên đơn vị trong quyết định">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Số quyết định</label>
                                <input type="text" class="form-control them-soquyetdinh"
                                       placeholder="Nhập số quyết định">
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Ngày ký quyết định</label>
                                <input type="text" class="form-control pull-right them-ngayquyetdinh" id="datepicker1"
                                       placeholder="Chọn ngày quyết định">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Ghi chú</label>
                        <textarea class="form-control them-ghichu" rows="3"
                                  placeholder="Nhập nội dung hoặc lý do cập nhật thông tin đơn vị"
                                  spellcheck="false"></textarea>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label for="exampleInputFile" class="required">File scan quyết định</label>
                            <div id="them-filescan"></div>
                        </div>
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
            list_file: [],
            max_size_kb: 20 * 1024,
            event_upload_error: function (res) {
                toastr.error(res, "Thao tác thất bại");
            },
            event_upload_success: function (res) {
                toastr.success("Tải lên tệp tin thành công", "Thành công");
            }
        });

        $(document).ready(function () {
            //Date picker
            $('#datepicker1').datepicker({
                format: 'dd/mm/yyyy',
                autoclose: true
            })

            $('#table_id').DataTable();

            $('.btn-them').click(function () {
                $('.modal-them').modal("show");
            });

            $('.btn-xoa').click(function () {
                var data = $(this).attr("data");
                $('.btn-xoa-thong-tin').data('mathongtindonvi', data);
                $('.modal-xoa').modal("show");
            });

            $('.btn-them-thong-tin').click(function () {

                if ($themfilescan.isFile() === false) {
                    toastr.error("Vui lòng đính kèm tệp tin trước khi thực hiện thao tác", "Thất bại");
                    return;
                }

                $.ajax({
                    url: "{{action('App\Http\Controllers\DonViController@putThongTinDonVi')}}",
                    type: "PUT",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'madonvi': $('.them-madonvi').attr('value'),
                        'tentrongquyetdinh': $('.them-tentrongquyetdinh').val(),
                        'soquyetdinh': $('.them-soquyetdinh').val(),
                        'ngayquyetdinh': $('.them-ngayquyetdinh').val(),
                        'ghichu': $('.them-ghichu').val(),
                        'hinhanh': $themfilescan.getURL()
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
                    url: "{{action('App\Http\Controllers\DonViController@deleteThongTinDonVi')}}",
                    type: "DELETE",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'mathongtindonvi': $('.btn-xoa-thong-tin').data('mathongtindonvi')
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
