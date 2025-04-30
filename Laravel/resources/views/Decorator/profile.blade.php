@extends('layouts.decorator')

@section('content')
<div class="main-content-wrap">
    <div class="container py-4">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <!-- Profile Card -->
                <div class="card shadow-sm border-0 mb-4" style="border-radius: 16px; overflow: hidden;">
                    <div class="card-header bg-primary text-white p-4">
                        <h5 class="mb-0">Decorator Profile</h5>
                    </div>
                    <div class="card-body p-4">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('decorator.profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="row mb-4">
                                <div class="col-md-3 text-center">
                                    <!-- Current Profile Image -->
                                    <div class="mb-3">
                                        <div class="profile-image-container mx-auto mb-3" style="width: 120px; height: 120px; border-radius: 50%; overflow: hidden; border: 2px solid #eee;">
                                            @if($decorator->decorator_icon)
                                                <img src="{{ asset($decorator->decorator_icon) }}" alt="{{ $decorator->decorator_name }}" class="img-fluid" style="width: 100%; height: 100%; object-fit: cover;">
                                            @else
                                                <div class="d-flex justify-content-center align-items-center bg-light h-100">
                                                    <i class="bi bi-person-circle text-muted" style="font-size: 3rem;"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <label for="decorator_icon" class="form-label">Profile Image</label>
                                        <input type="file" class="form-control form-control-sm @error('decorator_icon') is-invalid @enderror" id="decorator_icon" name="decorator_icon" accept="image/*">
                                        @error('decorator_icon')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Maximum file size: 2MB</div>
                                    </div>
                                </div>
                                
                                <div class="col-md-9">
                                    <!-- Basic Profile Info -->
                                    <div class="mb-3">
                                        <label for="decorator_name" class="form-label">Business Name</label>
                                        <input type="text" class="form-control @error('decorator_name') is-invalid @enderror" id="decorator_name" name="decorator_name" value="{{ old('decorator_name', $decorator->decorator_name) }}" required>
                                        @error('decorator_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email Address</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $decorator->email) }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="border-top pt-4 mt-2">
                                <h6 class="mb-3">Change Password</h6>
                                <div class="mb-3">
                                    <label for="password" class="form-label">New Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Leave blank to keep your current password</div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Confirm New Password</label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-end mt-4">
                                <button type="reset" class="btn btn-light me-2">Reset</button>
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- Account Information Card -->
                <div class="card shadow-sm border-0" style="border-radius: 16px; overflow: hidden;">
                    <div class="card-header bg-light p-4">
                        <h5 class="mb-0">Account Information</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="text-muted mb-1">Email Address</p>
                                <p class="mb-3">{{ $decorator->email }}</p>
                                
                                <p class="text-muted mb-1">Availability Status</p>
                                <p class="mb-0">{{ $decorator->availability ? 'Available' : 'Unavailable' }}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="text-muted mb-1">Account ID</p>
                                <p class="mb-3">{{ $decorator->decorator_id }}</p>
                                
                                <p class="text-muted mb-1">Account Status</p>
                                <p class="mb-0">
                                    <span class="badge bg-success">Active</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Preview uploaded image
    document.getElementById('decorator_icon').addEventListener('change', function(e) {
        const fileInput = e.target;
        const file = fileInput.files[0];
        
        if (file) {
            const reader = new FileReader();
            const imageContainer = document.querySelector('.profile-image-container');
            
            reader.onload = function(e) {
                // Clear existing content
                imageContainer.innerHTML = '';
                
                // Create and append new image
                const img = document.createElement('img');
                img.src = e.target.result;
                img.alt = 'Profile Preview';
                img.classList.add('img-fluid');
                img.style.width = '100%';
                img.style.height = '100%';
                img.style.objectFit = 'cover';
                
                imageContainer.appendChild(img);
            };
            
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush
