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
    
    .form-section {
        background-color: #fff;
        border-radius: 0.75rem;
        box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075);
        overflow: hidden;
        margin-bottom: 1.5rem;
    }
    
    .section-header {
        padding: 1rem 1.5rem;
        background-color: #f8f9fa;
        border-bottom: 1px solid rgba(0,0,0,0.1);
        font-weight: 600;
        display: flex;
        align-items: center;
    }
    
    .section-header i {
        margin-right: 0.5rem;
        color: #6c757d;
    }
    
    .section-body {
        padding: 1.5rem;
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
    
    .image-preview {
        width: 100%;
        height: 200px;
        overflow: hidden;
        border-radius: 0.5rem;
        margin-bottom: 1rem;
        background-color: #f8f9fa;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }
    
    .image-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .image-preview-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6c757d;
        font-size: 1.5rem;
    }
    
    .form-floating > .form-control:focus ~ label::after,
    .form-floating > .form-control:not(:placeholder-shown) ~ label::after,
    .form-floating > .form-control-plaintext ~ label::after,
    .form-floating > .form-select ~ label::after {
        position: absolute;
        inset: 1rem 0.375rem;
        z-index: -1;
        height: 1.5em;
        content: "";
        background-color: white;
        border-radius: 0.25rem;
    }
</style>

<div class="section-content-body">
    <div class="content-body">
        <!-- Header Section -->
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
            <div>
                <h4 class="mb-1">Edit Event</h4>
                <p class="text-muted">Update your event details</p>
            </div>
            <div>
                <a href="{{ route('decorator.events') }}" class="btn btn-outline-primary">
                    <i class="bi bi-arrow-left me-1"></i> Back to Events
                </a>
            </div>
        </div>
        
        @if(session('success'))
            <div class="alert alert-success mb-4">
                <i class="bi bi-check-circle me-2"></i>
                {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-danger mb-4">
                <i class="bi bi-exclamation-triangle me-2"></i>
                {{ session('error') }}
            </div>
        @endif
        
        <div class="row">
            <div class="col-lg-8">
                <form method="POST" action="{{ route('decorator.events.update', $event->event_id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <!-- Basic Information Card -->
                    <div class="form-section">
                        <div class="section-header">
                            <i class="bi bi-info-circle"></i>
                            <span>Basic Information</span>
                        </div>
                        <div class="section-body">
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="title" class="form-label">Event Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $event->title) }}" required>
                                        @error('title')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
                                        <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                                            <option value="">Select Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->category_id }}" {{ old('category_id', $event->category_id) == $category->category_id ? 'selected' : '' }}>
                                                    {{ $category->category_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="price" class="form-label">Price (₹) <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price', $event->price) }}" min="0" step="0.01" required>
                                        @error('price')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5" required>{{ old('description', $event->description) }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Event Image Card -->
                    <div class="form-section">
                        <div class="section-header">
                            <i class="bi bi-image"></i>
                            <span>Event Image</span>
                        </div>
                        <div class="section-body">
                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="image-preview">
                                        @if($event->image)
                                            <img id="preview" src="{{ asset($event->image) }}" alt="{{ $event->title }}">
                                        @else
                                            <div id="preview-placeholder" class="image-preview-placeholder">
                                                <i class="bi bi-image me-2"></i> No image uploaded
                                            </div>
                                            <img id="preview" src="" alt="" style="display: none;">
                                        @endif
                                    </div>
                                    
                                    <div class="form-group mb-3">
                                        <label for="image" class="form-label">Update Event Image</label>
                                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                                        <div class="form-text">Leave empty to keep the current image. Recommended size: 1200 x 800 pixels.</div>
                                        @error('image')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Status Note -->
                    <div class="alert alert-info mb-4">
                        <i class="bi bi-info-circle me-2"></i>
                        After updating, your event will require admin approval before being visible to customers.
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-between mb-5">
                        <a href="{{ route('decorator.events') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-x-lg me-1"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i> Update Event
                        </button>
                    </div>
                </form>
            </div>
            
            <div class="col-lg-4">
                <!-- Event Status Card -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Event Status</h5>
                        
                        <div class="d-flex align-items-center mb-3">
                            <div class="me-3">
                                <span class="badge bg-{{ $event->is_live ? 'success' : 'warning' }} rounded-pill p-2">
                                    <i class="bi bi-{{ $event->is_live ? 'check-circle' : 'hourglass' }} me-1"></i>
                                    {{ $event->is_live ? 'Live' : 'Pending Approval' }}
                                </span>
                            </div>
                            <div class="text-muted small">
                                {{ $event->is_live ? 'This event is visible to customers.' : 'This event is waiting for admin approval.' }}
                            </div>
                        </div>
                        
                        <h6 class="fw-bold mt-4 mb-3">Event ID: #{{ $event->event_id }}</h6>
                        
                        @if($event->rating > 0)
                            <div class="mt-4">
                                <h6 class="fw-bold mb-3">Customer Rating</h6>
                                <div class="d-flex align-items-center">
                                    <div class="me-2">
                                        <span class="fs-4 fw-bold">{{ number_format($event->rating, 1) }}</span>
                                        <span class="text-muted">/5</span>
                                    </div>
                                    <div class="d-flex text-warning">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $event->rating)
                                                <i class="bi bi-star-fill me-1"></i>
                                            @elseif($i - 0.5 <= $event->rating)
                                                <i class="bi bi-star-half me-1"></i>
                                            @else
                                                <i class="bi bi-star me-1"></i>
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                
                <!-- Help Card -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Need Help?</h5>
                        <p class="card-text small">For any questions or assistance with updating your event, please contact our support team.</p>
                        <a href="#" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-question-circle me-1"></i> Get Support
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<x-decoratorfooter />

<!-- Image Preview Script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const imageInput = document.getElementById('image');
        const preview = document.getElementById('preview');
        const previewPlaceholder = document.getElementById('preview-placeholder');
        
        if (imageInput) {
            imageInput.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        if (preview) {
                            preview.src = e.target.result;
                            preview.style.display = 'block';
                            if (previewPlaceholder) {
                                previewPlaceholder.style.display = 'none';
                            }
                        }
                    }
                    reader.readAsDataURL(file);
                }
            });
        }
    });
</script>
