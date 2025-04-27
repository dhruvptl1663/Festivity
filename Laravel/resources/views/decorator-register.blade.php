<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Festivity Decorator Registration</title>
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
        .container-register {
            background: linear-gradient(358.31deg,#fff -24.13%,hsla(0,0%,100%,0) 338.58%),linear-gradient(89.84deg,rgba(230,36,174,.15) .34%,rgba(94,58,255,.15) 16.96%,rgba(10,136,255,.15) 34.66%,rgba(75,191,80,.15) 50.12%,rgba(137,206,0,.15) 66.22%,rgba(239,183,0,.15) 82%,rgba(246,73,0,.15) 99.9%);
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            padding: 0;
            width: 1100px;
            min-height: 730px;
            background-color: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .registration-form {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            width: 60%;
            padding: 40px;
            overflow-y: auto;
            max-height: 730px;
        }

        .testimonial {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 40%;
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
            width: 100%;
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
            border-radius: 10px;
            border: 1px solid #ddd;
            padding-left: 15px;
            font-weight: 500;
            font-size: 1rem;
            outline: none;
            transition: all 0.3s ease;
        }

        .input_field:focus {
            border-color: #F0E6FF;
            box-shadow: 0 0 0 2px rgba(240, 230, 255, 0.2);
        }

        .text_area {
            height: 100px;
            padding-top: 15px;
            resize: none;
        }

        .sign-up_btn {
            width: 100%;
            height: 55px;
            border: none;
            background-color: #8A4FFF;
            border-radius: 10px;
            color: white;
            font-weight: 600;
            cursor: pointer;
            font-size: 1rem;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .sign-up_btn:hover {
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
        
        .login-link {
            margin-top: 20px;
            font-size: 0.9rem;
            color: #666;
        }
        
        .login-link a {
            color: #8A4FFF;
            text-decoration: none;
            font-weight: 600;
        }
        
        .login-link a:hover {
            text-decoration: underline;
        }
        
        .form-group {
            margin-bottom: 20px;
            width: 100%;
        }
        
        .form-label {
            font-size: 0.9rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
            display: block;
        }
        
        .form-row {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }
        
        .form-row > div {
            flex: 1;
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

    <div class="container-register">
        <div class="registration-form">
            <div class="header">
                <label class="title">Decorator Registration</label>
                <p class="description">Join our platform and start showcasing your event decoration services.</p>
            </div>
            <form method="POST" action="{{ route('decorator.register') }}" enctype="multipart/form-data">
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

                <div class="form-row">
                    <div class="form-group">
                        <label for="name" class="form-label">Business Name</label>
                        <input id="name" class="input_field" type="text" name="name" value="{{ old('name') }}"
                            placeholder="Your business name" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="owner_name" class="form-label">Owner Name</label>
                        <input id="owner_name" class="input_field" type="text" name="owner_name" value="{{ old('owner_name') }}"
                            placeholder="Your full name" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="email" class="form-label">Email Address</label>
                        <input id="email" class="input_field" type="email" name="email" value="{{ old('email') }}"
                            placeholder="your.email@example.com" required>
                    </div>
                    <div class="form-group">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input id="phone" class="input_field" type="text" name="phone" value="{{ old('phone') }}"
                            placeholder="Your contact number" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input id="password" class="input_field" type="password" name="password" 
                            placeholder="Create a strong password" required>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input id="password_confirmation" class="input_field" type="password" name="password_confirmation" 
                            placeholder="Confirm your password" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="address" class="form-label">Business Address</label>
                    <input id="address" class="input_field" type="text" name="address" value="{{ old('address') }}"
                        placeholder="Your business address" required>
                </div>

                <div class="form-group">
                    <label for="description" class="form-label">Business Description</label>
                    <textarea id="description" class="input_field text_area" name="description" placeholder="Describe your decoration services">{{ old('description') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="logo" class="form-label">Business Logo</label>
                    <input id="logo" class="input_field" type="file" name="logo" accept="image/*">
                </div>

                <div class="form-group">
                    <label for="specialization" class="form-label">Specialization</label>
                    <select id="specialization" class="input_field" name="specialization">
                        <option value="" disabled selected>Select your area of expertise</option>
                        <option value="Wedding">Wedding Decoration</option>
                        <option value="Birthday">Birthday Parties</option>
                        <option value="Corporate">Corporate Events</option>
                        <option value="Festival">Festival Decoration</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <button class="sign-up_btn" type="submit">
                    <span>Create Decorator Account</span>
                </button>

                <div class="login-link" style="text-align: center;">
                    Already have an account? <a href="{{ route('decorator.login') }}">Sign in</a>
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
            <p>"Join our community of creative decorators and showcase your talent. Connect with clients looking for your unique decoration services for their special events."</p>

            <div style="height: 5px;"></div>
            <img src="{{ asset('assets/Images/Brand/main_logo_medium.png') }}" alt="Logo"
                style="width: 150px; max-width: 100%; height: auto; ">

            <div class="user" style="bottom: auto;">
                <span class="username">Become a Festivity Decorator</span>
                <span class="occupation">Grow your decoration business</span>
            </div>
            
            <div style="margin-top: 40px; text-align: center;">
                <h3 style="font-size: 1.2rem; font-weight: 600; margin-bottom: 15px;">Benefits of joining:</h3>
                <ul style="list-style: none; padding: 0; text-align: left;">
                    <li style="margin-bottom: 10px; display: flex; align-items: center;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#8A4FFF" class="bi bi-check-circle-fill" viewBox="0 0 16 16" style="margin-right: 10px;">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                        </svg>
                        Reach more customers
                    </li>
                    <li style="margin-bottom: 10px; display: flex; align-items: center;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#8A4FFF" class="bi bi-check-circle-fill" viewBox="0 0 16 16" style="margin-right: 10px;">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                        </svg>
                        Manage bookings easily
                    </li>
                    <li style="margin-bottom: 10px; display: flex; align-items: center;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#8A4FFF" class="bi bi-check-circle-fill" viewBox="0 0 16 16" style="margin-right: 10px;">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                        </svg>
                        Secure payments
                    </li>
                    <li style="display: flex; align-items: center;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#8A4FFF" class="bi bi-check-circle-fill" viewBox="0 0 16 16" style="margin-right: 10px;">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                        </svg>
                        Build your portfolio
                    </li>
                </ul>
            </div>
        </div>
    </div>

</body>

</html>