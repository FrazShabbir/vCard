@extends('backend.main')
@section('title', 'Edit User - vCards')

@section('styles')
@endsection

@push('css')
@endpush



@section('content')
    <div id="content-page" class="content-page">
        <div class="container-fluid">
            <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                {{ @method_field('PUT') }}
                <div class="row">
                    <div class="col-sm-12">
                        <div class="iq-card">
                            <div class="iq-card-header d-flex justify-content-between">
                                <div class="iq-header-title">
                                    <h4 class="card-title">Edit User</h4>
                                </div>
                            </div>
                            <div class="iq-card-body px-4">

                                <div class="row">
                                    <div class="col-md-6 col-sm-12 mb-3">
                                        <label for="first_name" class="required">First Name </label>
                                        <input type="text" class="form-control" required name="first_name"
                                            placeholder="e.g. Ali" value="{{ $user->first_name }}">
                                    </div>
                                    <div class="col-md-6 col-sm-12 mb-3">
                                        <label for="last_name" class="required">Last Name</label>
                                        <input type="text" class="form-control" required name="last_name"
                                            placeholder="e.g. Raza" value="{{ $user->last_name }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12 mb-3">
                                        <label class="required" for="username">Username:</label>
                                        <input type="text" class="form-control" id="username" name="username"
                                            placeholder="e.g. aliraza12" required value="{{ $user->username }}">
                                    </div>
                                    <div class="col-md-6 col-sm-12 mb-3">
                                        <label class="required" for="email">Email address:</label>
                                        <input type="email" required class="form-control" id="email" name="email"
                                            placeholder="e.g. abc@email.com" value="{{ $user->email }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 col-sm-12 mb-3">
                                        <label class="required" for="organization">Organization:</label>
                                        <input type="text" required class="form-control" id="organization"
                                            name="organization" placeholder="e.g. aliraza12"
                                            value="{{ $user->organization }}">
                                    </div>
                                    <div class="col-md-6 col-sm-12 mb-3">
                                        <label class="required" required for="designation">Designation</label>
                                        <input type="designation" class="form-control" id="designation" name="designation"
                                            placeholder="e.g. CEO" value="{{ $user->designation }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 col-sm-12 mb-3">
                                        <label class="required" for="phone">phone:</label>
                                        <input type="text" required class="form-control" id="phone" name="phone"
                                            placeholder="e.g. aliraza12" value="{{ $user->phone }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 mb-3">
                                        <label class="required" for="bio">Bio:</label>
                                        <textarea required class="form-control" id="bio" name="bio" placeholder="e.g. aliraza12">{{ $user->bio }}</textarea>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-12 col-sm-12 mb-3">
                                        <label class="required" for="address">Address:</label>
                                        <textarea required class="form-control" id="address" name="address" placeholder="e.g. aliraza12">{{ $user->address }}</textarea>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 col-sm-12 mb-3">
                                        <div class="form-group">
                                            <p class="required">Avatar</p>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="avatar"
                                                    id="avatar">
                                                <label class="custom-file-label" for="image">Choose Avatar
                                                    (.png,.jpeg,jpg)</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12 mb-3">
                                        <img src="{{ asset($user->avatar ?? 'frontend/assets/images/logo-dark.png') }}"
                                            alt="{{ $user->username }}" class="img-fluid" style="max-width:200px;">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 col-sm-12 mb-3">
                                        <div class="form-group">
                                            <p class="required">Cover Image </p>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="cover_image"
                                                    id="cover">
                                                <label class="custom-file-label" for="image">Choose Cover Image
                                                    (.png,.jpeg,jpg)</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12 mb-3">
                                        <img src="{{ asset($user->cover_image ?? 'frontend/assets/images/logo-dark.png') }}"
                                            alt="{{ $user->username }}" class="img-fluid" style="max-width:200px;">
                                    </div>
                                </div>

                                <div class="mt-5">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-2 col-sm-12">
                                            <div class="mt-2 mb-3">
                                                <h4 class="required">
                                                    Access Level:
                                                </h4>
                                            </div>
                                        </div>
                                        <div class="col-gl-10 col-md-10 col-sm-12">
                                            <div class="row">
                                                <select name="roles[]" id="" class="form-control">
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role->id }}"
                                                            {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                                            {{ $role->name }}</option>
                                                    @endforeach
                                                </select>
                                                {{-- @foreach ($roles as $role)
                                                    <div class="col-md-3 col-sm-12">
                                                        <div class="custom-control custom-checkbox mb-3">
                                                            <input type="checkbox" name="roles[]"
                                                                class="custom-control-input"
                                                                {{ $user->hasRole($role->name) ? 'checked' : '' }}
                                                                id="{{ $role->name }}" value="{{ $role->name }}">
                                                            <label class="custom-control-label" for="{{ $role->name }}">
                                                                {{ ucfirst($role->name) }}</label>

                                                        </div>
                                                    </div>
                                                @endforeach --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-5 mb-4">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-2 col-sm-12">
                                            <div class="mt-2 mb-3">
                                                <h4 class="required">
                                                    User Status
                                                </h4>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-12">
                                            <div class="form-group">
                                                {{-- <label for="exampleFormControlSelect1">Select Input</label> --}}
                                                <select class="form-control" id="exampleFormControlSelect1"
                                                    name="status" required>
                                                    <option selected="" disabled="">Select Status</option>
                                                    <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>
                                                        Active
                                                    </option>
                                                    <option value="0" {{ $user->status == 0 ? 'selected' : '' }}>In
                                                        Active
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary mr-3">Update Data</button>
                                <a href="{{ route('users.index') }}" class="btn iq-bg-danger mr-3">Cancel</a>
                                <a href="{{ route('users.reset_password', $user->id) }}" class="btn iq-bg-info">Send Reset
                                    Password Mail</a>
                                <button type="button" class="btn btn-info" data-toggle="modal"data-target=".bd-example-modal-sm">Reset Password</button>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="iq-card">
                            <div class="iq-card-header d-flex justify-content-between">
                                <div class="iq-header-title">
                                    <h4 class="card-title">Social Media Accounts</h4>
                                </div>
                            </div>
                            <div class="iq-card-body px-4">

                                <div class="row">
                                    <div class="col-md-4 col-sm-12 mb-3">
                                        <label for="name" class="required">Name/Type</label>
                                        <input type="text" class="form-control" name="name"
                                            placeholder="e.g. Facebook" value="">
                                    </div>
                                    <div class="col-md-4 col-sm-12 mb-3">
                                        <label for="link" class="required">Url/Link</label>
                                        <input type="text" class="form-control" name="link"
                                            placeholder="e.g. https://" value="">
                                    </div>
                                    <div class="col-md-4 col-sm-12 mb-3">
                                        <label for="icon" class="required">Icon</label>
                                        <select name="icon" id="" class="form-control">
                                            <option value="la-th-list"><i class="las la-th-list"></i> Website</option>
                                            <option value="la-th-list"><i class="las la-th-list"></i> Facebook</option>
                                            <option value="la-th-list"><i class="las la-th-list"></i> Instagram</option>
                                            <option value="la-th-list"><i class="las la-th-list"></i> Youtube</option>
                                        </select>
                                    </div>
                                </div>


                                <div id="websites">

                                </div>

                                <div class="row">
                                    <div class="col-12 text-right">
                                        <button class="btn btn-primary " onclick="add_website()" type="button">+
                                            Website
                                        </button>
                                    </div>
                                </div>



                                <button type="submit" class="btn btn-primary mr-3">Update Data</button>

                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" style="display: none;"
        aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('users.update.password') }}" method="POST">
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="pwd">Password:</label>
                            <input type="text" class="form-control" id="password" name="password">
                        </div>
                        <div class="form-group">
                            <label for="pwd">C.Password:</label>
                            <input type="text" class="form-control" id="password_confirmation" name="password_confirmation">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection


@section('scripts')
@endsection

@push('js')
    <script>
        function add_website() {
            id = "w" + (Math.random() + 1).toString(36).substring(7);
            template = `
            <div class="row"  id="${id}">
            <div class="col-md-4 col-sm-12 mb-3">
                                        <label for="name" class="required">Name/Type</label>
                                        <input type="text" class="form-control" name="name"
                                            placeholder="e.g. Facebook" value="">
                                    </div>
                                    <div class="col-md-4 col-sm-12 mb-3">
                                        <label for="link" class="required">Url/Link</label>
                                        <input type="text" class="form-control" name="link"
                                            placeholder="e.g. https://" value="">
                                    </div>
                                    <div class="col-md-3 col-sm-12 mb-3">
                                        <label for="icon" class="required">Icon</label>
                                        <select name="icon" id="" class="form-control">
                                            <option value="la-th-list"><i class="las la-th-list"></i> Website</option>
                                            <option value="la-th-list"><i class="las la-th-list"></i> Facebook</option>
                                            <option value="la-th-list"><i class="las la-th-list"></i> Instagram</option>
                                            <option value="la-th-list"><i class="las la-th-list"></i> Youtube</option>
                                        </select>
                                    </div>
                                    <div class="col-md-1 col-sm-12 mb-3">
                                        <span class="float-right" onclick="remove(${id})"><i class="fa fa-minus-circle fa-lg text-danger"></i></span>
                                    </div>
                                    </div>`;


            $("#websites").append(template);
        }

        function remove(id) {
            console.log(id);
            id.remove();
        }

        function removeById(id) {
            console.log(id);
            $("#" + id).remove();
        }
    </script>
@endpush
