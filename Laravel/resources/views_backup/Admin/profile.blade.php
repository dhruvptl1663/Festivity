<!-- Admin Profile Page -->
@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Admin Profile</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="profile-image">
                                <div class="avatar-initials">
                                    {{ getInitials(Auth::guard('admin')->user()->name) }}
                                </div>
                            </div>
                            <div class="mt-3">
                                <a href="{{ route('admin.profile.edit') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-edit me-2"></i>Edit Profile
                                </a>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="profile-info">
                                <h5>{{ Auth::guard('admin')->user()->name }}</h5>
                                <p class="text-muted">Administrator</p>
                                <div class="mt-4">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p class="mb-1"><strong>Email:</strong></p>
                                            <p class="text-muted">{{ Auth::guard('admin')->user()->email }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="mb-1"><strong>Role:</strong></p>
                                            <p class="text-muted">Administrator</p>
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

<style>
    .avatar-initials {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary-color) 0%, #8b5cf6 100%);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 3rem;
    }
    
    .profile-info h5 {
        color: var(--text-dark);
        font-weight: 600;
        font-size: 1.5rem;
    }
    
    .profile-info p {
        margin-bottom: 0.5rem;
        font-size: 1.1rem;
    }
    
    .btn-primary {
        padding: 0.5rem 1.5rem;
        border-radius: 8px;
        font-size: 1rem;
    }
</style>
@endsection
