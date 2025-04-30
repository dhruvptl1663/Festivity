<x-decoratorheader />

<!-- Page content wrapper -->
<div class="container-fluid py-4">
    <!-- Main Content Card -->
    <div class="card shadow-sm">
        <div class="card-body p-4">
                <!-- Header with back button -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="mb-0">Create New Event</h4>
                    <a href="{{ route('decorator.events') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Back to Events
                    </a>
                </div>
                
                <div class="form-wrapper">
                    <form method="POST" action="{{ route('decorator.events.store') }}" enctype="multipart/form-data" class="form-box">
                        @csrf
                        
                        <div class="form-group">
                            <label for="title">Event Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
                            @error('title')
                                <span class="error-message">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4">{{ old('description') }}</textarea>
                            @error('description')
                                <span class="error-message">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="category_id">Category</label>
                            <select class="form-control @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->category_id }}" {{ old('category_id') == $category->category_id ? 'selected' : '' }}>
                                        {{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="error-message">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="price">Price (₹)</label>
                            <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') }}" required>
                            @error('price')
                                <span class="error-message">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="image">Event Image</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" required>
                            <small class="form-text text-muted">Upload a high-quality image (JPEG, PNG, JPG, GIF)</small>
                            @error('image')
                                <span class="error-message">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Create Event</button>
                            <a href="{{ route('decorator.events') }}" class="btn btn-outline-secondary ml-2">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Get references to sidebar and content elements
    const sidebar = document.getElementById('sidebar');
    const content = document.getElementById('content');
    const sidebarToggle = document.getElementById('sidebarToggle');
    const mobileMenuToggle = document.getElementById('mobileMenuToggle');

    // Function to check if viewing on mobile
    function isMobile() {
        return window.innerWidth < 992;
    }

    // Function to toggle sidebar
    function toggleSidebar() {
        sidebar.classList.toggle('sidebar-collapsed');
        content.classList.toggle('content-expanded');
    }

    // Set initial state based on screen size
    if (isMobile()) {
        sidebar.classList.add('sidebar-collapsed');
        content.classList.add('content-expanded');
    }

    // Handle sidebar toggle button click
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', toggleSidebar);
    }

    // Handle mobile menu toggle button click
    if (mobileMenuToggle) {
        mobileMenuToggle.addEventListener('click', toggleSidebar);
    }
</script>
<x-decoratorfooter />