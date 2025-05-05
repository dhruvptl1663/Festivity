<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Festivity Decorator Login</title>
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js" type="text/javascript"></script>
    <script
        type="text/javascript">WebFont.load({ google: { families: ["Inter:100,300,regular,500,600,700,100italic,300italic,italic,500italic,600italic,700italic"] } });</script>
    <script
        type="text/javascript">!function (o, c) { var n = c.documentElement, t = " w-mod-"; n.className += t + "js", ("ontouchstart" in o || o.DocumentTouch && c instanceof DocumentTouch) && (n.className += t + "touch") }(window, document);</script>
    <link href="{{ asset('assets/Images/Brand/icon_logo_small.png') }}" rel="shortcut icon" type="image/x-icon">
    <link href="{{ asset('assets/Images/Brand/icon_logo_big.png') }}" rel="apple-touch-icon">
    <style>
        .container-login {
            background: linear-gradient(358.31deg,#fff -24.13%,hsla(0,0%,100%,0) 338.58%),linear-gradient(89.84deg,rgba(230,36,174,.15) .34%,rgba(94,58,255,.15) 16.96%,rgba(10,136,255,.15) 34.66%,rgba(75,191,80,.15) 50.12%,rgba(137,206,0,.15) 66.22%,rgba(239,183,0,.15) 82%,rgba(246,73,0,.15) 99.9%);
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            padding: 0;
            width: 900px;
            height: 600px;
            background-color: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .login-form {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 50%;
            padding: 40px;
        }

        .testimonial {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 50%;
            background-color: #F0E6FF;
            height: 100%;
            padding: 40px;
            color: #333;
            position: relative;
        }

        .testimonial p {
            font-size: 1.2rem;
            font-weight: 500;
            text-align: center;
            margin-bottom: 30px;
            font-style: italic;
            color: #333;
        }

        .user {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 30px;
        }

        .username {
            font-weight: 700;
            font-size: 1.5rem;
            margin-bottom: 5px;
        }

        .occupation {
            font-size: 0.9rem;
            color: #555;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 10px;
        }

        .description {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 20px;
        }

        .input_container {
            position: relative;
            width: 100%;
            margin-bottom: 20px;
        }

        .input_field {
            height: 55px;
            width: 100%;
            border-radius: 30px;
            border: 1px solid #ddd;
            padding-left: 50px;
            font-weight: 500;
            font-size: 1rem;
            outline: none;
            transition: all 0.3s ease;
        }

        .input_field:focus {
            border-color: #F0E6FF;
            box-shadow: 0 0 0 2px rgba(240, 230, 255, 0.2);
        }

        .icon {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
        }

        .sign-in_btn {
            width: 100%;
            height: 55px;
            border: none;
            background-color: #8A4FFF;
            border-radius: 30px;
            color: white;
            font-weight: 600;
            cursor: pointer;
            font-size: 1rem;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .sign-in_btn:hover {
            background-color: #7A3FEF;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(138, 79, 255, 0.2);
        }
        
        .decorator-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
            color: #333;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        
        .invalid-feedback {
            color: #e3342f;
            font-size: 0.8rem;
            margin-top: 5px;
            margin-left: 15px;
        }
        
        .signup-link {
            margin-top: 20px;
            font-size: 0.9rem;
            color: #666;
        }
        
        .signup-link a {
            color: #8A4FFF;
            text-decoration: none;
            font-weight: 600;
        }
        
        .signup-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body style="display: flex;
justify-content: center;
align-items: center;
height: 100vh;
margin: 0;
background-image: url({{ asset('assets/Images/HomePage/wedding_showcase.png') }});
background-size: cover;
background-position: center;
background-repeat: no-repeat;
backdrop-filter: blur(5px);
-webkit-backdrop-filter: blur(5px);">

    <div class="container-login">
        <div class="login-form">
            <div class="header">
                <label class="title">Decorator Login</label>
                <p class="description">Welcome back! Sign in to manage your events, packages, and bookings.</p>
            </div>
            <form method="POST" action="{{ route('decorator.login') }}">
                @csrf

                @if ($errors->any())
                     <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <p style="color: red; margin-bottom: 10px; font-size: 0.7em;">{{ $error }}</p>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="input_container">
                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none">
                        <path d="M7 8.5L9.94202 10.2394C11.6572 11.2535 12.3428 11.2535 14.058 10.2394L17 8.5"
                            stroke="#141B34" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path
                            d="M2.01577 13.4756C2.08114 16.5412 2.11383 18.0739 3.24496 19.2094C4.37608 20.3448 5.95033 20.3843 9.09883 20.4634C11.0393 20.5122 12.9607 20.5122 14.9012 20.4634C18.0497 20.3843 19.6239 20.3448 20.7551 19.2094C21.8862 18.0739 21.9189 16.5412 21.9842 13.4756C22.0053 12.4899 22.0053 11.5101 21.9842 10.5244C21.9189 7.45886 21.8862 5.92609 20.7551 4.79066C19.6239 3.65523 18.0497 3.61568 14.9012 3.53657C12.9607 3.48781 11.0393 3.48781 9.09882 3.53656C5.95033 3.61566 4.37608 3.65521 3.24495 4.79065C2.11382 5.92608 2.08114 7.45885 2.01576 10.5244C1.99474 11.5101 1.99475 12.4899 2.01577 13.4756Z"
                            stroke="#141B34" stroke-width="1.5" stroke-linejoin="round"></path>
                    </svg>
                    <input id="email" class="input_field" type="email" name="email" value="{{ old('email') }}"
                        placeholder="decorator@example.com" required autofocus>
                </div>
                <div class="input_container">
                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none">
                        <path
                            d="M18 11.0041C17.4166 9.91704 16.273 9.15775 14.9519 9.0993C13.477 9.03404 11.9788 9 10.329 9C8.67911 9 7.18091 9.03404 5.70604 9.0993C3.95328 9.17685 2.51295 10.4881 2.27882 12.1618C2.12602 13.2541 2 14.3734 2 15.5134C2 16.6534 2.12602 17.7727 2.27882 18.865C2.51295 20.5387 3.95328 21.8499 5.70604 21.9275C6.42013 21.9591 7.26041 21.9834 8 22"
                            stroke="#141B34" stroke-width="1.5" stroke-linecap="round"></path>
                        <path d="M6 9V6.5C6 4.01472 8.01472 2 10.5 2C12.9853 2 15 4.01472 15 6.5V9" stroke="#141B34"
                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path
                            d="M21.2046 15.1045L20.6242 15.6956V15.6956L21.2046 15.1045ZM21.4196 16.4767C21.7461 16.7972 22.2706 16.7924 22.5911 16.466C22.9116 16.1395 22.9068 15.615 22.5804 15.2945L21.4196 16.4767ZM18.0228 15.1045L17.4424 14.5134V14.5134L18.0228 15.1045ZM18.2379 18.0387C18.5643 18.3593 19.0888 18.3545 19.4094 18.028C19.7299 17.7016 19.7251 17.1771 19.3987 16.8565L18.2379 18.0387ZM14.2603 20.7619C13.7039 21.3082 12.7957 21.3082 12.2394 20.7619L11.0786 21.9441C12.2794 23.1232 14.2202 23.1232 15.4211 21.9441L14.2603 20.7619ZM12.2394 20.7619C11.6914 20.2239 11.6914 19.358 12.2394 18.82L11.0786 17.6378C9.86927 18.8252 9.86927 20.7567 11.0786 21.9441L12.2394 20.7619ZM12.2394 18.82C12.7957 18.2737 13.7039 18.2737 14.2603 18.82L15.4211 17.6378C14.2202 16.4587 12.2794 16.4587 11.0786 17.6378L12.2394 18.82ZM14.2603 18.82C14.8082 19.358 14.8082 20.2239 14.2603 20.7619L15.4211 21.9441C16.6304 20.7567 16.6304 18.8252 15.4211 17.6378L14.2603 18.82ZM20.6242 15.6956L21.4196 16.4767L22.5804 15.2945L21.785 14.5134L20.6242 15.6956ZM15.4211 18.82L17.8078 16.4767L16.647 15.2944L14.2603 17.6377L15.4211 18.82ZM17.8078 16.4767L18.6032 15.6956L17.4424 14.5134L16.647 15.2945L17.8078 16.4767ZM16.647 16.4767L18.2379 18.0387L19.3987 16.8565L17.8078 15.2945L16.647 16.4767ZM21.785 14.5134C21.4266 14.1616 21.0998 13.8383 20.7993 13.6131C20.4791 13.3732 20.096 13.1716 19.6137 13.1716V14.8284C19.6145 14.8284 19.619 14.8273 19.6395 14.8357C19.6663 14.8466 19.7183 14.8735 19.806 14.9391C19.9969 15.0822 20.2326 15.3112 20.6242 15.6956L21.785 14.5134ZM18.6032 15.6956C18.9948 15.3112 19.2305 15.0822 19.4215 14.9391C19.5091 14.8735 19.5611 14.8466 19.5879 14.8357C19.6084 14.8273 19.6129 14.8284 19.6137 14.8284V13.1716C19.1314 13.1716 18.7483 13.3732 18.4281 13.6131C18.1276 13.8383 17.8008 14.1616 17.4424 14.5134L18.6032 15.6956Z"
                            fill="#141B34"></path>
                    </svg>
                    <input id="password" class="input_field" type="password" name="password" placeholder="Password"
                        required>
                </div>
                <div class="input_container" style="display: flex; align-items: center; margin-bottom: 15px;">
                    <label for="remember" style="display: flex; align-items: center; cursor: pointer;">
                        <input type="checkbox" name="remember" id="remember" style="margin-right: 10px;">
                        <span style="font-size: 0.9rem; color: #666;">Remember Me</span>
                    </label>
                </div>
                <button class="sign-in_btn" type="submit">
                    <span>Sign In as Decorator</span>
                </button>

                <div class="signup-link">
                    Don't have an account? <a href="{{ route('decorator.register') }}">Sign up</a>
                </div>
            </form>
        </div>
        <div class="testimonial">
            <div class="decorator-badge">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-brush" viewBox="0 0 16 16" style="margin-right: 5px; vertical-align: text-bottom;">
                    <path d="M15.825.12a.5.5 0 0 1 .132.584c-1.53 3.43-4.743 8.17-7.095 10.64a6.1 6.1 0 0 1-2.373 1.534c-.018.227-.06.538-.16.868-.201.659-.667 1.479-1.708 1.74a8.1 8.1 0 0 1-3.078.132 4 4 0 0 1-.562-.135 1.4 1.4 0 0 1-.466-.247.7.7 0 0 1-.204-.288.62.62 0 0 1 .004-.443c.095-.245.333-.54.698-.848.363-.309.8-.616 1.292-.848.492-.233.93-.35 1.23-.35.268-.1.583-.046.85-.018a6 6 0 0 0 1.68-.362l.045-.02a6 6 0 0 0 2.063-1.43A61.2 61.2 0 0 0 5.12 5.012a61.2 61.2 0 0 0-2.945-3.777.5.5 0 0 1 .708-.708A61.2 61.2 0 0 0 5.9 3.838c.326.356.75.832 1.23 1.383a133.8 133.8 0 0 1-1.856 2.505.5.5 0 0 1-.8-.6c1.067-1.42 1.725-2.327 2.067-2.83a60.9 60.9 0 0 0-1.635-1.987A61.2 61.2 0 0 0 3.91 1.175a.5.5 0 0 1 .15-.695A59.2 59.2 0 0 0 4.963.708a.5.5 0 0 1 .497 0Z"/>
                </svg>
                Decorator Portal
            </div>
            <p>"Showcase your creative skills and grow your event decoration business. Our decorator platform connects you with clients looking for your unique design expertise."</p>

            <div style="height: 5px;"></div>
            <img src="{{ asset('assets/Images/Brand/main_logo_medium.png') }}" alt="Logo"
                style="width: 150px; max-width: 100%; height: auto; ">

            <div class="user" style="bottom: auto;">
                <span class="username">Festivity Decorators</span>
                <span class="occupation">Bringing Events to Life</span>
            </div>
        </div>
    </div>

</body>

</html>
