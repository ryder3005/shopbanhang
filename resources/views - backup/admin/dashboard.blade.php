@extends('admin_layout')
@section('admin_content')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <div class="row">
        <div class="col-6 mb-6">
            <div></div>
            <h1>Biểu đồ doanh thu </h1>
            <div id="chart"></div>

            <script>
                var options = {
                    chart: {
                        type: 'line',
                        toolbar: {
                            show: false,
                        },
                        height: 350,
                        background: '#2b2c40', // Màu nền tối
                        foreColor: '#ffffff' // Màu chữ sáng
                    },
                    series: [{
                        name: 'Sales',
                        data: [30, 40, 35, 50, 49, 60, 70, 91, 125]
                    }],
                    xaxis: {
                        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep']
                    },
                    colors: ['#71dd37'], // Màu của các đường biểu đồ
                    stroke: {
                        curve: 'smooth',
                    },
                    tooltip: {
                        theme: 'dark' // Chế độ tối cho tooltip
                    },
                    grid: {
                        borderColor: '#555' // Màu đường lưới
                    }
                };

                var chart = new ApexCharts(document.querySelector("#chart"), options);
                chart.render();
            </script>

        </div>

        <div class="col-6 mb-6">
            <h3></h3>
        </div>
    </div>
@endsection
