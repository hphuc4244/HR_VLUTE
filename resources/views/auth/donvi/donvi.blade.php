@extends('auth.master')
@section('title') Quản lý nhân sự @endsection
@section('content')
    <div class="container-fluid no-padding">
        <section class="content-header">
            <h1 class="tieu-de">
                ĐƠN VI
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Thông tin khác</a></li>
                <li class="active">Đơn vị làm việc</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title" style="font-weight: bold; ">Danh sách đơn vị</h3>
                        </div>
                        <div class="box-body">
                            <table class="table table-bordered" id="table_id" >
                                <thead>
                                <tr>
                                    <th>Tên đơn vị</th>
                                    <th>Tên tiếng anh</th>
                                    <th>Vị trí đơn vị</th>
                                    <th style="width: 150px">Trạng thái đơn vị</th>
                                    <th style="width: 150px; text-align: center"></th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($ds as $item)
                                    <tr>
                                        <td>{{  $item->tendonvi }}</td>
                                        <td>{{  $item->tentienganh }}</td>
                                        <td>{{  $item->vitridonvi }}</td>
                                        <td class="{{$item->trangthaidonvi == 'Đang hoạt động' ? 'text-green' : 'text-red'}}" style="font-weight: bold">{{$item->trangthaidonvi}}</td>
                                        <td class="text-center">
                                            <a class="btn btn-warning btn-chi-tiet" href="{{action('App\Http\Controllers\DonViv2Controller@getCTDonVi', $item->madonvi)}}">Xem chi tiết</a>
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
            {{ csrf_field() }}
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
                    <div class="form-group">
                        <label>Tên đơn vị</label>
                        <input type="text" class="form-control them-tendonvi" placeholder="Nhập tên đơn vị">
                    </div>
                    <div class="form-group">
                        <label>Tên tiếng anh</label>
                        <input type="text" class="form-control them-tentienganh" placeholder="Nhập tên tiếng anh đơn vị">
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
                        <textarea class="form-control them-ghichu" rows="3" placeholder="Nhập nội dung hoặc lý do cập nhật thông tin đơn vị" spellcheck="false"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">File scan quyết định</label>
                        <br>
                        <input type="button" class="them-filescan btn btn-success" value="Đính kèm tệp tin">
                        <p class="tep-tin"></p>
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
        $(document).ready(function () {

        });
    </script>
@endsection
