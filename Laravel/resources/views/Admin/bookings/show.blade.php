<x-adminheader />
<div class="main-content">
    <div class="main-content-inner">
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
                                    <p><strong>Event Type:</strong> {{ $booking->event->name ?? 'N/A' }}</p>
                                    <p><strong>Package:</strong> {{ $booking->package->name ?? 'N/A' }}</p>
                                    <p><strong>Package Description:</strong> {{ $booking->package->description ?? 'N/A' }}</p>
                                    <p><strong>Event Date:</strong> {{ $booking->event_date ? \Carbon\Carbon::parse($booking->event_date)->format('M d, Y') : 'Not specified' }}</p>
                                    @if($booking->package && $booking->package->decorator)
                                    <p><strong>Decorator:</strong> {{ $booking->package->decorator->name }}</p>
                                    <p><strong>Decorator Contact:</strong> {{ $booking->package->decorator->phone }}</p>
                                    <p><strong>Decorator Email:</strong> {{ $booking->package->decorator->email }}</p>
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
                                    <div class="row mb-2">
                                        <div class="col-md-6"><strong>Original Amount:</strong></div>
                                        <div class="col-md-6">₹{{ $booking->original_amount ? number_format($booking->original_amount, 2) : ($booking->package ? number_format($booking->package->price, 2) : '0.00') }}</div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-6"><strong>Discount:</strong></div>
                                        <div class="col-md-6">₹{{ number_format($booking->discount_amount ?? 0, 2) }}</div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-6"><strong>Final Amount:</strong></div>
                                        <div class="col-md-6 fs-5 text-primary">₹{{ $booking->final_amount ? number_format($booking->final_amount, 2) : ($booking->package ? number_format($booking->package->price, 2) : '0.00') }}</div>
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
<x-adminfooter />
