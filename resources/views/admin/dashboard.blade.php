
@extends('layouts.mytemplate_system')

@section('pagetitle')
Admin Dashboard
@endsection

@section('content')
<div class="row">
    @section('pageheader')
    Admin Dashboard
    @endsection

    @section('breadcrumb')
        <li class="breadcrumb-item"><a href="{{ route('app.admin.dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active">Admin Dashboard</li>
    @endsection

    <!-- Total Bookings Card -->
    <div class="col-xxl-3 col-md-6">
        <div class="card info-card sales-card">
            <div class="card-body">
                <h5 class="card-title">Total Bookings</h5>
                <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-geo"></i>
                    </div>
                    <div class="ps-3">
                        <h6>{{ $total_booking }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- End Total Bookings Card -->
    
    <!-- Total Pending Card -->
    <div class="col-xxl-3 col-md-6">
        <div class="card info-card customers-card">
            <div class="card-body">
                <h5 class="card-title">Total Pending</h5>
                <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-hourglass-split"></i>
                    </div>
                    <div class="ps-3">
                        <h6>{{ $total_pending }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- End Total Pending Card -->
    
    <!-- Total Approved Card -->
    <div class="col-xxl-3 col-md-6">
        <div class="card info-card revenue-card">
            <div class="card-body">
                <h5 class="card-title">Total Approved</h5>
                <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-check2-circle"></i>
                    </div>
                    <div class="ps-3">
                        <h6>{{ $total_approve }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- End Total Approved Card -->
    
    <!-- Total Reject Card -->
    <div class="col-xxl-3 col-xl-12">
        <div class="card info-card customers-card">
            <div class="card-body">
                <h5 class="card-title">Total Reject</h5>
                <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                        <h6>{{ $total_reject }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- End Total Reject Card -->
</div>
<br>
<div class="card">
    <h5 class="card-header">Population Of Lots Among Campers</h5>
    <div class="card-body">
        <div id="myfirstchart" style="height: 300px;"></div>
    </div>
</div>

<br>
<div class="card">
    <h5 class="card-header">Profit Overview</h5>
    <center>
        <div class="card-body">
            <canvas id="profitChart" style="height: 500px;"></canvas>
        </div>
        <div class="buttonBox d-flex justify-content-center mb-5"
            <ul style="list-style: none;">
                <li>
                    <a class="btn btn-danger text-white" onclick="changeChart('rgba(78, 115, 223, 1)', 'Profit Overview:Weekly', {{ json_encode($weeklyProfits->pluck('profit_week')->map(function ($item) { return 'Week'. ' ' . $item; })) }}, {{ json_encode($weeklyProfits->pluck('total_profit_week')) }})">Week</a>
                </li>

                <li>
                    <a class="btn btn-primary" onclick="changeChart('rgba(78, 115, 223, 1)', 'Profit Overview:Monthly', {{ json_encode($monthlyProfits->pluck('profit_month')->map(function ($item) { return date('F', mktime(0, 0, 0, $item, 1)); })) }}, {{ json_encode($monthlyProfits->pluck('total_profit_month')) }})">Month</a>                 
                </li>

                <li>
                    <a class="btn btn-success" onclick="changeChart('rgba(78, 115, 223, 1)', 'Profit Overview:Yearly', {{ json_encode($yearlyProfits->pluck('profit_year')) }}, {{ json_encode($yearlyProfits->pluck('total_profit_year')) }})">Year</a>
                </li>
            </ul>
        </div>
    </center>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    console.log("Weekly Profits:", {!! json_encode($weeklyProfits) !!});
    console.log("Monthly Profits:", {!! json_encode($monthlyProfits) !!});
    console.log("Yearly Profits:", {!! json_encode($yearlyProfits) !!});

    const ctx = document.getElementById("profitChart");
    const profitChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($weeklyProfits->pluck('period')->map(function ($item) { return 'Week' . ' '. $item; })) !!},
            datasets: [{
                // label: {!! json_encode($weeklyProfits->pluck('profit_week')->map(function ($item) { return 'Profit Overview:Weekly'. ' '. $item; })) !!},
                label: "Profit Overview:Weekly",
                data: @json($weeklyProfits->pluck('total_profit_week')),
                backgroundColor: 'rgba(78, 115, 223, 1)',
                borderColor: 'rgba(78, 115, 223, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    function changeChart(color, label, labels, data){
        console.log("Changing chart:", color, label, labels, data);

        profitChart.data.datasets[0].backgroundColor = color;
        profitChart.data.datasets[0].borderColor = color;
        profitChart.data.datasets[0].label = label;
        profitChart.data.labels = labels;
        profitChart.data.datasets[0].data = data;
        profitChart.update();
    }
        
        //  // Initial empty data for the chart
        // const initialData = {
        //     labels: [],
        //     data: [],
        // };


        // const ctx = document.getElementById("profitChart");
        // const profitChart = new Chart(ctx, {
        //     type: 'bar',
        //     data: {
        //         labels: initialData.labels,
        //         datasets: [{
        //             label: "Profit Overview:Weekly",
        //             data: initialData.data,
        //             backgroundColor:'rgba(78, 115, 223, 1)',
        //             borderColor:'rgba(78, 115, 223, 1)',
        //             borderWidth: 1
        //         }]
        //     },
        //     options: {
        //         scales: {
        //             y: {
        //                 beginAtZero: true
        //             }
        //         }
        //     }
        // });

        // function fetchAndUpdateWeeklyData() {
        //     fetch('/dashboard/fetch-weekly-profits')
        //         .then(response => response.json())
        //         .then(data => {
        //             // Update chart with new data
        //             profitChart.data.labels = data.map(item => 'Week ' + item.profit_week);
        //             profitChart.data.datasets[0].data = data.data;
        //             profitChart.data.datasets[0].label = "Profit Overview:Weekly"; // Set initial label
        //             profitChart.update();
        //         });
        // }

        // function fetchAndUpdateMonthlyData() {
        //     fetch('/dashboard/fetch-monthly-profits')
        //         .then(response => response.json())
        //         .then(data => {
        //             // Update chart with new data
        //             profitChart.data.labels = data.map(item => 'Month ' + item.profit_month);
        //             profitChart.data.datasets[0].data = data.data;
        //             profitChart.data.datasets[0].label = "Profit Overview:Monthly"; // Set initial label
        //             profitChart.update();
        //         });
        // }

        // function fetchAndUpdateYearlyData() {
        //     fetch('app/admin/dashboard/fetch-yearly-profits')
        //         .then(response => response.json())
        //         .then(data => {
        //             // Update chart with new data
        //             profitChart.data.labels = data.map(item => 'Year ' + item.profit_year);
        //             profitChart.data.datasets[0].data = data.data;
        //             profitChart.data.datasets[0].label = "Profit Overview:Yearly"; // Set initial label
        //             profitChart.update();
        //         });
        // }
    </script>
</div>

<script type="text/javascript">
    new Morris.Bar({
    // ID of the element in which to draw the chart.
    element: 'myfirstchart',
    // Chart data records -- each entry in this array corresponds to a point on
    // the chart.
    data: [
        @foreach($lots as $lot)
        { name: '{{ $lot->name }}', value: {{ $lot->getTotalBooking() }}, },
        @endforeach
    ],
    // The name of the data record attribute that contains x-values.
    xkey: 'name',
    // A list of names of data record attributes that contain y-values.
    ykeys: ['value'],
    // Labels for the ykeys -- will be displayed when you hover over the
    // chart.
    labels: ['Value']
});
</script>
@endsection 