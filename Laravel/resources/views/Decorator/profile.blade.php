@extends('layouts.decorator')

@section('content')
<div class="main-content-wrap" style="margin-top:40px;">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <!-- Profile Card -->
                <div class="card shadow-lg border-0 mb-4" style="border-radius: 20px; overflow: hidden;">
                    <div class="card-header p-4" style="background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);">
                        <h5 class="mb-0 text-white fs-4 fw-bold">Profile Settings</h5>
                        <p class="text-white-50 mb-0">Manage your professional information</p>
                    </div>
                    <div class="card-body p-4">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
                                <i class="bi bi-check-circle me-2"></i>
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show rounded-3" role="alert">
                                <i class="bi bi-x-circle me-2"></i>
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('decorator.profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="row mb-4 align-items-center">
                                <div class="col-md-3 text-center">
                                    <div class="position-relative">
                                        <div class="profile-image-container mx-auto mb-3 hover-scale" 
                                             style="width: 120px; height: 120px; border-radius: 50%; overflow: hidden; 
                                                    border: 3px solid #e0e0e0; transition: transform 0.3s ease;">
                                            @if($decorator->decorator_icon)
                                                <img src="{{ asset($decorator->decorator_icon) }}" 
                                                     alt="{{ $decorator->decorator_name }}" 
                                                     class="img-fluid" 
                                                     style="width: 100%; height: 100%; object-fit: cover;">
                                            @else
                                                <div class="d-flex justify-content-center align-items-center bg-light h-100">
                                                    <i class="bi bi-person-circle text-muted" style="font-size: 3rem;"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <label for="decorator_icon" class="btn btn-sm btn-outline-primary rounded-pill">
                                            <i class="bi bi-upload me-2"></i>Upload
                                            <input type="file" class="visually-hidden" 
                                                   id="decorator_icon" name="decorator_icon" accept="image/*">
                                        </label>
                                        @error('decorator_icon')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-9">
                                    <div class="mb-4">
                                        <label for="decorator_name" class="form-label">Business Name</label>
                                        <input type="text" 
                                               class="form-control form-control-lg rounded-3 @error('decorator_name') is-invalid @enderror" 
                                               id="decorator_name" 
                                               name="decorator_name" 
                                               value="{{ old('decorator_name', $decorator->decorator_name) }}" 
                                               required>
                                        @error('decorator_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label for="email" class="form-label">Email Address</label>
                                        <input type="email" 
                                               class="form-control form-control-lg rounded-3 @error('email') is-invalid @enderror" 
                                               id="email" 
                                               name="email" 
                                               value="{{ old('email', $decorator->email) }}" 
                                               required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">Availability</label>
                                        <div class="toggle-switch d-flex align-items-center">
                                            <!-- Hidden input to ensure the field is always submitted -->
                                            <input type="hidden" name="availability" value="0">
                                            <input type="checkbox" 
                                                   id="availability" 
                                                   name="availability" 
                                                   value="1"
                                                   class="toggle-input"
                                                   {{ $decorator->availability ? 'checked' : '' }}>
                                            <label for="availability" class="toggle-slider"></label>
                                            <span class="toggle-status ms-3">
                                                {{ $decorator->availability ? 'Available' : 'Unavailable' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="border-top pt-4 mt-2">
                                <h6 class="mb-4 fw-bold text-primary">Password Settings</h6>
                                <div class="mb-4">
                                    <label for="password" class="form-label">New Password</label>
                                    <input type="password" 
                                           class="form-control form-control-lg rounded-3 @error('password') is-invalid @enderror" 
                                           id="password" 
                                           name="password"
                                           placeholder="••••••••">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-4">
                                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                                    <input type="password" 
                                           class="form-control form-control-lg rounded-3 @error('password_confirmation') is-invalid @enderror" 
                                           id="password_confirmation" 
                                           name="password_confirmation"
                                           placeholder="••••••••">
                                    @error('password_confirmation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-end mt-5 gap-3">
                                <button type="reset" class="btn btn-outline-secondary px-4 rounded-pill">
                                    <i class="bi bi-arrow-counterclockwise me-2"></i>Reset
                                </button>
                                <button type="submit" class="btn btn-primary px-4 rounded-pill">
                                    <i class="bi bi-save me-2"></i>Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- Account Information Card -->
                <div class="card shadow-lg border-0 mt-4" style="border-radius: 20px; overflow: hidden;">
                    <div class="card-header p-4 bg-light">
                        <h5 class="mb-0 fw-bold">Account Overview</h5>
                        <p class="text-muted mb-0">Your account details</p>
                    </div>
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="icon-container bg-primary-soft rounded-3 p-3">
                                        <i class="bi bi-envelope-fill text-primary fs-4"></i>
                                    </div>
                                    <div>
                                        <p class="text-muted mb-1">Email Address</p>
                                        <p class="mb-0 fw-semibold">{{ $decorator->email }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="icon-container bg-success-soft rounded-3 p-3">
                                        <i class="bi bi-person-badge-fill text-success fs-4"></i>
                                    </div>
                                    <div>
                                        <p class="text-muted mb-1">Account ID</p>
                                        <p class="mb-0 fw-semibold">{{ $decorator->decorator_id }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="icon-container bg-info-soft rounded-3 p-3">
                                        <i class="bi bi-toggle-on text-info fs-4"></i>
                                    </div>
                                    <div>
                                        <p class="text-muted mb-1">Availability Status</p>
                                        <p class="mb-0 fw-semibold">
                                            <span class="badge bg-{{ $decorator->availability ? 'success' : 'secondary' }} rounded-pill">
                                                {{ $decorator->availability ? 'Available' : 'Unavailable' }}
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="icon-container bg-warning-soft rounded-3 p-3">
                                        <i class="bi bi-shield-check text-warning fs-4"></i>
                                    </div>
                                    <div>
                                        <p class="text-muted mb-1">Account Status</p>
                                        <p class="mb-0 fw-semibold">
                                            <span class="badge bg-success rounded-pill">Active</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Custom Toggle Switch */
    .toggle-switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
        margin-left:20px;
    }

    .toggle-input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .toggle-slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: .4s;
        border-radius: 34px;
    }

    .toggle-slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        transition: .4s;
        border-radius: 50%;
    }

    .toggle-input:checked + .toggle-slider {
        background-color: #6366f1;
    }

    .toggle-input:checked + .toggle-slider:before {
        transform: translateX(26px);
    }

    .toggle-status {
        font-weight: 500;
        color: #495057;
    }

    /* Icon Fixes */
    .bi::before {
        vertical-align: middle;
    }

    .hover-scale:hover {
        transform: scale(1.05);
    }
    
    .bg-primary-soft {
        background-color: rgba(99, 102, 241, 0.1);
    }
    
    .bg-success-soft {
        background-color: rgba(40, 167, 69, 0.1);
    }
    
    .bg-info-soft {
        background-color: rgba(23, 162, 184, 0.1);
    }
    
    .bg-warning-soft {
        background-color: rgba(255, 193, 7, 0.1);
    }
    
    .form-control:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.25);
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
        border: none;
        transition: all 0.3s ease;
    }
    
    .btn-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
    }
</style>

<!-- Add Bootstrap Icons CDN if not already included -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

@endsection

@push('scripts')
<script>
    // Enhanced Image Preview
    const fileInput = document.getElementById('decorator_icon');
    const imageContainer = document.querySelector('.profile-image-container');

    fileInput.addEventListener('change', function(e) {
        const file = this.files[0];
        if (file) {
            if (file.size > 2 * 1024 * 1024) {
                alert('File size exceeds 2MB');
                this.value = '';
                return;
            }
            
            const reader = new FileReader();
            
            reader.onload = function(e) {
                imageContainer.innerHTML = `
                    <img src="${e.target.result}" 
                         alt="Profile Preview" 
                         class="img-fluid hover-scale"
                         style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease;">
                `;
            };
            
            reader.readAsDataURL(file);
        }
    });

    // Dynamic Availability Label Update
    const availabilityToggle = document.getElementById('availability');
    const availabilityStatus = document.querySelector('.toggle-status');
    
    if (availabilityToggle) {
        availabilityToggle.addEventListener('change', function() {
            const status = this.checked ? 'Available' : 'Unavailable';
            availabilityStatus.textContent = status;
        });
    }
</script>
@endpush