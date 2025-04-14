<!DOCTYPE html>

<html data-wf-page="6706104d4f29e916e4cae2b1"
      data-wf-site="6706104d4f29e916e4cae2ad" lang="en" data-wf-locale="en">

<head>
    <meta charset="utf-8">
    <title>Festivity</title>

    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin="anonymous">
    <script src="{{ asset('ajax/libs/webfont/1.6.26/webfont.js') }}" type="text/javascript"></script>

    <link href="https://use.fontawesome.com/releases/v5.0.1/css/all.css" rel="stylesheet">
    <script
        type="text/javascript">WebFont.load({google: {families: ["Inter:100,300,regular,500,600,700,100italic,300italic,italic,500italic,600italic,700italic"]}});</script>
    <script
        type="text/javascript">!function (o, c) {
            var n = c.documentElement, t = " w-mod-";
            n.className += t + "js", ("ontouchstart" in o || o.DocumentTouch && c instanceof DocumentTouch) && (n.className += t + "touch")
        }(window, document);</script>
    <link href="{{ asset('assets/Images/Brand/icon_logo_small.png') }}" rel="shortcut icon" type="image/x-icon">
    <link href="{{ asset('assets/Images/Brand/icon_logo_big.png') }}" rel="apple-touch-icon">
</head>

<body>
<!-- NavBar Starts -->
<div data-animation="default" class="navbar w-nav" data-easing2="ease" data-easing="ease" data-collapse="medium"
     data-w-id="06ab6c64-468c-b44e-1b8c-856deb96ba7f" role="banner" data-no-scroll="1" data-duration="400"
     data-doc-height="1"><a href="{{ URL::to('/')}}" aria-current="page"
                            class="logo-link-wrapper w-nav-brand w--current"><img width="Auto" height="Auto" alt="Logo"
                                                                                  src="{{ asset('assets/Images/Brand/main_logo_big.png') }}"
                                                                                  loading="eager"
                                                                                  srcset="{{ asset('assets/Images/Brand/main_logo_small.png') }} 500w, {{ asset('assets/Images/Brand/main_logo_medium.png') }} 800w, {{ asset('assets/Images/Brand/main_logo_big.png') }} 1015w"
                                                                                  sizes="(max-width: 991px) 124.921875px, 11vw"
                                                                                  class="logo"></a>
    <div class="nav-container w-container">

        <nav role="navigation" class="nav-menu w-nav-menu">
            <div class="nav-link-wrapper" data-url="{{ URL::to('/') }}">
                <p class="nav-link w-nav-link">Home</p>
                <p class="nav-link move-down hide-on-tab w-nav-link">Home</p>
            </div>

            <div class="nav-link-wrapper" data-url="{{ URL::to('/events') }}">
                <p class="nav-link w-nav-link">Events</p>
                <p class="nav-link move-down hide-on-tab w-nav-link">Events</p>
            </div>

            <div class="nav-link-wrapper" data-url="{{ URL::to('/packages') }}">
                <p class="nav-link w-nav-link">Package</p>
                <p class="nav-link move-down hide-on-tab w-nav-link">Package</p>
            </div>

            <div class="nav-link-wrapper" data-url="{{ URL::to('/about') }}">
                <p class="nav-link w-nav-link">About</p>
                <p class="nav-link move-down hide-on-tab w-nav-link">About</p>
            </div>

            <div class="nav-link-wrapper" data-url="{{ URL::to('/contact') }}">
                <p class="nav-link w-nav-link">Contact</p>
                <p class="nav-link move-down hide-on-tab w-nav-link">Contact</p>
            </div>
        </nav>


        @auth
            <i class="fa badge fa-lg" value=8 style="margin-right: 40px;">&#xf07a;</i>
            <div class="dropdown" style="margin-top: 20px;">
                <a href="{{ route('profile') }}" data-w-id="5636032a-1271-e473-ecbe-20e393bd2447"
                   class="button-with-circle-icon-loginbtn w-inline-block">
                    <p class="button-text">Hello, {{ Auth::user()->name }}</p>
                    <p class="button-text move-down hide-on-tab">Hello, {{ Auth::user()->name }}</p>
                    <div class="circle-absolute"></div>
                </a>
                <form method="POST" action="{{ route('logout') }}" class="d-inline" style="margin-left: 100px;">
                    @csrf
                    <button type="submit" class="dropdown-item">
                        {{ __('Logout') }}
                    </button>
                </form>
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
