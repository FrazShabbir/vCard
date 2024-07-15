@extends('user.main')
@section('title', $user->username)

@section('styles')
@endsection

@push('css')
@endpush



@section('content')
    <div id="content-page" class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">vCard Stats</h4>
                            </div>
                            <a href="" class="btn iq-bg-primary">Home</a>
                        </div>
                        <div class="iq-card-body px-4">

                            <div class="row">
                                <div class="col-md-6 col-sm-12 mb-3">
                                    <label for="name" class="">Name</label>
                                    <input type="text" required class="form-control required" placeholder="School"
                                        value="{{ $user->first_name }}" disabled>
                                </div>

                                <div class="col-md-6 col-sm-12 mb-3">
                                    <label for="description" class="">Total Reach</label>
                                    <input type="text" required class="form-control required" placeholder="School"
                                        value="{{ $user->reach }}" disabled>
                                </div>


                                <div class="col-md-6 col-sm-12 mb-3">
                                    <label for="description" class="">Total Visits</label>
                                    <input type="text" required class="form-control required" placeholder="School"
                                        value="{{ $user->count }}" disabled>
                                </div>

                            </div>



                            {{-- <button type="submit" class="btn btn-primary mr-3">Submit</button>
                                <a href="" class="btn iq-bg-danger">Home</a> --}}

                        </div>
                    </div>
                </div>
                @php
                    $i = 1;
                @endphp
                @foreach ($user->locations as $location)
                <div class="col-sm-12">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">Location => {{$i}}</h4>
                            </div>
                            @php
                                $i++;
                            @endphp
                        </div>
                        <div class="iq-card-body px-4">

                                {{-- <div class="row">
                                <div class="col-md-6 col-sm-12 mb-3">
                                    <label for="name" class="">Link</label>
                                    <input type="text" required class="form-control required"
                                        placeholder="School" value="{{$link->link}}" disabled>
                                </div>

                                <div class="col-md-6 col-sm-12 mb-3">
                                    <label for="description" class="">Short Url</label>
                                    <input type="text" required class="form-control required"
                                    placeholder="School" value="{{$link->short_link}}" disabled>
                                </div>

                                <div class="col-md-6 col-sm-12 mb-3">
                                    <label for="description" class="">Creator</label>
                                    <input type="text" required class="form-control required"
                                    placeholder="School" value="{{getFullNameById($link->creator->id)}}" disabled>
                                </div>
                                <div class="col-md-6 col-sm-12 mb-3">
                                    <label for="description" class="">Total Counts</label>
                                    <input type="text" required class="form-control required"
                                    placeholder="School" value="{{$link->count}}" disabled>
                                </div>

                            </div> --}}
                                <div class="row">
                                    <div class="col-lg-4 col-12">
                                        <div class="">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="">
                                                    <p>
                                                        <b>IP</b>
                                                    </p>
                                                </div>
                                                <div class="">
                                                    <p>{{ $location->ip_address }}</p>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="">
                                                    <p>
                                                        <b>Zip Code</b>
                                                    </p>
                                                </div>
                                                <div class="">
                                                    <p>{{ $location->zip_code }}</p>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="">
                                                    <p>
                                                        <b>City Name</b>
                                                    </p>
                                                </div>
                                                <div class="">
                                                    <p>{{ $location->city_name }}</p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-12">
                                        <div class="">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="">
                                                    <p>
                                                        <b>Latitude</b>
                                                    </p>
                                                </div>
                                                <div class="">
                                                    <p>{{ $location->latitude }}</p>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="">
                                                    <p>
                                                        <b>Region Name</b>
                                                    </p>
                                                </div>
                                                <div class="">
                                                    <p>{{ $location->region_name }}</p>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="">
                                                    <p>
                                                        <b>Country Name</b>
                                                    </p>
                                                </div>
                                                <div class="">
                                                    <p>{{ $location->country_name }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-12">
                                        <div class="">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="">
                                                    <p>
                                                        <b>Longitude</b>
                                                    </p>
                                                </div>
                                                <div class="">
                                                    <p>{{ $location->longitude }}</p>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="">
                                                    <p>
                                                        <b>areaCode</b>
                                                    </p>
                                                </div>
                                                <div class="">
                                                    <p>{{ $location->area_code }}</p>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="">
                                                    <p>
                                                        <b>timezone</b>
                                                    </p>
                                                </div>
                                                <div class="">
                                                    <p>{{ $location->timezone }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="iq-card-header d-flex justify-content-between">
                                    <div class="iq-header-title">
                                        <h4 class="card-title">Devices from this location/network</h4>
                                    </div>
                                </div>
                                <div class="table-responsive">

                                    <table id="user-list-table" class="table table-striped table-bordered mt-4"
                                        role="grid" aria-describedby="user-list-page-info">
                                        <thead>
                                            <tr>
                                                <th>Device</th>
                                                <th>Platform</th>
                                                <th>Platform Version</th>
                                                <th>Browser</th>
                                                <th>Browser Version</th>
                                                {{-- <th>Action</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($location->devices as $device)
                                                <tr>
                                                    <td>{{ $device->device }}</td>
                                                    <td>{{ $device->platform }}</td>
                                                    <td>{{ $device->platform_version }}</td>
                                                    <td>{{ $device->browser }}</td>
                                                    <td>{{ $device->browser_version }}</td>


                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>

                        </div>
                    </div>
                </div>
                @endforeach
                {{-- <div class="col-sm-12">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">Devices</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <div class="table-responsive">

                                <table id="user-list-table" class="table table-striped table-bordered mt-4" role="grid"
                                    aria-describedby="user-list-page-info">
                                    <thead>
                                        <tr>
                                            <th>Device</th>
                                            <th>Platform</th>
                                            <th>Platform Version</th>
                                            <th>Browser</th>
                                            <th>Browser Version</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($link->devices as $device)
                                            <tr>
                                                <td>{{ $device->device }}</td>
                                                <td>{{ $device->platform }}</td>
                                                <td>{{ $device->platform_version }}</td>
                                                <td>{{ $device->browser }}</td>
                                                <td>{{ $device->browser_version }}</td>


                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
@endsection


@section('scripts')
@endsection

@push('js')
@endpush
