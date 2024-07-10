@extends('user.main')

@section('styles')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
@endsection
@section('content')
    <div id="content-page" class="content-page">
        <div class="container-fluid">
            <div class="row">

                <div class="col-sm-6 col-md-6 col-lg-3">
                    <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-body iq-box-relative">
                            <div class="iq-box-absolute icon iq-icon-box rounded-circle iq-bg-primary">
                                <i class="ri-focus-2-line"></i>
                            </div>
                            <p class="text-secondary">Total Reach</p>
                            <div class="d-flex align-items-center justify-content-between">
                                <h4><b>{{ auth()->user()->reach }}</b></h4>
                                {{-- <div id="iq-chart-box1"></div> --}}
                                {{-- <span class="text-primary"><b> +14% <i class="ri-arrow-up-fill"></i></b></span> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-3">
                    <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-body iq-box-relative">
                            <div class="iq-box-absolute icon iq-icon-box rounded-circle iq-bg-danger">
                                <i class="ri-pantone-line"></i>
                            </div>
                            <p class="text-secondary">Visitors</p>
                            <div class="d-flex align-items-center justify-content-between">
                                <h4><b>{{ auth()->user()->count }}</b></h4>
                                {{-- <div id="iq-chart-box2"></div>
                      <span class="text-danger"><b> -6% <i class="ri-arrow-down-fill"></i></b></span> --}}
                            </div>
                        </div>
                    </div>
                </div>
                @if (isset(auth()->user()->vcard[0]->card_number))
                    <div class="col-sm-6 col-md-6 col-lg-3">
                        <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                            <div class="iq-card-body iq-box-relative">
                                <div class="iq-box-absolute icon iq-icon-box rounded-circle iq-bg-success">
                                    <i class="ri-database-2-line"></i>
                                </div>
                                <p class="text-secondary">Card Number</p>
                                <div class="d-flex align-items-center justify-content-between">
                                    <h4><b>{{ auth()->user()->vcard[0]->card_number }}</b></h4>
                                    {{-- <div id="iq-chart-box3"></div>
                      <span class="text-success"><b> +0.36% <i class="ri-arrow-up-fill"></i></b></span> --}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6 col-lg-3">
                        <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                            <div class="iq-card-body iq-box-relative">
                                <div class="iq-box-absolute icon iq-icon-box rounded-circle iq-bg-warning">
                                    <i class="ri-pie-chart-2-line"></i>
                                </div>
                                <p class="text-secondary">Card Expiry</p>
                                <div class="d-flex align-items-center justify-content-between">
                                    <h4><b>{{ date('d-M-Y', strtotime(auth()->user()->vcard[0]->expiry)) }}</b></h4>
                                    {{-- <div id="iq-chart-box4"></div>
                      <span class="text-warning"><b> +0.45% <i class="ri-arrow-up-fill"></i></b></span> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="col-sm-6 col-md-6 col-lg-3">
                    <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-body iq-box-relative">

                            <p class="text-secondary">My QR</p>
                            <div class="d-flex align-items-center justify-content-between text-center">

                                {!! QrCode::eye('circle')->size(200)->generate(route('home') . '/' . auth()->user()->username) !!}
                            </div>
                            {{-- <div class="text-center mt-2">
                                <a href="{{ route('downloadQRCode') }}" class="btn btn-primary">Download QR Code</a>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="container mt-5">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div id="chart"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mt-5">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div id="charts"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            function generateApexChart() {
                var options = {
                    chart: {
                        type: 'line', // You can change this to 'bar', 'pie', etc.
                        height: 350
                    },
                    series: [{
                        name: 'Sample Data',
                        data: [10, 41, 35, 51, 49, 62, 69, 91, 148]
                    }],
                    xaxis: {
                        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep']
                    }
                };

                var chart = new ApexCharts(document.querySelector("#chart"), options);
                chart.render();
            }

            // Call the function to generate the chart
            generateApexChart();
        });

        $(document).ready(function() {
    function generateApexChart() {
        var options = {
            chart: {
                type: 'bar', // Bar chart type
                height: '100%',
                width: '100%',
                toolbar: {
                    show: false
                },
                zoom: {
                    enabled: false
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false, // Set to false for vertical bars
                }
            },
            series: [{
                name: 'Sample Data',
                data: [10, 41, 35, 51, 49, 62, 69, 91, 148]
            }],
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep']
            },
            responsive: [{
                breakpoint: 1000,
                options: {
                    chart: {
                        width: '100%'
                    }
                }
            }]
        };

        var chart = new ApexCharts(document.querySelector("#charts"), options);
        chart.render();
    }

    // Call the function to generate the chart
    generateApexChart();
});

    </script>
@endsection
