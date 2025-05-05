@extends('layouts.admin')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-xl-10">
            <div class="glass-card p-5 rounded-5">
                <div class="header-bar mb-5">
                    <h1 class="display-5 fw-bold text-purple mb-4">Send New Notification</h1>
                    <div class="accent-line" style="width: 80px; height: 6px;"></div>
                </div>

                <form action="{{ route('admin.notifications.store') }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    
                    <!-- Recipient Field -->
                    <div class="form-floating mb-5">
                        <select class="form-control form-control-xl rounded-4 @error('user_id') is-invalid @enderror" 
                                id="user_id" name="user_id" required
                                style="height: 70px; font-size: 1.25rem;">
                            <option value="">Select User</option>
                            @foreach($users as $user)
                                <option value="{{ $user->user_id }}">{{ $user->name }} ({{ $user->email }})</option>
                            @endforeach
                        </select>
                        <label for="user_id" class="text-muted fs-5">
                            <i class="fas fa-user me-3 fa-lg"></i>Recipient
                        </label>
                        @error('user_id')
                            <div class="invalid-feedback ps-5 fs-5">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Title Field -->
                    <div class="form-floating mb-5">
                        <input type="text" class="form-control form-control-xl rounded-4 @error('title') is-invalid @enderror" 
                               id="title" name="title" placeholder=" " required
                               style="height: 70px; font-size: 1.25rem;">
                        <label for="title" class="text-muted fs-5">
                            <i class="fas fa-heading me-3 fa-lg"></i>Notification Title
                        </label>
                        @error('title')
                            <div class="invalid-feedback ps-5 fs-5">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Message Field -->
                    <div class="form-floating mb-5">
                        <textarea class="form-control form-control-xl rounded-4 @error('message') is-invalid @enderror" 
                                  id="message" name="message" rows="4" 
                                  style="font-size: 1.25rem; padding: 1.5rem;" required></textarea>
                        <label for="message" class="text-muted fs-5">
                            <i class="fas fa-comment me-3 fa-lg"></i>Notification Message
                        </label>
                        @error('message')
                            <div class="invalid-feedback ps-5 fs-5">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="d-grid gap-3">
                        <button type="submit" class="btn btn-purple-xl rounded-pill py-4 fs-4">
                            <i class="fas fa-paper-plane me-3 fa-lg"></i>Send Notification
                        </button>
                        <a href="{{ route('admin.notifications.index') }}" class="btn btn-outline-purple-xl rounded-pill py-4 fs-4">
                            <i class="fas fa-times me-3 fa-lg"></i>Cancel
                        </a>
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
        padding: 1.5rem 3rem;
        transition: all 0.3s ease;
        font-size: 1.5rem;
    }

    .btn-purple-xl:hover {
        background: #5b4bc4;
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(108, 92, 231, 0.4);
    }

    .btn-outline-purple-xl {
        color: #6c5ce7;
        border: 2px solid #6c5ce7;
        padding: 1.5rem 3rem;
        transition: all 0.3s ease;
        font-size: 1.5rem;
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
</style>
@endpush