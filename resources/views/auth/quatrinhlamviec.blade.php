@extends('auth.master')
@section('title') Quản lý nhân sự @endsection
@section('content')
    <div class="container-fluid no-padding">
        <section class="content-header">
            <h1 class="tieu-de">
                QUÁ TRÌNH LÀM VIỆC - {{mb_strtoupper($ds[0]->hoten, "UTF-8")}}
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Quản lý nhân sự</a></li>
                <li class="active">Lịch sử làm việc</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-xs-12" style="margin-bottom: 10px;">
                    <button class="btn btn-success btn-them">Thêm mới</button>
                </div>
                <div class="col-xs-12">
                    <p><i>Lưu ý: Khi thêm thông tin công tác của nhân viên chỉ được chọn duy nhất 01 đơn vị với trạng thái là đang làm việc</i></p>
                </div>
                    @foreach($ds as $item)
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <p class="box-title text-yellow">Cập nhật
                                    lúc: {{date("d/m/Y - H:i:s", strtotime($item->ngaytao))}}</p>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <p><b>Tên đơn vị: </b><span class="tt">{{$item->tendonvi}}</span></p>
                                <p><b>Chức vụ: </b><span class="tt">{{$item->tenchucvu}}</span></p>
                                <div class="row">
                                    <div class="col-md-4">
                                        <p><b>Số quyết định: </b><span class="tt">{{$item->soquyetdinh}}</span></p>
                                    </div>
                                    <div class="col-md-4">
                                        <p><b>Ngày quyết định: </b><span
                                                class="tt">{{date("d/m/Y", strtotime($item->ngayquyetdinh))}}</span></p>
                                    </div>
                                    <div class="col-md-4">
                                        <p><b>Cơ quan ban hành: </b><span class="tt">{{$item->coquanbanhanh}}</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <p><b>Loại nhân viên: </b><span class="tt">{{$item->loainhanvien}}</span></p>
                                    </div>
                                    <div class="col-md-4">
                                        <p><b>Ngày hiệu lực: </b><span
                                                class="tt">{{date("d/m/Y", strtotime($item->tgvaovienchuc))}}</span></p>
                                    </div>
                                    <div class="col-md-4">
                                        @if($item->trangthailamviec == "Đang làm việc")
                                            <p><b>Trạng thái làm việc: <span
                                                    class="text-green">{{$item->trangthailamviec}}</span></b></p>
                                        @elseif($item->trangthailamviec == "Nghỉ hưu")
                                            <p><b>Trạng thái làm việc: <span
                                                    class="text-yellow">{{$item->trangthailamviec}}</span></b></p>
                                        @elseif($item->trangthailamviec == "Đã chuyển công tác")
                                            <p><b>Trạng thái làm việc: <span
                                                    class="text-aqua">{{$item->trangthailamviec}}</span></b></p>
                                        @else
                                            <p><b>Trạng thái làm việc: <span
                                                    class="text-red">{{$item->trangthailamviec}}</span></b></p>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <p><b>File scan quyết định:</b></p>
                                    @php
                                        $arr = json_decode($item->hinhanh);
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
                                    <p><b>Ghi chú: </b><span class="tt">{{$item->ghichu}}</span></p>
                                </div>
                                @if(count($ds) > 1)
                                    <a class="btn btn-danger btn-xoa" data="{{$item->maquatrinhlamviec}}">Xóa thông tin</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
@endsection

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
                    <input class="form-control" value="{{$ds[0]->hoten}}" disabled />
                    <span class="them-manhanvien" hidden>{{$ds[0]->manhanvien}}</span>
                </div>
                <div class="form-group">
                    <label class="required">Đơn vị làm việc</label>
                    <select class="form-control them-donvi">
                        @foreach($dv as $item)
                            <option value="{{ $item->madonvi }}">{{ $item->tendonvi }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="required">Chức vụ</label>
                    <select class="form-control them-chucvu">
                        @foreach($cv as $item)
                            <option value="{{ $item->machucvu }}">{{ $item->tenchucvu }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="required">CC/VC/HĐLĐ</label>
                            <select class="form-control them-loainhanvien">
                                <option value="Hợp đồng lao động">Hợp đồng lao động</option>
                                <option value="Viên chức">Viên chức</option>
                                <option value="Công chức">Công chức</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="required">Ngày hiệu lực</label>
                            <input type="text" class="form-control them-tgvaovienchuc"
                                   id="picker-tgvienchuc" placeholder="Nhập thời gian thi hành" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="required">Trạng thái làm việc</label>
                            <select class="form-control them-trangthailamviec">
                                <option value="Đang làm việc">Đang làm việc</option>
                                <option value="Đã chuyển công tác">Đã chuyển công tác</option>
                                <option value="Nghỉ hưu">Nghỉ hưu</option>
                                <option value="Đã nghỉ việc">Đã nghỉ việc</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="required">Số quyết định/HĐLĐ</label>
                            <input type="text" class="form-control them-soquyetdinh"
                                   placeholder="Nhập số QĐ hoặc HĐLĐ" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="required">Ngày quyết định</label>
                            <input type="text" class="form-control pull-right them-ngayquyetdinh"
                                   id="datepicker" placeholder="Chọn ngày định dạng dd/mm/yyyy" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="required">Cơ quan ban hành</label>
                            <input type="text" class="form-control them-coquanbanhanh"
                                   placeholder="Nhập cơ quan ban hành" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputFile" class="required">File scan quyết định</label>
                    <div id="them-filescan"></div>
                </div>
                <div class="form-group">
                    <label>Ghi chú</label>
                    <input type="text" class="form-control them-ghichu" placeholder="Nhập ghi chú">
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

        $(document).ready(function () {

            $('.btn-them').click(function () {
                $('.modal-them').modal("show");
            });

            $('#datepicker, #picker-tgvienchuc').datepicker({
                format: 'dd/mm/yyyy'
            });

            $('.btn-them-thong-tin').click(function () {

                if ($themfilescan.isFile() === false) {
                    toastr.error("Vui lòng đính kèm tệp tin trước khi thực hiện thao tác", "Thất bại");
                    return;
                }

                $.ajax({
                    url: "{{action('App\Http\Controllers\QuaTrinhLamViecController@putQuaTrinhLamViec')}}",
                    type: "PUT",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'manhanvien': $('.them-manhanvien').text(),
                        'madonvi': $('.them-donvi').val(),
                        'machucvu': $('.them-chucvu').val(),
                        'loainhanvien': $('.them-loainhanvien').val(),
                        'ngayquyetdinh': toYYYYMMDD($('.them-ngayquyetdinh').val()),
                        'soquyetdinh': ($('.them-soquyetdinh').val()),
                        'tgvaovienchuc': toYYYYMMDD($('.them-tgvaovienchuc').val()),
                        'trangthailamviec': $('.them-trangthailamviec').val(),
                        'coquanbanhanh': $('.them-coquanbanhanh').val(),
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

            $(document).on('click', '.btn-xoa', function () {
                var data = $(this).attr("data");
                $('.btn-xoa-thong-tin').data('ma', data);
                $('.modal-xoa').modal("show");
            });

            $('.btn-xoa-thong-tin').click(function () {
                $.ajax({
                    url: "{{action('App\Http\Controllers\QuaTrinhLamViecController@deleteQuaTrinhLamViec')}}",
                    type: "DELETE",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'maquatrinhlamviec': $('.btn-xoa-thong-tin').data('ma')
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
