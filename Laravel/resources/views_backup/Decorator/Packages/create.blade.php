@extends('layouts.decorator')

@push('styles')
<style>
    :root {
        --primary-accent: #6366f1;
        --primary-hover: #4f46e5;
    }

    .event-selection-card {
        border-radius: 12px;
        padding: 1.25rem;
        margin-bottom: 1rem;
        border: 1px solid #e2e8f0;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        background: white;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }

    .event-selection-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        border-color: var(--primary-accent);
    }

    .event-selection-card::after {
        content: '';
        position: absolute;
        top: -1px;
        left: -1px;
        right: -1px;
        bottom: -1px;
        border: 2px solid var(--primary-accent);
        border-radius: 12px;
        opacity: 0;
        transition: opacity 0.2s ease;
    }

    .form-check-input:checked + .form-check-label .event-selection-card {
        border-color: var(--primary-accent);
        background-color: #f8f9ff;
    }

    .form-check-input:checked + .form-check-label .event-selection-card::after {
        opacity: 1;
    }

    .event-price {
        font-size: 0.9rem;
        background: linear-gradient(135deg, var(--primary-accent) 0%, var(--primary-hover) 100%);
        color: white;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        margin-left: auto;
    }

    .event-image {
        width: 80px;
        height: 80px;
        border-radius: 8px;
        object-fit: cover;
        margin-right: 1rem;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .event-image-placeholder {
        background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: #94a3b8;
    }

    .event-details {
        flex: 1;
        min-width: 0;
    }

    .event-description {
        font-size: 0.875rem;
        color: #64748b;
        line-height: 1.5;
        margin: 0.5rem 0;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .event-meta {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-size: 0.8rem;
    }

    .event-category {
        background-color: rgba(99, 102, 241, 0.1);
        color: var(--primary-accent);
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-weight: 500;
    }

    .form-control {
        border-radius: 8px;
        padding: 0.75rem 1rem;
        transition: border-color 0.2s ease;
    }

    .form-control:focus {
        border-color: var(--primary-accent);
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15);
    }

    .form-label {
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 0.5rem;
    }

    .card {
        border: 1px solid #f1f5f9;
        border-radius: 16px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.05);
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--primary-accent) 0%, var(--primary-hover) 100%);
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 500;
        transition: transform 0.2s ease;
    }

    .btn-primary:hover {
        transform: translateY(-1px);
    }
</style>
@endpush

@section('content')
<div class="main-content-wrap" style="margin-top:40px">
    <div class="container-fluid py-6">
        <div class="d-flex align-items-center justify-content-between mb-5">
            <h1 class="text-2xl font-bold text-slate-800">Create New Package</h1>
            <a href="{{ route('decorator.packages') }}" class="btn btn-light rounded-lg px-4 py-2 border hover:bg-slate-50">
                <i class="bi bi-arrow-left-short mr-2"></i> Back to Packages
            </a>
        </div>

        <div class="card">
            <div class="card-body p-6">
                <form action="{{ route('decorator.packages.store') }}" method="POST">
                    @csrf
                    
                    <div class="row g-5">
                        <!-- Left Column -->
                        <div class="col-lg-7">
                            <div class="mb-5">
                                <label for="title" class="form-label">Package Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                    id="title" name="title" value="{{ old('title') }}" 
                                    placeholder="Premium Wedding Package">
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-5">
                                <label for="description" class="form-label">Package Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" 
                                    id="description" name="description" rows="4"
                                    placeholder="Describe your package details...">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-5">
                                <label for="price" class="form-label">Package Price</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent">₹</span>
                                    <input type="number" class="form-control ps-2 @error('price') is-invalid @enderror" 
                                        id="price" name="price" value="{{ old('price') }}" 
                                        placeholder="Enter package price" min="0" step="0.01">
                                </div>
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted mt-1 d-block">Base price for this package</small>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="col-lg-5">
                            <div class="sticky-top" style="top: 100px;">
                                <h5 class="text-lg font-semibold mb-4">Select Included Events</h5>
                                
                                @if($events->count() > 0)
                                    <div class="events-selection space-y-3">
                                        @foreach($events as $event)
                                            <div class="form-check mb-0">
                                                <input class="form-check-input visually-hidden" type="checkbox" 
                                                    name="events[]" value="{{ $event->event_id }}" 
                                                    id="event{{ $event->event_id }}"
                                                    {{ is_array(old('events')) && in_array($event->event_id, old('events')) ? 'checked' : '' }}>
                                                <label class="form-check-label w-100" for="event{{ $event->event_id }}">
                                                    <div class="event-selection-card">
                                                        <div class="d-flex align-items-start">
                                                            @if($event->image)
                                                                <img src="{{ asset('storage/' . $event->image) }}" 
                                                                     class="event-image" 
                                                                     alt="{{ $event->title }}">
                                                            @else
                                                                <div class="event-image event-image-placeholder">
                                                                    <i class="bi bi-image"></i>
                                                                </div>
                                                            @endif
                                                            
                                                            <div class="event-details">
                                                                <div class="d-flex align-items-center mb-2">
                                                                    <h6 class="mb-0 font-semibold flex-grow-1">{{ $event->title }}</h6>
                                                                    <span class="event-price">₹{{ number_format($event->price, 0) }}</span>
                                                                </div>
                                                                <p class="event-description">{{ Str::limit($event->description, 100) }}</p>
                                                                <div class="event-meta">
                                                                    @if($event->category)
                                                                        <span class="event-category">{{ $event->category->category_name }}</span>
                                                                    @endif
                                                                    <span class="text-slate-500">
                                                                        <i class="bi bi-calendar-event mr-1"></i>
                                                                        {{ $event->created_at instanceof \Carbon\Carbon ? $event->created_at->format('M d, Y') : date('M d, Y', strtotime($event->created_at)) }}
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    @error('events')
                                        <div class="text-danger small mt-3">{{ $message }}</div>
                                    @enderror
                                @else
                                    <div class="alert bg-slate-50 border border-slate-200 rounded-lg p-4">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-exclamation-circle-fill text-slate-500 me-3"></i>
                                            <div>
                                                <h6 class="mb-1">No Events Available</h6>
                                                <p class="mb-0 text-slate-600">Create your first event to start building packages</p>
                                            </div>
                                        </div>
                                        <a href="{{ route('decorator.events.create') }}" class="btn btn-link p-0 mt-3">
                                            Create New Event <i class="bi bi-arrow-right ms-2"></i>
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Form Footer -->
                    <div class="d-flex justify-content-end gap-3 mt-6 pt-5 border-top">
                        <button type="reset" class="btn btn-light px-4">Reset</button>
                        <button type="submit" class="btn btn-primary px-5">
                            <i class="bi bi-plus-circle-fill me-2"></i> Create Package
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection