@extends('auth.master')
@section('title') Quản lý nhân sự @endsection
@section('content')
    <style>
        * {
            box-sizing: border-box;
        }

        .row {
            margin-left:-5px;
            margin-right:-5px;
        }

        .column {
            float: left;
            width: 50%;
            padding: 5px;
        }

        /* Clearfix (clear floats) */
        .row::after {
            content: "";
            clear: both;
            display: table;
        }

        table {
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
            border: 3px solid #00a65a;
            border-radius: 3;
        }

        th, td {
            text-align: left;
            padding: 16px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
    <div class="container-fluid no-padding">
        <section class="content">
            <div class="column">
                <table>
                    <tr>
                        <td colspan="3" class="tieu-de" style="text-align: center; font-size: 30px">TỦ SỐ 1</td>
                    </tr>
                    <tr>
                        <th>Ngăn số</th>
                        <th>Trái</th>
                        <th>Phải</th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Smith</td>
                        <td>50</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Jackson</td>
                        <td>94</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Johnson</td>
                        <td>67</td>
                    </tr>
                </table>
            </div>
            <div class="column">
                <table>
                    <tr>
                        <td colspan="3" class="tieu-de" style="text-align: center;font-size: 30px">TỦ SỐ 2</td>
                    </tr>
                    <tr>
                        <th>Ngăn số</th>
                        <th>Trái</th>
                        <th>Phải</th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Smith</td>
                        <td>50</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Jackson</td>
                        <td>94</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Johnson</td>
                        <td>67</td>
                    </tr>
                </table>
            </div>
            <div class="column">
                <table>
                    <tr>
                        <td colspan="3" class="tieu-de" style="text-align: center;font-size: 30px">TỦ SỐ 3</td>
                    </tr>
                    <tr>
                        <th>Ngăn số</th>
                        <th>Trái</th>
                        <th>Phải</th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Smith</td>
                        <td>50</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Jackson</td>
                        <td>94</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Johnson</td>
                        <td>67</td>
                    </tr>
                </table>
            </div>
            <div class="column">
                <table>
                    <tr>
                        <td colspan="3" class="tieu-de" style="text-align: center;font-size: 30px">TỦ SỐ 4</td>
                    </tr>
                    <tr>
                        <th>Ngăn số</th>
                        <th>Trái</th>
                        <th>Phải</th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Smith</td>
                        <td>50</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Jackson</td>
                        <td>94</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Johnson</td>
                        <td>67</td>
                    </tr>
                </table>
            </div>
        </section>
    </div>
@endsection


