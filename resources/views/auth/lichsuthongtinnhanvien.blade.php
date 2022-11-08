@extends('auth.master')
@section('title') Quản lý nhân sự @endsection
@section('content')
    <div class="container-fluid no-padding">
        <section class="content-header">
            <h1 class="tieu-de">
                LỊCH SỬ THÔNG TIN NHÂN VIÊN - {{mb_strtoupper($nv->hoten, "UTF-8")}}
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Quản lý nhân sự</a></li>
                <li class="active">Thông tin cá nhân</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                @if(!is_null($nv->log))
                    @foreach(json_decode($nv->log) as $item)
                <div class="col-xs-12" >
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title text-yellow" style="font-weight: bold;">Cập nhật lúc: {{ date("d/m/Y - H:i:s", strtotime($item->ngaycapnhat)) }} </h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <p><b>Họ tên: </b><span class="tt">{{$item->hoten}}</span></p>
                            <p><b>Chức danh nghề nghiệp: </b><span class="tt">{{$item->chucdanh}}</span></p>
                            <div class="row">
                                <div class="col-md-4">
                                    <p><b>Ngày sinh: </b><span class="tt">{{date("d/m/Y", strtotime($item->ngaysinh))}}</span></p>
                                </div>
                                <div class="col-md-4">
                                    <p><b>Nơi sinh: </b><span class="tt">{{$item->noisinh}}</span></p>
                                </div>
                                <div class="col-md-4">
                                    <p><b>Quê quán: </b><span class="tt">{{$item->quequan}}</span></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <p><b>Giới tính: </b><span class="tt">{{$item->gioitinh}}</span></p>
                                </div>
                                <div class="col-md-4">
                                    <p><b>Số điện thoại: </b><span class="tt">{{$item->sodienthoai}}</span></p>
                                </div>
                                <div class="col-md-4">
                                    <p><b>Email: </b><span class="tt">{{$item->email}}</span></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <p><b>Số CMND/CCCD: </b><span class="tt">{{$item->cmnd}}</span></p>
                                </div>
                                <div class="col-md-4">
                                    <p><b>Ngày cấp: </b><span class="tt">{{date("d/m/Y", strtotime($item->ngaycapcmnd))}}</span></p>
                                </div>
                                <div class="col-md-4">
                                    <p><b>Nơi cấp: </b><span class="tt">{{$item->noicapcmnd}}</span></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <p><b>Ngày tuyển dụng: </b><span class="tt">{{date("d/m/Y", strtotime($item->ngaytuyendung))}}</span></p>
                                </div>
                                <div class="col-md-4">
                                    <p><b>Nghề nghiệp khi được tuyển dụng: </b><span class="tt">{{$item->nghenghieptuyendung}}</span></p>
                                </div>
                                <div class="col-md-4">
                                    <p><b>Số bảo hiểm xã hội: </b><span class="tt">{{$item->bhxh}}</span></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <p><b>Dân tộc: </b><span class="tt">{{$item->dantoc}}</span></p>
                                </div>
                                <div class="col-md-4">
                                    <p><b>Tôn giáo: </b><span class="tt">{{$item->tongiao}}</span></p>
                                </div>
                                <div class="col-md-4">
                                    <p><b>Trình độ văn hóa: </b><span class="tt">{{$item->trinhdovanhoa}}</span></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <p><b>Trình độ chuyên môn: </b><span class="tt">{{$item->trinhdochuyenmon}}</span></p>
                                </div>
                                <div class="col-md-4">
                                    <p><b>Học hàm: </b><span class="tt">{{$item->hocham}}</span></p>
                                </div>
                                <div class="col-md-4">
                                    <p><b>Học vị: </b><span class="tt">{{$item->hocvi}}</span></p>
                                </div>
                            </div>
                            <p><b>Hộ khẩu thường trú: </b>
                                <span class="tt">
                                    @php
                                        $hokhau = json_decode($item->hokhauthuongtru)
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
                                        $noio = json_decode($item->noiohiennay)
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
                                <p><b>Ghi chú: </b><span class="tt">{{$item->ghichu}}</span></p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                    <div class="col-xs-12" >
                        <h4 style="font-style: italic; font-weight: bold;">Chưa ghi nhận lịch sử thay đổi dữ liệu</h4>
                    </div>
                @endif
            </div>
        </section>
    </div>

@endsection

@section('script')
    <script>
        $(document).ready(function () {

        });
    </script>
@endsection
