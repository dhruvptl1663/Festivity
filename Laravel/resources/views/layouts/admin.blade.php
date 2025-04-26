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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easypiechart/2.1.7/jquery.easypiechart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-countTo/1.2.0/jquery.countTo.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.shuffle/0.1.1/jquery.shuffle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.slicknav/1.0.10/jquery.slicknav.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fitvids/1.2.0/jquery.fitvids.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/imagesloaded/4.1.4/imagesloaded.pkgd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/counterup2/1.0.3/jquery.counterup.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.countdown/2.2.0/jquery.countdown.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/validator/13.7.0/validator.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Keep your custom JS file -->
    <script src="{{ asset('dashboard/js/custom.js') }}"></script>
    
    @stack('scripts')
</body>
</html>