@extends('backend.main')
@section('title', 'vCards.pk - Orders')

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
                                <h4 class="card-title">All Orders</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <div class="table-responsive">
                                <table id="user-list-table" class="table table-striped table-bordered mt-4" role="grid"
                                    aria-describedby="user-list-page-info">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Type</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>{{ $order->first_name }} {{ $order->last_name }}</td>
                                                <td>{{ $order->email }}</td>
                                                <td> {{ $order->status }}</td>
                                                <td>{{ $order->type }}</td>
                                                <td>
                                                    <div class="flex align-items-center list-user-action">
                                                        <a class="iq-bg-primary" data-toggle="tooltip" data-placement="top"
                                                            title="" data-original-title="Show" href="{{route('order.show',$order->id)}}"><i
                                                                class="lar la-eye"></i></a>
                                                        <a class="iq-bg-primary" data-toggle="tooltip" data-placement="top"
                                                            title="Edit" data-original-title="Edit" href="{{route('order.edit',$order->id)}}"><i
                                                                class="ri-pencil-line"></i></a>


                                                    </div>

                                                </td>
                                            </tr>

                                            @php
                                                $i++;
                                            @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
@endsection

@push('js')
@endpush
