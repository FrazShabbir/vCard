@extends('frontend.main')
@section('title', getFullNameById($profile->id))

@section('styles')
@endsection

@push('css')
    <style>
        .card_top_header {
            position: relative;
            margin-bottom: 50px;
        }

        .card_cover {
            height: 250px;
        }

        .card_cover img {
            height: 100%;
            width: 100%;
            object-fit: cover;
            border-radius: 5px 5px 40px 40px;
        }

        .card_profile_img {
            text-align: center;
            margin-top: -100px;
        }

        .card_profile_img img {
            width: 200px;
            height: 200px;
            object-fit: cover;
            border: 5px solid #fff;
        }

        .card_personal_content h1 {
            font-size: 50px;
            font-weight: bold;
            margin-bottom: 5px
        }

        .card_personal_content h4 {
            font-size: 20px;
        }

        .card_personal_content .company {
            font-size: 12px;
            margin-bottom: 20px;
        }

        .sub_p_heading {
            font-size: 20px;
            font-weight: bold;
        }

        .contact_links a {
            display: block;
            margin-bottom: 20px;
            font-size: 15px;
            color: #000;
            /* text-align: center */
        }
        .text-sm-10 {
            font-size: 8px;!important;
        }
    </style>
@endpush

@section('extra_class')
    contact-page-navbar
@endsection

@section('banner')

@endsection
@section('content')
    <section class="pt-0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="">
                        <div class="card_top_header">
                            <div class="card_cover">
                                <img src="{{ asset($profile->cover_image ?? 'https://demo.rajodiya.com/vcardgo-saas/storage/card_banner//banner16367162581410231106.png') }}"
                                    alt="" class="img-fluid">
                            </div>
                            <div class="card_profile_img">
                                <img class="rounded-circle"
                                    src="{{ asset($profile->avatar ?? 'https://www.treasury.gov.ph/wp-content/uploads/2022/01/male-placeholder-image.jpeg') }}"
                                    alt="">
                            </div>
                        </div>
                        <div class="card_personal_content">
                            <h1 class="">
                                {{ getFullNameById($profile->id) }}
                            </h1> 
                            <h4 class="">
                                {{ $profile->designation }}
                            </h4>
                            <p class="company text-muted">
                                {{ $profile->organization }}
                            </p>
                            <p class="mb-4">
                                {{ $profile->bio }}
                            </p>
                        </div>
                        <hr>
                        <div class="">
                            <div class="">
                                <p class="sub_p_heading mb-4">Contact Information</p>
                            </div>
                            <div class="contact_links">
                                <div class="row">
                                    @if ($profile->phone)
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <a class="" href="tel:{{ $profile->phone }}"><i
                                                    class="fa color-purple mr-2 fa-phone-alt"></i> {{ $profile->phone }}</a>
                                        </div>
                                    @endif
                                    @if ($profile->email)
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <a class="" href="mailto:{{ $profile->email }}"><i
                                                    class="fas color-purple mr-2 fa-paper-plane"></i>
                                                {{ $profile->email }}</a>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                        <hr>
                        @if (checkSocials($profile->id) == true)
                            <div class="">
                                <div class="">
                                    <p class="sub_p_heading mb-4">Social Information:</p>
                                </div>
                                <div class="contact_links">
                                    <div class="row">
                                        @if ($profile->facebook)
                                            <div class="col-lg-3 col-md-6 col-sm-6 col-6 text-sm-10" >
                                                <a class="" href="https://www.facebook.com/{{ $profile->facebook }}"><i
                                                        class="color-purple fab fa-facebook"></i> /{{ $profile->facebook }}</a>
                                            </div>
                                        @endif
                                        @if ($profile->instagram)
                                            <div class="col-lg-3 col-md-6 col-sm-6 col-6 text-sm-10" >
                                                <a class="" href="https://www.instagram.com/{{ $profile->instagram }}"><i
                                                        class="color-purple fab fa-instagram"></i> /{{ $profile->instagram }}</a>
                                            </div>
                                        @endif
                                        @if ($profile->twitter)
                                            <div class="col-lg-3 col-md-6 col-sm-6 col-6 text-sm-10" >
                                                <a class="" href="https://www.twitter.com/{{ $profile->twitter }}"><i
                                                        class="color-purple fab fa-twitter"></i> /{{ $profile->twitter }}</a>
                                            </div>
                                        @endif
                                        @if ($profile->google)
                                            <div class="col-lg-3 col-md-6 col-sm-6 col-6 text-sm-10" >
                                                <a class="" href="https://www.google.com/{{ $profile->google }}"><i
                                                        class="color-purple fab fa-google"></i> /{{ $profile->google }}</a>
                                            </div>
                                        @endif
                                        @if ($profile->tiktok)
                                            <div class="col-lg-3 col-md-6 col-sm-6 col-6 text-sm-10" >
                                                <a class="" href="https://www.tiktok.com/{{ $profile->tiktok }}"><i
                                                        class="color-purple fab fa-tiktok"></i> /{{ $profile->tiktok }}</a>
                                            </div>
                                        @endif
                                        @if ($profile->youtube)
                                            <div class="col-lg-3 col-md-6 col-sm-6 col-6 text-sm-10" >
                                                <a class="" href="https://www.youtube.com/{{ $profile->youtube }}"><i
                                                        class="color-purple fab fa-youtube"></i> /{{ $profile->youtube }}</a>
                                            </div>
                                        @endif
                                        @if ($profile->pinterest)
                                            <div class="col-lg-3 col-md-6 col-sm-6 col-6 text-sm-10" >
                                                <a class="" href="https://www.pinterest.com/{{ $profile->pinterest }}"><i
                                                        class="color-purple fab fa-pinterest"></i> /{{ $profile->pinterest }}</a>
                                            </div>
                                        @endif
                                        @if ($profile->linkedin)
                                            <div class="col-lg-3 col-md-4 col-sm-4 col-4">
                                                <a class="" href="https://www.linkedin.com/{{ $profile->linkedin }}"><i
                                                        class="color-purple fab fa-linkedin"></i> /{{ $profile->linkedin }}</a>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        @endif




                        <div class="">
                            <div class="">
                                <p class="sub_p_heading mb-4">Save Contact:</p>
                            </div>
                            <div class="contact_links">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-4 col-12">
                                        <a class="btn btn-success"
                                            href="{{ route('downloadVCard', $profile->username) }}"><i
                                                class="text-white fa fa-download"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- <!-- Contact Section -->
     <section class="contact bg-grey" id="contact">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-8">
                    <div class="section-title">
                        <h2>Stay Tuned</h2>
                        <p class="mt-4">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laborum obcaecati dignissimos quae quo ad iste ipsum officiis deleniti asperiores sit.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12 col-md-5">
                    <div class="contact-us">
                        <p class="mb-3">
                            Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical
                            Latin literature from 45 BC, making it over 2000 years old.
                        </p>
                        <ul class="contact-info">
                            <li class="py-2">
                                <a class="media" href="#ew">
                                    <div class="social-icon mr-3">
                                        <i class="fas fa-home"></i>
                                    </div>
                                    <span class="media-body align-self-center">Vestibulum nulla libero, convallis, tincidunt suscipit diam, DC 2002</span>
                                </a>
                            </li>
                            <li class="py-2">
                                <a class="media" href="#we">
                                    <div class="social-icon mr-3">
                                        <i class="fas fa-phone-alt"></i>
                                    </div>
                                    <span class="media-body align-self-center">+1 230 456 789-012 345 6789</span>
                                </a>
                            </li>
                            <li class="py-2">
                                <a class="media" href="#we">
                                    <div class="social-icon mr-3">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <span class="media-body align-self-center">dummy@lifo.com</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="col-12 col-md-6 offset-md-1 pt-4 pt-md-0">
                    <div class="contact-form">
                        <form method="POST" class="needs-validation" id="contact-form" novalidate>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="name" placeholder="Name" required="required">
                                        <div class="valid-feedback">Valid.</div>
                                        <div class="invalid-feedback">Please fill out this field.</div>
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control" name="email" placeholder="Email" required="required">
                                        <div class="valid-feedback">Valid.</div>
                                        <div class="invalid-feedback">Please fill out this field.</div>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="subect" placeholder="Subject" required="required">
                                        <div class="valid-feedback">Valid.</div>
                                        <div class="invalid-feedback">Please fill out this field.</div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <textarea class="form-control" name="message" placeholder="Message" required="required"></textarea>
                                        <div class="valid-feedback">Valid.</div>
                                        <div class="invalid-feedback">Please fill out this field.</div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-lg btn-block mt-3">
                                        <span class="text-white pr-3">
                                            <i class="fas fa-paper-plane"></i>
                                        </span>Send Message
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Ends --> --}}
@endsection


@section('scripts')
@endsection

@push('js')
@endpush
