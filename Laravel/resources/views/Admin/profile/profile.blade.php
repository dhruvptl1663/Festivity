<!-- Admin Profile Page -->
@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-transparent px-4 py-3 border-bottom">
                    <h4 class="card-title mb-0 fs-2 text-primary">Admin Profile</h4>
                </div>
                <div class="card-body p-4">
                    <div class="row align-items-center g-5">
                        <div class="col-md-4 text-center">
                            <div class="position-relative">
                                <img src="{{ Auth::guard('admin')->user()->profile_photo_url ?? asset('dashboard/images/avatar/user-1.png') }}" 
                                     alt="Profile" class="img-fluid rounded-circle shadow-lg"
                                     style="width: 160px; height: 160px; object-fit: cover; border: 3px solid #e9ecef;">
                                <div class="mt-4">
                                    <a href="{{ route('admin.profile.edit') }}" class="btn btn-primary px-4 py-2 rounded-pill d-inline-flex align-items-center">
                                        <i class="fas fa-edit me-2"></i>Edit Profile
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="ps-md-4">
                                <h2 class="mb-1 fw-bold text-gradient">{{ Auth::guard('admin')->user()->name }}</h2>
                                <p class="badge bg-primary-soft text-primary fw-medium mb-4">Administrator</p>
                                
                                <div class="bg-light rounded-3 p-4">
                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <div class="d-flex align-items-center">
                                                <div class="icon-shape icon-sm bg-primary-soft text-primary rounded-2 me-3 p-2">
                                                    <i class="fas fa-envelope fs-5"></i>
                                                </div>
                                                <div>
                                                    <p class="mb-0 text-muted fw-semibold">Email</p>
                                                    <p class="mb-0 fw-medium">{{ Auth::guard('admin')->user()->email }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="d-flex align-items-center">
                                                <div class="icon-shape icon-sm bg-primary-soft text-primary rounded-2 me-3 p-2">
                                                    <i class="fas fa-user-shield fs-5"></i>
                                                </div>
                                                <div>
                                                    <p class="mb-0 text-muted fw-semibold">Role</p>
                                                    <p class="mb-0 fw-medium">Administrator</p>
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
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    :root {
        --primary: #6366f1;
        --primary-soft: #e0e7ff;
        --text-gradient: linear-gradient(45deg, #6366f1, #8b5cf6);
    }

    .text-gradient {
        background-image: var(--text-gradient);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .bg-primary-soft {
        background-color: var(--primary-soft);
    }

    .icon-shape {
        transition: transform 0.3s ease;
    }

    .card {
        border-radius: 1rem;
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 1rem 3rem rgba(0,0,0,.1);
    }

    .rounded-pill {
        border-radius: 50rem !important;
    }

    .btn-primary {
        background: var(--primary);
        border: none;
        padding: 0.625rem 1.5rem;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(99, 102, 241, 0.3);
    }
</style>
@endpush