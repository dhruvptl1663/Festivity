<!DOCTYPE html>

<html data-wf-page="6706104d4f29e916e4cae2b1"
      data-wf-site="6706104d4f29e916e4cae2ad" lang="en" data-wf-locale="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Festivity</title>

    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin="anonymous">
    <script src="{{ asset('ajax/libs/webfont/1.6.26/webfont.js') }}" type="text/javascript"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/brands.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/solid.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/brands.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/solid.min.js"></script>

    <link href="{{ asset('assets/Images/Brand/icon_logo_small.png') }}" rel="shortcut icon" type="image/x-icon">
    <link href="{{ asset('assets/Images/Brand/icon_logo_big.png') }}" rel="apple-touch-icon">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css">
    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
    <style>
        .menu-icon-wrapper {
            margin-left: 20px;
            cursor: pointer;
            position: relative;
            z-index: 100;
        }

        .menu-trigger {
            background: none;
            border: none;
            padding: 12px;
            color: #1a1a1a;
            font-size: 1.25rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .menu-trigger i {
            font-size: 1.25rem;
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
        }

        .menu-trigger:hover {
            color:rgb(0, 0, 0);
            transform: scale(1.05);
            box-shadow: 0 6px 24px rgba(0, 0, 0, 0.1);
            border-radius: 100%;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(12px);
        }

        .menu-dropdown {
            position: absolute;
            right: 0;
            top: 100%;
            margin-top: 12px;
            background: rgba(255, 255, 255, 0.65);
            backdrop-filter: blur(12px);
            border-radius: 16px;
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.1);
            padding: 16px 0;
            min-width: 240px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1000;
            border: 1px solid rgba(0, 0, 0, 0.05);
            border-top: 2px solid #C1E4C4;
        }

        .menu-icon-wrapper:hover .menu-dropdown {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 14px 20px;
            color: #333;
            text-decoration: none;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            border-radius: 12px;
            font-weight: 500;
            font-size: 0.95rem;
            position: relative;
            overflow: hidden;
        }

        .menu-item i {
            font-size: 1.25rem !important;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6c757d;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            font-family: "Font Awesome 6 Free" !important;
            font-weight: 900 !important;
        }

        .menu-item:hover i {
            color: #C1E4C4;
            transform: scale(1.1);
        }

        .menu-item:hover {
            background: rgba(0, 123, 255, 0.1);
            color:rgb(28, 195, 42);
            transform: translateX(6px);
        }

        .menu-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 3px;
            background: #C1E4C4;
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.2s ease;
        }

        .menu-item:hover::before {
            transform: scaleX(1);
        }

        /* Modern Icons */
        .menu-item.bookmark i {
            content: "\f02e";
        }

        .menu-item.notifications i {
            content: "\f0f3";
        }

        .menu-item i {
            font-family: "Font Awesome 6 Free" !important;
            font-weight: 900 !important;
        }

        /* Add subtle divider between items */
        .menu-item:not(:last-child) {
            margin-bottom: 8px;
            padding-bottom: 8px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        
        .menu-item:hover {
            border-bottom-color: rgba(0, 123, 255, 0.1);
        }

        .cart-icon-wrapper {
            cursor: pointer;
            position: relative;
            z-index: 100;
        }

        .cart-icon {
            background: none;
            border: none;
            padding: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            color: #1a1a1a;
        }

        .cart-icon img {
            width: 20px;
            height: 20px;
            object-fit: contain;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .cart-icon:hover {
            color: #C1E4C4;
            transform: scale(1.05);
        }

        .cart-icon:hover img {
            filter: brightness(0.9);
        }
    </style>
</head>

<body>
<!-- NavBar Starts -->
<div data-animation="default" class="navbar w-nav" data-easing2="ease" class="w-nav" data-easing="ease" data-collapse="medium"
     data-w-id="06ab6c64-468c-b44e-1b8c-856deb96ba7f" role="banner" data-no-scroll="1" data-duration="400"
     data-doc-height="1"><a href="{{ URL::to('/')}}" aria-current="page"
                            class="logo-link-wrapper w-nav-brand w--current"><img width="Auto" height="Auto" alt="Logo"
                                                                                  src="{{ asset('assets/Images/Brand/main_logo_big.png') }}"
                                                                                  loading="eager"
                                                                                  srcset="{{ asset('assets/Images/Brand/main_logo_small.png') }} 500w, {{ asset('assets/Images/Brand/main_logo_medium.png') }} 800w, {{ asset('assets/Images/Brand/main_logo_big.png') }} 1015w"
                                                                                  sizes="(max-width: 991px) 124.921875px, 11vw"
                                                                                  class="logo"></a>
    <div class="nav-container w-container" style="display: flex; align-items: center; justify-content: space-between;">

        <nav role="navigation" class="nav-menu w-nav-menu">
            <div class="nav-link-wrapper" data-url="{{ URL::to('/') }}">
                <a href="{{ URL::to('/') }}" class="nav-link w-nav-link">Home</a>
                <p class="nav-link move-down hide-on-tab w-nav-link">Home</p>
            </div>

            <div class="nav-link-wrapper" data-url="{{ URL::to('/events') }}">
                <a href="{{ URL::to('/events') }}" class="nav-link w-nav-link">Events</a>
                <p class="nav-link move-down hide-on-tab w-nav-link">Events</p>
            </div>

            <div class="nav-link-wrapper" data-url="{{ URL::to('/packages') }}">
                <a href="{{ URL::to('/packages') }}" class="nav-link w-nav-link">Package</a>
                <p class="nav-link move-down hide-on-tab w-nav-link">Package</p>
            </div>

            <div class="nav-link-wrapper" data-url="{{ URL::to('/about') }}">
                <a href="{{ URL::to('/about') }}" class="nav-link w-nav-link">About</a>
                <p class="nav-link move-down hide-on-tab w-nav-link">About</p>
            </div>

            <div class="nav-link-wrapper" data-url="{{ URL::to('/contactus') }}">
                <a href="{{ URL::to('/contactus') }}" class="nav-link w-nav-link">Contact</a>
                <p class="nav-link move-down hide-on-tab w-nav-link">Contact</p>
            </div>
        </nav>


        @auth
        <div style="display: flex; align-items: center; gap: 24px;">
            <div class="cart-icon-wrapper">
                <a href="{{ route('cart') }}" class="cart-icon" title="View Cart">
                    <img src="{{ asset('assets/Images/Icons/cart_fill.png') }}" alt="Cart" loading="lazy">
                </a>
            </div>
            <div class="dropdown">
                <a href="{{ route('profile.show') }}" data-w-id="5636032a-1271-e473-ecbe-20e393bd2447"
                   class="button-with-circle-icon-loginbtn w-inline-block">
                    <p class="button-text">Hello, {{ Auth::user()->name }}</p>
                    <p class="button-text move-down hide-on-tab">Hello, {{ Auth::user()->name }}</p>
                    <div class="circle-absolute"></div>
                </a>
            </div>
        </div>

        <div class="menu-icon-wrapper">
            <button class="menu-trigger" aria-label="Menu">
                <i class="fas fa-bars"></i>
            </button>
            
            <div class="menu-dropdown">
                <a href="{{ route('bookmarks') }}" class="menu-item bookmark">
                    <i class="fas fa-bookmark"></i>
                    <span>Bookmarks</span>
                </a>
                <a href="{{ route('notifications') }}" class="menu-item notifications">
                    <i class="fas fa-bell"></i>
                    <span>Notifications</span>
                </a>
            </div>
        </div>

        @else
            <a href="{{ URL::to('/login')}}" data-w-id="5636032a-1271-e473-ecbe-20e393bd2447"
               class="button-with-circle-icon-loginbtn w-inline-block">
                <p class="button-text">Login/SignUp</p>
                <p class="button-text move-down hide-on-tab">Login/SignUp</p>
                <div class="circle-absolute"></div>
            </a>
        @endauth
        <div class="menu-button w-nav-button">
            <div class="burger-icon w-icon-nav-menu"></div>
        </div>

    </div>
</div>
<!-- NavBar Ends -->
