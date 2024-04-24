<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="EssentialSofts">
    <title>Vcard - For Samrt Patients</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('asset/css/font-awesome.css')}}">
    <link rel="stylesheet" href="{{asset('asset/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('asset/css/responsive.css')}}">
</head>
{{-- @dd($user) --}}
<body>
    <div class="body-wrapper">
        <header class="py-3">
            <div>
                <div class="d-flex">
                    <div class="">
                        <div class="">
                            <a href="http://essentialsofts.com">
                                <img width="80px" src="asset/images/logo.png" alt="Logo">
                            </a>
                        </div>
                    </div>
                    <div class="navigation">
                        <div class="">
                            <ul class="">
                                <li>
                                    <a href="" class="">
                                        <i class="far fa-share-alt"></i>
                                    </a>
                                </li>
                                <li class="me-0">
                                    <a href="" class="">
                                        <i class="far fa-qrcode"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Cover Photo -->
        <div class="">
            <img class="cover-img" src="{{ asset($profile->cover_image ?? 'https://demo.rajodiya.com/vcardgo-saas/storage/card_banner//banner16367162581410231106.png') }}" alt="">
        </div>
        <!-- Profile Photo / User Logo -->
        <div class="user-logo-div">
            <img class="user-logo" src="{{ asset($profile->avatar ?? 'https://www.treasury.gov.ph/wp-content/uploads/2022/01/male-placeholder-image.jpeg') }}" alt="">
        </div>
        <!-- User Detils -->
        <div class="user-detail-main-div">
            <div class="text-center">
                <h1 class="pb-2">
                    {{ getFullNameById($user->id) }}
                </h1>
                {{-- <div class="mb-3">
                    <span class="badge me-2 mb-2">
                        {{ $user->organization }}
                    </span>
                    <span class="badge me-2 mb-2">
                        Creator
                    </span>
                </div> --}}
                @if ($profile->organization || $profile->designation)
                <p>
                    {{ $profile->organization }}  @if ($profile->designation) | {{ $profile->designation }} @endif
                  </p>
                @endif

            </div>
            <div class="address-div text-center">
                <address class="px-2">
                    {{ $profile->address ??'-'}}
                </address>
                <p>
                    {{ $profile->bio }}
                </p>
            </div>
            <div class="px-5 mb-4 pt-5 pb-5">
                <a href="{{ route('downloadVCard', $user->username) }}" class="btn btn-primary w-100">
                    <i class="far fa-cloud-download me-2"></i> Save Contact
                </a>
            </div>
            <div class="container-fluid">
                <div class="row">
                    @if ($user->phone)
                    <div class="col-6">
                        <div class="">
                            <div class="text-center mb-5">
                                <a class="action-buttons mb-4" href="tel:{{$user->phone}}">
                                    <i class="far fa-phone-alt"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endif
                    {{-- <div class="col-4">
                        <div class="">
                            <div class="text-center mb-5">
                                <a class="action-buttons mb-4" href="">
                                    <i class="far fa-comments-alt"></i>
                                </a>
                            </div>
                        </div>
                    </div> --}}
                    @if ($user->email)
                    <div class="col-6">
                        <div class="">
                            <div class="text-center mb-5">
                                <a class="action-buttons mb-4" href="mailto:{{$user->email}}" title="Email">
                                    <i class="far fa-envelope"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endif
                    {{-- <div class="col-4 offset-2">
                        <div class="">
                            <div class="text-center mb-5">
                                <a class="action-buttons mb-4" href="">
                                    <i class="far fa-calendar-alt"></i>
                                </a>
                            </div>
                        </div>
                    </div> --}}
                    {{-- <div class="col-4">
                        <div class="">
                            <div class="text-center mb-5">
                                <a class="action-buttons mb-4" href="https://isaadahmad.com">
                                    <i class="far fa-globe"></i>
                                </a>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
        <!-- Social Links -->
        <div class="social_links_div">
            <h2 class="text-center">
                Social Connections
            </h2>
            <div>
                <ul>
                    @if ($user->facebook)
                    <li>
                        <a href="{{ $user->facebook }}">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    </li>
                    @endif
                    @if ($user->instagram)

                    <li>
                        <a href="{{ $user->instagram }}">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </li>
                    @endif
                    @if ($user->linkedin)

                    <li>
                        <a href="{{ $user->linkedin }}">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </li>
                    @endif
                    @if ($user->twitter)
                    <li>
                        <a href="{{ $user->twitter }}">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </li>
                    @endif
                    @if ($user->phone)
                    <li>
                        <a href="{{$user->phone}}">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
        <!-- Footer -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="text-center">
                            © <script>document.write(new Date().getFullYear());</script>, all rights reserved by <a class="copyright_link" href="https://essentialsofts.com">EssentialSofts</a>.
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
        crossorigin="anonymous"></script>
    <script src="{{asset('asset/js/custom.js')}}"></script>
</body>

</html>
