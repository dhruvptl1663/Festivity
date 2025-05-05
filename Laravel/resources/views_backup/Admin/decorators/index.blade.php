@extends('layouts.admin')
@section('content')
<div class="main-content-admin" style="margin-left:0px;">
    {{-- Increased container padding --}}
    <div class="container-fluid px-5 py-5">
        <div class="d-flex justify-content-between align-items-center mb-5"> {{-- Increased bottom margin --}}
            <div>
                {{-- Increased heading size --}}
                <h1 class="h3 fw-bold mb-1 fs-2">Manage Decorators</h1>
                <p class="text-muted mb-0 fs-5">Total {{ $decorators->count() }} decorators found</p> {{-- Slightly larger subtext --}}
            </div>
            {{-- Larger button --}}
            <a href="{{ route('admin.decorators.create') }}" class="btn btn-primary px-4 py-2 btn-lg">
                <i class="bi bi-plus-lg me-2"></i>Add New
            </a>
        </div>

        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4 fs-5" role="alert"> {{-- Larger alert font --}}
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="row g-5"> {{-- Increased gutter size --}}
            @forelse($decorators as $decorator)
            {{-- Changed grid: 1 on small, 1 on medium, 2 on large+ --}}
            <div class="col-12 col-md-12 col-lg-6">
                <div class="card h-100 border-0 shadow-sm overflow-hidden">
                    {{-- Increased card padding --}}
                    <div class="card-body p-4">
                        {{-- Increased gap --}}
                        <div class="d-flex gap-4">
                            <div class="flex-shrink-0">
                                {{-- Increased image size --}}
                                <img src="{{ asset('storage/' . $decorator->decorator_icon) }}"
                                     alt="{{ $decorator->decorator_name }}"
                                     class="rounded-3"
                                     width="100"
                                     height="100"
                                     style="object-fit: cover">
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div>
                                        {{-- Increased card title size --}}
                                        <h5 class="mb-1 fw-semibold fs-4">{{ $decorator->decorator_name }}</h5>
                                        {{-- Increased email size --}}
                                        <small class="text-muted fs-6">{{ $decorator->email }}</small>
                                    </div>
                                    {{-- Larger badge --}}
                                    <span class="badge bg-{{ $decorator->availability ? 'success' : 'danger' }} rounded-pill px-3 py-1 fs-6">
                                        {{ $decorator->availability ? 'Available' : 'Busy' }}
                                    </span>
                                </div>

                                {{-- Increased top margin --}}
                                <div class="d-flex align-items-center justify-content-between mt-4">
                                    {{-- Star rating size increased via CSS --}}
                                    <div class="star-rating">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="bi bi-star{{ $i <= $decorator->rating ? '-fill' : '' }} text-warning"></i>
                                        @endfor
                                        <span class="text-muted ms-2">({{ $decorator->rating }})</span>
                                    </div>
                                    {{-- Increased gap for buttons --}}
                                    <div class="btn-group gap-3">
                                        <a href="{{ route('admin.decorators.edit', $decorator) }}"
                                           class="btn btn-icon btn-outline-primary" {{-- Size increased via CSS --}}
                                           aria-label="Edit decorator"
                                           data-bs-toggle="tooltip"
                                           title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.decorators.destroy', $decorator) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-icon btn-outline-danger" {{-- Size increased via CSS --}}
                                                    aria-label="Delete decorator"
                                                    onclick="return confirm('Are you sure?')"
                                                    data-bs-toggle="tooltip"
                                                    title="Delete">
                                                <i class="bi bi-trash"></i>
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
            <div class="col-12">
                <div class="card border-dashed">
                    <div class="card-body text-center py-5">
                        {{-- Larger icon for empty state --}}
                        <i class="bi bi-people display-2 text-muted"></i>
                        {{-- Larger text for empty state --}}
                        <h5 class="mt-4 mb-0 text-muted fs-4">No decorators found</h5>
                    </div>
                </div>
            </div>
            @endforelse
        </div>
    </div> <!-- end .container-fluid -->
</div> <!-- end .main-content-admin -->
@endsection

@push('styles')
<!-- Bootstrap Icons CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<style>
    .main-content-admin {
        padding-top: 90px;
    }

    /* --- Increased Button Icon Size --- */
    .btn-icon {
        width: 44px;  /* Increased size */
        height: 44px; /* Increased size */
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50% !important;
        padding: 0;
        font-size: 1.3rem; /* Slightly increased base font size */
        transition: background 0.18s, color 0.18s, box-shadow 0.18s;
        box-shadow: none;
        border-width: 2px;
    }
    .btn-icon .bi {
        font-size: 1.4rem; /* Increased icon size */
        vertical-align: middle;
    }
    /* (Keep existing hover styles for btn-icon) */
    .btn-icon.btn-outline-primary {
        color: #2563eb;
        border-color: #2563eb;
        background: #f1f5ff;
    }
    .btn-icon.btn-outline-primary:hover, .btn-icon.btn-outline-primary:focus {
        background: #2563eb;
        color: #fff;
        border-color: #2563eb;
        box-shadow: 0 2px 8px rgba(37,99,235,0.10);
    }
    .btn-icon.btn-outline-danger {
        color: #dc2626;
        border-color: #dc2626;
        background: #fef2f2;
    }
    .btn-icon.btn-outline-danger:hover, .btn-icon.btn-outline-danger:focus {
        background: #dc2626;
        color: #fff;
        border-color: #dc2626;
        box-shadow: 0 2px 8px rgba(220,38,38,0.10);
    }

    .card {
        transition: all 0.2s ease;
        border-radius: 16px; /* Slightly larger radius */
    }

    .card:hover {
        transform: translateY(-5px); /* Increased hover effect */
        box-shadow: 0 10px 30px rgba(0,0,0,0.10) !important; /* Increased shadow */
    }

    /* --- Increased Star Rating Size --- */
    .star-rating {
        font-size: 1rem; /* Increased base size */
    }
    .star-rating i.bi {
        font-size: 1.2rem; /* Increased star icon size */
    }
    .star-rating span {
        font-size: 1rem; /* Increased rating number size */
    }

    /* --- Removed smaller star rating rule --- */
    /* .star-rating.small { ... } */

    .border-dashed {
        border: 2px dashed #e9ecef !important;
        border-radius: 16px; /* Match card radius */
    }

    /* Adjust button padding if needed for standard buttons (Add New already uses btn-lg) */
    /* .btn-group .btn { ... } */

    @media (max-width: 992px) { /* Adjusted breakpoint for card layout change */
        /* Add specific adjustments for medium screens if needed */
    }

    @media (max-width: 768px) {
        .card-body {
            padding: 1.25rem !important; /* Slightly increase padding on smaller screens too */
        }
        .d-flex.gap-4 {
            /* Maybe reduce gap slightly on small screens if needed */
             /* gap: 1rem !important; */
        }
        .fs-4 { /* Adjust heading size on small screens if it becomes too large */
            font-size: 1.5rem !important;
        }
        .btn-icon { /* Slightly smaller icons on mobile */
            width: 40px;
            height: 40px;
        }
        .btn-icon .bi {
            font-size: 1.2rem;
        }
    }
</style>
@endpush
