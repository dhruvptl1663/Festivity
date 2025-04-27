@extends('layouts.app')
@section('title', 'My Orders')
@section('content')
<div class="container my-5">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-primary text-white p-4">
            <h3 class="mb-0"><i class="fas fa-shopping-bag me-2"></i>My Orders</h3>
        </div>
        <div class="card-body p-4">
            @if($bookings->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Event/Package</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bookings as $booking)
                        <tr>
                            <td>#{{ $booking->booking_id }}</td>
                            <td>
                                @if($booking->event_id)
                                    <strong><a href="{{ route('eventdetails.show', $booking->event_id) }}" class="text-decoration-none">{{ $booking->event->title }}</a></strong>
                                    <div class="small text-muted">Event</div>
                                @elseif($booking->package_id)
                                    <strong><a href="{{ route('packagedetails', $booking->package_id) }}" class="text-decoration-none">{{ $booking->package->title }}</a></strong>
                                    <div class="small text-muted">Package</div>
                                @endif
                            </td>
                            <td>
                                @if($booking->status == 'pending')
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @elseif($booking->status == 'accepted')
                                    <span class="badge bg-info">Accepted</span>
                                @elseif($booking->status == 'completed')
                                    <span class="badge bg-success">Completed</span>
                                @elseif($booking->status == 'rejected')
                                    <span class="badge bg-danger">Rejected</span>
                                @elseif($booking->status == 'cancelled')
                                    <span class="badge bg-secondary">Cancelled</span>
                                @endif
                            </td>
                            <td>{{ $booking->created_at }}</td>
                            <td>
                                @php
                                    $price = 0;
                                    if($booking->event_id) {
                                        $price = $booking->event->price;
                                    } elseif($booking->package_id) {
                                        $price = $booking->package->price;
                                    }
                                @endphp
                                ₹{{ number_format($price, 2) }}
                            </td>
                            <td>
                                @if($booking->status == 'completed' && !$booking->hasFeedback())
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#feedbackModal{{ $booking->booking_id }}">
                                    <i class="fas fa-star me-1"></i> Rate & Review
                                </button>
                                @elseif($booking->hasFeedback())
                                <span class="d-inline-block" tabindex="0" data-bs-toggle="tooltip" title="You have already provided feedback">
                                    <button type="button" class="btn btn-sm btn-outline-success" disabled>
                                        <i class="fas fa-check-circle me-1"></i> Reviewed
                                    </button>
                                </span>
                                @endif
                                
                                @if($booking->status == 'pending' || $booking->status == 'accepted')
                                <button type="button" class="btn btn-sm btn-danger ms-1" data-bs-toggle="modal" data-bs-target="#cancelModal{{ $booking->booking_id }}">
                                    <i class="fas fa-times-circle me-1"></i> Cancel
                                </button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Feedback Modals -->
            @foreach($bookings as $booking)
            @if($booking->status == 'completed' && !$booking->hasFeedback())
            <div class="modal fade" id="feedbackModal{{ $booking->booking_id }}" tabindex="-1" aria-labelledby="feedbackModalLabel{{ $booking->booking_id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="feedbackModalLabel{{ $booking->booking_id }}">
                                Rate & Review Your Experience
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('feedback.store') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <input type="hidden" name="booking_id" value="{{ $booking->booking_id }}">
                                
                                @if($booking->event_id)
                                <input type="hidden" name="event_id" value="{{ $booking->event_id }}">
                                <input type="hidden" name="decorator_id" value="{{ $booking->event->decorator_id }}">
                                @elseif($booking->package_id)
                                <input type="hidden" name="package_id" value="{{ $booking->package_id }}">
                                <input type="hidden" name="decorator_id" value="{{ $booking->package->decorator_id }}">
                                @endif
                                
                                <div class="mb-4">
                                    <label class="form-label fw-bold mb-3">How would you rate your experience?</label>
                                    <div class="rating-container">
                                        <div class="star-rating">
                                            @for($i = 5; $i >= 1; $i--)
                                            <input type="radio" id="star{{ $i }}_{{ $booking->booking_id }}" name="rating" value="{{ $i }}.0" required />
                                            <label for="star{{ $i }}_{{ $booking->booking_id }}">
                                                <span class="star-value">{{ $i }}</span>
                                            </label>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="comment" class="form-label">Your Review (Optional)</label>
                                    <textarea class="form-control" id="comment" name="comment" rows="4" placeholder="Tell us about your experience..."></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Submit Feedback</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
            
            <!-- Cancellation Modals -->
            @foreach($bookings as $booking)
            @if($booking->status == 'pending' || $booking->status == 'accepted')
            <div class="modal fade" id="cancelModal{{ $booking->booking_id }}" tabindex="-1" aria-labelledby="cancelModalLabel{{ $booking->booking_id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-light">
                            <h5 class="modal-title" id="cancelModalLabel{{ $booking->booking_id }}">
                                Cancel Booking #{{ $booking->booking_id }}
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('bookings.cancel') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <input type="hidden" name="booking_id" value="{{ $booking->booking_id }}">
                                
                                <div class="alert alert-warning">
                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                    <strong>Important:</strong> Cancellation will result in a refund of only 50% of the amount paid.
                                </div>
                                
                                <div class="mb-3">
                                    <label for="reason" class="form-label">Reason for Cancellation</label>
                                    <textarea class="form-control" id="reason" name="reason" rows="3" placeholder="Please explain why you are cancelling this booking..." required></textarea>
                                </div>
                                
                                @php
                                    $price = 0;
                                    if($booking->event_id) {
                                        $price = $booking->event->price;
                                    } elseif($booking->package_id) {
                                        $price = $booking->package->price;
                                    }
                                    $refundAmount = $price * 0.5;
                                @endphp
                                
                                <div class="d-flex justify-content-between border-top border-bottom py-3 my-3">
                                    <span>Original Amount:</span>
                                    <strong>₹{{ number_format($price, 2) }}</strong>
                                </div>
                                
                                <div class="d-flex justify-content-between">
                                    <span>Refund Amount (50%):</span>
                                    <strong class="text-success">₹{{ number_format($refundAmount, 2) }}</strong>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Never Mind</button>
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-times-circle me-1"></i> Confirm Cancellation
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
            
            {{ $bookings->links() }}
            @else
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i>You don't have any bookings yet.
            </div>
            @endif
        </div>
    </div>
</div>

<style>
/* Rating Stars */
.rating-container {
    text-align: center;
    margin: 20px 0;
}

.star-rating {
    display: flex;
    flex-direction: row-reverse;
    justify-content: center;
    align-items: center;
}

.star-rating input {
    display: none;
}

.star-rating label {
    cursor: pointer;
    width: 50px;
    height: 50px;
    margin: 0 5px;
    position: relative;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.star-rating label:before {
    content: '\f005';
    font-family: 'Font Awesome 6 Free';
    font-weight: 900;
    font-size: 40px;
    color: #ddd;
    line-height: 1;
}

.star-rating input:checked ~ label:before,
.star-rating label:hover:before,
.star-rating label:hover ~ label:before {
    color: #ffc107;
}

.star-value {
    display: block;
    text-align: center;
    font-size: 14px;
    margin-top: 8px;
    font-weight: bold;
}

/* General Styling */
.card {
    border-radius: 10px;
    overflow: hidden;
    transition: all 0.3s ease;
}

.card-header {
    background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
    border-bottom: none;
}

.table-hover tbody tr:hover {
    background-color: #f8f9fa;
}

.badge {
    padding: 0.5em 0.8em;
    font-weight: 500;
    border-radius: 6px;
}

.btn-primary {
    background: #6366f1;
    border: none;
}

.btn-primary:hover {
    background: #4f46e5;
}

.modal-content {
    border-radius: 12px;
    border: none;
    overflow: hidden;
}

.modal-header {
    border-bottom: 1px solid #f0f0f0;
    padding: 1.25rem 1.5rem;
}

.modal-footer {
    border-top: 1px solid #f0f0f0;
    padding: 1.25rem 1.5rem;
}
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize tooltips
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
        
        // Initialize feedback modals
        const feedbackModals = document.querySelectorAll('.modal');
        feedbackModals.forEach(modal => {
            modal.addEventListener('shown.bs.modal', function() {
                // Reset form when modal is shown
                const form = this.querySelector('form');
                if (form) form.reset();
                
                // Add visual feedback when stars are selected
                const stars = this.querySelectorAll('.star-rating input');
                stars.forEach(star => {
                    star.addEventListener('change', function() {
                        const rating = this.value.split('.')[0];
                        console.log('Selected rating:', rating);
                    });
                });
            });
        });
    });
</script>
@endsection
