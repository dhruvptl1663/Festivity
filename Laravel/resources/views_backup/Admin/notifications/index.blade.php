@extends('layouts.admin')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
    .glass-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(30px);
        border: 2px solid rgba(255, 255, 255, 0.4);
        box-shadow: 0 12px 40px rgba(31, 38, 135, 0.15);
        border-radius: 20px;
        overflow: hidden;
    }

    .text-purple {
        color: #6c5ce7;
    }

    .btn-purple {
        background: #6c5ce7;
        color: white;
        border: none;
        transition: all 0.3s ease;
        border-radius: 50px !important;
        padding: 0.5rem 1.2rem;
    }

    .btn-purple:hover {
        background: #5b4bc4;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(108, 92, 231, 0.3);
    }

    .btn-danger {
        border-radius: 50px !important;
        padding: 0.5rem 1.2rem;
    }

    .btn-danger:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
    }

    .btn-purple i,
    .btn-danger i {
        margin-right: 0.5rem;
    }

    .header-bar {
        position: relative;
        padding-bottom: 1.5rem;
    }

    .accent-line {
        background: #6c5ce7;
        height: 4px;
        width: 60px;
        border-radius: 2px;
    }

    .notification-table {
        border-collapse: separate;
        border-spacing: 0 1rem;
        width: 100%;
    }

    .notification-table thead th {
        background: #f8f9fa;
        color: #6c5ce7;
        font-size: 1.1rem;
        padding: 1.2rem;
        border-bottom: 3px solid #6c5ce7;
    }

    .notification-table tbody tr {
        background: white;
        transition: all 0.2s ease;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }

    .notification-table tbody tr:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .notification-table td {
        padding: 1.2rem;
        vertical-align: middle;
        font-size: 1rem;
    }

    .empty-state {
        background: white;
        padding: 2rem;
        text-align: center;
        color: #6c5ce7;
        border-radius: 12px;
    }

    .alert-custom {
        padding: 1.5rem;
        margin-bottom: 2rem;
        border-radius: 12px;
        font-size: 1.1rem;
        color: white;
    }

    .alert-custom i {
        font-size: 1.5rem;
        margin-right: 1rem;
    }

    .alert-custom .btn-close {
        color: white;
        opacity: 0.5;
    }

    .alert-custom .btn-close:hover {
        opacity: 1;
    }

    /* Success Alert */
    .alert-success {
        background: rgba(34, 197, 94, 0.15);
        border: 2px solid #22c55e;
        color: #22c55e;
    }

    .alert-success i {
        color: #22c55e;
    }

    .alert-success .btn-close {
        color: #22c55e;
    }


    .alert-danger {
        background: rgba(255, 69, 58, 0.15);
        border: 2px solid #ff453a;
        color: #ff453a;
    }

    .alert-danger i {
        color: #ff453a;
    }

    .alert-danger .btn-close {
        color: #ff453a;
    }
</style>
@endpush

@section('content')
<div class="container py-5" style="margin-top: 7rem;">
    <div class="row justify-content-center">
        <div class="col-12 col-xl-10">
            <!-- Flash Message Section -->
            @if(session('success'))
            <div class="alert alert-custom alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            
            @if(session('error'))
            <div class="alert alert-custom alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="glass-card p-5 rounded-5">
                <div class="header-bar mb-4">
                    <h1 class="display-6 fw-bold text-purple mb-3 d-flex align-items-center">
                        <i class="fas fa-bell me-2" style="color: #6c5ce7; font-size: 1.5rem;"></i>
                        <span>Notifications</span>
                    </h1>
                    <div class="accent-line"></div>
                    <div class="text-end mb-4">
                    <a href="{{ route('admin.notifications.create') }}" class="btn btn-purple">
                        <i class="fas fa-plus me-2"></i>Send New Notification
                    </a>
                </div>
                </div>

            

                <div class="table-responsive">
                    <table class="notification-table">
                        <thead>
                            <tr>
                                <th class="text-center">Title</th>
                                <th class="text-center">Recipient</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($notifications->isEmpty())
                                <tr>
                                    <td colspan="4" class="empty-state">
                                        <i class="fas fa-inbox fa-3x mb-3"></i>
                                        <p class="mb-0">No notifications found</p>
                                    </td>
                                </tr>
                            @else
                                @foreach($notifications as $notification)
                                    <tr>
                                        <td class="text-center align-middle">{{ $notification->title }}</td>
                                        <td class="text-center align-middle">
                                            {{ $notification->user ? $notification->user->name : 'User Not Found' }}
                                        </td>
                                        <td class="text-center align-middle">
                                            <span class="badge {{ $notification->is_read ? 'bg-secondary' : 'bg-primary' }} p-2">
                                                {{ $notification->is_read ? 'Read' : 'Unread' }}
                                            </span>
                                        </td>
                                        <td class="text-center align-middle">
                                            <div class="btn-group">
                                                <a href="{{ route('admin.notifications.show', $notification) }}" 
                                                   class="btn btn-purple">
                                                    <i class="fas fa-eye"></i>View
                                                </a>
                                                <form action="{{ route('admin.notifications.destroy', $notification) }}" 
                                                      method="POST" 
                                                      class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="btn btn-danger"
                                                            onclick="return confirm('Are you sure you want to delete this notification?')">
                                                        <i class="fas fa-trash-alt"></i>Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const flashMessage = document.getElementById('flash-message');
    if (flashMessage) {
        // Remove the message after 3 seconds
        setTimeout(() => {
            flashMessage.remove();
        }, 3000);
    }
});
</script>
@endpush