@extends('auth.master')
@section('title') Quản lý nhân sự @endsection
@section('style')
    body, html {
        height: 100%;
    }

    .bg {
    /* The image used */
    background-image: url("images/bg-trangchu.jpg");

    /* Full height */
    height: 800px;

    /* Center and scale the image nicely */
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    }
@endsection
@section('content')
    <div class="container-fluid no-padding bg" >

    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
        });
    </script>
@endsection
