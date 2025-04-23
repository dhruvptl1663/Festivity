<!DOCTYPE html>
<html xmlns="[http://www.w3.org/1999/xhtml"](http://www.w3.org/1999/xhtml") xml:lang="en-US" lang="en-US">

<head>
    <title>Festivity - Admin</title>
    <meta charset="utf-8">
    <meta name="author" content="themesflat.com">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    
    <!-- Add your admin CSS files -->
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/css/animate.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/css/animation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/font/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/icon/style.css') }}">
    <link href="{{ asset('assets/Images/Brand/icon_logo_small.png') }}" rel="shortcut icon" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/css/sweetalert.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/css/custom.css') }}">
    <link rel="icon" href="{{ asset('assets/Images/Brand/main_logo_small.png') }}" type="image/x-icon">




    

    
    @stack('styles')
</head>

<body class="body">
    <div id="wrapper">
        <div id="page" class="">
            <div class="layout-wrap">
                <div class="header">
                    <div class="container">
                        <div class="logo">
                            <a href="{{ url('/admin') }}">
                                <img src="{{ asset('assets/Images/Brand/main_logo_small.png') }}" alt="Festivity Logo" class="img-fluid" style="height: 45px;">
                            </a>
                        </div>
                    </div>
                </div>
                @include('components.adminheader')

                <div class="section-main">
                    <div class="container">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add your admin JS files -->
    <script src="{{ asset('dashboard/js/jquery.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/parallax.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/jquery.easypiechart.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/jquery.countTo.js') }}"></script>
    <script src="{{ asset('dashboard/js/jquery.shuffle.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/jquery.slicknav.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/jquery.fitvids.js') }}"></script>
    <script src="{{ asset('dashboard/js/jquery.isotope.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/imagesloaded.js') }}"></script>
    <script src="{{ asset('dashboard/js/jquery waypoints.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/wow.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/validator.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/custom.js') }}"></script>
    <script src="{{ asset('dashboard/js/sweetalert.min.js') }}"></script>
    
    @stack('scripts')
</body>
</html>