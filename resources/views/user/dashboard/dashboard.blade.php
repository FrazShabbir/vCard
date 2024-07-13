@extends('user.main')

@section('styles')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
@endsection
@section('content')
    <div id="content-page" class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-lg-3">
                    <div class="iq-card iq-card-block iq-card-stretch iq-card-height bg-primary rounded">
                       <div class="iq-card-body">
                          <div class="d-flex align-items-center justify-content-between">
                             <div class="icon iq-icon-box rounded iq-bg-primary rounded shadow" data-wow-delay="0.2s">
                                <i class="las la-users"></i>
                             </div>
                             <div class="iq-text">
                                <h6 class="text-white">Reach</h6>
                                <h3 class="text-white">{{ auth()->user()->reach }}</h3>
                             </div>
                          </div>
                       </div>
                    </div>
                 </div>
                 <div class="col-md-6 col-lg-3">
                    <div class="iq-card iq-card-block iq-card-stretch iq-card-height bg-warning rounded">
                       <div class="iq-card-body">
                          <div class="d-flex align-items-center justify-content-between">
                             <div class="icon iq-icon-box rounded iq-bg-warning rounded shadow" data-wow-delay="0.2s">
                                <i class="lab la-product-hunt"></i>
                             </div>
                             <div class="iq-text">
                                <h6 class="text-white">Visitors</h6>
                                <h3 class="text-white">{{ auth()->user()->count }}</h3>
                             </div>
                          </div>
                       </div>
                    </div>
                 </div>

                 <div class="col-md-6 col-lg-3">
                    <div class="iq-card iq-card-block iq-card-stretch iq-card-height bg-success rounded">
                       <div class="iq-card-body">
                          <div class="d-flex align-items-center justify-content-between">
                             <div class="icon iq-icon-box rounded iq-bg-success rounded shadow" data-wow-delay="0.2s">
                                <i class="las la-user-tie"></i>
                             </div>
                             <div class="iq-text">
                                <h6 class="text-white">Devices</h6>
                                <h3 class="text-white">{{ auth()->user()->devices()->count() }}</h3>
                             </div>
                          </div>
                       </div>
                    </div>
                 </div>

                 <div class="col-md-6 col-lg-3">
                    <div class="iq-card iq-card-block iq-card-stretch iq-card-height bg-danger rounded">
                       <div class="iq-card-body">
                          <div class="d-flex align-items-center justify-content-between">
                             <div class="icon iq-icon-box rounded iq-bg-danger rounded shadow" data-wow-delay="0.2s">
                                <i class="lab la-buffer"></i>
                             </div>
                             <div class="iq-text">
                                <h6 class="text-white">Locations</h6>
                                <h3 class="text-white">{{ auth()->user()->locations()->count() }}</h3>
                             </div>
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
        <div class="container mt5">
            <div class="row">
                <div class="col-6">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">Platform Statistics</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <div class="progress">
                                @foreach ($platforms_percentages as $platform => $percentage)
                                    @php
                                        // Dynamically generate color classes
                                        $colorClasses = [
                                            'bg-warning',
                                            'bg-primary',
                                            'bg-success',
                                            'bg-dark',
                                            'bg-light',
                                            'bg-secondary',

                                            'bg-info',
                                            'bg-danger',
                                        ];
                                        $colorClass = $colorClasses[$loop->index % count($colorClasses)];
                                    @endphp
                                    <div class="progress-bar {{ $colorClass }}" role="progressbar"
                                        style="width: {{ $percentage }}%" aria-valuenow="{{ $percentage }}"
                                        aria-valuemin="0" aria-valuemax="100">
                                        {{ $platform }} ({{ round($percentage, 2) }}%)
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">Client Devices Statistics</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <div class="progress">
                                @foreach ($clients_percentages as $client => $percentage)
                                    @php
                                        // Dynamically generate color classes
                                        $colorClasses = [
                                            'bg-success',
                                            'bg-light',
                                            'bg-secondary',
                                            'bg-warning',
                                            'bg-info',
                                            'bg-danger',
                                            'bg-dark',
                                            'bg-primary',
                                        ];
                                        $colorClass = $colorClasses[$loop->index % count($colorClasses)];
                                    @endphp
                                    <div class="progress-bar {{ $colorClass }}" role="progressbar"
                                        style="width: {{ $percentage }}%" aria-valuenow="{{ $percentage }}"
                                        aria-valuemin="0" aria-valuemax="100">
                                        {{ $client }} ({{ round($percentage, 2) }}%)
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">Devices Statistics</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">

                            <div class="progress">
                                @foreach ($devices_percentages as $device => $percentage)
                                    @php
                                        // Dynamically generate color classes
                                        $colorClasses = [
                                            'bg-primary',
                                            'bg-success',
                                            'bg-info',
                                            'bg-warning',
                                            'bg-danger',
                                            'bg-secondary',
                                            'bg-dark',
                                            'bg-light',
                                        ];
                                        $colorClass = $colorClasses[$loop->index % count($colorClasses)];
                                    @endphp
                                    <div class="progress-bar {{ $colorClass }}" role="progressbar"
                                        style="width: {{ $percentage }}%" aria-valuenow="{{ $percentage }}"
                                        aria-valuemin="0" aria-valuemax="100">
                                        {{ $device }} ({{ round($percentage, 2) }}%)
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mt-5">
            @php
                $userengagements = json_encode($engagements);
            @endphp

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div id="user-engagement" data-dataset="{{ $userengagements }}"></div>
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
                            @php
                                $location = json_encode($locations);
                            @endphp
                            <div id="charts" data-dataset="{{ $location }}"></div>
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
                            @php
                                $devices = json_encode($devices);
                            @endphp
                            <div id="devices" data-dataset="{{ $devices }}"></div>
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
            engagments = $('#user-engagement').data('dataset');
            locations = $('#charts').data('dataset');
            devices = $('#devices').data('dataset');
            generateApexChart(engagments, 'User Engagements', 'line', 'user-engagement');
            generateApexChart(locations, 'Locations', 'line', 'charts');
            generateApexChart(devices, 'Devices', 'line', 'devices');
        });

        function generateApexChart(dataset, title, type, id) {
            let keys = Object.keys(dataset);
            let values = Object.values(dataset);
            var options = {
                chart: {
                    type: type,
                    height: 150
                },
                series: [{
                    name: title,
                    data: values
                }],
                xaxis: {
                    categories: keys
                }
            };
            var chart = new ApexCharts(document.querySelector("#" + id), options);
            chart.render();
        }
    </script>
@endsection
