@extends('layouts.decorator')

@push('styles')
<!-- Bootstrap Icons CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<style>
    .main-content-admin {
        padding-top: 2rem; 
        padding-bottom: 3rem;
        margin-left: 0px; 
        padding-left: 3rem;
        padding-right: 3rem;
        margin-top: 60px;
        position: relative;
        z-index: 1;
    }
    
    /* Fix dropdown z-index and positioning */
    .dropdown-menu {
        z-index: 1070 !important; /* Higher than most elements */
        position: absolute !important;
        will-change: transform;
        top: 100% !important;
        left: 0 !important;
        transform: none !important;
        margin-top: 0.125rem;
        min-width: 10rem;
        padding: 0.5rem 0;
        font-size: 0.875rem;
        color: #212529;
        text-align: left;
        list-style: none;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid rgba(0, 0, 0, 0.15);
        border-radius: 0.375rem;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }
    
    .dropdown-item {
        display: block;
        width: 100%;
        padding: 0.375rem 1.5rem;
        clear: both;
        font-weight: 400;
        color: #212529;
        text-align: inherit;
        text-decoration: none;
        white-space: nowrap;
        background-color: transparent;
        border: 0;
    }
    
    .dropdown-item:hover, .dropdown-item:focus {
        color: #1e2125;
        background-color: #e9ecef;
    }
    
    .btn-group {
        position: relative;
        z-index: 1000;
    }
    
    /* Ensure the dropdown is not cut off by parent containers */
    .card, .card-body, .booking-detail-card {
        overflow: visible !important;
    }
    
    .booking-detail-card {
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.08);
        border: none;
    }
    
    .card-header-custom {
        background-color: rgba(0,0,0,0.02);
        padding: 1rem 1.5rem;
        border-bottom: 1px solid rgba(0,0,0,0.05);
    }
    
    .detail-list {
        margin: 0;
        padding: 0;
        list-style: none;
    }
    
    .detail-list li {
        padding: 0.75rem 0;
        display: flex;
        justify-content: space-between;
        border-bottom: 1px solid rgba(0,0,0,0.05);
    }
    
    .detail-list li:last-child {
        border-bottom: none;
    }
    
    .detail-label {
        color: #6c757d;
        font-weight: 500;
    }
    
    .detail-value {
        font-weight: 500;
        text-align: right;
    }
    
    .status-badge {
        font-weight: 500;
        font-size: 0.875rem;
        padding: 0.5rem 0.85rem;
        border-radius: 50rem;
    }
</style>
@endpush

@section('content')
<div class="main-content-admin">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="mb-1 fw-bold">Booking #{{ $booking->booking_id }}</h4>
            <p class="text-muted mb-0">View and manage booking details</p>
        </div>
        <a href="{{ route('decorator.bookings') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i> Back to Bookings
        </a>
    </div>
    
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    
    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="row g-4">
        <!-- Status Card -->
        <div class="col-lg-12 mb-4">
            <div class="booking-detail-card">
                <div class="card-header-custom">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-0 fw-bold">Current Status</h5>
                        </div>
                        <span class="status-badge {{ 
                            $booking->status == 'pending' ? 'bg-warning' : 
                            ($booking->status == 'accepted' ? 'bg-info' : 
                            ($booking->status == 'rejected' ? 'bg-secondary' : 
                            ($booking->status == 'completed' ? 'bg-success' : 'bg-danger'))) }}">
                            {{ ucfirst($booking->status) }}
                        </span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <div class="d-flex align-items-center">
                                <div class="me-4 p-3 rounded-circle {{ 
                                    $booking->status == 'pending' ? 'bg-warning bg-opacity-10' : 
                                    ($booking->status == 'accepted' ? 'bg-info bg-opacity-10' : 
                                    ($booking->status == 'rejected' ? 'bg-secondary bg-opacity-10' : 
                                    ($booking->status == 'completed' ? 'bg-success bg-opacity-10' : 'bg-danger bg-opacity-10'))) }}">
                                    <i class="bi {{ 
                                        $booking->status == 'pending' ? 'bi-hourglass' : 
                                        ($booking->status == 'accepted' ? 'bi-check-circle' : 
                                        ($booking->status == 'rejected' ? 'bi-x-circle' : 
                                        ($booking->status == 'completed' ? 'bi-trophy' : 'bi-slash-circle'))) }} 
                                        fs-4 {{ 
                                        $booking->status == 'pending' ? 'text-warning' : 
                                        ($booking->status == 'accepted' ? 'text-info' : 
                                        ($booking->status == 'rejected' ? 'text-secondary' : 
                                        ($booking->status == 'completed' ? 'text-success' : 'text-danger'))) }}"></i>
                                </div>
                                <div>
                                    <p class="mb-1 text-muted">Booking was created on {{ date('d M Y', strtotime($booking->created_at)) }}</p>
                                    <p class="mb-1">
                                        @if($booking->status == 'pending')
                                            This booking is awaiting your confirmation.
                                        @elseif($booking->status == 'accepted')
                                            You've accepted this booking.
                                        @elseif($booking->status == 'rejected')
                                            You've rejected this booking.
                                        @elseif($booking->status == 'completed')
                                            This booking has been completed successfully.
                                        @elseif($booking->status == 'cancelled')
                                            This booking was cancelled.
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 text-md-end mt-3 mt-md-0">
                            <div class="dropdown">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                                    <i class="bi bi-arrow-repeat me-1"></i> Update Status
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    @if($booking->status != 'pending')
                                    <li>
                                        <form action="{{ route('decorator.bookings.status', $booking->booking_id) }}" method="POST" class="status-update-form">
                                            @csrf
                                            <input type="hidden" name="status" value="pending">
                                            <button type="submit" class="dropdown-item"><i class="bi bi-hourglass me-2"></i> Mark as Pending</button>
                                        </form>
                                    </li>
                                    @endif
                                    
                                    @if($booking->status != 'accepted')
                                    <li>
                                        <form action="{{ route('decorator.bookings.status', $booking->booking_id) }}" method="POST" class="status-update-form">
                                            @csrf
                                            <input type="hidden" name="status" value="accepted">
                                            <button type="submit" class="dropdown-item"><i class="bi bi-check-circle me-2"></i> Mark as Accepted</button>
                                        </form>
                                    </li>
                                    @endif
                                    
                                    @if($booking->status != 'rejected')
                                    <li>
                                        <form action="{{ route('decorator.bookings.status', $booking->booking_id) }}" method="POST" class="status-update-form">
                                            @csrf
                                            <input type="hidden" name="status" value="rejected">
                                            <button type="submit" class="dropdown-item"><i class="bi bi-x-circle me-2"></i> Mark as Rejected</button>
                                        </form>
                                    </li>
                                    @endif
                                    
                                    @if($booking->status != 'completed')
                                    <li>
                                        <form action="{{ route('decorator.bookings.status', $booking->booking_id) }}" method="POST" class="status-update-form">
                                            @csrf
                                            <input type="hidden" name="status" value="completed">
                                            <button type="submit" class="dropdown-item"><i class="bi bi-trophy me-2"></i> Mark as Completed</button>
                                        </form>
                                    </li>
                                    @endif
                                    
                                    @if($booking->status != 'cancelled')
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="{{ route('decorator.bookings.status', $booking->booking_id) }}" method="POST" class="cancel-form" onsubmit="return confirm('Are you sure you want to cancel this booking? This will process a 50% refund.')">
                                            @csrf
                                            <input type="hidden" name="status" value="cancelled">
                                            <button type="submit" class="dropdown-item text-danger"><i class="bi bi-x-circle me-2"></i> Cancel Booking (50% Refund)</button>
                                        </form>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Customer and Event Information -->
        <div class="col-md-6 mb-4">
            <div class="booking-detail-card">
                <div class="card-header-custom">
                    <h5 class="mb-0 fw-bold"><i class="bi bi-person me-2"></i>Customer Information</h5>
                </div>
                <div class="card-body">
                    <ul class="detail-list">
                        <li>
                            <span class="detail-label">Name:</span>
                            <span class="detail-value">{{ $booking->user->name ?? 'N/A' }}</span>
                        </li>
                        <li>
                            <span class="detail-label">Email:</span>
                            <span class="detail-value">{{ $booking->user->email ?? 'N/A' }}</span>
                        </li>
                        <li>
                            <span class="detail-label">Phone:</span>
                            <span class="detail-value">{{ $booking->user->phone_number ?? 'N/A' }}</span>
                        </li>
                        <li>
                            <span class="detail-label">Customer Since:</span>
                            <span class="detail-value">{{ $booking->user ? date('M d, Y', strtotime($booking->user->created_at)) : 'N/A' }}</span>
                        </li>
                        <li>
                            <span class="detail-label">Booking Date:</span>
                            <span class="detail-value">{{ date('M d, Y', strtotime($booking->created_at)) }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="booking-detail-card">
                <div class="card-header-custom">
                    <h5 class="mb-0 fw-bold"><i class="bi bi-calendar-event me-2"></i>Event Information</h5>
                </div>
                <div class="card-body">
                    <ul class="detail-list">
                        <li>
                            <span class="detail-label">Type:</span>
                            <span class="detail-value">
                                @if($booking->event_id)
                                    {{ $booking->event->title ?? 'Custom Event' }}
                                    <span class="badge bg-light text-dark">Event</span>
                                @elseif($booking->package_id)
                                    {{ $booking->package->title ?? 'Custom Package' }}
                                    <span class="badge bg-info bg-opacity-10 text-info">Package</span>
                                @else
                                    Custom Booking
                                @endif
                            </span>
                        </li>
                        @if($booking->event_id && isset($booking->event->category))
                        <li>
                            <span class="detail-label">Category:</span>
                            <span class="detail-value">{{ $booking->event->category->category_name ?? 'N/A' }}</span>
                        </li>
                        @endif
                        @if($booking->package_id && !empty($booking->package->description))
                        <li>
                            <span class="detail-label">Package Description:</span>
                            <span class="detail-value">{{ $booking->package->description }}</span>
                        </li>
                        @endif
                        <li>
                            <span class="detail-label">Event Date:</span>
                            <span class="detail-value">{{ $booking->event_datetime ? date('M d, Y', strtotime($booking->event_datetime)) : 'Not specified' }}</span>
                        </li>
                        <li>
                            <span class="detail-label">Location:</span>
                            <span class="detail-value">{{ $booking->event ? ($booking->event->location ?? 'Not specified') : 'Not specified' }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

                        <!-- Payment Information -->
                        <div class="col-md-6 mb-4">
                            <div class="card border-0 shadow-sm h-100" style="border-radius: 16px; overflow: hidden;">
                                <div class="card-header bg-transparent" style="border-bottom: 1px solid rgba(0, 0, 0, 0.03); background-color: rgba(59, 130, 246, 0.03); padding: 18px 20px;">
                                    <h6 class="mb-0" style="color: #1e293b; font-weight: 600;"><i class="icon-credit-card me-2"></i>Payment Information</h6>
                                </div>
                                <div class="card-body" style="padding: 20px;">
                                    @php
                                        // Get amounts from booking
                                        $originalAmount = $booking->original_amount ?? ($booking->package ? $booking->package->price : ($booking->event ? $booking->event->price : 0));
                                        $discountAmount = $booking->discount_amount ?? 0;
                                        $finalAmount = $booking->final_amount ?? $booking->advance_paid ?? 0;
                                        
                                        // Calculate final amount if not set
                                        if ($finalAmount <= 0) {
                                            $finalAmount = max(0, $originalAmount - $discountAmount);
                                        }
                                    @endphp
                                    
                                    <div class="row mb-2">
                                        <div class="col-md-6"><strong>{{ $booking->event_id ? 'Event' : 'Package' }} Price:</strong></div>
                                        <div class="col-md-6">₹{{ number_format($originalAmount, 2) }}</div>
                                    </div>
                                    
                                    @if(isset($appliedPromo) && $appliedPromo)
                                    <div class="row mb-2">
                                        <div class="col-md-6"><strong>Coupon Applied:</strong></div>
                                        <div class="col-md-6">
                                            <span class="badge bg-success">{{ $appliedPromo->code }}</span>
                                            <span class="ms-1 small">({{ $appliedPromo->discount_percentage }}% off)</span>
                                        </div>
                                    </div>
                                    @endif
                                    
                                    @if($discountAmount > 0)
                                    <div class="row mb-2">
                                        <div class="col-md-6"><strong>Discount:</strong></div>
                                        <div class="col-md-6 text-danger">- ₹{{ number_format($discountAmount, 2) }}</div>
                                    </div>
                                    @endif
                                    
                                    <div class="row mb-2">
                                        <div class="col-md-6"><strong>Total Amount:</strong></div>
                                        <div class="col-md-6 fs-5 text-primary">₹{{ number_format($finalAmount, 2) }}</div>
                                    </div>
                                    
                                    <div class="row mb-2">
                                        <div class="col-md-6"><strong>Amount Paid:</strong></div>
                                        <div class="col-md-6">₹{{ number_format($booking->advance_paid ?? $finalAmount, 2) }}</div>
                                    </div>
                                    <hr>
                                    <div class="row mb-2">
                                        <div class="col-md-6"><strong>Payment ID:</strong></div>
                                        <div class="col-md-6">{{ $booking->payment_id ?? 'Not available' }}</div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-6"><strong>Payment Method:</strong></div>
                                        <div class="col-md-6">{{ $booking->payment_id ? 'Razorpay' : 'Not specified' }}</div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-6"><strong>Payment Status:</strong></div>
                                        <div class="col-md-6"><span class="badge {{ $booking->payment_id ? 'bg-success' : 'bg-warning' }}">{{ $booking->payment_id ? 'Paid' : 'Pending' }}</span></div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6"><strong>Booking Date:</strong></div>
                                        <div class="col-md-6">{{ \Carbon\Carbon::parse($booking->created_at)->format('M d, Y H:i A') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Feedback Information (if exists) -->
                        <div class="col-md-6 mb-4">
                            <div class="card border-0 shadow-sm h-100" style="border-radius: 16px; overflow: hidden;">
                                <div class="card-header bg-transparent">
                                    <h6 class="mb-0"><i class="icon-message-square me-2"></i>Customer Feedback</h6>
                                </div>
                                <div class="card-body" style="padding: 20px;">
                                    @if($booking->feedback && isset($booking->feedback->rating))
                                        <div class="mb-3">
                                            <p><strong>Rating:</strong> 
                                                @for($i = 1; $i <= 5; $i++)
                                                    @if($i <= $booking->feedback->rating)
                                                        <i class="icon-star text-warning"></i>
                                                    @else
                                                        <i class="icon-star text-muted"></i>
                                                    @endif
                                                @endfor
                                                ({{ $booking->feedback->rating }}/5)
                                            </p>
                                        </div>
                                        <div>
                                            <p><strong>Comments:</strong></p>
                                            <p class="border p-3 rounded bg-light">{{ $booking->feedback->comment ?? 'No comments provided' }}</p>
                                            <small class="text-muted">Submitted on {{ $booking->feedback->created_at ? \Carbon\Carbon::parse($booking->feedback->created_at)->format('M d, Y H:i A') : 'N/A' }}</small>
                                        </div>
                                    @else
                                        <div class="d-flex justify-content-center align-items-center h-100">
                                            <p class="text-muted">No feedback provided for this booking</p>
                                        </div>
                                    @endif
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

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Make sure Bootstrap's dropdown is properly initialized
        if (typeof bootstrap !== 'undefined') {
            const dropdownElements = document.querySelectorAll('.dropdown-toggle');
            dropdownElements.forEach(element => {
                new bootstrap.Dropdown(element);
            });
        }
        
        // Form submission handling for status updates and cancellations
        const statusForms = document.querySelectorAll('.status-update-form');
        const cancelForms = document.querySelectorAll('.cancel-form');
        
        statusForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                if (confirm('Are you sure you want to update the status?')) {
                    const button = this.querySelector('button[type="submit"]');
                    if (button) {
                        button.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Updating...';
                        button.disabled = true;
                    }
                    
                    // Manual form submission
                    const formData = new FormData(this);
                    const url = this.action;
                    const csrfMeta = document.querySelector('meta[name="csrf-token"]');
                    const token = csrfMeta ? csrfMeta.getAttribute('content') : '';
                    
                    if (!token) {
                        console.error('CSRF token not found');
                        alert('Security token missing. Please refresh the page and try again.');
                        return;
                    }
                    
                    // Show loading state
                    const originalButtonText = button ? button.innerHTML : '';
                    if (button) {
                        button.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Updating...';
                        button.disabled = true;
                    }
                    
                    console.log('Submitting form to:', url);
                    console.log('Form data:', Object.fromEntries(formData));
                    
                    // Add loading state to all buttons in the form
                    const formButtons = this.querySelectorAll('button[type="submit"]');
                    formButtons.forEach(btn => {
                        btn.disabled = true;
                        btn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Updating...';
                    });

                    fetch(url, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': token,
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json',
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: new URLSearchParams(formData).toString(),
                        credentials: 'same-origin'
                    })
                    .then(async response => {
                        const responseText = await response.text();
                        console.log('Response status:', response.status);
                        console.log('Response headers:', Object.fromEntries([...response.headers]));
                        console.log('Response text:', responseText);
                        
                        let responseData;
                        try {
                            responseData = responseText ? JSON.parse(responseText) : {};
                        } catch (e) {
                            console.error('Failed to parse JSON response:', e);
                            throw new Error('Invalid response from server. Please try again.');
                        }
                        
                        if (!response.ok) {
                            console.error('Server responded with error:', responseData);
                            throw new Error(responseData.message || 'Failed to update status. Server returned ' + response.status);
                        }
                        
                        return responseData;
                    })
                    .then(data => {
                        console.log('Success response:', data);
                        if (data.redirect) {
                            window.location.href = data.redirect;
                        } else if (data.success) {
                            // Show success message and reload after a short delay
                            const alertDiv = document.createElement('div');
                            alertDiv.className = 'alert alert-success alert-dismissible fade show mt-3';
                            alertDiv.role = 'alert';
                            alertDiv.innerHTML = `
                                <i class="bi bi-check-circle-fill me-2"></i>
                                ${data.message || 'Status updated successfully'}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            `;
                            
                            // Insert the alert after the status card
                            const statusCard = document.querySelector('.booking-detail-card');
                            if (statusCard) {
                                statusCard.parentNode.insertBefore(alertDiv, statusCard.nextSibling);
                                // Scroll to show the alert
                                setTimeout(() => alertDiv.scrollIntoView({ behavior: 'smooth', block: 'center' }), 100);
                            }
                            
                            // Reload the page after a short delay
                            setTimeout(() => window.location.reload(), 1500);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        let errorMessage = 'An error occurred while updating the status.';
                        
                        if (error.message) {
                            errorMessage = error.message;
                        }
                        
                        // Show error message in a more user-friendly way
                        const alertDiv = document.createElement('div');
                        alertDiv.className = 'alert alert-danger alert-dismissible fade show mt-3';
                        alertDiv.role = 'alert';
                        alertDiv.innerHTML = `
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            ${errorMessage}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        `;
                        
                        // Insert the alert after the status card
                        const statusCard = document.querySelector('.booking-detail-card');
                        if (statusCard) {
                            statusCard.parentNode.insertBefore(alertDiv, statusCard.nextSibling);
                        } else {
                            document.body.appendChild(alertDiv);
                        }
                        
                        // Scroll to the error message
                        alertDiv.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    })
                    .finally(() => {
                        // Reset button state
                        if (button) {
                            button.innerHTML = originalButtonText;
                            button.disabled = false;
                        }
                    });
                }
            });
        });
        
        cancelForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                if (confirm('Are you sure you want to cancel this booking? This will process a 50% refund.')) {
                    const button = this.querySelector('button[type="submit"]');
                    if (button) {
                        button.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Processing...';
                        button.disabled = true;
                    }
                    
                    // Manual form submission
                    const formData = new FormData(this);
                    fetch(this.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => {
                        if (response.ok) {
                            window.location.reload();
                        } else {
                            console.error('Form submission failed');
                            alert('An error occurred. Please try again.');
                            if (button) {
                                button.innerHTML = button.getAttribute('data-original-text') || '<i class="fas fa-ban me-2"></i> Cancel Booking & Refund';
                                button.disabled = false;
                            }
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred. Please try again.');
                        if (button) {
                            button.innerHTML = button.getAttribute('data-original-text') || '<i class="fas fa-ban me-2"></i> Cancel Booking & Refund';
                            button.disabled = false;
                        }
                    });
                }
            });
        });
    });
</script>
@endpush
