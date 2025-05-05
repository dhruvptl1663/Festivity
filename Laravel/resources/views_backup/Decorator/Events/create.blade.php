@extends('layouts.decorator')

@section('content')
<div class="main-content-wrap">
    <div class="tf-section mb-30">
        <div class="wg-box">
            <div class="flex items-center justify-between mb-4">
                <h5>Create New Event</h5>
                <a href="{{ route('decorator.events') }}" class="btn btn-light rounded-pill shadow-sm btn-sm">
                    <i class="bi bi-arrow-left me-1"></i> Back to All Events
                </a>
            </div>

            <div class="card border-0 shadow-sm" style="border-radius: 16px; overflow: hidden;">
                <div class="card-body p-4">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('decorator.events.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-4">
                                    <label for="title" class="form-label">Event Title</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                        id="title" name="title" value="{{ old('title') }}" required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-4">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" 
                                        id="description" name="description" rows="5" required>{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label for="category_id" class="form-label">Category</label>
                                            <select class="form-select @error('category_id') is-invalid @enderror" 
                                                id="category_id" name="category_id" required>
                                                <option value="" selected disabled>Select a category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->category_id }}" 
                                                        {{ old('category_id') == $category->category_id ? 'selected' : '' }}>
                                                        {{ $category->category_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label for="price" class="form-label">Price (₹)</label>
                                            <input type="number" class="form-control @error('price') is-invalid @enderror" 
                                                id="price" name="price" value="{{ old('price') }}" min="0" step="0.01" required>
                                            @error('price')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <div class="form-text mb-2">
                                        <span class="text-warning">Note:</span> All new events will be reviewed by administrators before appearing on the website.
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="image" class="form-label">Event Image</label>
                                    <div class="file-upload-wrapper">
                                        <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                            id="image" name="image" accept="image/*" required>
                                        @error('image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="image-preview mt-3 d-none" id="imagePreview">
                                        <img src="#" alt="Event Image Preview" class="img-fluid rounded">
                                    </div>
                                </div>
                                
                                <div class="mb-4">
                                    <div class="event-info p-3 rounded" style="background-color: rgba(0,0,0,0.05);">
                                        <h6 class="mb-3">Event Guidelines</h6>
                                        <ul class="mb-0 ps-3 small">
                                            <li class="mb-2">Provide clear, accurate details about your event services</li>
                                            <li class="mb-2">Use high-quality images that showcase your work</li>
                                            <li class="mb-2">Set competitive pricing based on market research</li>
                                            <li>Events will be reviewed within 24-48 hours</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="text-end mt-4">
                            <button type="reset" class="btn btn-light rounded-pill me-2">Reset</button>
                            <button type="submit" class="btn btn-primary rounded-pill">Create Event</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Image preview functionality
    document.getElementById('image').addEventListener('change', function(e) {
        const preview = document.getElementById('imagePreview');
        const file = e.target.files[0];
        
        if (file) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.querySelector('img').src = e.target.result;
                preview.classList.remove('d-none');
            }
            
            reader.readAsDataURL(file);
        } else {
            preview.classList.add('d-none');
        }
    });
</script>
@endpush
