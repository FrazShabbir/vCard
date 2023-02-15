<!DOCTYPE html>
<html lang="en">

<head>

    <!-- meta tags -->
    <meta charset="utf-8">
    <meta name="keywords" content="bootstrap 5, premium, multipurpose, sass, scss, saas" />
    <meta name="description" content="Bootstrap 5 Landing Page Template" />
    <meta name="author" content="www.themeht.com" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Title -->
    <title>vCards - Create New Account</title>

    <!-- Favicon Icon -->
    <link rel="shortcut icon" href="{{asset('frontend/assets/favicon.png')}}" />

    <!-- inject css start -->

    <!--== bootstrap -->
    <link href="{{ asset('frontend/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />

    <!--== animate -->
    <link href="{{ asset('frontend/assets/css/animate.css') }}" rel="stylesheet" type="text/css" />

    <!--== line-awesome -->
    <link href="{{ asset('frontend/assets/css/line-awesome.min.css') }}" rel="stylesheet" type="text/css" />

    <!--== magnific-popup -->
    <link href="{{ asset('frontend/assets/css/magnific-popup.css') }}" rel="stylesheet" type="text/css" />

    <!--== owl.carousel -->
    <link href="{{ asset('frontend/assets/css/owl.carousel.css') }}" rel="stylesheet" type="text/css" />

    <!--== spacing -->
    <link href="{{ asset('frontend/assets/css/spacing.css') }}" rel="stylesheet" type="text/css" />

    <!--== theme.min -->
    <link href="{{ asset('frontend/assets/css/theme.min.css') }}" rel="stylesheet" />

    <!-- inject css end -->

</head>

<body>

    <!-- page wrapper start -->

    <div class="page-wrapper">

        <!-- preloader start -->

        @include('frontend.partial._preloader')


        <!-- preloader end -->


        <!--header start-->

        @include('frontend.partial._navbar')


        <!--hero section start-->

        <section class="hero-banner position-relative custom-pt-1 custom-pb-2 bg-dark"
            data-bg-img="{{ asset('frontend/assets/images/bg/02.png') }}')}}">
            <div class="container">
                <div class="row text-white text-center z-index-1">
                    <div class="col">
                        <h1 class="text-white">Create New Account</h1>
                        <nav aria-label="breadcrumb">

                        </nav>
                    </div>
                </div>
                <!-- / .row -->
            </div>
            <!-- / .container -->
            <div class="shape-1 bottom">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                    <path fill="#fff" fill-opacity="1"
                        d="M0,288L48,288C96,288,192,288,288,266.7C384,245,480,203,576,208C672,213,768,267,864,245.3C960,224,1056,128,1152,96C1248,64,1344,96,1392,112L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
                    </path>
                </svg>
            </div>
        </section>

        <!--hero section end-->


        <!--body content start-->

        <div class="page-content">

            <!--login start-->
            <section class="register">
                <div class="container">
                    <div class="row justify-content-center text-center">
                        <div class="col-lg-8 col-md-12">
                            <div class="mb-5">
                                <h2><span class="font-w-4">Simple And</span> Easy To Sign Up</h2>
                                <p class="lead">We use the latest technologies it voluptatem accusantium doloremque
                                    laudantium, totam rem aperiam.</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @if (count($errors) > 0)
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ $error }}
                                </div>
                            @endforeach
                        @endif
                        @if (Session::has('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ Session::get('error') }}
                            </div>
                        @endif
                        <div class="col-lg-8 col-md-10 ms-auto me-auto">
                            <div class="register-form text-center">
                                <form id="" method="post" action="{{ route('contact.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="slug" value="{{$slug}}">
                                    <div class="messages"></div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input id="form_name_fname" type="text" name="first_name"
                                                    class="form-control" placeholder="First name" required="required"
                                                    data-error="First Name is required.">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input id="form_name_lname" type="text" name="last_name"
                                                    class="form-control" placeholder="Last name" required="required"
                                                    data-error="Last Name is required.">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input id="form_name_number" type="text" name="phone"
                                                    class="form-control" placeholder="+92-------" required="required"
                                                    data-error="Phone is required.">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <select name="type" id="" class="form-control">
                                                    <option value="">Select Account Type</option>
                                                    <option value="personal">Personal</option>
                                                    <option value="business">Business</option>
                                                </select>
                                                {{-- <input id="form_name" type="text" name="last_name"
                                                    class="form-control" placeholder="Last name" required="required"
                                                    data-error="Last Name is required."> --}}
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input id="form_name_email" type="text" name="email" class="form-control"
                                                    placeholder="email@mail.com" required="required"
                                                    data-error="Email is required.">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input id="form_password" type="password" name="password"
                                                    class="form-control" placeholder="Password" required="required"
                                                    data-error="password is required.">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group_password">
                                                <input id="form_password1" type="password"
                                                    name="password_confirmation" class="form-control"
                                                    placeholder="Confirm Password" required="required"
                                                    data-error="Conform Password is required.">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-md-12">
                                            <div class="remember-checkbox clearfix mb-4">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input float-none"
                                                        id="customCheck1" name="terms">
                                                    <label class="form-check-label" for="customCheck1">I agree to the
                                                        term of use and privacy policy</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <button type="submit" class="btn btn-primary">Create Account</button>
                                            <span class="mt-4 d-block">Have An Account ? <a
                                                    href="{{ route('login') }}"><i>Sign
                                                        In!</i></a></span>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!--login end-->


            <!--newsletter start-->

            @include('frontend.partial.newsletter')


            <!--newsletter end-->

        </div>

        <!--body content end-->


        <!--footer start-->

        @include('frontend.partial._footer')

        <!--footer end-->

    </div>

    <!-- page wrapper end -->


    <!--back-to-top start-->

    <div class="scroll-top"><a class="smoothscroll" href="#top">Scroll Top</a></div>

    <!--back-to-top end-->

    <!-- inject js start -->

    <!--== jquery -->
    <script src="{{ asset('frontend/assets/js/jquery.min.js') }}"></script>

    <!--== bootstrap -->
    <script src="{{ asset('frontend/assets/js/bootstrap.bundle.min.js') }}"></script>

    <!--== owl-carousel -->
    <script src="{{ asset('frontend/assets/js/owl.carousel.min.js') }}"></script>

    <!--== magnific-popup -->
    <script src="{{ asset('frontend/assets/js/jquery.magnific-popup.min.js') }}"></script>

    <!--== counter -->
    <script src="{{ asset('frontend/assets/js/counter.js') }}"></script>

    <!--== countdown -->
    <script src="{{ asset('frontend/assets/js/jquery.countdown.min.js') }}"></script>

    <!--== particles -->
    <script src="{{ asset('frontend/assets/js/particles.js') }}"></script>

    <!--== typer -->
    <script src="{{ asset('frontend/assets/js/typer.js') }}"></script>

    <!--== wow -->
    <script src="{{ asset('frontend/assets/js/wow.min.js') }}"></script>

    <!--== theme-script -->
    <script src="{{ asset('frontend/assets/js/theme-script.js') }}"></script>

    <!-- inject js end -->

</body>


</html>
