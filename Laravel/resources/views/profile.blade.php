@extends('layouts.app')

@section('content')
<!-- Remove the default header -->

<div class="profile-page">
    <div class="container-xl">
        <div class="row g-4">
            <!-- Left Sidebar -->
            <div class="col-lg-4">
                <div class="profile-sidebar card border-0 shadow-sm rounded-lg overflow-hidden">
                    <div class="profile-banner bg-gradient-primary"></div>
                    <div class="profile-details text-center p-4">
                        <div class="avatar-wrapper mx-auto mb-3">
                            <div class="avatar-circle bg-light text-dark">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                        </div>
                        <h2 class="h4 mb-1">{{ $user->name }}</h2>
                        <p class="text-muted mb-4">{{ $user->email }}</p>
                        
                        <!-- My Orders Button -->
                        <a href="{{ route('orders') }}" class="btn btn-primary w-100 mb-3">
                            <i class="fas fa-shopping-bag me-2"></i>My Orders
                        </a>
                        
                        <!-- Logout Button -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-light w-100" 
                                    onclick="return confirm('Are you sure you want to logout?')">
                                <i class="fas fa-sign-out-alt me-2"></i>Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Right Content -->
            <div class="col-lg-8">
                <!-- Messages -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show mb-4">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show mb-4">
                        <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- Profile Info Card -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h3 class="h5 mb-4">
                            <i class="fas fa-user-cog me-2 text-primary"></i>Profile Settings
                        </h3>
                        <form method="POST" action="{{ route('profile.update') }}">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                           name="name" value="{{ old('name', $user->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                           name="email" value="{{ old('email', $user->email) }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary px-4">
                                        <i class="fas fa-save me-2"></i>Update Profile
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Password Card -->
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h3 class="h5 mb-4">
                            <i class="fas fa-shield-alt me-2 text-primary"></i>Security Settings
                        </h3>
                        <form method="POST" action="{{ route('profile.update-password') }}">
                            @csrf
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label">Current Password</label>
                                    <input type="password" class="form-control @error('current_password') is-invalid @enderror" 
                                           name="current_password" required>
                                    @error('current_password')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">New Password</label>
                                    <input type="password" class="form-control @error('new_password') is-invalid @enderror" 
                                           name="new_password" required>
                                    @error('new_password')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control @error('new_password_confirmation') is-invalid @enderror" 
                                           name="new_password_confirmation" required>
                                    @error('new_password_confirmation')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary px-4">
                                        <i class="fas fa-key me-2"></i>Change Password
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.profile-page {
    padding: 3rem 0;
    background: #f8f9fa;
}

.profile-sidebar {
    position: sticky;
    top: 1rem;
}

.profile-banner {
    height: 120px;
    background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
}

.avatar-circle {
    width: 100px;
    height: 100px;
    border: 3px solid #fff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    margin-top: -50px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.card {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    background: #fff;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.05);
}

.form-control {
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 0.75rem 1rem;
}

.form-control:focus {
    border-color: #a855f7;
    box-shadow: 0 0 0 3px rgba(168, 85, 247, 0.1);
}

.btn-primary {
    background: #6366f1;
    border: none;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
}

.btn-primary:hover {
    background: #4f46e5;
}

.alert {
    border-radius: 8px;
    padding: 1rem 1.5rem;
}
</style>
@endsection