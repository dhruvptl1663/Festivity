<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="icon" href="{{ asset('assets/Images/Brand/main_logo_small.png') }}" type="image/x-icon">

    <style>
        body {
            margin: 0;
            padding: 0;
        }
        
        #wrapper {
            margin: 0;
            padding: 0;
        }

        .layout-wrap {
            margin: 0;
            padding: 0;
        }

        .section-menu-left {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            z-index: 1000;
        }

        .section-main {
            margin-left: 250px; /* Adjust based on your sidebar width */
            padding: 20px;
        }

        @media (max-width: 768px) {
            .section-menu-left {
                position: absolute;
            }
            .section-main {
                margin-left: 0;
                padding: 10px;
            }
        }
    </style>

    @stack('styles')
</head>

<body class="body">
    <div id="wrapper">
        <div id="page" class="">
            <div class="layout-wrap">
                <x-adminheader />

                <div class="section-main">
                    <div class="container-fluid">
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
    <script src="{{ asset('dashboard/js/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/jquery.scrollUp.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/jquery.slicknav.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/parallax.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/progressbar.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/wow.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/main.js') }}"></script>
    <script src="{{ asset('dashboard/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/custom.js') }}"></script>

    @stack('scripts')
</body>
</html>