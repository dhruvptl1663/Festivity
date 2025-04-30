<x-decoratorheader />

<!-- Add Bootstrap Icons CSS if not already included in the layout -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<style>
    .card {
        transition: all 0.3s ease;
        overflow: hidden;
        border-radius: 0.75rem !important;
    }

    .card:hover {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }
    
    .booking-card {
        display: flex;
        flex-direction: column;
        height: 100%;
    }
    
    .booking-card .card-body {
        flex: 1;
    }
    
    .booking-header {
        padding: 1.25rem;
        background-color: #f8f9fa;
        border-bottom: 1px solid rgba(0,0,0,0.1);
    }
    
    .booking-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-bottom: 1rem;
    }
    
    .booking-meta-item {
        display: flex;
        align-items: center;
        font-size: 0.875rem;
        color: #6c757d;
    }
    
    .booking-meta-item i {
        margin-right: 0.25rem;
        font-size: 0.75rem;
    }
    
    .status-badge {
        padding: 0.35rem 0.75rem;
        border-radius: 2rem;
        font-size: 0.75rem;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
    }
    
    .status-badge.pending {
        background-color: rgba(255, 193, 7, 0.1);
        color: #fd7e14;
    }
    
    .status-badge.accepted {
        background-color: rgba(13, 110, 253, 0.1);
        color: #0d6efd;
    }
    
    .status-badge.completed {
        background-color: rgba(25, 135, 84, 0.1);
        color: #198754;
    }
    
    .status-badge.cancelled, .status-badge.rejected {
        background-color: rgba(220, 53, 69, 0.1);
        color: #dc3545;
    }
    
    .status-badge i {
        margin-right: 0.35rem;
        font-size: 0.75rem;
    }
    
    .btn-icon {
        width: 38px;
        height: 38px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        font-size: 1rem;
        transition: all 0.2s ease;
        vertical-align: middle;
    }
    
    .btn-icon:hover {
        transform: scale(1.05);
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    
    .filter-card {
        margin-bottom: 1.5rem;
    }
    
    .empty-state {
        text-align: center;
        padding: 3rem;
        background-color: #f8f9fa;
        border-radius: 0.75rem;
        border: 2px dashed rgba(0,0,0,0.1);
    }
    
    .empty-state-icon {
        font-size: 3rem;
        color: #6c757d;
        margin-bottom: 1rem;
    }
    
    .booking-amount {
        font-weight: 600;
        font-size: 1.1rem;
        margin-bottom: 0.5rem;
    }
    
    .booking-amount span {
        color: #198754;
    }
</style>

<div class="main-content">
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <!-- Header Section -->
            <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="mb-1">Booking Management</h4>
                    <p class="text-muted">Manage your event and package bookings</p>
                </div>
            </div>
            
            @if(session('success'))
                <div class="alert alert-success mb-4">
                    <i class="bi bi-check-circle me-2"></i>
                    {{ session('success') }}
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-danger mb-4">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    {{ session('error') }}
                </div>
            @endif
            
            <!-- Filters Section -->
            <div class="card filter-card">
                <div class="card-body">
                    <form action="{{ route('decorator.bookings') }}" method="GET" class="row g-3 align-items-end">
                        <div class="col-md-3">
                            <label class="form-label small">Status</label>
                            <select name="status" class="form-select">
                                <option value="">All Statuses</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="accepted" {{ request('status') == 'accepted' ? 'selected' : '' }}>Accepted</option>
                                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small">Booking Type</label>
                            <select name="type" class="form-select">
                                <option value="">All Types</option>
                                <option value="event" {{ request('type') == 'event' ? 'selected' : '' }}>Events</option>
                                <option value="package" {{ request('type') == 'package' ? 'selected' : '' }}>Packages</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-filter me-1"></i> Apply Filters
                                </button>
                                <a href="{{ route('decorator.bookings') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-arrow-repeat me-1"></i> Reset
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            @if($bookings->isEmpty())
                <div class="empty-state">
                    <div class="empty-state-icon">
                        <i class="bi bi-calendar-x"></i>
                    </div>
                    <h5>No Bookings Found</h5>
                    <p class="text-muted">There are no bookings matching your criteria at this time.</p>
                </div>
            @else
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mb-4">
                    @foreach($bookings as $booking)
                        <div class="col">
                            <div class="card booking-card h-100">
                                <div class="booking-header">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h6 class="mb-0">Booking #{{ $booking->booking_id }}</h6>
                                        <div class="status-badge {{ strtolower($booking->status) }}">
                                            @if($booking->status == 'pending')
                                                <i class="bi bi-clock"></i>
                                            @elseif($booking->status == 'accepted')
                                                <i class="bi bi-check-circle"></i>
                                            @elseif($booking->status == 'completed')
                                                <i class="bi bi-trophy"></i>
                                            @elseif($booking->status == 'cancelled' || $booking->status == 'rejected')
                                                <i class="bi bi-x-circle"></i>
                                            @endif
                                            {{ ucfirst($booking->status) }}
                                        </div>
                                    </div>
                                    <div class="booking-meta">
                                        <div class="booking-meta-item">
                                            <i class="bi bi-person"></i>
                                            {{ $booking->user->name }}
                                        </div>
                                        <div class="booking-meta-item">
                                            <i class="bi bi-calendar-event"></i>
                                            {{ $booking->event_datetime ? date('d M, Y', strtotime($booking->event_datetime)) : 'Not specified' }}
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <div class="mb-3">
                                        <h6 class="text-primary">
                                            <i class="bi {{ $booking->event_id ? 'bi-stars' : 'bi-box-seam' }} me-1"></i>
                                            {{ $booking->event_id ? 'Event' : 'Package' }}
                                        </h6>
                                        <h5 class="card-title">{{ $booking->event_id ? $booking->event->title : $booking->package->title }}</h5>
                                    </div>
                                    
                                    <div class="booking-amount">
                                        Advance Paid: <span>₹{{ number_format($booking->advance_paid, 2) }}</span>
                                    </div>
                                    
                                    <div class="text-muted small mb-3">
                                        <i class="bi bi-clock-history me-1"></i> Booked on {{ $booking->created_at->format('d M, Y') }}
                                    </div>
                                    
                                    <div class="mt-auto">
                                        <a href="{{ route('decorator.bookings.show', $booking->booking_id) }}" class="btn btn-primary w-100">
                                            <i class="bi bi-eye me-1"></i> View Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="d-flex justify-content-center">
                    {{ $bookings->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Initialize Bootstrap tooltips -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    });
</script>

<x-decoratorfooter />
