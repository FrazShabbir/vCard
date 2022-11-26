@extends('backend.main')
@section('title', 'Edit User - CyberTag')

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
                                        <input type="text" class="form-control" required name="first_name" placeholder="e.g. Ali"
                                            value="{{ $user->first_name }}">
                                    </div>
                                    <div class="col-md-6 col-sm-12 mb-3">
                                        <label for="last_name" class="required">Last Name</label>
                                        <input type="text" class="form-control" required name="last_name" placeholder="e.g. Raza"
                                            value="{{ $user->last_name }}">
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
                                        <input type="text" required class="form-control" id="organization" name="organization"
                                            placeholder="e.g. aliraza12" value="{{ $user->organization }}">
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
                                        <textarea  required class="form-control" id="bio" name="bio" placeholder="e.g. aliraza12">{{ $user->bio }}</textarea>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-12 col-sm-12 mb-3">
                                        <label class="required" for="address">Address:</label>
                                        <textarea  required class="form-control" id="address" name="address" placeholder="e.g. aliraza12">{{ $user->address }}</textarea>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 col-sm-12 mb-3">
                                        <div class="form-group">
                                            <p class="required">Avatar</p>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="avatar"
                                                    id="avatar" >
                                                <label class="custom-file-label" for="image">Choose Avatar (.png,.jpeg,jpg)</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12 mb-3">
                                        <img src="{{ asset($user->avatar ?? 'frontend/assets/images/logo-dark.png') }}"
                                            alt="{{$user->username}}" class="img-fluid" style="max-width:200px;">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 col-sm-12 mb-3">
                                        <div class="form-group">
                                            <p class="required">Cover Image </p>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="cover_image"
                                                    id="cover" >
                                                <label class="custom-file-label" for="image">Choose Cover Image
                                                    (.png,.jpeg,jpg)</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12 mb-3">
                                        <img src="{{ asset($user->cover_image ?? 'frontend/assets/images/logo-dark.png') }}"
                                        alt="{{$user->username}}" class="img-fluid" style="max-width:200px;">
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
                                <a href="{{ route('users.reset_password', $user->id) }}" class="btn iq-bg-info">Reset
                                    Password</a>

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
                                    <div class="col-md-6 col-sm-12 mb-3">
                                        <label for="facebook" class="required">Facebook</label>
                                        <input type="text" class="form-control" name="facebook"
                                            placeholder="e.g. Ali" value="{{ $user->facebook }}">
                                    </div>

                                    <div class="col-md-6 col-sm-12 mb-3">
                                        <label for="instagram" class="required">Instagram</label>
                                        <input type="text" class="form-control" name="instagram"
                                            placeholder="e.g. Raza" value="{{ $user->instagram }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 col-sm-12 mb-3">
                                        <label for="twitter" class="required">Twitter</label>
                                        <input type="text" class="form-control" name="twitter"
                                            placeholder="e.g. Ali" value="{{ $user->twitter }}">
                                    </div>

                                    <div class="col-md-6 col-sm-12 mb-3">
                                        <label for="youtube" class="required">Youtube</label>
                                        <input type="text" class="form-control" name="youtube"
                                            placeholder="e.g. Raza" value="{{ $user->youtube }}">
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6 col-sm-12 mb-3">
                                        <label for="google" class="required">Google</label>
                                        <input type="text" class="form-control" name="google"
                                            placeholder="e.g. Ali" value="{{ $user->google }}">
                                    </div>

                                    <div class="col-md-6 col-sm-12 mb-3">
                                        <label for="linkedin" class="required">Linkedin</label>
                                        <input type="text" class="form-control" name="linkedin"
                                            placeholder="e.g. Raza" value="{{ $user->linkedin }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12 mb-3">
                                        <label for="pinterest" class="required">Pinterest</label>
                                        <input type="text" class="form-control" name="pinterest"
                                            placeholder="e.g. Ali" value="{{ $user->pinterest }}">
                                    </div>

                                    <div class="col-md-6 col-sm-12 mb-3">
                                        <label for="tiktok" class="required">Tiktok</label>
                                        <input type="text" class="form-control" name="tiktok"
                                            placeholder="e.g. Raza" value="{{ $user->tiktok }}">
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
@endsection


@section('scripts')
@endsection

@push('js')
@endpush
