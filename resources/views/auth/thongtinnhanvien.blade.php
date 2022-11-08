@extends('auth.master')
@section('title') Quản lý nhân sự @endsection
@section('style')
    .tt{
        color: #367FA9;
        font-weight: bold;
    }
@endsection
@section('content')
    <div class="container-fluid no-padding">
        <section class="content-header">
            <h1 class="tieu-de">
                THÔNG TIN NHÂN VIÊN - {{mb_strtoupper($tt->hoten, "UTF-8")}}
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Quản lý nhân sự</a></li>
                <li class="active">Thông tin cá nhân</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-xs-12" style="margin-bottom: 10px;">
                    <a class="btn btn-bitbucket" href="{{action('App\Http\Controllers\QuaTrinhHocTapController@hoSoQuaTrinhHocTap', $tt->manhanvien)}}">Quá trình học tập</a>
                    <a class="btn btn-success" href="{{action('App\Http\Controllers\QuaTrinhLamViecController@getQuaTrinhLamViec', $tt->manhanvien)}}">Quá trình làm việc</a>
                    <a class="btn btn-primary" href="{{action('App\Http\Controllers\LuongPhuCapController@getDanhSach', $tt->manhanvien)}}">Diễn biến lương, phụ cấp</a>
                    <a class="btn btn-warning" href="{{action('App\Http\Controllers\NhanVienController@getLog', $tt->manhanvien)}}">Lịch sử chỉnh sửa thông tin</a>
                </div>
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title" style="font-weight: bold; ">Thông tin vị trí việc làm hiện tại</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <p><b>Đơn vị làm việc: </b><span class="tt">{{$tt->tendonvi}}</span></p>
                                </div>
                                <div class="col-md-4">
                                    <p><b>Chức vụ - Vị trí việc làm: </b><span class="tt">{{$tt->tenchucvu}}</span></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <p><b>Loại nhân viên: </b><span class="tt">{{$tt->loainhanvien}}</span></p>
                                </div>
                                @if($tt->loainhanvien != "Hợp đồng lao động")
                                    <div class="col-md-4">
                                        <p><b>Ngày vào viên chức/công chức: </b><span
                                                class="tt">{{date("d/m/Y", strtotime($tt->tgvaovienchuc))}}</span></p>
                                    </div>
                                @endif
                                <div class="col-md-4">
                                    <p><b>Trạng thái làm việc: </b><span class="tt">{{$tt->trangthailamviec}}</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title" style="font-weight: bold; ">Thông tin cá nhân</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <p><b>Họ tên: </b><span class="tt">{{$tt->hoten}}</span></p>
                            <p><b>Chức danh nghề nghiệp: </b><span class="tt">{{$tt->chucdanh}}</span></p>
                            <div class="row">
                                <div class="col-md-4">
                                    <p><b>Ngày sinh: </b><span class="tt">{{date("d/m/Y", strtotime($tt->ngaysinh))}}</span></p>
                                </div>
                                <div class="col-md-4">
                                    <p><b>Nơi sinh: </b><span class="tt">{{$tt->noisinh}}</span></p>
                                </div>
                                <div class="col-md-4">
                                    <p><b>Quê quán: </b><span class="tt">{{$tt->quequan}}</span></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <p><b>Giới tính: </b><span class="tt">{{$tt->gioitinh}}</span></p>
                                </div>
                                <div class="col-md-4">
                                    <p><b>Số điện thoại: </b><span class="tt">{{$tt->sodienthoai}}</span></p>
                                </div>
                                <div class="col-md-4">
                                    <p><b>Email: </b><span class="tt">{{$tt->email}}</span></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <p><b>Số CMND/CCCD: </b><span class="tt">{{$tt->cmnd}}</span></p>
                                </div>
                                <div class="col-md-4">
                                    <p><b>Ngày cấp: </b><span class="tt">{{date("d/m/Y", strtotime($tt->ngaycapcmnd))}}</span></p>
                                </div>
                                <div class="col-md-4">
                                    <p><b>Nơi cấp: </b><span class="tt">{{$tt->noicapcmnd}}</span></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <p><b>Ngày tuyển dụng: </b><span class="tt">{{date("d/m/Y", strtotime($tt->ngaytuyendung))}}</span></p>
                                </div>
                                <div class="col-md-4">
                                    <p><b>Nghề nghiệp khi được tuyển dụng: </b><span class="tt">{{$tt->nghenghieptuyendung}}</span></p>
                                </div>
                                <div class="col-md-4">
                                    <p><b>Số bảo hiểm xã hội: </b><span class="tt">{{$tt->bhxh}}</span></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <p><b>Dân tộc: </b><span class="tt">{{$tt->dantoc}}</span></p>
                                </div>
                                <div class="col-md-4">
                                    <p><b>Tôn giáo: </b><span class="tt">{{$tt->tongiao}}</span></p>
                                </div>
                                <div class="col-md-4">
                                    <p><b>Trình độ văn hóa: </b><span class="tt">{{$tt->trinhdovanhoa}}</span></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <p><b>Trình độ chuyên môn: </b><span class="tt">{{$tt->trinhdochuyenmon}}</span></p>
                                </div>
                                <div class="col-md-4">
                                    <p><b>Học hàm: </b><span class="tt">{{$tt->hocham}}</span></p>
                                </div>
                                <div class="col-md-4">
                                    <p><b>Học vị: </b><span class="tt">{{$tt->hocvi}}</span></p>
                                </div>
                            </div>
                            <p><b>Hộ khẩu thường trú: </b>
                                <span class="tt">
                                    @php
                                        $hokhau = json_decode($tt->hokhauthuongtru)
                                    @endphp
                                    {{ strlen(trim($hokhau->sonha)) == 0 ? '' : $hokhau->sonha . ', ' }}
                                    {{ strlen(trim($hokhau->duong)) == 0 ? '' : $hokhau->duong . ', ' }}
                                    {{ strlen(trim($hokhau->thonxom)) == 0 ? '' : $hokhau->thonxom . ', ' }}
                                    {{ strlen(trim($hokhau->xaphuong)) == 0 ? '' : $hokhau->xaphuong . ', ' }}
                                    {{ strlen(trim($hokhau->quanhuyen)) == 0 ? '' : $hokhau->quanhuyen . ', ' }}
                                    {{ strlen(trim($hokhau->tinh)) == 0 ? '' : $hokhau->tinh }}
                                </span>
                            </p>
                            <p><b>Nơi ở hiện nay: </b>
                                <span class="tt">
                                    @php
                                        $noio = json_decode($tt->noiohiennay)
                                    @endphp
                                        {{ strlen(trim($noio->sonha)) == 0 ? '' : $noio->sonha . ', ' }}
                                        {{ strlen(trim($noio->duong)) == 0 ? '' : $noio->duong . ', ' }}
                                        {{ strlen(trim($noio->thonxom)) == 0 ? '' : $noio->thonxom . ', ' }}
                                        {{ strlen(trim($noio->xaphuong)) == 0 ? '' : $noio->xaphuong . ', ' }}
                                        {{ strlen(trim($noio->quanhuyen)) == 0 ? '' : $noio->quanhuyen . ', ' }}
                                        {{ strlen(trim($noio->tinh)) == 0 ? '' : $noio->tinh }}
                                </span>
                            </p>
                            <div class="form-group">
                                <p><b>Ghi chú: </b><span class="tt">{{$tt->ghichu}}</span></p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary btn-sua" data="{{json_encode($tt)}}">Cập nhật
                                thông tin
                            </button>
                            <button type="button" class="btn btn-danger btn-xoa" style="margin-bottom: 5px;"
                                    data="{{$tt->manhanvien}}">Xóa nhân viên
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
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
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="required">Họ tên nhân viên</label>
                                <input type="text" class="form-control sua-hoten"
                                       placeholder="Nhập họ tên nhân viên" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="required">Chức danh nghề nghiệp</label>
                                <select class="form-control sua-chucdanh">
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
                                <label>Ngày sinh</label>
                                <input type="text" class="form-control pull-right sua-ngaysinh"
                                       id="datepicker" placeholder="Chọn ngày định dạng dd/mm/yyyy" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nơi sinh</label>
                                <select class="form-control sua-noisinh">
                                    @foreach($tinh as $item)
                                        <option value="{{$item->name}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Quê quán</label>
                                <select class="form-control sua-quequan">
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
                                <select class="form-control sua-gioitinh">
                                    <option value="Nam">Nam</option>
                                    <option value="Nữ">Nữ</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Số điện thoại</label>
                                <input type="number" class="form-control sua-sodienthoai"
                                       placeholder="Nhập số điện thoại">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control sua-email"
                                       placeholder="Nhập email">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Số CMND/CCCD</label>
                                <input type="number" class="form-control sua-cmnd"
                                       placeholder="Nhập số CMND/CCCD">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Ngày cấp</label>
                                <input type="text" class="form-control pull-right sua-ngaycapcmnd"
                                       id="picker-ngaycap" placeholder="Chọn ngày cấp">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nơi cấp</label>
                                <input type="text" class="form-control sua-noicapcmnd"
                                       placeholder="Nhập nơi cấp">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Ngày tuyển dụng</label>
                                <input type="text" class="form-control pull-right sua-ngaytuyendung"
                                       id="picker-ngaytuyendung" placeholder="Chọn ngày tuyển dụng">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nghề nghiệp khi được tuyển dụng</label>
                                <input type="text" class="form-control sua-nghenghieptuyendung"
                                       placeholder="Nhập nghề nghiệp tuyển dụng">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Bảo hiểm xã hổi</label>
                                <input type="text" class="form-control sua-bhxh"
                                       placeholder="Nhập số bảo hiểm xã hội">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Dân tộc</label>
                                <select class="form-control sua-dantoc">
                                    @foreach($dt as $item)
                                        <option value="{{$item->noidung}}">{{$item->noidung}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Tôn giáo</label>
                                <input type="text" class="form-control sua-tongiao"
                                       placeholder="Nhập tôn giáo">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Trình độ văn hóa</label>
                                <input type="text" class="form-control sua-trinhdovanhoa"
                                       placeholder="Nhập trình độ văn hóa">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Trình độ chuyên môn</label>
                                <input type="text" class="form-control sua-trinhdochuyenmon"
                                       placeholder="Nhập trình độ chuyên môn">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Học hàm</label>
                                <select class="form-control sua-hocham">
                                    <option value="Không">Không</option>
                                    <option value="Phó giáo sư">Phó giáo sư</option>
                                    <option value="Giáo sư">Giáo sư</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Học vị</label>
                                <select class="form-control sua-hocvi">
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
                                    <input type="text" class="form-control sua-hokhau-sonha"
                                           placeholder="Nhập hộ khẩu thường trú">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Đường</label>
                                    <input type="text" class="form-control sua-hokhau-duong"
                                           placeholder="Nhập hộ khẩu thường trú">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Thôn/xóm/ấp</label>
                                    <input type="text" class="form-control sua-hokhau-thonxom"
                                           placeholder="Nhập hộ khẩu thường trú">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Tỉnh/thành phố</label>
                                    <select class="form-control sua-hokhau-tinh">
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
                                    <select class="form-control sua-hokhau-quanhuyen">
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Xã/phường/thị trấn</label>
                                    <select class="form-control sua-hokhau-xaphuong">
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
                                    <input type="text" class="form-control sua-noio-sonha"
                                           placeholder="Nhập nơi ở hiện nay">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Đường</label>
                                    <input type="text" class="form-control sua-noio-duong"
                                           placeholder="Nhập nơi ở hiện nay">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Thôn/xóm/ấp</label>
                                    <input type="text" class="form-control sua-noio-thonxom"
                                           placeholder="Nhập nơi ở hiện nay">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Tỉnh/thành phố</label>
                                    <select class="form-control sua-noio-tinh">
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
                                    <select class="form-control sua-noio-quanhuyen">
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Xã/phường/thị trấn</label>
                                    <select class="form-control sua-noio-xaphuong">
                                    </select>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <div class="form-group">
                        <label>Ghi chú</label>
                        <input type="text" class="form-control sua-ghichu" placeholder="Nhập ghi chú cập nhật"
                               required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-sua-thong-tin">Lưu thông tin</button>
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
        $(document).ready(function () {

            $('#datepicker, #picker-ngaycap, #picker-ngaytuyendung').datepicker({
                format: 'dd/mm/yyyy'
            });

            var data = $('.btn-sua').attr("data");
            data = JSON.parse(data);

            $('.btn-sua').click(function () {
                $('.sua-hoten').val(data.hoten);
                $(".sua-chucdanh option:contains("+data.chucdanh+")").prop('selected', true).trigger('change');
                $('.sua-ngaysinh').val(toDDMMYYYY(data.ngaysinh));
                $(".sua-noisinh option:contains("+data.noisinh+")").prop('selected', true).trigger('change');
                $(".sua-quequan option:contains("+data.quequan+")").prop('selected', true).trigger('change');
                $(".sua-gioitinh option:contains("+data.gioitinh+")").prop('selected', true).trigger('change');
                $('.sua-sodienthoai').val(data.sodienthoai);
                $('.sua-email').val(data.email);
                $('.sua-cmnd').val(data.cmnd);
                $('.sua-ngaycapcmnd').val(toDDMMYYYY(data.ngaycapcmnd));
                $('.sua-noicapcmnd').val(data.noicapcmnd);
                $('.sua-ngaytuyendung').val(toDDMMYYYY(data.ngaytuyendung));
                $('.sua-nghenghieptuyendung').val(data.nghenghieptuyendung);
                $('.sua-bhxh').val(data.bhxh);
                $(".sua-dantoc option:contains("+data.dantoc+")").prop('selected', true).trigger('change');
                $('.sua-tongiao').val(data.tongiao);
                $('.sua-trinhdovanhoa').val(data.trinhdovanhoa);
                $('.sua-trinhdochuyenmon').val(data.trinhdochuyenmon);
                $(".sua-hocham option:contains("+data.hocham+")").prop('selected', true).trigger('change');
                $(".sua-hocvi option:contains("+data.hocvi+")").prop('selected', true).trigger('change');
                var hokhau = JSON.parse(data.hokhauthuongtru);
                $('.sua-hokhau-sonha').val(hokhau.sonha);
                $('.sua-hokhau-duong').val(hokhau.duong);
                $('.sua-hokhau-thonxom').val(hokhau.thonxom);
                $(".sua-hokhau-tinh option:contains("+hokhau.tinh+")").prop('selected', true).trigger('change');
                var noio = JSON.parse(data.noiohiennay);
                $('.sua-noio-sonha').val(noio.sonha);
                $('.sua-noio-duong').val(noio.duong);
                $('.sua-noio-thonxom').val(noio.thonxom);
                $(".sua-noio-tinh option:contains("+noio.tinh+")").prop('selected', true).trigger('change');
                $('.sua-ghichu').val(data.ghichu);
                $('.btn-sua-thong-tin').data('ma', data.manhanvien);
                $('.modal-sua').modal("show");
            });

            $('.btn-xoa').click(function () {
                var data = $(this).attr("data");
                $('.btn-xoa-thong-tin').data('ma', data);
                $('.modal-xoa').modal("show");
            });

            $('.btn-sua-thong-tin').click(function () {

                var hokhau = JSON.stringify({
                    'sonha' : $('.sua-hokhau-sonha').val(),
                    'duong' : $('.sua-hokhau-duong').val(),
                    'thonxom' : $('.sua-hokhau-thonxom').val(),
                    'tinh' : $('.sua-hokhau-tinh option:selected').text(),
                    'quanhuyen' : $('.sua-hokhau-quanhuyen option:selected').text(),
                    'xaphuong' : $('.sua-hokhau-xaphuong option:selected').text()
                });

                var noio = JSON.stringify({
                    'sonha' : $('.sua-noio-sonha').val(),
                    'duong' : $('.sua-noio-duong').val(),
                    'thonxom' : $('.sua-noio-thonxom').val(),
                    'tinh' : $('.sua-noio-tinh option:selected').text(),
                    'quanhuyen' : $('.sua-noio-quanhuyen option:selected').text(),
                    'xaphuong' : $('.sua-noio-xaphuong option:selected').text()
                });

                $.ajax({
                    url: "{{action('App\Http\Controllers\NhanVienController@postDuLieu')}}",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'manhanvien': $('.btn-sua-thong-tin').data('ma'),
                        'chucdanh': $('.sua-chucdanh').val(),
                        'hoten': $('.sua-hoten').val(),
                        'ngaysinh': toYYYYMMDD($('.sua-ngaysinh').val()),
                        'noisinh': $('.sua-noisinh').val(),
                        'quequan': $('.sua-quequan').val(),
                        'gioitinh': $('.sua-gioitinh').val(),
                        'sodienthoai': $('.sua-sodienthoai').val(),
                        'email': $('.sua-email').val(),
                        'cmnd': $('.sua-cmnd').val(),
                        'ngaycapcmnd': toYYYYMMDD($('.sua-ngaycapcmnd').val()),
                        'noicapcmnd': $('.sua-noicapcmnd').val(),
                        'ngaytuyendung': toYYYYMMDD($('.sua-ngaytuyendung').val()),
                        'nghenghieptuyendung': $('.sua-nghenghieptuyendung').val(),
                        'bhxh': $('.sua-bhxh').val(),
                        'dantoc': $('.sua-dantoc').val(),
                        'tongiao': $('.sua-tongiao').val(),
                        'trinhdovanhoa': $('.sua-trinhdovanhoa').val(),
                        'trinhdochuyenmon': $('.sua-trinhdochuyenmon').val(),
                        'hocham': $('.sua-hocham').val(),
                        'hocvi': $('.sua-hocvi').val(),
                        'hokhauthuongtru': hokhau,
                        'noiohiennay': noio,
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
                    url: "{{action('App\Http\Controllers\NhanVienController@deleteDuLieu')}}",
                    type: "DELETE",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'manhanvien': $('.btn-xoa-thong-tin').data('ma')
                    },
                    success: function (result) {
                        if (result === "1") {
                            toastr.success("Kết quả", "Thao tác thành công");
                            window.location.replace("{{action('App\Http\Controllers\NhanVienController@getDanhSach')}}");
                            setTimeout(function () {
                                window.location.reload();
                            }, 500);
                        } else {
                            toastr.error("Kết quả", "Thao tác thất bại");
                        }
                    }
                });
            });

            $('.sua-hokhau-tinh').change(function () {
                if ($('.sua-hokhau-tinh').val() == "none")
                {
                    $('.sua-hokhau-quanhuyen').empty();
                    $('.sua-hokhau-xaphuong').empty();
                }
                $.ajax({
                    url: "{{action('App\Http\Controllers\NhanVienController@getDanhSachQuanHuyen')}}",
                    type: "GET",
                    data: {
                        'matp': $('.sua-hokhau-tinh').val()
                    },
                    success: function (result) {
                        $('.sua-hokhau-quanhuyen').empty();
                        if(result.length > 0) {
                            result.forEach(function (item){
                                $('.sua-hokhau-quanhuyen').append("<option value="+String(item.maqh)+">"+item.name+"</option>");
                            });
                            var hokhau = JSON.parse(data.hokhauthuongtru);
                            $(".sua-hokhau-quanhuyen option:contains("+hokhau.quanhuyen+")").prop('selected', true).trigger('change');
                        }
                        else {
                            $('.sua-hokhau-quanhuyen').empty();
                        }
                    }
                });
            });


            $('.sua-hokhau-quanhuyen').change(function () {
                $.ajax({
                    url: "{{action('App\Http\Controllers\NhanVienController@getDanhSachXaPhuong')}}",
                    type: "GET",
                    data: {
                        'maqh': $('.sua-hokhau-quanhuyen').val()
                    },
                    success: function (result) {
                        $('.sua-hokhau-xaphuong').empty();
                        if(result.length > 0) {
                            result.forEach(function (item){
                                $('.sua-hokhau-xaphuong').append("<option value="+item.xaid+">"+item.name+"</option>");
                            });
                            var hokhau = JSON.parse(data.hokhauthuongtru);
                            $(".sua-hokhau-xaphuong option:contains("+hokhau.xaphuong+")").prop('selected', true).trigger('change');
                        }
                        else {
                            $('.sua-hokhau-xaphuong').empty();
                        }
                    }
                });
            });

            $('.sua-noio-tinh').change(function () {
                if ($('.sua-noio-tinh').val() == "none")
                {
                    $('.sua-noio-quanhuyen').empty();
                    $('.sua-noio-xaphuong').empty();
                }
                $.ajax({
                    url: "{{action('App\Http\Controllers\NhanVienController@getDanhSachQuanHuyen')}}",
                    type: "GET",
                    data: {
                        'matp': $('.sua-noio-tinh').val()
                    },
                    success: function (result) {
                        $('.sua-noio-quanhuyen').empty();
                        if(result.length > 0) {
                            result.forEach(function (item){
                                $('.sua-noio-quanhuyen').append("<option value="+String(item.maqh)+">"+item.name+"</option>");
                            });
                            var noio = JSON.parse(data.noiohiennay);
                            $(".sua-noio-quanhuyen option:contains("+noio.quanhuyen+")").prop('selected', true).trigger('change');
                        }
                        else {
                            $('.sua-noio-quanhuyen').empty();
                        }
                    }
                });
            });


            $('.sua-noio-quanhuyen').change(function () {
                $.ajax({
                    url: "{{action('App\Http\Controllers\NhanVienController@getDanhSachXaPhuong')}}",
                    type: "GET",
                    data: {
                        'maqh': $('.sua-noio-quanhuyen').val()
                    },
                    success: function (result) {
                        $('.sua-noio-xaphuong').empty();
                        if(result.length > 0) {
                            result.forEach(function (item){
                                $('.sua-noio-xaphuong').append("<option value="+item.xaid+">"+item.name+"</option>");
                            });
                            var noio = JSON.parse(data.noiohiennay);
                            $(".sua-noio-xaphuong option:contains("+noio.xaphuong+")").prop('selected', true).trigger('change');
                        }
                        else {
                            $('.sua-noio-xaphuong').empty();
                        }
                    }
                });
            });

        });
    </script>
@endsection
