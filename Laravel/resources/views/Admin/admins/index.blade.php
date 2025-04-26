@extends('layouts.admin')

@section('content')
<div class="main-content-admin" style="margin-left:100px;">
    <div class="container-fluid px-5 py-5">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h1 class="h3 fw-bold mb-1 fs-2">Manage Admins</h1>
                <p class="text-muted mb-0 fs-5">Total {{ $admins->count() }} admins found</p>
            </div>
            <a href="{{ route('admin.admins.create') }}" class="btn btn-primary px-4 py-2 btn-lg">
                <i class="bi bi-plus-lg me-2"></i>Add New Admin
            </a>
        </div>

        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4 fs-5" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="row g-5">
            @forelse($admins as $admin)
            <div class="col-12 col-md-12 col-lg-6">
                <div class="card h-100 border-0 shadow-sm overflow-hidden">
                    <div class="card-body p-4">
                        <div class="d-flex gap-4">
                            <div class="flex-shrink-0">
                                <div class="avatar-icon d-flex align-items-center justify-content-center rounded-circle" 
                                     style="width: 40px; height: 40px; font-size: 16px;">
                                    {{ strtoupper(substr($admin->name, 0, 1)) }}
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div>
                                        <h5 class="mb-1 fw-semibold fs-4">{{ $admin->name }}</h5>
                                        <small class="text-muted fs-6">{{ $admin->email }}</small>
                                    </div>
                                    <div class="btn-group gap-2">
                                        <a href="{{ route('admin.admins.edit', $admin) }}"
                                           class="btn btn-icon btn-outline-primary"
                                           aria-label="Edit admin"
                                           data-bs-toggle="tooltip"
                                           title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.admins.destroy', $admin) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-icon btn-outline-danger"
                                                    aria-label="Delete admin"
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
                        <i class="bi bi-people display-2 text-muted"></i>
                        <h5 class="mt-4 mb-0 text-muted fs-4">No admins found</h5>
                    </div>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<style>
    .main-content-admin {
        padding-top: 90px;
    }

    .btn-icon {
        width: 44px;
        height: 44px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50% !important;
        padding: 0;
        font-size: 1.3rem;
        transition: background 0.18s, color 0.18s, box-shadow 0.18s;
        box-shadow: none;
        border-width: 2px;
    }
    .btn-icon .bi {
        font-size: 1.4rem;
        vertical-align: middle;
    }
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
        border-radius: 16px;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.10) !important;
    }

    .border-dashed {
        border: 2px dashed #e9ecef !important;
        border-radius: 16px;
    }

    .avatar-icon {
        background: linear-gradient(135deg, #e9ecef 0%, #dee2e6 100%);
        color: #343a40;
        font-weight: 600;
        border: 2px solid #e9ecef;
        transition: all 0.2s ease;
    }

    .avatar-icon:hover {
        background: linear-gradient(135deg, #dee2e6 0%, #ced4da 100%);
        transform: scale(1.1);
    }
</style>
@endpush