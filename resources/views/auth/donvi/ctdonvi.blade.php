@extends('auth.master')
@section('title') Quản lý nhân sự @endsection
@section('content')
    <div class="container-fluid no-padding">
        <section class="content-header">
            <h1 class="tieu-de">
                ĐƠN VI/ {{ $ct->tendonvi  }}
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
                    <button class="btn btn-success open-modal-import">Import danh sách</button>

                    <div class="btn-group">
                        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Xuất biểu mẫu
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="#">Danh sách đơn vị</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title" style="font-weight: bold; ">Danh sách nhân sự</h3>
                        </div>
                        <div class="box-body">
                            <table class="table table-bordered" id="table_id" >
                                <thead>
                                <tr>
                                    <th>Họ tên</th>
                                    <th>Ngày sinh</th>
                                    <th>Giới tính</th>
                                    <th>Trình độ chuyên môn</th>
                                </tr>
                                </thead>
                                @foreach($nv as $item)
                                    <tr>
                                        <td>{{  $item->hoten }}</td>
                                        <td>{{  $item->ngaysinh }}</td>
                                        <td>{{  $item->gioitinh }}</td>
                                        <td>{{  $item->trinhdochuyenmon }}</td>
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

    <form method="post" action="" enctype="multipart/form-data">
        <div class="modal fade" id="nhapDSNhanSu">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Nhập danh sách nhân sự theo đơn vị</h4>
                    </div>
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="">Chọn file (*.xlsx) hoặc tải về
                                    <a target="_blank" href="{{ asset('imports/BM_Nhập thông tin nhân sự.xlsx') }}">
                                        Biểu mẫu nhập nhân sự theo đơn vị
                                    </a>
                                </label>
                                <input accept=".xlsx" name="file-excel" type="file" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary luuTT">Tải lên</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $('.open-modal-import').click(function (){
                $('#nhapDSNhanSu').modal('show');
            });
        });
    </script>
@endsection
