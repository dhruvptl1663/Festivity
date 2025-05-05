@extends('layouts.admin')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-xl-10">
            <div class="glass-card p-5 rounded-5">
                <div class="header-bar mb-5">
                    <h1 class="display-5 fw-bold text-purple mb-4">Edit Decorator Profile</h1>
                    <div class="accent-line" style="width: 80px; height: 6px;"></div>
                </div>

                <form action="{{ route('admin.decorators.update', $decorator) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                    @csrf
                    @method('PUT')
                    
                    <!-- Name Field -->
                    <div class="form-floating mb-5">
                        <input type="text" class="form-control form-control-xl rounded-4 @error('decorator_name') is-invalid @enderror" 
                               id="decorator_name" name="decorator_name" value="{{ $decorator->decorator_name }}" 
                               placeholder=" " required style="height: 70px; font-size: 1.25rem;">
                        <label for="decorator_name" class="text-muted fs-5">
                            <i class="fas fa-user-tag me-3 fa-lg"></i>Decorator Full Name
                        </label>
                        @error('decorator_name')
                            <div class="invalid-feedback ps-5 fs-5">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email Field -->
                    <div class="form-floating mb-5">
                        <input type="email" class="form-control form-control-xl rounded-4 @error('email') is-invalid @enderror" 
                               id="email" name="email" value="{{ $decorator->email }}" placeholder=" " required
                               style="height: 70px; font-size: 1.25rem;">
                        <label for="email" class="text-muted fs-5">
                            <i class="fas fa-at me-3 fa-lg"></i>Professional Email Address
                        </label>
                        @error('email')
                            <div class="invalid-feedback ps-5 fs-5">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div class="form-floating mb-5">
                        <input type="password" class="form-control form-control-xl rounded-4 @error('password') is-invalid @enderror" 
                               id="password" name="password" placeholder=" "
                               style="height: 70px; font-size: 1.25rem;">
                        <label for="password" class="text-muted fs-5">
                            <i class="fas fa-key me-3 fa-lg"></i>New Password (leave blank to keep current)
                        </label>
                        @error('password')
                            <div class="invalid-feedback ps-5 fs-5">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Profile Picture Upload -->
                    <div class="mb-5">
                        <label class="form-label text-muted mb-4 fs-5">
                            <i class="fas fa-camera-retro me-3 fa-lg"></i>Profile Image Update
                        </label>
                        <div class="drop-zone rounded-4 p-5 text-center border-3 dashed-border" style="min-height: 200px;">
                            <input type="file" class="form-control visually-hidden" 
                                   id="decorator_icon" name="decorator_icon" accept="image/*">
                            <div class="drop-zone-content">
                                <i class="fas fa-cloud-upload-alt display-4 text-purple mb-4"></i>
                                <p class="mb-2 fs-5">Drag & drop new photos here</p>
                                @if($decorator->decorator_icon)
                                    <div class="existing-image mt-3">
                                        <img src="{{ asset('storage/' . $decorator->decorator_icon) }}" 
                                             alt="{{ $decorator->decorator_name }}" 
                                             width="100" height="100" class="rounded-circle shadow-sm">
                                        <p class="text-muted mt-2 mb-0 fs-6">Current Profile Image</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                        @error('decorator_icon')
                            <div class="invalid-feedback d-block ps-5 fs-5">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Rating Field -->
                    <div class="mb-5">
                        <label class="form-label text-muted fs-5">
                            <i class="fas fa-star-half-alt me-3 fa-lg"></i>Professional Rating
                        </label>
                        <div class="rating-input">
                            <input type="number" step="0.1" 
                                   class="form-control form-control-xl rounded-pill @error('rating') is-invalid @enderror" 
                                   id="rating" name="rating" value="{{ $decorator->rating }}" 
                                   min="0" max="5" style="height: 70px; font-size: 1.25rem; padding-left: 2rem;">
                            <span class="rating-label fs-4">/5</span>
                        </div>
                        @error('rating')
                            <div class="invalid-feedback ps-5 fs-5">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Availability Toggle -->
                    <div class="mb-5">
                        <div class="d-flex align-items-center gap-4">
                            <label class="form-label text-muted fs-5 mb-0">
                                <i class="fas fa-toggle-on me-3 fa-lg"></i>Current Availability
                            </label>
                            <div class="toggle-switch-lg">
                                <input type="checkbox" class="visually-hidden" 
                                       id="availability" name="availability" value="1" {{ $decorator->availability ? 'checked' : '' }}>
                                <label for="availability" class="switch-label-lg">
                                    <span class="switch-handle-lg"></span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="d-grid mt-5">
                        <button type="submit" class="btn btn-purple-xl rounded-pill py-4 fs-4">
                            <i class="fas fa-save me-3 fa-lg"></i>Update Professional Profile
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Include the same styles as in the create form */
    .glass-card {
        margin-top: 80px;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(30px);
        border: 2px solid rgba(255, 255, 255, 0.4);
        box-shadow: 0 12px 40px rgba(31, 38, 135, 0.15);
    }

    .text-purple {
        color: #6c5ce7;
    }

    .btn-purple-xl {
        background: #6c5ce7;
        color: white;
        border: none;
        padding: 1.5rem 3rem;
        transition: all 0.3s ease;
        font-size: 1.5rem;
    }

    .btn-purple-xl:hover {
        background: #5b4bc4;
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(108, 92, 231, 0.4);
    }

    .dashed-border {
        border: 3px dashed #dee2e6;
        transition: all 0.3s ease;
    }

    .drop-zone:hover {
        border-color: #6c5ce7;
        background: rgba(108, 92, 231, 0.05);
    }

    .toggle-switch-lg {
        position: relative;
        display: inline-block;
        width: 80px;
        height: 45px;
    }

    .switch-label-lg {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: .4s;
        border-radius: 45px;
    }

    .switch-label-lg:before {
        position: absolute;
        content: "";
        height: 37px;
        width: 37px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        transition: .4s;
        border-radius: 50%;
    }

    input:checked + .switch-label-lg {
        background-color: #6c5ce7;
    }

    input:checked + .switch-label-lg:before {
        transform: translateX(35px);
    }

    .rating-input {
        position: relative;
        max-width: 300px;
    }

    .rating-label {
        position: absolute;
        right: 30px;
        top: 50%;
        transform: translateY(-50%);
        color: #6c5ce7;
        pointer-events: none;
    }

    .accent-line {
        background: #6c5ce7;
        border-radius: 3px;
    }

    .form-control-xl {
        font-size: 1.25rem;
        padding: 1rem 1.5rem;
    }

    @media (max-width: 768px) {
        .glass-card {
            padding: 2rem !important;
        }
        
        .btn-purple-xl {
            font-size: 1.25rem;
            padding: 1rem 2rem;
        }
        
        .drop-zone {
            min-height: 150px !important;
            padding: 2rem !important;
        }
    }
</style>
@endpush