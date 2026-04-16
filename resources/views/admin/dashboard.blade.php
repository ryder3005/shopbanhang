@extends('admin_layout')
@section('admin_content')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<style>
    #chart {
  max-width: 650px;
  margin: 35px auto;
}

</style>
    <div class="row">
        <div class="col-6 mb-6">
            <div></div>
            <h1>Biểu đồ doanh thu </h1>

            <div class="card">
                <div class="card-body">
                    <div id="chart"></div>
                </div>
            </div>
            {{-- <script>
                var options = {
                    chart: {
                        type: 'line'
                    },
                    series: [{
                        name: 'sales',
                        data: [30, 40, 35, 50, 49, 60, 70, 91, 125]
                    }],
                    xaxis: {
                        categories: [1991, 1992, 1993, 1994, 1995, 1996, 1997, 1998, 1999]
                    }
                }

                var chart = new ApexCharts(document.querySelector("#chart"), options);

                chart.render();
            </script> --}}

        </div>

        <div class="col-6 mb-6">
            <h3></h3>
        </div>
    </div>
@endsection
