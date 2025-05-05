@extends('layouts.admin')

@push('styles')
<!-- Bootstrap Icons CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
{{-- Note: Swiper CSS is removed as Events index uses single images --}}
<style>
    .main-content-admin {
        /* Adjust based on your admin layout's sidebar/navbar */
        padding-top: 2rem; 
        padding-bottom: 3rem;
        /* Assuming a fixed sidebar width, adjust if needed */
        margin-left: 0px; 
        padding-left: 3rem; /* Replaces container-fluid px-5 */
        padding-right: 3rem; /* Replaces container-fluid px-5 */
        margin-top: 60px;
    }

    .card {
        transition: all 0.3s ease;
        overflow: hidden; /* Prevents content overflow on hover */
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important; /* Bootstrap shadow lg */
    }

    .btn-icon {
        width: 38px; /* Slightly smaller for better fit */
        height: 38px;
        padding: 0;
        display: inline-flex; /* Use inline-flex */
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        font-size: 1rem; /* Adjusted icon size */
        transition: all 0.2s ease;
        vertical-align: middle; /* Align buttons nicely */
    }
     .btn-icon:hover {
        transform: scale(1.05); /* Subtle scale */
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    .rounded-xl {
        border-radius: 0.75rem !important; /* Slightly less rounded */
    }

    .display-3 {
        font-size: 3.5rem; /* Adjusted size */
    }

    /* Reduce default Bootstrap muted color intensity */
    .text-muted {
        color: #6c757d !important; /* Standard Bootstrap muted */
        font-size: 0.875rem; /* Slightly smaller */
    }
    
    /* Event Image Container */
    .event-image-container {
        flex-shrink: 0;
        width: 180px; /* Matched package image size */
        height: 180px; /* Matched package image size */
        background-color: #f8f9fa; /* Light bg for consistency */
        border-radius: 0.5rem; /* Match inner image rounding */
        display: flex; /* Center placeholder */
        align-items: center;
        justify-content: center;
        overflow: hidden; /* Ensure image stays within bounds */
    }
    
    .event-image-container img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 0.5rem; 
    }

    .border-dashed {
        border-style: dashed !important;
    }
    .border-2 {
        border-width: 2px !important;
    }
    .text-muted {
        color: #64748b !important;
        font-weight: 500;
        font-size: 14px;
    }

    .bi-star-fill { /* Keep if rating might be added later, otherwise remove */
        color: #ffc107;
    }

    .fw-medium {
        font-weight: 500;
    }

    .badge {
        font-size: 0.875rem; /* Slightly smaller badge */
        padding: 0.375rem 0.75rem; 
    }

    .badge.bg-success {
        background-color: rgba(25, 135, 84, 0.9) !important; /* Standard Bootstrap success */
         color: #fff !important; /* White text */
    }

    .badge.bg-warning {
        background-color: #ffc107 !important; /* Standard Bootstrap warning */
        color: #000 !important; /* Black text for yellow bg */
    }

    /* Responsive Adjustments */
    @media (max-width: 767.98px) {
        .main-content-admin {
             margin-left: 0; /* Adjust if sidebar collapses */
             padding-left: 1rem;
             padding-right: 1rem;
        }
        .card-body .d-flex.gap-4 { /* Target the main flex container */
            flex-direction: column; /* Stack image and content */
            align-items: center; /* Center items when stacked */
            text-align: center; /* Center text */
        }
        .event-card { cursor: pointer; }
        .event-image-container {
            margin-bottom: 1rem; /* Space below image */
            width: 200px; /* Optional: Adjust size for mobile */
            height: 200px;
        }
        .card-body .flex-grow-1 {
            width: 100%; /* Take full width */
        }
        .card-body .justify-content-between {
           justify-content: center !important; /* Center title/badge */
           flex-direction: column; /* Stack title and badge */
           gap: 0.5rem;
        }
         .card-body .gap-3 { /* Category/Decorator/Price row */
            justify-content: center; /* Center items */
            flex-wrap: wrap; /* Allow wrapping if needed */
         }
         .card-body .justify-content-end {
            justify-content: center !important; /* Center buttons */
            margin-top: 1rem; /* Add space above buttons */
         }
    }
     @media (max-width: 575.98px) {
        .header-flex {
            flex-direction: column;
            align-items: flex-start !important; /* Align left on smallest screens */
            gap: 0.75rem; /* Add gap */
        }
         .header-flex .btn { /* Adjust button size slightly on mobile */
            padding: 0.5rem 1rem;
         }
     }

</style>
@endpush

@section('content')
<div class="main-content-admin">
    {{-- Removed container-fluid, using padding on main-content-admin now --}}

    {{-- Header Section --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-5 header-flex">
        <div>
            <h1 class="h2 fw-bold mb-1">Manage Events</h1>
            <p class="text-muted mb-0">Total {{ $events->count() }} events found</p>
        </div>
        <div>
           
        </div>
    </div>

    {{-- Success Alert --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-5" role="alert">
        <div class="d-flex align-items-center">
            <i class="bi bi-check-circle-fill me-2 fs-5"></i> {{-- Consistent icon size --}}
            <div>{{ session('success') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    @endif

    {{-- Events Grid --}}
    <div class="row g-4"> {{-- Matched gutter g-4 --}}
        @forelse($events as $event)
        <div class="col-12 col-lg-6"> {{-- Changed breakpoint to lg for 2 columns --}}
            <div class="card shadow-sm rounded-xl border-0 h-100"> {{-- Added h-100 --}}
            <div class="card-body p-4 event-card" data-event-id="{{ $event->event_id }}">
                    {{-- Use flex for layout, stack on mobile (defined in CSS) --}}
                    <div class="d-flex gap-4"> 
                        {{-- Image Container --}}
                        <div class="event-image-container"> {{-- Applied new class --}}
                             @if($event->image)
                                <img src="{{ asset('storage/' . $event->image) }}"
                                     alt="{{ $event->title }}"
                                     loading="lazy"> {{-- Added lazy loading --}}
                            @else
                                {{-- Placeholder if event has no image --}}
                                <i class="bi bi-image text-muted fs-1"></i>
                            @endif
                        </div>

                        {{-- Content Area --}}
                        <div class="flex-grow-1 d-flex flex-column"> {{-- Added d-flex flex-column --}}
                            {{-- Top section: Title, ID, Status --}}
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h5 class="mb-1 fw-bold">{{ $event->title }}</h5>
                                    <small class="text-muted">#{{ $event->event_id }}</small>
                                </div>
                                <span class="badge bg-{{ $event->is_live ? 'success' : 'warning' }} rounded-pill"> {{-- Removed px/py, uses badge padding + added color styles --}}
                                    {{ $event->is_live ? 'Live' : 'Pending' }}
                                </span>
                            </div>

                            {{-- Middle section: Details --}}
                            <div class="d-flex align-items-center flex-wrap gap-3 mb-4"> 
                                <span class="text-muted d-flex align-items-center">
                                    <i class="bi bi-grid-3x3 me-1"></i>
                                    {{ $event->category->category_name ?? 'N/A' }}
                                </span>
                                <span class="text-muted d-flex align-items-center">
                                    <i class="bi bi-person me-1"></i>
                                    {{ $event->decorator->decorator_name ?? 'N/A' }}
                                </span>
                                
                                
                            </div>
                            <span class="text-muted fw-medium d-flex align-items-center" style="margin-top: 10px;"> 
                                    <i class="bi bi-currency-rupee me-1"></i>
                                    {{ number_format($event->price, 0) }}
                                </span>
                            <span class="text-muted d-flex align-items-center" style="margin-top: 10px;">
        <i class="bi bi-star-fill me-1"></i>
        {{ number_format($event->rating, 1) }}
    </span>
                            
                            <div class="mt-auto"></div> 

                            {{-- Action Buttons --}}
                            <div class="d-flex justify-content-end align-items-center"> {{-- Added align-items-center --}}
                                <div class="btn-group gap-2">
                                    {{-- Approve Form --}}
                                    <form action="{{ route('admin.events.approve', $event->event_id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" 
                                                class="btn btn-icon btn-outline-success"
                                                {{ $event->is_live ? 'disabled' : '' }}
                                                data-bs-toggle="tooltip" 
                                                data-bs-placement="top"
                                                title="Approve Event"> {{-- More descriptive title --}}
                                            <i class="bi bi-check-lg"></i>
                                        </button>
                                    </form>
                                    {{-- Decline Form --}}
                                    <form action="{{ route('admin.events.decline', $event->event_id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" 
                                                class="btn btn-icon btn-outline-danger"
                                                {{ !$event->is_live ? 'disabled' : '' }}
                                                data-bs-toggle="tooltip" 
                                                data-bs-placement="top"
                                                title="Decline Event"> {{-- More descriptive title --}}
                                            <i class="bi bi-x-lg"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        {{-- Empty State Card --}}
        <div class="col-12">
            <div class="card border-dashed border-2 rounded-xl border-secondary-subtle"> {{-- Matched styling --}}
                <div class="card-body text-center py-6 px-4"> {{-- Adjusted padding --}}
                    <i class="bi bi-calendar-x display-3 text-muted mb-4"></i> {{-- Changed icon --}}
                    <h4 class="mb-2">No Events Found</h4> {{-- Adjusted margin --}}
                    <p class="text-muted mb-4">It looks like there are no events awaiting review or currently live.</p>
                    <a href="{{ route('admin.events.create') }}" class="btn btn-primary">
                       <i class="bi bi-plus-lg me-1"></i> Create Your First Event
                    </a>
                </div>
            </div>
        </div>
        @endforelse
    </div>

</div>
@endsection

@push('scripts')
{{-- Note: Swiper JS is removed as it's not used here --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    
    // Initialize Bootstrap Tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        // Ensure tooltips are disposed if they already exist (useful for dynamic content)
        var existingTooltip = bootstrap.Tooltip.getInstance(tooltipTriggerEl);
        if (existingTooltip) {
            existingTooltip.dispose();
        }
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // No Swiper initialization needed for this page
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Event card click handler
    document.querySelectorAll('.event-card').forEach(card => {
        card.addEventListener('click', function(e) {
            // Prevent click if it's on a button or form
            if (e.target.closest('button') || e.target.closest('form')) {
                return;
            }
            
            const eventId = this.getAttribute('data-event-id');
            window.location.href = `/eventdetails/${eventId}`;
        });
    });
});
</script>
@endpush