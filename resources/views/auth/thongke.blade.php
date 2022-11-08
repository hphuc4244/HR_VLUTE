@extends('auth.master')
@section('title') Quản lý nhân sự @endsection
@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <div>
        <canvas id="myChart"></canvas>
    </div>

    @foreach ( $chart as $key =>$item)
       @php
           $donvi[] = $item->TenDonVi;
           $soluong[] = $item->SoLuong;
       @endphp
    @endforeach
    <script>

        const labels = @php echo json_encode($donvi); @endphp;
        const data = {
            labels: labels,
            datasets: [{
                label: 'Thống kê số lượng cán bộ giảng viên',
                data: @php echo json_encode($soluong); @endphp,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 205, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(201, 203, 207, 0.2)'
                ],
                borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(255, 159, 64)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(54, 162, 235)',
                    'rgb(153, 102, 255)',
                    'rgb(201, 203, 207)'
                ],
                borderWidth: 1
            }]
        };
        const config = {
            type: 'bar',
            data: data,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            },
        };
        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );
    </script>
@endsection


