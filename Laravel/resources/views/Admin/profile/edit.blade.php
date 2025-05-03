@extends('layouts.admin')

@section('content')
<div class="main-content-wrap" style="margin-top:40px;">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <!-- Profile Card -->
                <div class="card shadow-lg border-0 mb-4" style="border-radius: 20px; overflow: hidden;">
                    <div class="card-header p-4" style="background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);">
                        <h5 class="mb-0 text-white fs-4 fw-bold">Profile Settings</h5>
                        <p class="text-white-50 mb-0">Manage your administrative information</p>
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

                        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <div class="row mb-4 align-items-center">
                                <div class="col-md-3 text-center">
                                    <div class="position-relative">
                                        <div class="profile-image-container mx-auto mb-3 hover-scale d-flex justify-content-center align-items-center" 
                                             style="width: 120px; height: 120px; border-radius: 50%; overflow: hidden; 
                                                    border: 3px solid #e0e0e0; transition: transform 0.3s ease;
                                                    background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);">
                                            <span class="text-white fw-bold fs-1">{{ strtoupper(substr($admin->name, 0, 1)) }}</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-9">
                                    <div class="mb-4">
                                        <label for="name" class="form-label">Admin Name</label>
                                        <input type="text" 
                                               class="form-control form-control-lg rounded-3 @error('name') is-invalid @enderror" 
                                               id="name" 
                                               name="name" 
                                               value="{{ old('name', $admin->name) }}" 
                                               required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label for="email" class="form-label">Email Address</label>
                                        <input type="email" 
                                               class="form-control form-control-lg rounded-3 @error('email') is-invalid @enderror" 
                                               id="email" 
                                               name="email" 
                                               value="{{ old('email', $admin->email) }}" 
                                               required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="border-top pt-4 mt-2">
                                <h6 class="mb-4 fw-bold text-primary">Password Settings</h6>
                                <div class="mb-4">
                                    <label for="current_password" class="form-label">Current Password</label>
                                    <input type="password" 
                                           class="form-control form-control-lg rounded-3 @error('current_password') is-invalid @enderror" 
                                           id="current_password" 
                                           name="current_password"
                                           placeholder="••••••••">
                                    <small class="text-muted">Enter current password to make changes</small>
                                    @error('current_password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-4">
                                    <label for="new_password" class="form-label">New Password</label>
                                    <input type="password" 
                                           class="form-control form-control-lg rounded-3 @error('new_password') is-invalid @enderror" 
                                           id="new_password" 
                                           name="new_password"
                                           placeholder="••••••••">
                                    @error('new_password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-4">
                                    <label for="confirm_password" class="form-label">Confirm Password</label>
                                    <input type="password" 
                                           class="form-control form-control-lg rounded-3 @error('confirm_password') is-invalid @enderror" 
                                           id="confirm_password" 
                                           name="confirm_password"
                                           placeholder="••••••••">
                                    @error('confirm_password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-end mt-5 gap-3">
                                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary px-4 rounded-pill">
                                    <i class="bi bi-x-circle me-2"></i>Cancel
                                </a>
                                <button type="submit" class="btn btn-primary px-4 rounded-pill">
                                    <i class="bi bi-save me-2"></i>Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- Account Information Card removed as requested -->
            </div>
        </div>
    </div>
</div>

<style>
    /* Custom background colors */
    .bg-primary-soft {
        background-color: rgba(99, 102, 241, 0.1);
    }
    .bg-success-soft {
        background-color: rgba(16, 185, 129, 0.1);
    }
    .bg-warning-soft {
        background-color: rgba(245, 158, 11, 0.1);
    }
    .bg-info-soft {
        background-color: rgba(6, 182, 212, 0.1);
    }
    
    /* Hover scale effect */
    .hover-scale:hover {
        transform: scale(1.05);
    }
</style>
@endsection
