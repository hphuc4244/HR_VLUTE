@extends('auth.master')
@section('title') Quản lý nhân sự @endsection
@section('content')
    <div class="container-fluid no-padding">
        <section class="content-header">
            <h1 class="tieu-de">
                DANH SÁCH NHÂN SỰ
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Thông tin khác</a></li>
                <li class="active">Danh sách nhân sự</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-xs-12" style="margin-bottom: 10px;">
                    <button class="btn btn-success btn-them">Thêm mới</button>
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Xuất báo cáo tổng hợp
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" style="position: absolute;">
                            <li>
                                <a target="_blank" href="{{ action('App\Http\Controllers\ThongKeController@dsCanBoToanTruong') }}">Danh sách cán bộ CCVC&NLĐ toàn Trường</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xs-12">
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
                                            <td class="text-green" style="font-weight: bold">Đang làm việc</td>
                                        @elseif($item->trangthailamviec == "Nghỉ hưu")
                                            <td class="text-yellow" style="font-weight: bold">Nghỉ hưu</td>
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
                        <label class="required">Họ tên</label>
                        <input type="text" class="form-control them-hoten"
                               placeholder="Nhập họ tên" required>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Đơn vị làm việc</label>
                                <select class="form-control them-donvi">
                                    @foreach($dv as $item)
                                        <option value="{{  $item->madonvi }}">{{  $item->tendonvi }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Chức vụ</label>
                                <select class="form-control them-chucvu">
                                    @foreach($cv as $item)
                                        <option value="{{  $item->machucvu }}">{{  $item->tenchucvu }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Chức danh nghề nghiệp</label>
                                <select class="form-control them-chucdanh">
                                    <option value="Giảng viên hạng III">Giảng viên hạng III</option>
                                    <option value="Giảng viên hạng II">Giảng viên hạng II</option>
                                    <option value="Giảng viên hạng I">Giảng viên hạng I</option>
                                    <option value="Chuyên viên">Chuyên viên</option>
                                    <option value="Nhân viên">Nhân viên</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="required">Ngày sinh</label>
                                <input type="text" class="form-control pull-right them-ngaysinh"
                                       id="datepicker1" placeholder="Chọn ngày định dạng dd/mm/yyyy" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nơi sinh</label>
                                <select class="form-control them-noisinh">
                                    @foreach($tinh as $item)
                                        <option value="{{$item->name}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Quê quán</label>
                                <select class="form-control them-quequan">
                                    @foreach($tinh as $item)
                                        <option value="{{$item->name}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Giới tính</label>
                                <select class="form-control them-gioitinh">
                                    <option value="Nam">Nam</option>
                                    <option value="Nữ">Nữ</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Số điện thoại</label>
                                <input type="text" class="form-control them-sdt"
                                       placeholder="Nhập số điện thoại">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control them-email"
                                       placeholder="Nhập email">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Số CMND/CCCD</label>
                                <input type="number" class="form-control them-cmnd"
                                       placeholder="Nhập số CMND/CCCD">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Ngày cấp</label>
                                <input type="text" class="form-control pull-right them-ngaycapcmnd"
                                       id="picker-ngaycap" placeholder="Chọn ngày định dạng dd/mm/yyyy">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nơi cấp</label>
                                <input type="text" class="form-control them-noicapcmnd"
                                       placeholder="Nhập nơi cấp">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Ngày tuyển dụng</label>
                                <input type="text" class="form-control pull-right them-ngaytuyendung"
                                       id="picker-tuyendung" placeholder="Chọn ngày định dạng dd/mm/yyyy">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nghề nghiệp khi được tuyển dụng</label>
                                <input type="text" class="form-control them-nghenghieptuyendung"
                                       placeholder="Nhập nghề nghiệp khi được tuyển dụng">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Số bảo hiểm xã hội</label>
                                <input type="text" class="form-control them-bhxh"
                                       placeholder="Nhập số bảo hiểm xã hội">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Dân tộc</label>
                                <select class="form-control them-dantoc">
                                    @foreach($dt as $item)
                                        <option value="{{$item->noidung}}">{{$item->noidung}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Tôn giáo</label>
                                <input type="text" class="form-control them-tongiao"
                                       placeholder="Nhập tôn giáo">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Trình độ văn hóa</label>
                                <input type="text" class="form-control them-trinhdovanhoa"
                                       placeholder="Nhập trình độ văn hóa">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Trình độ chuyên môn</label>
                                <input type="text" class="form-control them-trinhdochuyenmon"
                                       placeholder="Nhập trình độ chuyên môn">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Học hàm</label>
                                <select class="form-control them-hocham">
                                    <option value="Không">Không</option>
                                    <option value="Phó giáo sư">Phó giáo sư</option>
                                    <option value="Giáo sư">Giáo sư</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Học vị</label>
                                <select class="form-control them-hocvi">
                                    <option value="Kỹ sư">Kỹ sư</option>
                                    <option value="Cử nhân">Cử nhân</option>
                                    <option value="Thạc sĩ">Thạc sĩ</option>
                                    <option value="Tiến sĩ">Tiến sĩ</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <fieldset class="diachi-border">
                        <legend class="diachi-border">Hộ khẩu thường trú</legend>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Số nhà</label>
                                    <input type="text" class="form-control them-hokhau-sonha"
                                           placeholder="Nhập hộ khẩu thường trú">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Đường</label>
                                    <input type="text" class="form-control them-hokhau-duong"
                                           placeholder="Nhập hộ khẩu thường trú">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Thôn/xóm/ấp</label>
                                    <input type="text" class="form-control them-hokhau-thonxom"
                                           placeholder="Nhập hộ khẩu thường trú">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Tỉnh/thành phố</label>
                                    <select class="form-control them-hokhau-tinh">
                                        <option value="none" selected>---Chọn tỉnh/thành phố---</option>
                                        @foreach($tinh as $item)
                                                <option value="{{$item->matp}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Huyện/quận/thị xã/thành phố</label>
                                    <select class="form-control them-hokhau-quanhuyen">
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Xã/phường/thị trấn</label>
                                    <select class="form-control them-hokhau-xaphuong">
                                    </select>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="diachi-border">
                        <legend class="diachi-border">Nơi ở hiện nay</legend>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Số nhà</label>
                                    <input type="text" class="form-control them-noio-sonha"
                                           placeholder="Nhập nơi ở hiện nay">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Đường</label>
                                    <input type="text" class="form-control them-noio-duong"
                                           placeholder="Nhập nơi ở hiện nay">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Thôn/xóm/ấp</label>
                                    <input type="text" class="form-control them-noio-thonxom"
                                           placeholder="Nhập nơi ở hiện nay">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Tỉnh/thành phố</label>
                                    <select class="form-control them-noio-tinh">
                                        <option value="none" selected>---Chọn tỉnh/thành phố---</option>
                                        @foreach($tinh as $item)
                                            <option value="{{$item->matp}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Huyện/quận/thị xã/thành phố</label>
                                    <select class="form-control them-noio-quanhuyen">
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Xã/phường/thị trấn</label>
                                    <select class="form-control them-noio-xaphuong">
                                    </select>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>CC/VC/HĐLĐ</label>
                                <select class="form-control them-loainhanvien">
                                    <option value="Hợp đồng lao động">Hợp đồng lao động</option>
                                    <option value="Viên chức">Viên chức</option>
                                    <option value="Công chức">Công chức</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Ngày hiệu lực</label>
                                <input type="text" class="form-control them-tgvaovienchuc"
                                       id="picker-tgvienchuc" placeholder="Nhập thời gian thi hành">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Trạng thái làm việc</label>
                                <select class="form-control them-trangthailamviec">
                                    <option value="Đang làm việc">Đang làm việc</option>
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

        $(document).ready(function () {
            $('#table_id').DataTable();
            //Date picker
            $('#datepicker, #datepicker1, #picker-ngaycap, #picker-tgvienchuc, #picker-tuyendung').datepicker({
                format: 'dd/mm/yyyy'
            });

            // var $tt_loai_nv = $('.them-loainhanvien');
            // $tt_loai_nv.change(function () {
            //     if ($tt_loai_nv.val() != 'Hợp đồng lao động') {
            //         $('.them-tgvaovienchuc').removeAttr('disabled');
            //     } else {
            //         $('.them-tgvaovienchuc').attr('disabled', 'disabled').val('');
            //     }
            // }).trigger('change');

            $('.btn-them').click(function () {
                $('.modal-them').modal("show");
            });

            $('.btn-them-thong-tin').click(function () {
                var hokhau = JSON.stringify({
                    'sonha' : $('.them-hokhau-sonha').val(),
                    'duong' : $('.them-hokhau-duong').val(),
                    'thonxom' : $('.them-hokhau-thonxom').val(),
                    'tinh' : $('.them-hokhau-tinh option:selected').text(),
                    'quanhuyen' : $('.them-hokhau-quanhuyen option:selected').text(),
                    'xaphuong' : $('.them-hokhau-xaphuong option:selected').text()
                });

                var noio = JSON.stringify({
                    'sonha' : $('.them-noio-sonha').val(),
                    'duong' : $('.them-noio-duong').val(),
                    'thonxom' : $('.them-noio-thonxom').val(),
                    'tinh' : $('.them-noio-tinh option:selected').text(),
                    'quanhuyen' : $('.them-noio-quanhuyen option:selected').text(),
                    'xaphuong' : $('.them-noio-xaphuong option:selected').text()
                });

                if ($themfilescan.isFile() === false) {
                    toastr.error("Vui lòng đính kèm tệp tin trước khi thực hiện thao tác", "Thất bại");
                    return;
                }

                $.ajax({
                    url: "{{action('App\Http\Controllers\NhanVienController@putDuLieu')}}",
                    type: "PUT",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'madonvi': $('.them-donvi').val(),
                        'machucvu': $('.them-chucvu').val(),
                        'chucdanh': $('.them-chucdanh').val(),
                        'hoten': $('.them-hoten').val(),
                        'ngaysinh': toYYYYMMDD($('.them-ngaysinh').val()),
                        'noisinh': $('.them-noisinh').val(),
                        'quequan': $('.them-quequan').val(),
                        'gioitinh': $('.them-gioitinh').val(),
                        'sodienthoai': $('.them-sdt').val(),
                        'email': $('.them-email').val(),
                        'cmnd': $('.them-cmnd').val(),
                        'ngaycapcmnd': toYYYYMMDD($('.them-ngaycapcmnd').val()),
                        'noicapcmnd': $('.them-noicapcmnd').val(),
                        'ngaytuyendung': toYYYYMMDD($('.them-ngaytuyendung').val()),
                        'nghenghieptuyendung': $('.them-nghenghieptuyendung').val(),
                        'bhxh': $('.them-bhxh').val(),
                        'dantoc': $('.them-dantoc').val(),
                        'tongiao': $('.them-tongiao').val(),
                        'trinhdovanhoa': $('.them-trinhdovanhoa').val(),
                        'trinhdochuyenmon': $('.them-trinhdochuyenmon').val(),
                        'hocham': $('.them-hocham').val(),
                        'hocvi': $('.them-hocvi').val(),
                        'hokhauthuongtru': hokhau,
                        'noiohiennay': noio,
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

            $('.them-hokhau-tinh').change(function () {
                if ($('.them-hokhau-tinh').val() == "none")
                {
                    $('.them-hokhau-quanhuyen').empty();
                    $('.them-hokhau-xaphuong').empty();
                }
                $.ajax({
                    url: "{{action('App\Http\Controllers\NhanVienController@getDanhSachQuanHuyen')}}",
                    type: "GET",
                    data: {
                        'matp': $('.them-hokhau-tinh').val()
                    },
                    success: function (result) {
                        $('.them-hokhau-quanhuyen').empty();
                        if(result.length > 0) {
                            result.forEach(function (item){
                                $('.them-hokhau-quanhuyen').append("<option value="+String(item.maqh)+">"+item.name+"</option>");
                            });
                            $('.them-hokhau-quanhuyen').trigger('change');
                        }
                        else {
                            $('.them-hokhau-quanhuyen').empty();
                        }
                    }
                });
            });


            $('.them-hokhau-quanhuyen').change(function () {
                $.ajax({
                    url: "{{action('App\Http\Controllers\NhanVienController@getDanhSachXaPhuong')}}",
                    type: "GET",
                    data: {
                        'maqh': $('.them-hokhau-quanhuyen').val()
                    },
                    success: function (result) {
                        $('.them-hokhau-xaphuong').empty();
                        if(result.length > 0) {
                            result.forEach(function (item){
                                $('.them-hokhau-xaphuong').append("<option value="+item.xaid+">"+item.name+"</option>");
                            });
                        }
                        else {
                            $('.them-hokhau-xaphuong').empty();
                        }
                    }
                });
            });

            $('.them-noio-tinh').change(function () {
                if ($('.them-noio-tinh').val() == "none")
                {
                    $('.them-noio-quanhuyen').empty();
                    $('.them-noio-xaphuong').empty();
                }
                $.ajax({
                    url: "{{action('App\Http\Controllers\NhanVienController@getDanhSachQuanHuyen')}}",
                    type: "GET",
                    data: {
                        'matp': $('.them-noio-tinh').val()
                    },
                    success: function (result) {
                        $('.them-noio-quanhuyen').empty();
                        if(result.length > 0) {
                            result.forEach(function (item){
                                $('.them-noio-quanhuyen').append("<option value="+String(item.maqh)+">"+item.name+"</option>");
                            });
                            $('.them-noio-quanhuyen').trigger('change');
                        }
                        else {
                            $('.them-noio-quanhuyen').empty();
                        }
                    }
                });
            });


            $('.them-noio-quanhuyen').change(function () {
                $.ajax({
                    url: "{{action('App\Http\Controllers\NhanVienController@getDanhSachXaPhuong')}}",
                    type: "GET",
                    data: {
                        'maqh': $('.them-noio-quanhuyen').val()
                    },
                    success: function (result) {
                        $('.them-noio-xaphuong').empty();
                        if(result.length > 0) {
                            result.forEach(function (item){
                                $('.them-noio-xaphuong').append("<option value="+item.xaid+">"+item.name+"</option>");
                            });
                        }
                        else {
                            $('.them-noio-xaphuong').empty();
                        }
                    }
                });
            });



        });
    </script>
@endsection
