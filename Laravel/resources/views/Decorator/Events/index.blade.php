<x-decoratorheader />

<style>
    .card {
        transition: all 0.3s ease;
        overflow: hidden;
        border-radius: 0.75rem !important;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }
    
    .event-image {
        height: 180px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f8f9fa;
    }
    
    .event-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
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
    
    .empty-state-card {
        border: 2px dashed rgba(0,0,0,0.1);
        border-radius: 0.75rem;
    }
</style>
<!-- Page content wrapper -->
<div class="container-fluid py-4">
    <!-- Header Section -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1">My Events</h4>
            <p class="text-muted">Manage your decoration events</p>
        </div>
        <div>
            <a href="{{ route('decorator.events.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg me-1"></i> Create New Event
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
            
            <!-- Filters (Optional) -->
            <div class="card mb-4">
                <div class="card-body">
                    <form action="{{ route('decorator.events') }}" method="GET" class="row g-3">
                        <div class="col-md-3">
                            <select name="category" class="form-select">
                                <option value="">All Categories</option>
                                <!-- Add categories here with foreach loop if needed -->
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select name="status" class="form-select">
                                <option value="">All Statuses</option>
                                <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Live</option>
                                <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Pending</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary">Filter</button>
                            <a href="{{ route('decorator.events') }}" class="btn btn-outline-secondary">Reset</a>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Events Grid -->
            @if($events->isEmpty())
                <!-- Empty State Card -->
                <div class="card empty-state-card">
                    <div class="card-body text-center py-5">
                        <i class="bi bi-calendar-x display-1 text-muted mb-4"></i>
                        <h4>No Events Found</h4>
                        <p class="text-muted mb-4">You haven't created any events yet. Start by creating your first event.</p>
                        <a href="{{ route('decorator.events.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-lg me-1"></i> Create Your First Event
                        </a>
                    </div>
                </div>
            @else
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    @foreach($events as $event)
                    <div class="col">
                        <div class="card h-100">
                            <!-- Event Image -->
                            <div class="event-image">
                                @if($event->image)
                                    <img src="{{ asset($event->image) }}" alt="{{ $event->title }}" loading="lazy">
                                @else
                                    <i class="bi bi-image text-muted fs-1"></i>
                                @endif
                            </div>
                            
                            <!-- Event Content -->
                            <div class="card-body d-flex flex-column">
                                <!-- Top section: Title, ID, Status -->
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <div>
                                        <h5 class="mb-1 fw-bold">{{ $event->title }}</h5>
                                        <small class="text-muted">#{{ $event->event_id }}</small>
                                    </div>
                                    <span class="badge bg-{{ $event->is_live ? 'success' : 'warning' }} rounded-pill">
                                        {{ $event->is_live ? 'Live' : 'Pending' }}
                                    </span>
                                </div>
                                
                                <!-- Middle section: Details -->
                                <div class="d-flex align-items-center flex-wrap gap-3 mb-3">
                                    <span class="text-muted d-flex align-items-center">
                                        <i class="bi bi-grid-3x3 me-1"></i>
                                        {{ $event->category->category_name ?? 'N/A' }}
                                    </span>
                                </div>
                                
                                <div class="d-flex justify-content-between mb-3">
                                    <span class="text-muted fw-medium d-flex align-items-center">
                                        <i class="bi bi-currency-rupee me-1"></i>
                                        {{ number_format($event->price, 0) }}
                                    </span>
                                    <span class="text-muted d-flex align-items-center">
                                        <i class="bi bi-star-fill me-1 text-warning"></i>
                                        {{ number_format($event->rating, 1) }}
                                    </span>
                                </div>
                                
                                <!-- Spacer to push buttons to the bottom -->
                                <div class="mt-auto"></div>
                                
                                <!-- Action Buttons -->
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <a href="{{ route('decorator.events.edit', $event->event_id) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    
                                    <div class="btn-group">
                                        <a href="#" class="btn btn-sm btn-outline-secondary" data-bs-toggle="tooltip" title="View Bookings">
                                            <i class="bi bi-calendar-check"></i>
                                        </a>
                                        <form action="{{ route('decorator.events.destroy', $event->event_id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this event?')" data-bs-toggle="tooltip" title="Delete Event">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-5">
                    {{ $events->links() }}
                </div>
            @endif
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

<!-- Initialize Bootstrap tooltips -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    });
</script>

<x-decoratorfooter />