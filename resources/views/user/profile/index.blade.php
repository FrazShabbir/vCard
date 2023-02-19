@extends('user.main')
@section('title', 'My Profile - vCards.pk')

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
                                <h4 class="card-title">My Profile</h4>
                            </div>
                        </div>
                        <div class="iq-card-body px-4">
                            <form action="{{ route('user.profile.save') }}" method="POST">
                                @csrf
                                {{ @method_field('PUT') }}
                                <div class="row">
                                    <div class="col-md-6 col-sm-12 mb-3">
                                        <label for="first_name">First Name</label>
                                        <input type="text" class="form-control" name="first_name" placeholder="e.g. Ali"
                                            value="{{ Auth::user()->first_name }}">
                                    </div>
                                    <div class="col-md-6 col-sm-12 mb-3">
                                        <label for="last_name">Last Name</label>
                                        <input type="text" class="form-control" name="last_name" placeholder="e.g. Raza"
                                            value="{{ Auth::user()->last_name }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12 mb-3">
                                        <label for="username">Username:</label>
                                        <input type="text" class="form-control" id="username" name="username"
                                            placeholder="e.g. aliraza12" value="{{ Auth::user()->username }}" disabled>
                                    </div>
                                    <div class="col-md-6 col-sm-12 mb-3">
                                        <label for="email">Email address:</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="e.g. abc@email.com" value="{{ Auth::user()->email }}">
                                    </div>
                                </div>


                                <div class="mt-5 mb-4">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-2 col-sm-12">
                                            <div class="mt-2 mb-3">
                                                <h4>
                                                    Your Status
                                                </h4>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-12">
                                            <div class="form-group">
                                                {{-- <label for="exampleFormControlSelect1">Select Input</label> --}}
                                                <input type="text" class="form-control" disabled id="status"
                                                    @if (Auth::user()->status == 1) value="Active" @else value="Suspended" @endif>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row text-right">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary mr-3">Update</button>
                                        <a href="{{ route('users.index') }}" class="btn iq-bg-danger">Cancel</a>
                                   
                                    </div>
                                </div>
                            </form>

                            {!! QrCode::eye('circle')->size(200)->generate(env('APP_URL').auth()->user()->username); !!}
                        </div>
                    </div>
                </div>


                <div class="col-sm-12">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">My Profile</h4>
                            </div>
                        </div>
                        <div class="iq-card-body px-4">
                            <form action="{{ route('user.profile.save') }}" method="POST">
                                @csrf
                                {{ @method_field('PUT') }}

                                <div class="row">
                                    <div class="col-md-6 col-sm-12 mb-3">
                                        <label for="organization">Organization</label>
                                        <input type="text" class="form-control" name="organization" placeholder="e.g. Google"
                                            value="{{ Auth::user()->profile->organization }}">
                                    </div>

                                    <div class="col-md-6 col-sm-12 mb-3">
                                        <label for="designation">Designation</label>
                                        <input type="text" class="form-control" name="designation" placeholder="e.g. Engineer"
                                            value="{{ Auth::user()->profile->designation }}">
                                    </div>
                                  
                                </div>


                                <div class="row">
                                    <div class="col-md-6 col-sm-12 mb-3">
                                        <label for="website">Website</label>
                                        <input type="url" class="form-control" name="website" placeholder="e.g. https://google.com"
                                            value="{{ Auth::user()->profile->website }}">
                                    </div>

                                
                                  
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-12 mb-3">
                                        <label for="bio">BIO</label>
                                        <textarea  class="form-control" name="bio" placeholder="e.g. Tell about yourself.">{{ Auth::user()->profile->address }}</textarea>
                                    </div>
                                  
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-12 mb-3">
                                        <label for="address">Address</label>
                                        <textarea  class="form-control" name="address" placeholder="e.g. Lahore">{{ Auth::user()->profile->address }}</textarea>
                                    </div>
                                  
                                </div>
                             

                                
                               
                                <div class="row text-right">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary mr-3">Update</button>
                                        <a href="{{ route('users.index') }}" class="btn iq-bg-danger">Cancel</a>
                                   
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>


                <div class="col-sm-12">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                           <div class="iq-header-title">
                              <h4 class="card-title">Media</h4>
                           </div>
                        </div>
                        <div class="iq-card-body px-4">
                           <form action="" method="POST" enctype="multipart/form-data">
                            @csrf
                            {{@method_field('post')}}
                           
        
                             <div class="row">
                                <div class="col-md-6 col-sm-12 mb-3">
                                    <div class="form-group">
                                        <p class="required">Profile Picture</p>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="image"
                                                id="logo" required>
                                            <label class="custom-file-label" for="image">Choose Profile Picture
                                                (.png,.jpeg,jpg)</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 mb-3">
                                    <img src="{{asset(auth()->user()->avatar)}}" alt="Avatar" class="img-fluid" style="max-width: 200px">
                                </div>
                            
                            </div>
        
        
        
                            <div class="row">
                                <div class="col-md-6 col-sm-12 mb-3">
                                    <div class="form-group">
                                        <p class="required">Profile Banner</p>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="image"
                                                id="data_image" required >
                                            <label class="custom-file-label" for="image">Choose Profile Banner
                                                (.png,.jpeg,jpg)</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 mb-3">
                                
                                    <img id="uploadedImage_data_image" class="img-preview img_modal width_400 img-fluid"
                                    src="{{asset(auth()->user()->profile->cover_image)}}"
                                    alt="" accept="image/png, image/jpeg" >

                                </div>
                            
                            </div>

        

                        

                              <button type="submit" class="btn btn-primary mr-3">Submit</button>
                              <a href="{{route('users.index')}}" class="btn iq-bg-danger">Cancel</a>
                           </form>
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

<script>
    document.getElementById('data_image').addEventListener('change', function() {
        if (this.files[0]) {
            var picture = new FileReader();
            picture.readAsDataURL(this.files[0]);
            picture.addEventListener('load', function(event) {
                document.getElementById('uploadedImage_data_image').setAttribute('src',
                    event.target.result);
                document.getElementById('uploadedImage_data_image').style.display =
                    'block';
            });
        }
    });
</script>

@endpush
