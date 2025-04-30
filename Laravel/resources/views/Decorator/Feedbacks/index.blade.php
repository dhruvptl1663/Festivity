@extends('layouts.decorator')

@section('content')
<div class="main-content-wrap">
    <div class="tf-section mb-30">
        <div class="wg-box">
            <div class="flex items-center justify-between mb-4">
                <h5><i class="fas fa-star me-2"></i>Customer Feedback</h5>
                <div class="flex gap-2">
                    <div class="input-group">
                        <input type="text" id="searchFeedback" class="form-control" placeholder="Search feedback...">
                        <span class="input-group-text"><i class="icon-search"></i></span>
                    </div>
                </div>
            </div>
            
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <!-- Feedback Cards -->
            <div class="row g-4">
                @forelse ($feedbacks as $feedback)
                <div class="col-md-6 col-lg-4">
                    <div class="feedback-card h-100">
                        <div class="feedback-card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="feedback-date">{{ date('d M Y', strtotime($feedback->created_at)) }}</span>
                                <div class="feedback-rating">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $feedback->rating)
                                            <i class="fas fa-star text-warning"></i>
                                        @else
                                            <i class="far fa-star text-warning"></i>
                                        @endif
                                    @endfor
                                </div>
                            </div>
                        </div>
                        <div class="feedback-card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="avatar-sm me-3">
                                    <img src="{{ asset('images/users/default-avatar.png') }}" alt="User" class="rounded-circle" width="40">
                                </div>
                                <div>
                                    <h6 class="mb-0">{{ $feedback->user->name ?? 'Anonymous' }}</h6>
                                    <small class="text-muted">Customer</small>
                                </div>
                            </div>
                            
                            <div class="feedback-content">
                                <p>{{ $feedback->content }}</p>
                            </div>
                            
                            <div class="feedback-order-details mt-3">
                                <div class="detail-row">
                                    <span class="detail-label"><i class="far fa-calendar-alt text-primary"></i> Booking ID:</span>
                                    <span class="detail-value">
                                        @if($feedback->booking)
                                            <a href="{{ route('decorator.bookings.show', $feedback->booking->booking_id) }}">#{{ $feedback->booking->booking_id }}</a>
                                        @else
                                            N/A
                                        @endif
                                    </span>
                                </div>
                                
                                <div class="detail-row">
                                    <span class="detail-label"><i class="fas fa-tag text-primary"></i> Service:</span>
                                    <span class="detail-value">
                                        @if($feedback->event)
                                            {{ $feedback->event->title ?? 'N/A' }}
                                        @elseif($feedback->package)
                                            {{ $feedback->package->title ?? 'N/A' }}
                                        @else
                                            N/A
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="alert alert-info">
                        <i class="icon-info me-2"></i> No feedback received yet
                    </div>
                </div>
                @endforelse
            </div>
            
            <div class="mt-4">
                {{ $feedbacks->links() }}
            </div>
        </div>
    </div>
</div>

<style>
    .feedback-card {
        border-radius: 12px;
        border: 1px solid rgba(0,0,0,0.1);
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
        background-color: #fff;
        overflow: hidden;
    }
    
    .feedback-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0,0,0,0.1);
    }
    
    .feedback-card-header {
        padding: 16px;
        border-bottom: 1px solid rgba(0,0,0,0.05);
        background-color: rgba(0,0,0,0.01);
    }
    
    .feedback-card-body {
        padding: 16px;
    }
    
    .feedback-date {
        color: #666;
        font-size: 0.9rem;
    }
    
    .feedback-rating {
        letter-spacing: 3px;
    }
    
    .feedback-content {
        margin: 10px 0;
        font-size: 0.95rem;
        color: #333;
        line-height: 1.5;
    }
    
    .avatar-sm {
        width: 40px;
        height: 40px;
        overflow: hidden;
        border-radius: 50%;
    }
    
    .feedback-order-details {
        font-size: 0.85rem;
    }
    
    .detail-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 6px;
    }
    
    .detail-label {
        color: #666;
    }
    
    .detail-value {
        font-weight: 500;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Search functionality
        const searchInput = document.getElementById('searchFeedback');
        if (searchInput) {
            searchInput.addEventListener('keyup', function() {
                const searchTerm = this.value.toLowerCase();
                const feedbackCards = document.querySelectorAll('.feedback-card');
                
                feedbackCards.forEach(card => {
                    const content = card.querySelector('.feedback-content').textContent.toLowerCase();
                    const userName = card.querySelector('h6').textContent.toLowerCase();
                    
                    if (content.includes(searchTerm) || userName.includes(searchTerm)) {
                        card.closest('.col-md-6').style.display = '';
                    } else {
                        card.closest('.col-md-6').style.display = 'none';
                    }
                });
            });
        }
    });
</script>
@endsection
