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
    
    .feedback-card {
        display: flex;
        flex-direction: column;
        height: 100%;
    }
    
    .feedback-card .card-body {
        flex: 1;
    }
    
    .feedback-header {
        padding: 1.25rem;
        background-color: #f8f9fa;
        border-bottom: 1px solid rgba(0,0,0,0.1);
    }
    
    .feedback-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-bottom: 0.5rem;
    }
    
    .feedback-meta-item {
        display: flex;
        align-items: center;
        font-size: 0.875rem;
        color: #6c757d;
    }
    
    .feedback-meta-item i {
        margin-right: 0.25rem;
        font-size: 0.75rem;
    }
    
    .rating-stars {
        display: flex;
        align-items: center;
        color: #fd7e14;
        margin-top: 0.5rem;
    }
    
    .rating-stars i {
        margin-right: 0.25rem;
    }
    
    .feedback-type {
        padding: 0.35rem 0.75rem;
        border-radius: 2rem;
        font-size: 0.75rem;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
    }
    
    .feedback-type.event {
        background-color: rgba(13, 110, 253, 0.1);
        color: #0d6efd;
    }
    
    .feedback-type.package {
        background-color: rgba(25, 135, 84, 0.1);
        color: #198754;
    }
    
    .feedback-type.decorator {
        background-color: rgba(102, 16, 242, 0.1);
        color: #6610f2;
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
    
    .feedback-comment {
        font-style: italic;
        padding: 1rem;
        background-color: #f8f9fa;
        border-radius: 0.5rem;
        margin-top: 1rem;
        position: relative;
    }
    
    .feedback-comment::before {
        content: '\201C';
        font-family: Georgia, serif;
        font-size: 2rem;
        position: absolute;
        left: 0.5rem;
        top: -0.5rem;
        color: #dee2e6;
    }
    
    .stats-card {
        text-align: center;
        margin-bottom: 1.5rem;
    }
    
    .stats-value {
        font-size: 2rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }
    
    .stats-label {
        font-size: 0.875rem;
        color: #6c757d;
    }
    
    .rating-distribution {
        display: flex;
        align-items: center;
        margin-bottom: 0.5rem;
    }
    
    .rating-label {
        flex: 0 0 40px;
        display: flex;
        align-items: center;
    }
    
    .rating-progress {
        flex: 1;
        height: 8px;
        background-color: #e9ecef;
        border-radius: 4px;
        overflow: hidden;
        margin: 0 10px;
    }
    
    .rating-bar {
        height: 100%;
        background-color: #fd7e14;
    }
    
    .rating-count {
        flex: 0 0 40px;
        text-align: right;
        font-size: 0.75rem;
        color: #6c757d;
    }
</style>

<div class="main-content">
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <!-- Header Section -->
            <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="mb-1">Customer Feedbacks</h4>
                    <p class="text-muted">View and analyze customer ratings and reviews</p>
                </div>
            </div>
            
            <!-- Stats Section -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card stats-card">
                        <div class="card-body">
                            <div class="stats-icon mb-2">
                                <i class="bi bi-star-fill text-warning" style="font-size: 2rem;"></i>
                            </div>
                            <div class="stats-value">{{ number_format($averageRating, 1) }}</div>
                            <div class="stats-label">Average Rating</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card stats-card">
                        <div class="card-body">
                            <div class="stats-icon mb-2">
                                <i class="bi bi-chat-left-text text-primary" style="font-size: 2rem;"></i>
                            </div>
                            <div class="stats-value">{{ $totalFeedbacks }}</div>
                            <div class="stats-label">Total Reviews</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card stats-card">
                        <div class="card-body">
                            <div class="stats-icon mb-2">
                                <i class="bi bi-calendar-check text-success" style="font-size: 2rem;"></i>
                            </div>
                            <div class="stats-value">{{ $recentFeedbacks }}</div>
                            <div class="stats-label">New This Month</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Filters Section -->
            <div class="card filter-card">
                <div class="card-body">
                    <form action="{{ route('decorator.feedbacks') }}" method="GET" class="row g-3 align-items-end">
                        <div class="col-md-3">
                            <label class="form-label small">Type</label>
                            <select name="type" class="form-select">
                                <option value="">All Types</option>
                                <option value="event" {{ request('type') == 'event' ? 'selected' : '' }}>Events</option>
                                <option value="package" {{ request('type') == 'package' ? 'selected' : '' }}>Packages</option>
                                <option value="decorator" {{ request('type') == 'decorator' ? 'selected' : '' }}>Decorator</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small">Rating</label>
                            <select name="rating" class="form-select">
                                <option value="">All Ratings</option>
                                <option value="5" {{ request('rating') == '5' ? 'selected' : '' }}>5 Stars</option>
                                <option value="4" {{ request('rating') == '4' ? 'selected' : '' }}>4 Stars</option>
                                <option value="3" {{ request('rating') == '3' ? 'selected' : '' }}>3 Stars</option>
                                <option value="2" {{ request('rating') == '2' ? 'selected' : '' }}>2 Stars</option>
                                <option value="1" {{ request('rating') == '1' ? 'selected' : '' }}>1 Star</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-filter me-1"></i> Apply Filters
                                </button>
                                <a href="{{ route('decorator.feedbacks') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-arrow-repeat me-1"></i> Reset
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
                    
                    <div class="stats-box mt-4">
                        <div class="row">
                                        </div>
                                    </div>
                                    <div class="rating-stars">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $feedback->rating)
                                                <i class="bi bi-star-fill"></i>
                                            @else
                                                <i class="bi bi-star"></i>
                                            @endif
                                        @endfor
                                        <span class="ms-2">{{ $feedback->rating }}/5</span>
                                    </div>
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <div class="mb-3">
                                        <h6 class="card-subtitle mb-2 text-muted">For: </h6>
                                        <h5 class="card-title">
                                        @if($feedback->event_id)
                                            {{ $feedback->event->title }}
                                        @elseif($feedback->package_id)
                                            {{ $feedback->package->title }}
                                        @else
                                            Your Business
                                        @endif
                                        </h5>
                                    </div>
                                    
                                    <div class="feedback-comment">
                                        {{ $feedback->comment }}
                                    </div>
                                    
                                    <div class="mt-3 text-muted small">
                                        <i class="bi bi-calendar3 me-1"></i> {{ $feedback->created_at->format('d M, Y') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="d-flex justify-content-center">
                    {{ $feedbacks->links() }}
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
