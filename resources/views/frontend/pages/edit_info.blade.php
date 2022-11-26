@extends('frontend.main')
@section('title', getFullNameById($profile->id).' | Edit')

@section('styles')
@endsection

@push('css')
    <style>
        /* Upload Image */
        .avatar-upload {
            position: relative;
            max-width: 205px;
            margin: 50px auto;
        }

        .avatar-upload .avatar-edit {
            position: absolute;
            right: 12px;
            z-index: 1;
            top: 10px;
        }

        .avatar-upload .avatar-edit input {
            display: none;
        }
        .has-error {
            color: #a94442;
            border: 1px solid red; 
            
        }   

        .avatar-upload .avatar-edit input+label {
            display: inline-block;
            width: 34px;
            height: 34px;
            margin-bottom: 0;
            border-radius: 100%;
            background: #FFFFFF;
            border: 1px solid transparent;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
            cursor: pointer;
            font-weight: normal;
            transition: all 0.2s ease-in-out;
        }

        .avatar-upload .avatar-edit input+label:hover {
            background: #f1f1f1;
            border-color: #d6d6d6;
        }

        .avatar-edit label i {
            padding: 8px 6px 6px 6px;
        }

        /* .avatar-upload .avatar-edit input+label:after {
                content: "\f040";
                font-family: 'FontAwesome';
                color: #757575;
                position: absolute;
                top: 10px;
                left: 0;
                right: 0;
                text-align: center;
                margin: auto;
            } */

        .avatar-upload .avatar-preview {
            width: 192px;
            height: 192px;
            position: relative;
            border-radius: 100%;
            border: 6px solid #F8F8F8;
            /* box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1); */
            box-shadow: 0 0 5px 0 var(--purple);
        }

        .avatar-upload .avatar-preview>div {
            width: 100%;
            height: 100%;
            border-radius: 100%;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }














        .banner-upload {
            position: relative;
            max-width: 205px;
            margin: 50px auto;
        }

        .banner-upload .banner-edit {
            position: absolute;
            right: 12px;
            z-index: 1;
            top: 10px;
        }

        .banner-upload .banner-edit input {
            display: none;
        }

        .banner-upload .banner-edit input+label {
            display: inline-block;
            width: 34px;
            height: 34px;
            margin-bottom: 0;
            border-radius: 100%;
            background: #FFFFFF;
            border: 1px solid transparent;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
            cursor: pointer;
            font-weight: normal;
            transition: all 0.2s ease-in-out;
        }

        .banner-upload .banner-edit input+label:hover {
            background: #f1f1f1;
            border-color: #d6d6d6;
        }

        .banner-edit label i {
            padding: 8px 6px 6px 6px;
        }

        /* .banner-upload .banner-edit input+label:after {
                content: "\f040";
                font-family: 'FontAwesome';
                color: #757575;
                position: absolute;
                top: 10px;
                left: 0;
                right: 0;
                text-align: center;
                margin: auto;
            } */

        .banner-upload .banner-preview {
            max-width: 550px;
            height: 192px;
            position: relative;
            border-radius: 10%;
            border: 6px solid #F8F8F8;
            /* box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1); */
            box-shadow: 0 0 5px 0 var(--purple);
        }

        .banner-upload .banner-preview>div {
            max-width: 550px;
            height: 100%;
            border-radius: 10%;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }



        /* End Upload Image */





        /* body {
                    margin-top:40px;
                } */
        .stepwizard-step p {
            margin-top: 10px;
        }

        .stepwizard-row {
            display: table-row;
        }

        .stepwizard {
            display: table;
            width: 100%;
            position: relative;
        }

        .stepwizard-step button[disabled] {
            opacity: 1 !important;
            filter: alpha(opacity=100) !important;
        }

        /* .stepwizard-row:before {
                    top: 14px;
                    bottom: 0;
                    position: absolute;
                    content: " ";
                    width: 100%;
                    height: 1px;
                    background-color: #ccc;
                    z-order: 0;
                } */
        .stepwizard-step {
            display: table-cell;
            text-align: center;
            position: relative;
        }

        .setup-content {
            display: block;
            /* width: 100% !important; */
        }

        .btn-circle {
            width: 30px;
            height: 30px;
            text-align: center;
            padding: 6px 0;
            font-size: 12px;
            line-height: 1.428571429;
            border-radius: 15px;
        }

        #sig-canvas {
            border: 2px dotted #CCCCCC;
            border-radius: 15px;
            cursor: crosshair;
        }

        .other_amount {
            display: none;
        }

        .relative_input_div {
            display: none;
        }




        @media only screen and (max-width: 576px) {
            .vcard_wizard_form {
                text-align: center;
            }
        }
    </style>
@endpush

@section('extra_class')
    contact-page-navbar
@endsection

@section('banner')
    {{-- <div class="map">
    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d196344.1371271128!2d-104.8616648!3d39.7424105!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x876c7eb83b813ed1%3A0x401bdfcb1ed16e1a!2sDenver%20Botanic%20Gardens!5e0!3m2!1sen!2s!4v1616253609220!5m2!1sen!2s" allowfullscreen="" loading="lazy"></iframe>

</div> --}}
@endsection
@section('content')
    {{-- Wizard Form --}}

    <section>
        <div class="container">

            <div class="stepwizard col-md-offset-3 mb-5">
                <div class="stepwizard-row setup-panel">
                    <div class="stepwizard-step">
                        <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
                        <p>Create Your Account</p>
                    </div>
                    <div class="stepwizard-step">
                        <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                        <p>Upload Image</p>
                    </div>
                    <div class="stepwizard-step">
                        <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                        <p>Add V-Card Information</p>
                    </div>
                </div>
            </div>

            @if (count($errors) > 0)
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                @foreach ($errors->all() as $error)
                    <strong>Error: </strong> {{ $error }}
                @endforeach
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        @endif

            <form class="vcard_wizard_form" role="form" action="{{route('contact.update',$profile->username)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row setup-content" id="step-1">
                    <div class="col-xs-6 col-md-offset-3">
                        <div class="col-md-12">
                            <h3 class="mb-5 text-center">Create Your Account</h3>
                            <div class="row">
                                <div class="col-lg-8 offset-lg-2">
                                    <div class="form-group mb-4">
                                        <label class="control-label">Email*</label>
                                        <input type="email" required class="form-control" name="email" id="email"
                                            placeholder="dummy@gmail.com" required value="{{$profile->email}}">
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="control-label">Password</label>
                                        <input type="password"  class="form-control" name="password" id="password">
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="control-label">Confirm Password</label>
                                        <input type="password"  class="form-control" name="password_confirmation"
                                            id="password_confirm">
                                    </div>
                              
                                    <div class="text-center">
                                        <button class="btn btn-primary px-5 rounded-pill nextBtn mb-5 pull-right"
                                        type="button">Next</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row setup-content" id="step-2">
                    <div class="col-xs-6 col-md-offset-3">
                        <div class="col-md-12">
                            <h3 class="mb-5 text-center">Upload Your Picture</h3>
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="mb-2 text-center">Profile Picture</h5>

                                </div>
                                <div class="col-12">
                                    <div class="avatar-upload">
                                        <div class="avatar-edit">
                                            <input type='file' id="imageUpload" name="avatar"
                                                accept=".png, .jpg, .jpeg" />
                                            <label for="imageUpload">
                                                <i class="fal fa-cloud-upload"></i>
                                            </label>
                                        </div>
                                        <div class="avatar-preview">
                                            <div id="imagePreview"
                                                style="background-image: url({{asset($profile->avatar)??'http://i.pravatar.cc/500?img=7'}});">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="mb-2 text-center">Card Background Picture</h5>

                                </div>
                                <div class="col-12">
                                    <div class="banner-upload">
                                        <div class="banner-edit">
                                            <input type='file' id="imageUpload_2" name="cover_image"
                                                accept=".png, .jpg, .jpeg" />
                                            <label for="imageUpload_2">
                                                <i class="fal fa-cloud-upload"></i>
                                            </label>
                                        </div>
                                        <div class="banner-preview">
                                            <div id="cover_image_preview"
                                            style="background-image: url({{asset($profile->cover_image)??'https://repository-images.githubusercontent.com/297085169/aee2a480-7e7e-11eb-9f34-aa943f1978ea'}});">
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-primary px-5 rounded-pill nextBtn mb-5 pull-right"
                                    type="button">Next</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row setup-content" id="step-3">
                    <div class="col-xs-6 col-md-offset-3">
                        <div class="col-md-12">
                            <h3 class="mb-5 text-center">Your V-Card Information</h3>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group mb-5">
                                        <label class="control-label">First Name</label>
                                        <input type="text" required class="form-control" name="first_name"
                                            id="first_name" placeholder="John"   value="{{$profile->first_name}}" >
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group mb-5">
                                        <label class="control-label">Last Name</label>
                                        <input type="text" required class="form-control" name="last_name"
                                            id="last_name" placeholder="Doe" value="{{$profile->last_name}}">
                                    </div>
                                </div>
                            </div>

                      
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group mb-5">
                                        <label class="control-label">Phone</label>
                                        <input type="text" required class="form-control" name="phone"
                                            id="phone" placeholder="01234567" value="{{$profile->phone}}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="form-group mb-5">
                                        <label class="control-label">Address</label>
                                        <textarea type="text" required class="form-control" name="address"
                                            id="address" placeholder="Add your Address">{{$profile->address}}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="form-group mb-5">
                                        <label class="control-label">Bio</label>
                                        <input type="text" required class="form-control" name="bio"
                                            id="bio" placeholder="Add your bio" value="{{$profile->bio}}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="form-group mb-5">
                                        <label class="control-label">Organization</label>
                                        <input type="text" required class="form-control" name="organization"
                                            id="organization" placeholder="Add your organization" value="{{$profile->organization}}">
                                    </div>
                                </div>
                                
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="form-group mb-5">
                                        <label class="control-label">Designation</label>
                                        <input type="text" required class="form-control" name="designation"
                                            id="Designation" placeholder="Add your Designation" value="{{$profile->designation}}">
                                    </div>
                                </div>
                             
                                
                            </div>
                            <h3 class="mb-5 text-center">Your Social Media Information</h3>

                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <label class="control-label">Instagram</label>
                                    <div class="input-group mb-5">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="instagram"><i class="color-purple fab fa-instagram" style="font-size: 10px;margin-right:2px"></i><span style="font-size: 10px">https://www.instagram.com/</span></span>
                                        </div>
                                        <input type="text"  class="form-control" value="{{$profile->instagram}}" name="instagram" id="instagram" placeholder="Instagram handle" aria-describedby="instagram">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <label class="control-label">Twitter</label>
                                    <div class="input-group mb-5">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="twitter"><i class="color-purple fab fa-twitter" style="font-size: 10px;margin-right:2px"></i><span style="font-size: 10px">https://www.twitter.com/</span></span>
                                        </div>
                                        <input type="text"  class="form-control" value="{{$profile->twitter}}" name="twitter" id="twitter" placeholder="twitter handle" aria-describedby="twitter">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <label class="control-label">Facebook</label>
                                    <div class="input-group mb-5">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="facebook"><i class="color-purple fab fa-facebook"style="font-size: 10px;margin-right:2px"></i><span style="font-size: 10px">https://www.facebook.com/</span></span>
                                        </div>
                                        <input type="text"  class="form-control" value="{{$profile->facebook}}" name="facebook" id="facebook" placeholder="facebook handle" aria-describedby="facebook">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <label class="control-label">Google</label>
                                    <div class="input-group mb-5">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="google"><i class="color-purple fab fa-google"style="font-size: 10px;margin-right:2px"></i><span style="font-size: 10px">https://www.google.com/</span></span>
                                        </div>
                                        <input type="text"  class="form-control" value="{{$profile->google}}" name="google" id="google" placeholder="google handle" aria-describedby="google">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <label class="control-label">Linkedin</label>
                                    <div class="input-group mb-5">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="linkedin"><i class="color-purple fab fa-linkedin"style="font-size: 10px;margin-right:2px"></i><span style="font-size: 10px">https://www.linkedin.com/</span> </span>
                                        </div>
                                        <input type="text"  class="form-control" value="{{$profile->linkedin}}" name="linkedin" id="linkedin" placeholder="linkedin handle" aria-describedby="linkedin">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <label class="control-label">Youtube</label>
                                    <div class="input-group mb-5">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="youtube"><i class="color-purple fab fa-youtube"style="font-size: 10px;margin-right:2px"></i><span style="font-size: 10px">https://www.youtube.com/</span> </span>
                                        </div>
                                        <input type="text"  class="form-control" value="{{$profile->youtube}}" name="youtube" id="youtube" placeholder="youtube handle" aria-describedby="youtube">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <label class="control-label">TikTok</label>
                                    <div class="input-group mb-5">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="tiktok"><i class="color-purple fab fa-tiktok"style="font-size: 10px;margin-right:2px"></i><span style="font-size: 10px">https://www.tiktok.com/</span> </span>
                                        </div>
                                        <input type="text"  class="form-control" value="{{$profile->tiktok}}" name="tiktok" id="tiktok" placeholder="tiktok handle" aria-describedby="tiktok">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <label class="control-label">Pinterest</label>
                                    <div class="input-group mb-5">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="pinterest"><i class="color-purple fab fa-pinterest"style="font-size: 10px;margin-right:2px"></i><span style="font-size: 10px">https://www.pinterest.com/</span> </span>
                                        </div>
                                        <input type="text"  class="form-control" value="{{$profile->pinterest}}" name="pinterest" id="pinterest" placeholder="pinterest handle" aria-describedby="pinterest">
                                    </div>
                                </div>
                            </div>

                            <div class="text-center">
                                <button class="btn btn-success px-5 rounded-pill btn-lg pull-right" type="submit">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </section>
@endsection


@section('scripts')
@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            var navListItems = $('div.setup-panel div a'),
                allWells = $('.setup-content'),
                allNextBtn = $('.nextBtn');

            allWells.hide();

            navListItems.click(function(e) {
                e.preventDefault();
                var $target = $($(this).attr('href')),
                    $item = $(this);

                if (!$item.hasClass('disabled')) {
                    navListItems.removeClass('btn-primary').addClass('btn-default');
                    $item.addClass('btn-primary');
                    allWells.hide();
                    $target.show();
                    $target.find('input:eq(0)').focus();
                }
            });

            allNextBtn.click(function() {
                var curStep = $(this).closest(".setup-content"),
                    curStepBtn = curStep.attr("id"),
                    nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next()
                    .children("a"),
                    curInputs = curStep.find("input[type='file'],input[type='text'],input[type='email'],input[type='password'],input[type='checkbox'],input[type='url']"),
                    isValid = true;

                $(".form-group").removeClass("has-error");
                for (var i = 0; i < curInputs.length; i++) {
                    if (!curInputs[i].validity.valid) {
                        isValid = false;
                        $(curInputs[i]).closest(".form-control").addClass("has-error");
                    }
                }

                if (isValid)
                    nextStepWizard.removeAttr('disabled').trigger('click');
            });

            $('div.setup-panel div a.btn-primary').trigger('click');
        });
    </script>
    {{-- Upload Image --}}
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                    $('#imagePreview').hide();
                    $('#imagePreview').fadeIn(650);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#imageUpload").change(function() {
            readURL(this);
        });
    </script>
     <script>
        function readURL2(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#cover_image_preview').css('background-image', 'url(' + e.target.result + ')');
                    $('#cover_image_preview').hide();
                    $('#cover_image_preview').fadeIn(650);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#imageUpload_2").change(function() {
            readURL2(this);
        });
    </script>
@endpush
