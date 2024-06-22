@extends('user.main')
@section('title', 'My vCard - vCards.pk')

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
                                <h4 class="card-title">My Shop @if ($shop)
                                        <span class="badge badge-primary">#{{ $shop->slug }}
                                        </span>
                                    @endif
                                </h4>
                            </div>
                        </div>
                        <div class="iq-card-body px-4">
                            @if ($shop==null)
                                <div class="row text-center">
                                    <div class="col-12">
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target=".bd-create-shop">Create Shop</button>

                                    </div>
                                </div>
                            @else
                                <div class="table-responsive">

                                    <table id="user-list-table" class="table table-striped table-bordered mt-4"
                                        role="grid" aria-describedby="user-list-page-info">
                                        <thead>
                                            <tr>
                                                <th>Key</th>
                                                <th>Status</th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                                <tr>
                                                    <td>Shop Name</td>
                                                    <td>{{ $shop->name }}</td>
                                                    </td>
                                                </tr>


                                                <tr>
                                                    <td>URL</td>
                                                    <td>{{ $shop?->slug }}</td>
                                                </tr>


                                                <tr>
                                                    <td>Email</td>
                                                    <td>{{ $shop?->email }}</td>

                                                </tr>

                                                <tr>
                                                    <td>Phone</td>
                                                    <td>{{ $shop?->phone }}</td>

                                                </tr>



                                        </tbody>
                                    </table>
                                </div>
                                <div class="row text-right">
                                    <div class="col-12">
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target=".bd-update-shop">Update Shop Details</button>
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target=".bd-inventory-upload">Add Inventory</button>
                                    </div>
                                </div>
                            @endif




                        </div>
                    </div>
                </div>





            </div>
        </div>
    </div>


    @if ($shop==null)
    <div class="modal fade bd-create-shop" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">

            <form action="{{ route('user.shop.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Shop Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 col-sm-12 mb-3">
                                <label for="name" class="required">Shop Name</label>
                                <input type="text" required class="form-control required" id="name" name="name"
                                    placeholder="John" value="{{ auth()->user()->last_name }}">
                            </div>


                            <div class="col-md-6 col-sm-12 mb-3">
                                <label for="email" class="required">Shop Email</label>
                                <input type="text" required class="form-control required" id="email" name="email"
                                    placeholder="Doe" value="{{ auth()->user()->email }}">
                            </div>

                            <div class="col-md-6 col-sm-12 mb-3">
                                <label for="phone" class="required">Shop Phone</label>
                                <input type="text" required class="form-control required" id="phone" name="phone"
                                    placeholder="+92 311 1122334" value="{{ auth()->user()->profile->phone }}">
                            </div>
                            <div class="col-md-6 col-sm-12 mb-3">
                                <label for="website" class="required">Shop Website</label>
                                <input type="url" required class="form-control required" id="website" name="website"
                                    placeholder="http://" value="{{ auth()->user()->profile->website }}">
                            </div>


                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 mb-3">
                                <label for="address" class="required">Shop Address</label>
                                <textarea required class="form-control required" id="address" name="address" placeholder="Shop Address"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Create Shop</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
    @else
    <div class="modal fade bd-update-shop" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">

            <form action="{{ route('user.shop.update',$shop->slug) }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Shop Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 col-sm-12 mb-3">
                                <label for="name" class="required">Shop Name</label>
                                <input type="text" required class="form-control required" id="name"
                                    name="name" placeholder="John" value="{{ $shop->name }}">
                            </div>


                            <div class="col-md-6 col-sm-12 mb-3">
                                <label for="email" class="required">Shop Email</label>
                                <input type="text" required class="form-control required" id="email"
                                    name="email" placeholder="Doe" value="{{ $shop->email }}">
                            </div>

                            <div class="col-md-6 col-sm-12 mb-3">
                                <label for="phone" class="required">Shop Phone</label>
                                <input type="text" required class="form-control required" id="phone"
                                    name="phone" placeholder="+92 311 1122334"
                                    value="{{ $shop->phone }}">
                            </div>
                            <div class="col-md-6 col-sm-12 mb-3">
                                <label for="website" class="required">Shop Website</label>
                                <input type="url" required class="form-control required" id="website"
                                    name="website" placeholder="http://" value="{{ $shop->website }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 mb-3">
                                <label for="address" class="required">Shop Address</label>
                                <textarea required class="form-control required" id="address" name="address" placeholder="Shop Address">{{ $shop->address }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update Shop</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <div class="modal fade bd-inventory-upload" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form action="{{ route('user.shop.update',$shop->slug) }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 col-sm-12 mb-3">
                                <label for="name" class="required">Name</label>
                                <input type="text" required class="form-control required" id="name"
                                    name="name" placeholder="Product Name" value="">
                            </div>



                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 mb-3">
                                <label for="address" class="required">Shop Address</label>
                                <textarea required class="form-control required" id="address" name="address" placeholder="Shop Address">{{ auth()->user()->shop->address }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update Shop</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
    @endif
@endsection


@section('scripts')

@endsection

@push('js')
@endpush
