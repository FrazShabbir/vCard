<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->full_name }} - vCard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" />
    <style>
        html {
            width: 100%;
            height: 100%;
        }

        body {

            background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
            background-size: 400% 400%;
            -webkit-animation: Gradient 15s ease infinite;
            -moz-animation: Gradient 15s ease infinite;
            animation: Gradient 15s ease infinite;
        }

        p {
            margin: 10px;
        }

        @-webkit-keyframes Gradient {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        @-moz-keyframes Gradient {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        @keyframes Gradient {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }


        .banner {
            background-image: linear-gradient(to bottom, #333, #666);
            background-size: 100% 300px;
            background-position: 0% 100%;
            height: 300px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            font-size: 36px;
            font-weight: bold;
            border-radius: 20px 20px 0 0;
            position: relative;
            /* Add this to make the banner a positioning context */
        }

        .profile-pic {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 5px solid #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: absolute;
            /* Make the image absolute */
            top: 220px;
            /* Adjust the top margin to make it overlap the banner */
            left: 50%;
            /* Center the image horizontally */
            transform: translateX(-50%);
            /* Center the image horizontally */
            z-index: 1;
            /* Make sure the image is on top of the banner */
        }

        .profile-pic img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        .info {
            background-color: #fff;
            padding: 20px;
            border-radius: 0 0 20px 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .social-media {
            margin-top: 20px;
            text-align: center;
            /* Center the icons horizontally */
        }

        .social-media a {
            margin: 10px;
            font-size: 24px;
            color: #333;
        }

        .social-media a:hover {
            color: #666;
        }

        /* Add styles for the shop section */
        .shop {
            background-color: #f7f7f7;
            padding: 40px;
            margin-top: 40px;
            border-radius: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .product {
            display: inline-block;
            margin: 20px;
            width: 250px;
            height: 350px;
            border-radius: 20px;
            overflow: hidden;
            position: relative;
        }

        .product img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 20px;
            transition: transform 0.5s ease-in-out;
        }

        .product:hover img {
            transform: scale(1.1);
        }

        .product-info {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            color: #fff;
            padding: 10px;
            text-align: center;
            transition: opacity 0.5s ease-in-out;
            opacity: 1;
        }

        .product:hover.product-info {
            opacity: 1;
        }


        /* footer */
        .footer-box {
            text-align: center;
            padding: 0px 30px 10px 0;
        }

        .footer-box.text {
            color: #000;
            font-size: 12px;
            font-weight: 500;
        }

        .footer-box.text a {
            color: #1F8AFF;
            font-weight: 600;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="banner">
                    <h1>Contact Card</h1>
                    <div class="profile-pic">
                        <img src="{{ asset($profile->avatar ?? 'https://ui-avatars.com/api/?name=' . $user->full_name) }}   "
                            alt="Profile Picture" class="img-fluid">
                    </div>
                </div>
                <div class="info">
                    <h2> {{ getFullNameById($user->id) }}</h2>
                    <p> {{ $profile->organization }} {{ $profile->designation }}</p>
                    @if ($profile->primaryaddress)
                        <p>{{ $profile->primaryaddress->city->name ?? '' }} <i class="fal fa-circle"></i>
                            {{ $profile->primaryaddress->state->name ?? '' }} <i class="fal fa-circle"></i>
                            {{ $profile->primaryaddress->country->name ?? '' }}</p>
                    @endif
                    <p><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></p>
                    <p>{{ $profile->bio ?? 'Hello' }}</p>

                    <div class="text-center">
                        <a href="{{ route('downloadVCard', $user->username) }}" class="btn btn-block btn-primary">Save
                            Contact</a>
                    </div>
                </div>
                <div class="social-media">
                    @foreach ($profile->socials as $social)
                        <a href="{{ $social->shortlink?->shortlink }}" target="_blank">
                            <i class="{{ $social->platform->icon }}"></i>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="row shop">
            <div class="col-md-12 text-center">
                <h2 class="shop-title">Our Shop</h2>
                <p class="shop-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet nulla
                    auctor, vestibulum magna sed, convallis ex.</p>
            </div>
            <div class="col-md-3">
                <div class="product">
                    <img src="https://via.placeholder.com/250x350" alt="Product 1">
                    <div class="product-info">
                        <h3>Product 1</h3>
                        <p>$100</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="product">
                    <img src="https://via.placeholder.com/250x350" alt="Product 2">
                    <div class="product-info">
                        <h3>Product 2</h3>
                        <p>$200</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="product">
                    <img src="https://via.placeholder.com/250x350" alt="Product 3">
                    <div class="product-info">
                        <h3>Product 3</h3>
                        <p>$300</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="product">
                    <img src="https://via.placeholder.com/250x350" alt="Product 4">
                    <div class="product-info">
                        <h3>Product 4</h3>
                        <p>$400</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <div class="footer-box m-2">
            <p class="text">
                Powered by <a href="">vCards</a>
            </p>
            <p>For custom website building or customization, contact us. <a
                    href="https://wa.me/447561498786">Whatsapp</a></p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
