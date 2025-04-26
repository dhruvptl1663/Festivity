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
    }

    .btn-purple:hover {
        background: #5b4bc4;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(108, 92, 231, 0.3);
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

    .contact-table {
        border-collapse: separate;
        border-spacing: 0 1rem;
        width: 100%;
    }

    .contact-table thead th {
        background: #f8f9fa;
        color: #6c5ce7;
        font-size: 1.1rem;
        padding: 1.2rem;
        border-bottom: 3px solid #6c5ce7;
    }

    .contact-table tbody tr {
        background: white;
        transition: all 0.2s ease;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }

    .contact-table tbody tr:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .contact-table td {
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
</style>
@endpush

@section('content')
<div class="container py-5" style="margin-top: 7rem;">
    <div class="row justify-content-center">
        <div class="col-12 col-xl-10">
            <div class="glass-card p-5 rounded-5">
                <div class="header-bar mb-4">
                    <h1 class="display-6 fw-bold text-purple mb-3">
                        <i class="fas fa-envelope-open-text me-2"></i>Contact Messages
                    </h1>
                    <div class="accent-line"></div>
                </div>

                <div class="table-responsive">
                    <table class="contact-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($contacts as $contact)
                            <tr>
                                <td>{{ $contact->name }}</td>
                                <td>{{ $contact->email }}</td>
                                <td>{{ $contact->phone }}</td>
                                <td>{{ $contact->created_at->format('M d, Y') }}</td>
                                <td>
                                    <a href="{{ route('admin.contacts.show', $contact->id) }}" 
                                       class="btn btn-purple rounded-pill px-4 py-2">
                                        <i class="fas fa-eye me-2"></i>Details
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">
                                    <div class="empty-state">
                                        <i class="fas fa-comment-slash fa-2x mb-3"></i>
                                        <p class="mb-0 fs-5">No contact messages found</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($contacts->hasPages())
                <div class="mt-4 d-flex justify-content-center">
                    {{ $contacts->links('pagination::bootstrap-5') }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection