@extends('layouts.admin')

@push('styles')
<!-- Bootstrap Icons CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<!-- Swiper CSS CDN -->
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
<style>
    .main-content-admin {
        /* Adjust based on your admin layout's sidebar/navbar */
        padding-top: 2rem; 
        padding-bottom: 3rem;
        /* Assuming a fixed sidebar width, adjust if needed */
        margin-left: 100px; 
        padding-left: 3rem; /* Replaces container-fluid px-5 */
        padding-right: 3rem; /* Replaces container-fluid px-5 */
        margin-top: 90px;
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
    
    /* Swiper Container */
    .package-image-container {
        flex-shrink: 0;
        width: 180px; /* Increased size */
        height: 180px; /* Increased size */
    }

    .package-swiper {
        width: 100%;
        height: 100%;
        border-radius: 0.5rem; /* Match inner image rounding */
        background-color: #f8f9fa; /* Light bg for loading */
    }
    
    .package-swiper .swiper-slide img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 0.5rem; 
    }

    /* Style Swiper Navigation/Pagination if needed (defaults might be okay) */
     .package-swiper .swiper-button-next,
     .package-swiper .swiper-button-prev {
        color: #fff; /* White arrows */
        background-color: rgba(0, 0, 0, 0.3); /* Semi-transparent background */
        width: 30px; /* Adjust size */
        height: 30px; /* Adjust size */
        border-radius: 50%;
        margin-top: -15px; /* Center vertically */
     }
     .package-swiper .swiper-button-next::after,
     .package-swiper .swiper-button-prev::after {
        font-size: 14px; /* Arrow size */
        font-weight: bold;
     }
     .package-swiper .swiper-pagination-bullet-active {
        background-color: #0d6efd; /* Bootstrap primary color */
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

    .bi-star-fill {
        color: #ffc107;
    }

    .fw-medium {
        font-weight: 500;
    }

    .badge {
        font-size: 1rem; 
        padding: 0.375rem 0.75rem; 
    }

    .badge.bg-success {
        background-color:rgb(65, 200, 137);
    }

    .badge.bg-warning {
        background-color: #ffc107;
    }

    /* Responsive Adjustments */
    @media (max-width: 767.98px) {
        .main-content-admin {
             margin-left: 0; /* Adjust if sidebar collapses */
             padding-left: 1rem;
             padding-right: 1rem;
        }
        .card-body .d-flex.gap-4 {
        flex-direction: column;
        align-items: center;
        text-align: center;
}
.event-card { cursor: pointer; }
        .card-body .d-flex {
            flex-direction: column; /* Stack image and content */
            align-items: center; /* Center items when stacked */
            text-align: center; /* Center text */
            cursor: pointer; /* Change cursor to pointer */
        }
        .package-image-container {
            margin-bottom: 1rem; /* Space below image */
            width: 200px; /* Adjust size for mobile maybe */
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
         .card-body .gap-3 { /* Decorator/Price row */
            justify-content: center; /* Center items */
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
            gap: 0.5rem; /* Add gap */
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
            <h1 class="h2 fw-bold mb-1">Manage Packages</h1>
            <p class="text-muted mb-0">Total {{ $packages->count() }} packages found</p>
        </div>
        <div>
            
        </div>
    </div>

    {{-- Success Alert --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-5" role="alert">
        <div class="d-flex align-items-center">
            <i class="bi bi-check-circle-fill me-2 fs-5"></i>
            <div>{{ session('success') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    @endif

    {{-- Packages Grid --}}
    <div class="row g-4"> {{-- Reduced gutter slightly g-4 --}}
        @forelse($packages as $package)
        <div class="col-12 col-lg-6"> {{-- Changed breakpoint to lg for 2 columns --}}
            <div class="card shadow-sm rounded-xl border-0 h-100"> {{-- Added h-100 for equal height cards --}}
            <div class="card-body p-4 event-card" data-package-id="{{ $package->package_id }}">
                    {{-- Use flex for layout, stack on mobile (defined in CSS) --}}
                    <div class="d-flex gap-4"> 
                        {{-- Image Container with Swiper --}}
                        <div class="package-image-container">
                            <div class="swiper package-swiper">
                                <div class="swiper-wrapper">
                                    @forelse($package->packageEvents as $packageEvent)
                                        @if($packageEvent->event && $packageEvent->event->image)
                                            <div class="swiper-slide">
                                                <img src="{{ asset('storage/' . $packageEvent->event->image) }}"
                                                     alt="{{ $packageEvent->event->title }}"
                                                     class="img-fluid" {{-- Use img-fluid for basic responsiveness --}}
                                                     loading="lazy"> {{-- Use lazy loading for images below the fold --}}
                                            </div>
                                        @else
                                            {{-- Optional: Placeholder if an event has no image --}}
                                             <div class="swiper-slide d-flex align-items-center justify-content-center bg-light">
                                                <i class="bi bi-image text-muted fs-1"></i>
                                             </div>
                                        @endif
                                    @empty
                                        {{-- Placeholder if package has no events/images --}}
                                        <div class="swiper-slide d-flex align-items-center justify-content-center bg-light">
                                           <i class="bi bi-box text-muted fs-1"></i>
                                        </div>
                                    @endforelse
                                </div>
                                {{-- Optional: Add Swiper Pagination/Navigation elements if needed --}}
                                <div class="swiper-pagination"></div>
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                            </div>
                        </div>

                        {{-- Content Area --}}
                        <div class="flex-grow-1 d-flex flex-column">
                            {{-- Top section: Title, ID, Status --}}
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h5 class="mb-1 fw-bold">{{ $package->title }}</h5>
                                    <small class="text-muted">#{{ $package->package_id }}</small>
                                </div>
                                <span class="badge bg-{{ $package->is_live ? 'success' : 'warning' }} rounded-pill px-3 py-1 text-dark fw-medium"> {{-- Added text-dark for better contrast on yellow, fw-medium --}}
                                    {{ $package->is_live ? 'Live' : 'Pending' }}
                                </span>
                            </div>

                            {{-- Middle section: Details --}}
                            <div class="d-flex align-items-center gap-3 mb-4">
                                <span class="text-muted d-flex align-items-center">
                                    <i class="bi bi-person me-1"></i>
                                    {{ $package->decorator->decorator_name ?? 'N/A' }}
                                </span>
                                
                            </div>

                            <span class="text-muted fw-medium d-flex align-items-center" style="margin-top: 10px;"> 
                                    <i class="bi bi-currency-rupee me-1"></i>
                                    {{ number_format($package->price, 0) }}
                                </span>
                            <span class="text-muted d-flex align-items-center" style="margin-top: 10px;">
        <i class="bi bi-star-fill me-1"></i>
        {{ number_format($package->rating, 1) }}
    </span>
                           
                            <div class="mt-auto"></div> 

                            {{-- Action Buttons --}}
                            <div class="d-flex justify-content-end align-items-center">
                                <div class="btn-group gap-2">
                                    <form action="{{ route('admin.packages.approve', $package->package_id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit"
                                                class="btn btn-icon btn-outline-success"
                                                {{ $package->is_live ? 'disabled' : '' }}
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top" {{-- Specify placement --}}
                                                title="Approve Package"> {{-- More descriptive title --}}
                                            <i class="bi bi-check-lg"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.packages.decline', $package->package_id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit"
                                                class="btn btn-icon btn-outline-danger"
                                                {{ !$package->is_live ? 'disabled' : '' }}
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top" {{-- Specify placement --}}
                                                title="Decline Package"> {{-- More descriptive title --}}
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
            <div class="card border-dashed border-2 rounded-xl border-secondary-subtle"> {{-- Use subtle border color --}}
                <div class="card-body text-center py-6 px-4">
                    <i class="bi bi-box-seam display-3 text-muted mb-4"></i>
                    <h4 class="mb-2">No Packages Found</h4>
                    <p class="text-muted mb-4">It looks like there are no packages awaiting review or currently live.</p>
                    <a href="{{ route('admin.packages.create') }}" class="btn btn-primary">
                       <i class="bi bi-plus-lg me-1"></i> Create Your First Package
                    </a>
                </div>
            </div>
        </div>
        @endforelse
    </div>

</div>
@endsection

@push('scripts')
{{-- Swiper JS CDN --}}
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    
    // Initialize Bootstrap Tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Initialize Swiper Instances
    const swipers = document.querySelectorAll('.package-swiper');
    swipers.forEach(swiperElement => {
        new Swiper(swiperElement, {
            loop: swiperElement.querySelectorAll('.swiper-slide').length > 1, // Loop only if more than 1 slide
            autoplay: {
                delay: 4000, // Slightly longer delay
                disableOnInteraction: true, // Stop autoplay on interaction
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            grabCursor: true, // Add grab cursor
            // Optional: Add breakpoints if needed for responsive swiper behavior
        });
    });
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
            
            const packageId = this.getAttribute('data-package-id');
            window.location.href = `/packagedetails/${packageId}`;
        });
    });
});
</script>
@endpush