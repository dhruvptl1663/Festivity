@extends('layouts.admin')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
    .glass-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(30px);
        border: 2px solid rgba(255, 255, 255, 0.4);
        box-shadow: 0 12px 40px rgba(31, 38, 135, 0.15);
        border-radius: 20px;
        overflow: hidden;
    }

    .text-purple {
        color: #6c5ce7;
    }

    .btn-purple {
        background: #6c5ce7;
        color: white;
        border: none;
        transition: all 0.3s ease;
    }

    .btn-purple:hover {
        background: #5b4bc4;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(108, 92, 231, 0.3);
    }

    .header-bar {
        position: relative;
        padding-bottom: 1.5rem;
    }

    .accent-line {
        background: #6c5ce7;
        height: 4px;
        width: 60px;
        border-radius: 2px;
    }

    .info-card {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        transition: all 0.2s ease;
    }

    .info-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    }

    .info-icon {
        font-size: 1.5rem;
        color: #6c5ce7;
        width: 40px;
        margin-right: 1rem;
    }

    .message-content {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 1.5rem;
        min-height: 200px;
        border: 2px solid #eee;
    }

    .contact-image {
    max-width: 100%;
    border-radius: 12px;
    transition: all 0.3s ease;
    cursor: pointer;
    margin-top: 0.5rem; 
}


    .contact-image:hover {
        transform: scale(1.03);
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }
</style>
@endpush

@section('content')
<div class="container py-5" style="margin-top: 7rem;">
    <div class="row justify-content-center">
        <div class="col-12 col-xl-10">
            <div class="glass-card p-5 rounded-5">
                <div class="header-bar mb-5">
                    <h1 class="display-6 fw-bold text-purple mb-3">
                        <i class="fas fa-envelope-open-text me-2"></i>Message Details
                    </h1>
                    <div class="accent-line"></div>
                </div>

                <div class="row g-4">
                    <!-- Left Column -->
                    <div class="col-md-6">
                        <div class="info-card">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-user-circle info-icon"></i>
                                <div>
                                    <h5 class="text-muted mb-1">Sender Name</h5>
                                    <p class="mb-0 fs-5">{{ $contact->name }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="info-card">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-at info-icon"></i>
                                <div>
                                    <h5 class="text-muted mb-1">Email Address</h5>
                                    <p class="mb-0 fs-5">{{ $contact->email }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="info-card">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-phone info-icon"></i>
                                <div>
                                    <h5 class="text-muted mb-1">Phone Number</h5>
                                    <p class="mb-0 fs-5">{{ $contact->phone }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="info-card">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-clock info-icon"></i>
                                <div>
                                    <h5 class="text-muted mb-1">Date Sent</h5>
                                    <p class="mb-0 fs-5">{{ $contact->created_at->format('F d, Y h:i A') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($contact->image)
                        <div class="info-card mt-4">
                            <div class="d-flex align-items-start">
                                <i class="fas fa-image info-icon"></i>
                                <div class="w-100">
                                    <h5 class="text-muted mb-3">Attached Image</h5>
                                    <img src="{{ asset($contact->image) }}" 
                                         alt="Contact Image" 
                                         class="contact-image"
                                         data-bs-toggle="modal" 
                                         data-bs-target="#imageModal"
                                         onerror="this.src='{{ asset('images/default-image.jpg') }}'">
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Right Column -->
                    <div class="col-md-6">
                        <div class="info-card h-100">
                            <div class="d-flex align-items-start">
                                <i class="fas fa-comment-dots info-icon"></i>
                                <div class="w-100">
                                    <h5 class="text-muted mb-3">Message Content</h5>
                                    <div class="message-content">
                                        {{ $contact->message }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-5">
                    <a href="{{ route('admin.contacts.index') }}" 
                       class="btn btn-purple rounded-pill px-4 py-2">
                        <i class="fas fa-arrow-left me-2"></i>Back to Messages
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection