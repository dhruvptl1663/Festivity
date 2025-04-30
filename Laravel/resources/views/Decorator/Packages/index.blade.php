<x-decoratorheader />

<!-- Add Bootstrap Icons CSS if not already included in the layout -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

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
    
    .package-header {
        padding: 20px;
        background-color: #f8f9fa;
        border-bottom: 1px solid rgba(0,0,0,0.1);
    }
    
    .package-icon {
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #e9ecef;
        border-radius: 12px;
        margin-bottom: 15px;
    }
    
    .package-icon i {
        font-size: 28px;
        color: #6c757d;
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
    
    .status-badge {
        padding: 6px 12px;
        border-radius: 30px;
        font-size: 0.75rem;
        font-weight: 500;
    }
    
    .status-badge.confirmed {
        background-color: rgba(25, 135, 84, 0.1);
        color: #198754;
    }
    
    .status-badge.pending {
        background-color: rgba(255, 193, 7, 0.1);
        color: #fd7e14;
    }
    
    .status-badge.inactive {
        background-color: rgba(108, 117, 125, 0.1);
        color: #6c757d;
    }
    
    .rating-circle {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background-color: #fffaf0;
        color: #fd7e14;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 500;
    }
    
    .empty-state-card {
        border: 2px dashed rgba(0,0,0,0.1);
        border-radius: 0.75rem;
    }
    
    .event-tag {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 0.75rem;
        background-color: rgba(13, 110, 253, 0.1);
        color: #0d6efd;
        margin-right: 5px;
        margin-bottom: 5px;
    }
</style>

<div class="main-content">
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <!-- Header Section -->
            <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="mb-1">My Packages</h4>
                    <p class="text-muted">Manage your event packages and bundle offerings</p>
                </div>
                <div>
                    <a href="{{ route('decorator.packages.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-lg me-1"></i> Create New Package
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
                    <form action="{{ route('decorator.packages') }}" method="GET" class="row g-3">
                        <div class="col-md-3">
                            <select name="status" class="form-select">
                                <option value="">All Statuses</option>
                                <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select name="is_live" class="form-select">
                                <option value="">All Visibility</option>
                                <option value="1" {{ request('is_live') == '1' ? 'selected' : '' }}>Live</option>
                                <option value="0" {{ request('is_live') == '0' ? 'selected' : '' }}>Not Live</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary">Filter</button>
                            <a href="{{ route('decorator.packages') }}" class="btn btn-outline-secondary">Reset</a>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Packages Grid -->
            @if($packages->isEmpty())
                <!-- Empty State Card -->
                <div class="card empty-state-card">
                    <div class="card-body text-center py-5">
                        <i class="bi bi-box display-1 text-muted mb-4"></i>
                        <h4>No Packages Found</h4>
                        <p class="text-muted mb-4">You haven't created any packages yet. Packages are a great way to bundle your services.</p>
                        <a href="{{ route('decorator.packages.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-lg me-1"></i> Create Your First Package
                        </a>
                    </div>
                </div>
            @else
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    @foreach($packages as $package)
                    <div class="col">
                        <div class="card h-100">
                            <!-- Package Header -->
                            <div class="package-header">
                                <div class="d-flex justify-content-between mb-3">
                                    <div class="package-icon">
                                        <i class="bi bi-box"></i>
                                    </div>
                                    <div>
                                        <span class="status-badge {{ $package->status }}">
                                            {{ ucfirst($package->status) }}
                                        </span>
                                    </div>
                                </div>
                                <h5 class="mb-2 fw-bold">{{ $package->title }}</h5>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-muted">#{{ $package->package_id }}</span>
                                    <span class="status-badge {{ $package->is_live ? 'confirmed' : 'pending' }}">
                                        {{ $package->is_live ? 'Live' : 'Pending' }}
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Package Content -->
                            <div class="card-body d-flex flex-column">
                                <!-- Price and Rating -->
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="fs-5 fw-bold text-primary">
                                        <i class="bi bi-currency-rupee"></i> {{ number_format($package->price, 0) }}
                                    </div>
                                    <div class="rating-circle">
                                        {{ number_format($package->rating, 1) }}
                                    </div>
                                </div>
                                
                                <!-- Description Preview -->
                                <p class="text-muted mb-3">{{ Str::limit($package->description, 120) }}</p>
                                
                                <!-- Created Date -->
                                <div class="text-muted small mb-3">
                                    <i class="bi bi-calendar3 me-1"></i> Created: {{ $package->created_at->format('d M, Y') }}
                                </div>
                                
                                <!-- Spacer to push buttons to the bottom -->
                                <div class="mt-auto"></div>
                                
                                <!-- Action Buttons -->
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="{{ route('decorator.packages.edit', $package->package_id) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    
                                    <div class="btn-group">
                                        <a href="#" class="btn btn-sm btn-outline-secondary" data-bs-toggle="tooltip" title="View Bookings">
                                            <i class="bi bi-calendar-check"></i>
                                        </a>
                                        <form action="{{ route('decorator.packages.destroy', $package->package_id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this package?')" data-bs-toggle="tooltip" title="Delete Package">
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
                    {{ $packages->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Initialize Bootstrap tooltips -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    });
</script>

<x-decoratorfooter />
