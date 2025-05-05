@extends('layouts.admin')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-xl-10">
            <div class="glass-card p-5 rounded-5">
                <div class="header-bar mb-5">
                    <h1 class="display-5 fw-bold text-purple mb-4">Create New Admin</h1>
                    <div class="accent-line" style="width: 80px; height: 6px;"></div>
                </div>

                <form action="{{ route('admin.admins.store') }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    
                    <!-- Name Field -->
                    <div class="form-floating mb-5">
                        <input type="text" class="form-control form-control-xl rounded-4 @error('name') is-invalid @enderror" 
                               id="name" name="name" placeholder=" " required
                               style="height: 70px; font-size: 1.25rem;">
                        <label for="name" class="text-muted fs-5">
                            <i class="fas fa-user me-3 fa-lg"></i>Admin Name
                        </label>
                        @error('name')
                            <div class="invalid-feedback ps-5 fs-5">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email Field -->
                    <div class="form-floating mb-5">
                        <input type="email" class="form-control form-control-xl rounded-4 @error('email') is-invalid @enderror" 
                               id="email" name="email" placeholder=" " required
                               style="height: 70px; font-size: 1.25rem;">
                        <label for="email" class="text-muted fs-5">
                            <i class="fas fa-envelope me-3 fa-lg"></i>Email Address
                        </label>
                        @error('email')
                            <div class="invalid-feedback ps-5 fs-5">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div class="form-floating mb-5">
                        <input type="password" class="form-control form-control-xl rounded-4 @error('password') is-invalid @enderror" 
                               id="password" name="password" placeholder=" " required
                               style="height: 70px; font-size: 1.25rem;">
                        <label for="password" class="text-muted fs-5">
                            <i class="fas fa-lock me-3 fa-lg"></i>Password
                        </label>
                        @error('password')
                            <div class="invalid-feedback ps-5 fs-5">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-end gap-3 mt-5">
                        <a href="{{ route('admin.admins.index') }}" class="btn btn-outline-purple-xl rounded-pill py-3 fs-4">
                            <i class="fas fa-times me-3 fa-lg"></i>Cancel
                        </a>
                        <button type="submit" class="btn btn-purple-xl rounded-pill py-3 fs-4">
                            <i class="fas fa-plus-circle me-3 fa-lg"></i>Create Admin
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
    .glass-card {
        margin-top: 80px;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(30px);
        border: 2px solid rgba(255, 255, 255, 0.4);
        box-shadow: 0 12px 40px rgba(31, 38, 135, 0.15);
        border-radius: 20px;
    }

    .text-purple {
        color: #6c5ce7;
    }

    .btn-purple-xl {
        background: #6c5ce7;
        color: white;
        border: none;
        padding: 1.2rem 2.5rem;
        transition: all 0.3s ease;
        font-size: 1.25rem;
    }

    .btn-purple-xl:hover {
        background: #5b4bc4;
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(108, 92, 231, 0.4);
    }

    .btn-outline-purple-xl {
        color: #6c5ce7;
        border: 2px solid #6c5ce7;
        padding: 1.2rem 2.5rem;
        transition: all 0.3s ease;
        font-size: 1.25rem;
    }

    .btn-outline-purple-xl:hover {
        background: rgba(108, 92, 231, 0.1);
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(108, 92, 231, 0.2);
    }

    .accent-line {
        background: #6c5ce7;
        margin-top: 1rem;
    }

    .form-control-xl {
        font-size: 1.25rem;
        padding: 1.5rem 2rem;
    }

    .form-floating > label {
        padding-left: 2rem;
    }

    .invalid-feedback {
        padding-left: 2rem;
        font-size: 0.9rem;
    }
</style>
@endpush