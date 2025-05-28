@extends('layouts.admin')

@section('content')
<div class="main-content-wrap">
    <div class="tf-section mb-30">
        <div class="wg-box">
                    <div class="flex items-center justify-between mb-4">
                        <h5>Booking Details: #{{ $booking->booking_id }}</h5>
                        <a href="{{ route('admin.bookings.index') }}" class="btn btn-light rounded-pill shadow-sm btn-sm">
                            <i class="icon-arrow-left me-1"></i> Back to All Bookings
                        </a>
                    </div>
                    
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <div class="row">
                        <!-- Booking Status Card -->
                        <div class="col-md-12 mb-4">
                            <div class="card border-0 shadow-sm" style="border-radius: 16px; overflow: hidden;">
                                <div class="card-body" style="padding: 20px;">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="mb-1">Current Status</h6>
                                            <span class="badge {{ 
                                                $booking->status == 'pending' ? 'bg-warning' : 
                                                ($booking->status == 'accepted' ? 'bg-success' : 
                                                ($booking->status == 'rejected' ? 'bg-danger' : 
                                                ($booking->status == 'completed' ? 'bg-primary' : 
                                                ($booking->status == 'cancelled' ? 'bg-dark' : 'bg-secondary')))) }}" 
                                                style="font-size: 0.75rem; font-weight: 600; padding: 0.5em 0.75em; border-radius: 6px; text-transform: uppercase; letter-spacing: 0.5px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);">
                                                {{ ucfirst($booking->status) }}
                                            </span>
                                        </div>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary rounded-pill shadow-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-exchange-alt me-1"></i> Update Status
                                            </button>
                                            <ul class="dropdown-menu">
                                                @if($booking->status != 'pending')
                                                <li>
                                                    <form action="{{ route('admin.bookings.update-status', $booking->booking_id) }}" method="POST" class="status-update-form">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status" value="pending">
                                                        <button type="submit" class="dropdown-item"><i class="fas fa-clock me-2"></i> Mark as Pending</button>
                                                    </form>
                                                </li>
                                                @endif
                                                
                                                @if($booking->status != 'accepted')
                                                <li>
                                                    <form action="{{ route('admin.bookings.update-status', $booking->booking_id) }}" method="POST" class="status-update-form">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status" value="accepted">
                                                        <button type="submit" class="dropdown-item"><i class="fas fa-check me-2"></i> Mark as Accepted</button>
                                                    </form>
                                                </li>
                                                @endif
                                                
                                                @if($booking->status != 'rejected')
                                                <li>
                                                    <form action="{{ route('admin.bookings.update-status', $booking->booking_id) }}" method="POST" class="status-update-form">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status" value="rejected">
                                                        <button type="submit" class="dropdown-item"><i class="fas fa-times me-2"></i> Mark as Rejected</button>
                                                    </form>
                                                </li>
                                                @endif
                                                
                                                @if($booking->status != 'completed')
                                                <li>
                                                    <form action="{{ route('admin.bookings.update-status', $booking->booking_id) }}" method="POST" class="status-update-form">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status" value="completed">
                                                        <button type="submit" class="dropdown-item"><i class="fas fa-check-circle me-2"></i> Mark as Completed</button>
                                                    </form>
                                                </li>
                                                @endif
                                                
                                                @if($booking->status != 'cancelled')
                                                <li><hr class="dropdown-divider"></li>
                                                <li>
                                                    <form action="{{ route('admin.bookings.cancel', $booking->booking_id) }}" method="POST" class="cancel-form" onsubmit="return confirm('Are you sure you want to cancel this booking? This will process a 50% refund.')">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="dropdown-item text-danger"><i class="fas fa-ban me-2"></i> Cancel Booking & Process Refund</button>
                                                    </form>
                                                </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Customer Information -->
                        <div class="col-md-6 mb-4">
                            <div class="card border-0 shadow-sm h-100" style="border-radius: 16px; overflow: hidden;">
                                <div class="card-header bg-transparent" style="border-bottom: 1px solid rgba(0, 0, 0, 0.03); background-color: rgba(59, 130, 246, 0.03); padding: 18px 20px;">
                                    <h6 class="mb-0" style="color: #1e293b; font-weight: 600;"><i class="icon-user me-2"></i>Customer Information</h6>
                                </div>
                                <div class="card-body" style="padding: 20px;">
                                    <p><strong>Name:</strong> {{ $booking->user->name ?? 'N/A' }}</p>
                                    <p><strong>Email:</strong> {{ $booking->user->email ?? 'N/A' }}</p>
                                    <p><strong>Phone:</strong> {{ $booking->user->phone ?? 'N/A' }}</p>
                                    <p><strong>Customer Since:</strong> {{ $booking->user ? \Carbon\Carbon::parse($booking->user->created_at)->format('M d, Y') : 'N/A' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Event Information -->
                        <div class="col-md-6 mb-4">
                            <div class="card border-0 shadow-sm h-100" style="border-radius: 16px; overflow: hidden;">
                                <div class="card-header bg-transparent" style="border-bottom: 1px solid rgba(0, 0, 0, 0.03); background-color: rgba(59, 130, 246, 0.03); padding: 18px 20px;">
                                    <h6 class="mb-0" style="color: #1e293b; font-weight: 600;"><i class="icon-calendar me-2"></i>Event Information</h6>
                                </div>
                                <div class="card-body" style="padding: 20px;">
                                    @php
                                        $decorator = null;
                                        $decoratorName = 'N/A';
                                        $decoratorEmail = 'N/A';
                                        $decoratorPhone = 'N/A';
                                        
                                        // First check if decorator is directly assigned to booking
                                        if ($booking->decorator) {
                                            $decorator = $booking->decorator;
                                        } 
                                        // Then check if booking has an event with decorator
                                        elseif ($booking->event && $booking->event->decorator) {
                                            $decorator = $booking->event->decorator;
                                        } 
                                        // Finally check if booking has a package with decorator
                                        elseif ($booking->package && $booking->package->decorator) {
                                            $decorator = $booking->package->decorator;
                                        }
                                        
                                        if ($decorator) {
                                            $decoratorName = $decorator->decorator_name ?? 'N/A';
                                            $decoratorEmail = $decorator->email ?? 'N/A';
                                            $decoratorPhone = $decorator->contact_number ?? 'N/A';
                                        }
                                    @endphp
                                    
                                    <div class="mb-3">
                                        @php
                                            $eventType = 'Custom Event';
                                            $eventTitle = '';
                                            $categoryName = 'N/A';
                                            $isPackage = false;
                                            
                                            // Check if this is an event or package booking
                                            if ($booking->event) {
                                                $eventTitle = $booking->event->title ?? '';
                                                $eventType = $eventTitle ?: 'Custom Event';
                                                if (isset($booking->event->category)) {
                                                    $categoryName = $booking->event->category->name ?? 'N/A';
                                                }
                                            } elseif ($booking->package) {
                                                $isPackage = true;
                                                $eventTitle = $booking->package->title ?? '';
                                                $eventType = $eventTitle ?: 'Custom Package';
                                                if (isset($booking->package->category)) {
                                                    $categoryName = $booking->package->category->name ?? 'N/A';
                                                }
                                            }
                                        @endphp
                                        
                                        <p class="mb-1">
                                            <strong>Type:</strong> 
                                            @if($isPackage)
                                                Package: {{ $eventType }}
                                            @else
                                                {{ $eventType }}
                                            @endif
                                        </p>
                                        @if($categoryName !== 'N/A')
                                            <p class="mb-1"><strong>Category:</strong> {{ $categoryName }}</p>
                                        @endif
                                        
                                        @if(!empty($booking->event_date))
                                            <p class="mb-1">
                                                <strong>Event Date:</strong> 
                                                {{ \Carbon\Carbon::parse($booking->event_date)->format('M d, Y') }}
                                            </p>
                                        @endif
                                        
                                        @if(!empty($booking->event_location))
                                            <p class="mb-0">
                                                <strong>Location:</strong> 
                                                {{ $booking->event_location }}
                                            </p>
                                        @endif
                                    </div>
                                    
                                    @if($decoratorName !== 'N/A')
                                    <div class="mt-3 pt-3 border-top">
                                        <h6 class="mb-2">Decorator Information:</h6>
                                        <p class="mb-1"><strong>Name:</strong> {{ $decoratorName }}</p>
                                        <p class="mb-1"><strong>Email:</strong> {{ $decoratorEmail }}</p>
                                        @if($decoratorPhone !== 'N/A')
                                            <p class="mb-0"><strong>Phone:</strong> {{ $decoratorPhone }}</p>
                                        @endif
                                    </div>
                                    @endif
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
                                    <div class="mb-3">
                                        @php
                                            // Get amounts from booking or set defaults
                                            $originalAmount = $booking->original_amount ?? 0;
                                            $discountAmount = $booking->discount_amount ?? 0;
                                            $finalAmount = $booking->final_amount ?? 0;
                                            
                                            // Ensure we have positive values
                                            $originalAmount = max(0, (float)$originalAmount);
                                            $discountAmount = max(0, (float)$discountAmount);
                                            
                                            // Calculate final amount if not set or invalid
                                            if ($finalAmount <= 0 || $finalAmount < ($originalAmount - $discountAmount)) {
                                                $finalAmount = max(0, $originalAmount - $discountAmount);
                                            } else {
                                                $finalAmount = max(0, (float)$finalAmount);
                                            }
                                        @endphp
                                        
                                        @if($originalAmount > 0)
                                            <div class="row mb-2">
                                                <div class="col-md-6"><strong>Package Price:</strong></div>
                                                <div class="col-md-6">₹{{ number_format($originalAmount, 2) }}</div>
                                            </div>
                                        @endif
                                        
                                        @if($discountAmount > 0)
                                            <div class="row mb-2">
                                                <div class="col-md-6"><strong>Discount:</strong></div>
                                                <div class="col-md-6 text-danger">- ₹{{ number_format($discountAmount, 2) }}</div>
                                            </div>
                                        @endif
                                        
                                        <div class="row mb-2 fw-bold">
                                            <div class="col-md-6"><strong>Total Amount:</strong></div>
                                            <div class="col-md-6">₹{{ number_format($finalAmount, 2) }}</div>
                                        </div>
                                        <hr>
                                        <div class="row mb-2">
                                            <div class="col-md-6"><strong>Advance Paid:</strong></div>
                                            <div class="col-md-6">₹{{ number_format($booking->advance_paid ?? 0, 2) }}</div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-md-6"><strong>Payment Status:</strong></div>
                                            <div class="col-md-6">
                                                @if($booking->advance_paid > 0)
                                                    <span class="badge bg-success">Paid</span>
                                                @else
                                                    <span class="badge bg-warning">Pending</span>
                                                @endif
                                            </div>
                                        </div>
                                        @if($booking->payment_id)
                                        <div class="row mb-2">
                                            <div class="col-md-6"><strong>Payment ID:</strong></div>
                                            <div class="col-md-6">{{ $booking->payment_id }}</div>
                                        </div>
                                        @endif
                                        <div class="row mb-0">
                                            <div class="col-md-6"><strong>Booking Date:</strong></div>
                                            <div class="col-md-6">{{ \Carbon\Carbon::parse($booking->created_at)->format('M d, Y H:i A') }}</div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6"><strong>Booking Status:</strong></div>
                                        <div class="col-md-6">
                                            <span class="badge {{ 
                                                $booking->status == 'pending' ? 'bg-warning' : 
                                                ($booking->status == 'accepted' ? 'bg-success' : 
                                                ($booking->status == 'rejected' ? 'bg-danger' : 
                                                ($booking->status == 'completed' ? 'bg-primary' : 'bg-secondary'))) 
                                            }}">
                                                {{ ucfirst($booking->status) }}
                                            </span>
                                        </div>
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

@push('styles')
<style>
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
    .card, .card-body {
        overflow: visible !important;
    }
</style>
@endpush

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
                                button.innerHTML = button.getAttribute('data-original-text') || '<i class="fas fa-check me-2"></i> Update Status';
                                button.disabled = false;
                            }
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred. Please try again.');
                        if (button) {
                            button.innerHTML = button.getAttribute('data-original-text') || '<i class="fas fa-check me-2"></i> Update Status';
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
