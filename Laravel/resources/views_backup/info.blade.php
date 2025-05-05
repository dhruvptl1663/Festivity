<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Festivity - Event Management System</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #7c4dff;
            --secondary-color: #ff4081;
            --dark-color: #212121;
            --light-color: #f5f5f5;
            --success-color: #00c853;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8ed 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .header {
            background-color: white;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            padding: 20px 0;
            margin-bottom: 2rem;
        }
        
        .logo {
            font-size: 28px;
            font-weight: 700;
            color: var(--primary-color);
            text-decoration: none;
        }
        
        .logo span {
            color: var(--secondary-color);
        }
        
        .hero {
            text-align: center;
            padding: 3rem 0 2rem;
        }
        
        .hero h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .hero p {
            font-size: 1.2rem;
            max-width: 800px;
            margin: 0 auto 2rem;
            color: #555;
        }
        
        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 30px;
            margin-bottom: 3rem;
        }
        
        .portal-card {
            background-color: white;
            border-radius: 16px;
            overflow: hidden;
            width: 320px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
        }
        
        .portal-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        }
        
        .card-header {
            height: 140px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }
        
        .user-card .card-header {
            background: linear-gradient(135deg, #7c4dff 0%, #9688ff 100%);
        }
        
        .admin-card .card-header {
            background: linear-gradient(135deg, #ff4081 0%, #ff80ab 100%);
        }
        
        .decorator-card .card-header {
            background: linear-gradient(135deg, #00c853 0%, #69f0ae 100%);
        }
        
        .card-icon {
            font-size: 3.5rem;
        }
        
        .card-body {
            padding: 2rem;
            text-align: center;
        }
        
        .card-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--dark-color);
        }
        
        .card-text {
            color: #666;
            margin-bottom: 1.5rem;
            font-size: 0.95rem;
        }
        
        .btn {
            padding: 12px 24px;
            font-weight: 500;
            border-radius: 8px;
            transition: all 0.3s ease;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            margin-bottom: 0.75rem;
            display: block;
            width: 100%;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
        }
        
        .btn-primary:hover {
            background-color: #6a40e0;
            border-color: #6a40e0;
        }
        
        .btn-secondary {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            color: white;
        }
        
        .btn-secondary:hover {
            background-color: #e0366f;
            border-color: #e0366f;
        }
        
        .btn-success {
            background-color: var(--success-color);
            border-color: var(--success-color);
            color: white;
        }
        
        .btn-success:hover {
            background-color: #00ae49;
            border-color: #00ae49;
        }
        
        .btn-outline {
            background-color: transparent;
            color: #666;
            border: 1px solid #ddd;
        }
        
        .btn-outline:hover {
            background-color: #f5f5f5;
            color: var(--dark-color);
        }
        
        .footer {
            background-color: white;
            padding: 2rem 0;
            margin-top: auto;
            box-shadow: 0 -4px 12px rgba(0,0,0,0.03);
        }
        
        .footer p {
            margin-bottom: 0;
            color: #666;
        }
        
        @media (max-width: 768px) {
            .card-container {
                flex-direction: column;
                align-items: center;
            }
            
            .portal-card {
                width: 90%;
                max-width: 320px;
            }
            
            .hero h1 {
                font-size: 2.25rem;
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ url('/') }}" class="logo">Festivity<span>.</span></a>
                <div>
                    <a href="{{ url('/') }}" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-home me-1"></i> Home
                    </a>
                </div>
            </div>
        </div>
    </header>

    <main>
        <section class="hero">
            <div class="container">
                <h1>Welcome to Festivity</h1>
                <p>The complete event management system for creating memorable celebrations. Choose your portal to get started.</p>
            </div>
        </section>

        <section class="container">
            <div class="card-container">
                <!-- User Portal -->
                <div class="portal-card user-card">
                    <div class="card-header">
                        <i class="fas fa-user card-icon"></i>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title">User Portal</h3>
                        <p class="card-text">Book your favorite events and packages, manage orders, and provide feedback.</p>
                        <a href="{{ url('/') }}" class="btn btn-primary">
                            <i class="fas fa-external-link-alt me-2"></i> Visit Site
                        </a>
                        <a href="{{ route('login') }}" class="btn btn-outline">
                            <i class="fas fa-sign-in-alt me-2"></i> Login
                        </a>
                    </div>
                </div>
                
                <!-- Admin Portal -->
                <div class="portal-card admin-card">
                    <div class="card-header">
                        <i class="fas fa-user-shield card-icon"></i>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title">Admin Portal</h3>
                        <p class="card-text">Manage the entire system, users, decorators, and view overall statistics.</p>
                        @auth('admin')
                        <a href="{{ url('/admin') }}" class="btn btn-secondary">
                            <i class="fas fa-external-link-alt me-2"></i> Visit Dashboard
                        </a>
                        @else
                        <a href="{{ url('/admin/login') }}" class="btn btn-secondary">
                            <i class="fas fa-external-link-alt me-2"></i> Visit Dashboard
                        </a>
                        @endauth
                        <a href="{{ url('/admin/login') }}" class="btn btn-outline">
                            <i class="fas fa-sign-in-alt me-2"></i> Login
                        </a>
                    </div>
                </div>
                
                <!-- Decorator Portal -->
                <div class="portal-card decorator-card">
                    <div class="card-header">
                        <i class="fas fa-palette card-icon"></i>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title">Decorator Portal</h3>
                        <p class="card-text">Manage your events and packages, track bookings, and view customer feedback.</p>
                        <a href="{{ url('/decorator') }}" class="btn btn-success">
                            <i class="fas fa-external-link-alt me-2"></i> Visit Dashboard
                        </a>
                        <a href="{{ url('/decorator/login') }}" class="btn btn-outline">
                            <i class="fas fa-sign-in-alt me-2"></i> Login
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p>© {{ date('Y') }} Festivity. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="{{ url('/terms-conditions') }}" class="text-decoration-none me-3 text-muted">Terms & Conditions</a>
                    <a href="{{ url('/privacy-policy') }}" class="text-decoration-none text-muted">Privacy Policy</a>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
