@extends('layouts.decorator')

@push('styles')
<style>
    .event-selection-card {
        border-radius: 10px;
        padding: 0.5rem;
        margin-bottom: 0.75rem;
        border: 1px solid rgba(0,0,0,0.05);
        transition: all 0.2s ease;
    }
    
    .event-selection-card:hover {
        background-color: rgba(13, 110, 253, 0.04);
        border-color: rgba(13, 110, 253, 0.2);
    }
    
    .form-check-input:checked + .form-check-label {
        font-weight: 500;
        color: #0d6efd;
    }
    
    .event-price {
        font-size: 0.85rem;
        background-color: rgba(0,0,0,0.05);
        padding: 0.15rem 0.5rem;
        border-radius: 20px;
        display: inline-block;
        margin-left: 0.5rem;
    }
</style>
@endpush

@section('content')
<div class="main-content-wrap">
    <div class="container py-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h4 class="mb-0 fw-bold">Create New Package</h4>
            <a href="{{ route('decorator.packages') }}" class="btn btn-outline-secondary btn-sm rounded-pill">
                <i class="bi bi-arrow-left me-1"></i> Back
            </a>
        </div>

        <div class="card border-0 shadow-sm" style="border-radius: 16px; overflow: hidden;">
            <div class="card-body p-4">
                <form action="{{ route('decorator.packages.store') }}" method="POST">
                    @csrf
                    
                    <div class="row g-4">
                        <div class="col-md-7">
                            <div class="mb-4">
                                <label for="title" class="form-label">Package Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                    id="title" name="title" value="{{ old('title') }}" 
                                    placeholder="Enter package title" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-4">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" 
                                    id="description" name="description" rows="4" 
                                    placeholder="Describe what's included in this package" required>{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                                
                            <div class="mb-4">
                                <label for="price" class="form-label">Price (₹)</label>
                                <div class="input-group">
                                    <span class="input-group-text">₹</span>
                                    <input type="number" class="form-control @error('price') is-invalid @enderror" 
                                        id="price" name="price" value="{{ old('price') }}" 
                                        placeholder="0.00" min="0" step="0.01" required>
                                </div>
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Set the base price for this package</div>
                            </div>
                        </div>
                            
                        <div class="col-md-5">
                            <div class="card bg-light border-0 h-100">
                                <div class="card-body">
                                    <h6 class="card-title fw-bold mb-3">Select Events for Package</h6>
                                    
                                    @if($events->count() > 0)
                                        <div class="events-selection">
                                            @foreach($events as $event)
                                                <div class="event-selection-card">
                                                    <div class="form-check mb-0">
                                                        <input class="form-check-input" type="checkbox" 
                                                            name="events[]" value="{{ $event->event_id }}" 
                                                            id="event{{ $event->event_id }}"
                                                            {{ is_array(old('events')) && in_array($event->event_id, old('events')) ? 'checked' : '' }}>
                                                        <label class="form-check-label d-flex justify-content-between align-items-center w-100" for="event{{ $event->event_id }}">
                                                            <span>{{ $event->title }}</span>
                                                            <span class="event-price">₹{{ number_format($event->price, 0) }}</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        @error('events')
                                            <div class="text-danger small mt-2">{{ $message }}</div>
                                        @enderror
                                    @else
                                        <div class="alert alert-warning py-3">
                                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                            You don't have any live events to include. 
                                            <a href="{{ route('decorator.events.create') }}" class="alert-link">Create an event</a> first.
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-end mt-4 pt-3 border-top">
                        <button type="reset" class="btn btn-light me-2">Reset</button>
                        <button type="submit" class="btn btn-primary px-4">Create Package</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
