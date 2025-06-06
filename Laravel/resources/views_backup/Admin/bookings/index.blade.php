@extends('layouts.admin')

@section('content')
<div class="main-content-wrap">
    <div class="tf-section mb-30">
        <div class="wg-box">
                    <div class="flex items-center justify-between mb-4">
                        <h5><i class="fas fa-shopping-bag me-2"></i>Booking Management</h5>
                        <div class="flex gap-2">
                            <div class="input-group">
                                <input type="text" id="searchBooking" class="form-control" placeholder="Search bookings...">
                                <span class="input-group-text"><i class="icon-search"></i></span>
                            </div>
                            <div class="filter-buttons d-flex flex-wrap gap-2 mt-3 mt-md-0">
                                <button type="button" class="btn btn-filter btn-sm rounded-pill active" data-status=""><i class="fas fa-filter me-1"></i> All</button>
                                <button type="button" class="btn btn-filter btn-sm rounded-pill" data-status="pending"><i class="fas fa-clock me-1"></i> Pending</button>
                                <button type="button" class="btn btn-filter btn-sm rounded-pill" data-status="accepted"><i class="fas fa-check me-1"></i> Accepted</button>
                                <button type="button" class="btn btn-filter btn-sm rounded-pill" data-status="rejected"><i class="fas fa-times me-1"></i> Rejected</button>
                                <button type="button" class="btn btn-filter btn-sm rounded-pill" data-status="completed"><i class="fas fa-check-double me-1"></i> Completed</button>
                                <button type="button" class="btn btn-filter btn-sm rounded-pill" data-status="cancelled"><i class="fas fa-ban me-1"></i> Cancelled</button>
                            </div>
                        </div>
                    </div>
                    
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <!-- Stats Cards -->
                    <div class="row mb-4">
                        <div class="col-md-2">
                            <div class="card border-0 bg-warning bg-opacity-10 h-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <i class="icon-clock fa-2x text-warning"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-1">Pending</h6>
                                            <h3 class="mb-0">{{ $pendingCount }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card border-0 bg-info bg-opacity-10 h-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <i class="icon-check fa-2x text-info"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-1">Accepted</h6>
                                            <h3 class="mb-0">{{ $acceptedCount }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card border-0 bg-secondary bg-opacity-10 h-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <i class="icon-x fa-2x text-secondary"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-1">Rejected</h6>
                                            <h3 class="mb-0">{{ $rejectedCount }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card border-0 bg-success bg-opacity-10 h-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <i class="icon-check-circle fa-2x text-success"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-1">Completed</h6>
                                            <h3 class="mb-0">{{ $completedCount }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card border-0 bg-danger bg-opacity-10 h-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <i class="icon-x-circle fa-2x text-danger"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-1">Cancelled</h6>
                                            <h3 class="mb-0">{{ $cancelledCount }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card border-0 bg-primary bg-opacity-10 h-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <i class="icon-dollar-sign fa-2x text-primary"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-1">Total</h6>
                                            <h3 class="mb-0">{{ $pendingCount + $acceptedCount + $rejectedCount + $completedCount + $cancelledCount }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card-based Bookings View -->
                    <div class="row g-4">
                        @forelse ($bookings as $booking)
                        <div class="col-md-6 col-lg-4" data-status="{{ $booking->status }}">
                            <div class="order-card h-100">
                                <div class="order-card-header">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="order-id">Order #{{ $booking->booking_id }}</span>
                                        <span class="badge {{ 
                                            $booking->status == 'pending' ? 'bg-warning text-dark' : 
                                            ($booking->status == 'accepted' ? 'bg-info' : 
                                            ($booking->status == 'rejected' ? 'bg-secondary text-white' : 
                                            ($booking->status == 'completed' ? 'bg-success' : 'bg-danger'))) 
                                        }}">
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="order-card-body">
                                    <h5 class="order-title">
                                        @if($booking->event_id)
                                            <span>{{ $booking->event->name ?? $booking->event->title ?? 'N/A' }}</span>
                                            @if(isset($booking->event->category))
                                            <span class="badge bg-primary-subtle text-primary-emphasis ms-2">{{ $booking->event->category->category_name }}</span>
                                            @endif
                                        @elseif($booking->package_id)
                                            <span>{{ $booking->package->name ?? $booking->package->title ?? 'N/A' }}</span>
                                            <span class="badge bg-info-subtle text-info-emphasis ms-2">Package Bundle</span>
                                        @endif
                                    </h5>
                                    
                                    <div class="order-details">
                                        <div class="detail-row">
                                            <span class="detail-label"><i class="far fa-calendar-alt text-primary"></i> Order Date:</span>
                                            <span class="detail-value">{{ date('d M Y', strtotime($booking->created_at)) }}</span>
                                        </div>
                                        
                                        <div class="detail-row">
                                            <span class="detail-label"><i class="far fa-user text-primary"></i> Customer:</span>
                                            <span class="detail-value">{{ $booking->user->name ?? 'N/A' }}</span>
                                        </div>
                                        
                                        <div class="detail-row">
                                            <span class="detail-label"><i class="fas fa-paint-brush text-primary"></i> Decorator:</span>
                                            <span class="detail-value" style="color: #1e293b; font-weight: 500;">
                                                @if($booking->package && $booking->package->decorator)
                                                    {{ $booking->package->decorator->name }}
                                                @elseif($booking->event && isset($booking->event->decorator_id) && $booking->event->decorator)
                                                    {{ $booking->event->decorator->name }}
                                                @else
                                                    <span class="text-muted">N/A</span>
                                                @endif
                                            </span>
                                        </div>
                                        
                                        <div class="detail-row">
                                            <span class="detail-label"><i class="fas fa-rupee-sign text-primary"></i> Price:</span>
                                            <span class="detail-value fw-bold">₹{{ $booking->final_amount ? number_format($booking->final_amount, 2) : ($booking->package ? number_format($booking->package->price, 2) : '0.00') }}</span>
                                        </div>
                                        

                                    </div>
                                </div>
                                <div class="order-card-footer">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <a href="{{ route('admin.bookings.show', $booking->booking_id) }}" class="btn btn-sm btn-primary rounded-pill shadow-sm">
                                            <i class="fas fa-eye me-1"></i> View Details
                                        </a>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light rounded-pill shadow-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-h me-1"></i> Actions
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
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
                                                    <form action="{{ route('admin.bookings.cancel', $booking->booking_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this booking? This will process a 50% refund.')" class="cancel-form">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="dropdown-item text-danger"><i class="fas fa-ban me-2"></i> Cancel Booking & Refund</button>
                                                    </form>
                                                </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-12">
                            <div class="alert alert-info">
                                <i class="icon-info me-2"></i> No bookings found
                            </div>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CSS for card styling -->
<style>
    /* Filter Buttons */
    .btn-filter {
        background-color: #f8f9fa;
        border: 1px solid #e9ecef;
        color: #6c757d;
        font-weight: 500;
        transition: all 0.3s ease;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.03);
    }
    
    .btn-filter:hover {
        background-color: #e9ecef;
        color: #495057;
        transform: translateY(-1px);
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.06);
    }
    
    .btn-filter.active {
        background-color: #3b82f6;
        color: white;
        border-color: #3b82f6;
        box-shadow: 0 3px 6px rgba(59, 130, 246, 0.3);
    }
    
    /* Modern Order Cards Styling */
    .order-card {
        border-radius: 16px;
        border: none;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        overflow: hidden;
        transition: all 0.3s ease;
        background: #fff;
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    
    .order-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(37, 99, 235, 0.1);
        border-bottom: 3px solid #3b82f6;
    }
    
    .order-card-header {
        padding: 18px 20px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.03);
        background-color: rgba(59, 130, 246, 0.03);
    }
    
    .order-id {
        font-weight: 600;
        color: #555;
    }
    
    .order-card-body {
        padding: 20px;
        flex: 1;
    }
    
    .order-title {
        margin-bottom: 16px;
        font-weight: 600;
        color: #333;
    }
    
    .order-details .detail-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 12px;
        padding-bottom: 8px;
        border-bottom: 1px dashed rgba(0, 0, 0, 0.07);
    }
    
    .order-details .detail-row:last-child {
        margin-bottom: 0;
        border-bottom: none;
        padding-bottom: 0;
    }
    
    .detail-label {
        color: #64748b; /* slate-500 */
        margin-right: 10px;
        font-weight: 500;
    }
    
    .detail-label i {
        margin-right: 8px;
    }
    
    .detail-value {
        font-weight: 600;
        color: #1e293b; /* slate-800 */
        text-align: right;
    }
    
    .order-card-footer {
        padding: 16px 20px;
        border-top: 1px solid rgba(0, 0, 0, 0.03);
        background-color: rgba(249, 250, 251, 0.7);
    }
    
    /* Badge Styling */
    .badge {
        font-size: 0.75rem;
        font-weight: 600;
        padding: 0.5em 0.75em;
        border-radius: 6px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    }
    
    .bg-primary-subtle {
        background-color: rgba(13, 110, 253, 0.1);
    }
    
    .text-primary-emphasis {
        color: #0d6efd;
    }
    
    .bg-info-subtle {
        background-color: rgba(13, 202, 240, 0.1);
    }
    
    .text-info-emphasis {
        color: #0dcaf0;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Make sure Bootstrap's dropdown is properly initialized
        if (typeof bootstrap !== 'undefined') {
            const dropdownElements = document.querySelectorAll('.dropdown-toggle');
            dropdownElements.forEach(element => {
                new bootstrap.Dropdown(element);
            });
        }
        
        // Form submission for all action forms
        const statusUpdateForms = document.querySelectorAll('.status-update-form');
        const cancelForms = document.querySelectorAll('.cancel-form');
        
        statusUpdateForms.forEach(form => {
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
        
        // Status filter functionality with the new buttons
        const filterButtons = document.querySelectorAll('.btn-filter');
        let currentStatus = '';
        
        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Remove active class from all buttons
                filterButtons.forEach(btn => btn.classList.remove('active'));
                
                // Add active class to clicked button
                this.classList.add('active');
                
                // Get the status value
                currentStatus = this.getAttribute('data-status');
                console.log('Filter clicked: ', currentStatus);
                
                // Filter the booking cards
                filterBookings();
            });
        });
        
        // Search functionality
        const searchInput = document.getElementById('searchBooking');
        if (searchInput) {
            searchInput.addEventListener('keyup', function() {
                filterBookings();
            });
        }
        
        // Function to filter bookings based on search term and status
        function filterBookings() {
            const searchTerm = searchInput ? searchInput.value.toLowerCase() : '';
            const bookingCards = document.querySelectorAll('.col-md-6.col-lg-4');
            let visibleCount = 0;
            
            console.log('Filtering with status:', currentStatus);
            console.log('Total booking cards:', bookingCards.length);
            
            // Debug: Log all statuses on the page
            const allStatuses = [];
            bookingCards.forEach(card => {
                allStatuses.push(card.getAttribute('data-status'));
            });
            console.log('All statuses on page:', allStatuses);
            
            bookingCards.forEach(card => {
                const status = card.getAttribute('data-status');
                const cardText = card.textContent.toLowerCase();
                
                let statusMatch = currentStatus === '' || status === currentStatus;
                let searchMatch = searchTerm === '' || cardText.includes(searchTerm);
                
                if (statusMatch && searchMatch) {
                    card.style.display = '';
                    visibleCount++;
                    console.log('Showing card with status:', status);
                } else {
                    card.style.display = 'none';
                    console.log('Hiding card with status:', status, 'Status match:', statusMatch, 'Search match:', searchMatch);
                }
            });
            
            // Show/hide no results message
            const noResultsMessage = document.querySelector('.col-12 .alert-info');
            if (noResultsMessage) {
                if (visibleCount === 0) {
                    noResultsMessage.style.display = '';
                } else {
                    noResultsMessage.style.display = 'none';
                }
            }
            
            console.log('Visible cards after filtering:', visibleCount);
        }
        
        // Initialize filtering on page load
        filterBookings();
    });
</script>
@endsection
