<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->full_name }} - vCard</title>
    <!-- Fav Icon -->
    <link rel="shortcut icon" href="" type="image/x-icon">
    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="{{ asset('templates/template1/assets/css/bootstrap.min.css') }}">
    <!-- Font Awesome Style-Sheet -->
    <link rel="stylesheet" href="{{ asset('templates/template1/assets/css/all.css') }}">
    <!-- Owl Carsoule -->
    <link rel="stylesheet" href="{{ asset('templates/template1/assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('templates/template1/assets/css/owl.theme.default.min.css') }}">
    <!-- Custom Style-Sheet -->
    <link rel="stylesheet" href="{{ asset('templates/template1/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('templates/template1/assets/css/responsive.css') }}">
</head>

<body>

    <header>

    </header>

    <main>
        <section class="user-display-picture-sec">
            {{-- https://ui-avatars.com/api/?name=John+Doe --}}
            <div class="dp-box">
                <div class="backgound-box"
                    style="background-image: url({{ asset($profile->cover_image ?? 'uploads/cover_images/placeholder.png') }})">
                    <div class="dp-img-box">
                        <img src="{{ asset($profile->avatar ?? 'https://ui-avatars.com/api/?name=' . $user->full_name) }}"
                            alt="" style="max-width:200px">
                    </div>
                </div>
            </div>
            <div class="user-name-box">
                <h1>
                    {{ getFullNameById($user->id) }}
                </h1>
                <div class="user-tag-box">
                    <p class="tag">
                        {{ $profile->organization }}
                    </p>
                    <p class="tag">
                        {{ $profile->designation }}
                    </p>
                </div>
            </div>
            @if ($profile->primaryaddress)
                <a href="" class="user-address-box">

                    {{-- <img src="{{ asset('templates/template1/assets/images/Location.png') }}" alt=""> --}}
                    <p class="text">
                        {{ $profile->primaryaddress->city->name ?? '' }}
                    </p>

                    <i class="fal fa-circle"></i>

                    <p class="text">
                        {{ $profile->primaryaddress->state->name ?? '' }}
                    </p>
                    <i class="fal fa-circle"></i>
                    <p class="text">
                        {{ $profile->primaryaddress->country->name ?? '' }}
                    </p>
                </a>
            @endif


            <div class="save-contact-btn-box">
                <a href="{{ route('downloadVCard', $user->username) }}">
                    <img src="{{ asset('templates/template1/assets/images/download-icon.svg') }}" alt="">
                    Save Contact
                </a>
            </div>
        </section>
        <section class="user-about-me-sec">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="section-heading">
                            <h2>
                                About Me
                            </h2>
                        </div>
                        <div class="about-content">
                            <p class="text">
                                {{ $profile->bio ?? '' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @if ($profile->customlinks->count() > 0)


            <section class="user-checkme-out-sec">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="section-heading">
                                <h2>
                                    Check Me Out
                                </h2>
                            </div>
                        </div>
                        <div class="col-12">
                            @foreach ($profile->customlinks as $link)
                                <a class="check-me-link-box mb-3" href="{{ $link->link }}">
                                    <img src="{{ asset('templates/template1/assets/images/world.svg') }}"
                                        alt="">
                                    <span>
                                        {{ $link->platform->name ?? '' }}
                                    </span>
                                </a>
                            @endforeach


                        </div>
                    </div>
                </div>
            </section>
        @endif
        <section class="user-let-connect-sec">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-heading">
                            <h2>
                                Let’s Connect
                            </h2>
                        </div>
                        <div class="social-box">
                            @foreach ($profile->socials as $social)
                                <a href="{{ $social->shortlink?->shortlink }}" target="_blank">
                                    <img src="{{ asset('templates/template1/assets/images/image-1.svg') }}"
                                        alt="Social Link">
                                </a>
                            @endforeach

                            {{-- <a href="">
                                <img src="{{ asset('templates/template1/assets/images/image-2.svg') }}" alt="">
                            </a>
                            <a href="">
                                <img src="{{ asset('templates/template1/assets/images/image-3.svg') }}" alt="">
                            </a>
                            <a href="">
                                <img src="{{ asset('templates/template1/assets/images/image-4.svg') }}" alt="">
                            </a>
                            <a href="">
                                <img src="{{ asset('templates/template1/assets/images/image-5.svg') }}" alt="">
                            </a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <div class="footer-box">
            <p class="text">
                Powered by <a href="">vCard</a>
            </p>
        </div>
    </footer>

    <!-- Jquery CDN -->
    <script src="{{ asset('templates/template1/assets/js/jquery-3.7.1.min.js') }}"></script>
    <!-- Bootstrap CDN -->
    <script src="{{ asset('templates/template1/assets/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Owl Carsoul -->
    <script src="{{ asset('templates/template1/assets/js/owl.carousel.min.js') }}"></script>
    <!-- Cusotm Code -->
    <script src="{{ asset('templates/template1/assets/js/script.js') }}"></script>
</body>

</html>
