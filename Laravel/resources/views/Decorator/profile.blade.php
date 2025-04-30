<x-decoratorheader />

<!-- Add Bootstrap Icons CSS if not already included in the layout -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<style>
    .card {
        transition: all 0.3s ease;
        overflow: hidden;
        border-radius: 0.75rem !important;
    }

    .card:hover {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }
    
    .profile-header {
        padding: 2rem;
        background-color: #f8f9fa;
        border-bottom: 1px solid rgba(0,0,0,0.1);
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 1.5rem;
    }
    
    .profile-image {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        overflow: hidden;
        background-color: #e9ecef;
        border: 3px solid #fff;
        box-shadow: 0 0.25rem 0.5rem rgba(0,0,0,0.1);
        flex-shrink: 0;
    }
    
    .profile-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .profile-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #e9ecef;
        color: #6c757d;
        font-size: 3rem;
    }
    
    .profile-details {
        flex-grow: 1;
    }
    
    .form-section {
        background-color: #fff;
        border-radius: 0.75rem;
        box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075);
        overflow: hidden;
        margin-bottom: 1.5rem;
    }
    
    .section-header {
        padding: 1rem 1.5rem;
        background-color: #f8f9fa;
        border-bottom: 1px solid rgba(0,0,0,0.1);
        font-weight: 600;
        display: flex;
        align-items: center;
    }
    
    .section-header i {
        margin-right: 0.5rem;
        color: #6c757d;
    }
    
    .section-body {
        padding: 1.5rem;
    }
    
    .rating-stars {
        display: flex;
        align-items: center;
        color: #fd7e14;
        margin-top: 0.5rem;
    }
    
    .rating-stars i {
        margin-right: 0.25rem;
    }
    
    .btn-icon {
        width: 38px;
        height: 38px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        font-size: 1rem;
        transition: all 0.2s ease;
        vertical-align: middle;
    }
</style>

<div class="main-content">
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <!-- Header Section -->
            <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="mb-1">My Profile</h4>
                    <p class="text-muted">Manage your decorator profile and account settings</p>
                </div>
            </div>
            
            @if(session('success'))
                <div class="alert alert-success mb-4">
                    <i class="bi bi-check-circle me-2"></i>
                    {{ session('success') }}
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-danger mb-4">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    {{ session('error') }}
                </div>
            @endif
            
            <form method="POST" action="{{ route('decorator.profile.update') }}" enctype="multipart/form-data">
                @csrf
                
                <!-- Profile Overview Card -->
                <div class="card mb-4">
                    <div class="profile-header">
                        <div class="profile-image">
                            @if($decorator->decorator_icon)
                                <img src="{{ asset($decorator->decorator_icon) }}" alt="{{ $decorator->decorator_name }}">
                            @else
                                <div class="profile-placeholder">
                                    <i class="bi bi-person"></i>
                                </div>
                            @endif
                        </div>
                        <div class="profile-details">
                            <h3 class="mb-1">{{ $decorator->decorator_name }}</h3>
                            <p class="text-muted mb-2"><i class="bi bi-envelope me-2"></i>{{ $decorator->email }}</p>
                            <div class="rating-stars">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $decorator->rating)
                                        <i class="bi bi-star-fill"></i>
                                    @else
                                        <i class="bi bi-star"></i>
                                    @endif
                                @endfor
                                <span class="ms-2">{{ $decorator->rating }}/5</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Profile Information Card -->
                <div class="form-section">
                    <div class="section-header">
                        <i class="bi bi-person-vcard"></i>
                        <span>Business Information</span>
                    </div>
                    <div class="section-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="decorator_name" class="form-label">Business Name</label>
                                    <input type="text" class="form-control @error('decorator_name') is-invalid @enderror" id="decorator_name" name="decorator_name" value="{{ old('decorator_name', $decorator->decorator_name) }}" required>
                                    @error('decorator_name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $decorator->email) }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="decorator_icon" class="form-label">Business Logo</label>
                                    <input type="file" class="form-control @error('decorator_icon') is-invalid @enderror" id="decorator_icon" name="decorator_icon">
                                    <div class="form-text"><i class="bi bi-info-circle me-1"></i>Upload a logo for your business (JPEG, PNG, JPG, GIF)</div>
                                    @error('decorator_icon')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Security Section -->
                <div class="form-section">
                    <div class="section-header">
                        <i class="bi bi-shield-lock"></i>
                        <span>Security Settings</span>
                    </div>
                    <div class="section-body">
                        <div class="alert alert-light border mb-4">
                            <i class="bi bi-info-circle me-2"></i>
                            <span>Leave password fields blank if you don't want to change your password</span>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="password" class="form-label">New Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" minlength="6">
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="password_confirmation" class="form-label">Confirm New Password</label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" minlength="6">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Submit Button -->
                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i> Update Profile
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<x-decoratorfooter />
