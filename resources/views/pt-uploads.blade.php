<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/lte.css')}}">
    <link rel="stylesheet" href="{{asset('css/toastr.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/dataTables.bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/skins.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('js/toastr.min.js')}}"></script>
    <script src="{{asset('js/cit-update.js')}}"></script>
    <script src="{{asset('js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('js/push-menu-left.js')}}"></script>
    <script src="{{asset('js/tree-menu.js')}}"></script>
    <script src="{{asset('js/js.cookie.min.js')}}"></script>
    <script src="{{asset('js/jquery.highlight-5.js')}}"></script>
    <script src="{{asset('js/select2.min.js')}}"></script>
    <script src="{{asset('js/pt-uploads-multiple.js')}}"></script>
</head>
<body>
<div class="container">
    <div class="form-group">
        <label for="exampleInputFile" class="required">File scan quyết định</label>
        <div id="them-filescan"></div>
    </div>

    <button onclick="alert($themfilescan.getURL())" >Lấy link</button>
    <button onclick="alert($themfilescan.isFile())" >Kiểm tra có đính kèm file chưa</button>
</div>
</body>
</html>

<script>
    $themfilescan = $('#them-filescan').ptUploads({
        list_file: ['weq', 'acs'],
        max_size_kb: 5 * 1024,
        event_upload_error: function (res){
            toastr.error(res, "Thao tác thất bại");
        },
        event_upload_success: function (res){
            toastr.success("Tải lên tệp tin thành công", "Thành công");
        }
    });

</script>
