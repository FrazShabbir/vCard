@extends('backend.main')
@section('title', 'Edit User - vCards')

@section('styles')
@endsection

@push('css')
@endpush



@section('content')
    <div id="content-page" class="content-page">
        <div class="container-fluid">
            <form action="{{ route('order.update', $order->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                {{ @method_field('PUT') }}
                <div class="row">
                    <div class="col-sm-12">
                        <div class="iq-card">
                            <div class="iq-card-header d-flex justify-content-between">
                                <div class="iq-header-title">
                                    <h4 class="card-title">Order #{{ $order->id }}</h4>
                                </div>
                            </div>
                            <div class="iq-card-body px-4">

                                <div class="row">
                                    <div class="col-md-6 col-sm-12 mb-3">
                                        <label for="comment" class="required">Comment</label>
                                        <input type="text" class="form-control" required name="comment"
                                            placeholder="e.g. Your Order is Approved." value="">
                                    </div>
                                    <div class="col-md-6 col-sm-12 mb-3">
                                        <label for="status" class="required">Status</label>
                                        <select name="status" id="" class="form-control">
                                            <option value="Approved">Approved</option>
                                            <option value="Pending">Pending</option>
                                            <option value="Cancelled">Cancelled</option>
                                            <option value="Info">Info</option>
                                            <option value="Delivered">Delivered</option>
                                        </select>
                                    </div>
                                </div>
<hr>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12 mb-3">
                                        <label for="first_name" class="required">First Name </label>
                                        <input type="text" class="form-control" required name="first_name"
                                            placeholder="e.g. Ali" value="{{ $order->first_name }}">
                                    </div>
                                    <div class="col-md-6 col-sm-12 mb-3">
                                        <label for="last_name" class="required">Last Name</label>
                                        <input type="text" class="form-control" required name="last_name"
                                            placeholder="e.g. Raza" value="{{ $order->last_name }}">
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-6 col-sm-12 mb-3">
                                        <label class="required" for="email">Email address:</label>
                                        <input type="email" required class="form-control" id="email" name="email"
                                            placeholder="e.g. abc@email.com" value="{{ $order->email }}">
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-md-6 col-sm-12 mb-3">
                                        <label class="required" for="phone">Phone:</label>
                                        <input type="text" required class="form-control" id="phone" name="phone"
                                            placeholder="e.g. aliraza12" value="{{ $order->phone }}">
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-md-12 col-sm-12 mb-3">
                                        <label class="required" for="address">Delivery Address:</label>
                                        <textarea required class="form-control" id="address" name="address" placeholder="e.g. aliraza12">{{ $order->delivery_address }}</textarea>
                                    </div>
                                </div>






                                <button type="submit" class="btn btn-primary mr-3">Update Data</button>
                                <a href="{{ route('users.index') }}" class="btn iq-bg-danger mr-3">Cancel</a>


                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="iq-card">
                            <div class="iq-card-header d-flex justify-content-between">
                                <div class="iq-header-title">
                                    <h4 class="card-title">User Details</h4>
                                </div>
                            </div>
                            <div class="iq-card-body px-4">

                                <div class="table-responsive">

                                    <table id="user-list-table" class="table table-striped table-bordered mt-4"
                                        role="grid" aria-describedby="user-list-page-info">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Status</th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr>
                                                <td>type</td>
                                                <td>{{ $order->user->type }}</td>
                                            </tr>
                                            <tr>
                                                <td>expiry</td>
                                                <td>{{ $order->user->expiry }}</td>

                                            </tr>

                                            <tr>
                                                <td>Name</td>
                                                <td>{{ getFullname($order->user->id) }} </td>

                                            </tr>

                                            <tr>
                                                <td>Username</td>
                                                <td>{{ $order->user->username }}</td>

                                            </tr>


                                            <tr>
                                                <td>Email</td>
                                                <td>{{ $order->user->email }}</td>

                                            </tr>

                                            <tr>
                                                <td>Phone</td>
                                                <td>{{ $order->user->phone }}</td>

                                            </tr>


                                            <tr>
                                                <td>Reach</td>
                                                <td>{{ $order->user->reach }}</td>

                                            </tr>
                                            <tr>
                                                <td>Count</td>
                                                <td>{{ $order->user->count }}</td>

                                            </tr>


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </form>
        </div>
    </div>
@endsection


@section('scripts')
@endsection

@push('js')
@endpush
