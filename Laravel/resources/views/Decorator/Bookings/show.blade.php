<x-decoratorheader />
<div class="main-content">
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="wg-box">
                <div class="flex items-center justify-between">
                    <h5>Booking Details #{{ $booking->booking_id }}</h5>
                    <div class="dropdown default">
                        <a href="{{ route('decorator.bookings') }}" class="btn btn-secondary">
                            <span class="view-all">Back to Bookings</span>
                        </a>
                    </div>
                </div>
                
                @if(session('success'))
                    <div class="alert alert-success mb-4">
                        {{ session('success') }}
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-danger mb-4">
                        {{ session('error') }}
                    </div>
                @endif
                
                <div class="booking-details">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="details-box">
                                <h6>Booking Information</h6>
                                <div class="detail-item">
                                    <span class="detail-label">Booking ID:</span>
                                    <span class="detail-value">#{{ $booking->booking_id }}</span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Status:</span>
                                    <span class="detail-value status-text {{ strtolower($booking->status) }}">{{ ucfirst($booking->status) }}</span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Amount Paid:</span>
                                    <span class="detail-value">₹{{ number_format($booking->advance_paid, 2) }}</span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Booking Date:</span>
                                    <span class="detail-value">{{ $booking->created_at->format('d M, Y') }}</span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Event Date:</span>
                                    <span class="detail-value">{{ $booking->event_datetime ? date('d M, Y h:i A', strtotime($booking->event_datetime)) : 'Not specified' }}</span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Completed:</span>
                                    <span class="detail-value">{{ $booking->is_completed ? 'Yes' : 'No' }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="details-box">
                                <h6>Customer Information</h6>
                                <div class="detail-item">
                                    <span class="detail-label">Name:</span>
                                    <span class="detail-value">{{ $booking->user->name }}</span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Email:</span>
                                    <span class="detail-value">{{ $booking->user->email }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="details-box">
                                <h6>{{ $booking->event_id ? 'Event' : 'Package' }} Details</h6>
                                <div class="detail-item">
                                    <span class="detail-label">Type:</span>
                                    <span class="detail-value">{{ $booking->event_id ? 'Event' : 'Package' }}</span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Title:</span>
                                    <span class="detail-value">{{ $booking->event_id ? $booking->event->title : $booking->package->title }}</span>
                                </div>
                                @if($booking->event_id)
                                    <div class="detail-item">
                                        <span class="detail-label">Category:</span>
                                        <span class="detail-value">{{ $booking->event->category->category_name }}</span>
                                    </div>
                                    <div class="detail-item">
                                        <span class="detail-label">Price:</span>
                                        <span class="detail-value">₹{{ number_format($booking->event->price, 2) }}</span>
                                    </div>
                                @else
                                    <div class="detail-item">
                                        <span class="detail-label">Price:</span>
                                        <span class="detail-value">₹{{ number_format($booking->package->price, 2) }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    @if($feedback)
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="details-box">
                                <h6>Customer Feedback</h6>
                                <div class="detail-item">
                                    <span class="detail-label">Rating:</span>
                                    <span class="detail-value">
                                        <div class="rating-stars">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $feedback->rating)
                                                    <i class="fas fa-star text-warning"></i>
                                                @else
                                                    <i class="far fa-star text-muted"></i>
                                                @endif
                                            @endfor
                                            <span class="ml-1">{{ $feedback->rating }}/5</span>
                                        </div>
                                    </span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Comment:</span>
                                    <span class="detail-value">{{ $feedback->comment }}</span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Date:</span>
                                    <span class="detail-value">{{ $feedback->created_at->format('d M, Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="details-box">
                                <h6>Update Booking Status</h6>
                                <form action="{{ route('decorator.bookings.status', $booking->booking_id) }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="status">Change Status</label>
                                        <select name="status" id="status" class="form-control" required>
                                            <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="accepted" {{ $booking->status == 'accepted' ? 'selected' : '' }}>Accept</option>
                                            <option value="rejected" {{ $booking->status == 'rejected' ? 'selected' : '' }}>Reject</option>
                                            <option value="completed" {{ $booking->status == 'completed' ? 'selected' : '' }}>Complete</option>
                                            <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Cancel</option>
                                        </select>
                                    </div>
                                    
                                    <div id="reason-container" class="form-group" style="display: none;">
                                        <label for="reason">Reason for Cancellation/Rejection</label>
                                        <textarea name="reason" id="reason" class="form-control" rows="3"></textarea>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary">Update Status</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const statusSelect = document.getElementById('status');
        const reasonContainer = document.getElementById('reason-container');
        
        function toggleReasonField() {
            if (statusSelect.value === 'cancelled' || statusSelect.value === 'rejected') {
                reasonContainer.style.display = 'block';
            } else {
                reasonContainer.style.display = 'none';
            }
        }
        
        // Initial check
        toggleReasonField();
        
        // Add event listener
        statusSelect.addEventListener('change', toggleReasonField);
    });
</script>

<x-decoratorfooter />
