<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">

<head>
    <title>Festivity - Decorator</title>
    <meta charset="utf-8">
    <meta name="author" content="themesflat.com">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
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
                @if(Auth::guard('decorator')->check())
                    <x-decoratorheader />
                @else
                    <script>window.location.href = "{{ route('decorator.login') }}";</script>
                @endif

                <div class="section-main">
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Core JS Libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.18/dist/js/bootstrap-select.min.js"></script>
    
    <!-- SweetAlert for alerts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Load essential local scripts -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Load essential scripts
        const loadScript = (src) => {
            return new Promise((resolve, reject) => {
                const script = document.createElement('script');
                script.src = src;
                script.onload = resolve;
                script.onerror = () => {
                    console.warn('Failed to load script:', src);
                    resolve(); // Resolve even if script fails to prevent blocking
                };
                document.body.appendChild(script);
            });
        };

        // Load custom scripts
        Promise.all([
            loadScript('{{ asset('dashboard/js/custom.js') }}')
        ]).then(() => {
            console.log('All scripts loaded successfully');
        });
    });
    </script>

    @stack('scripts')
</body>
</html>