@extends('layouts.admin')

@push('styles')
<style>
    .glass-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(30px);
        border: 2px solid rgba(255, 255, 255, 0.4);
        box-shadow: 0 12px 40px rgba(31, 38, 135, 0.15);
        border-radius: 20px;
        overflow: hidden;
       
        margin: 0 auto;
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
        padding: 1rem 1.5rem;
        font-size: 1.1rem;
        margin-top: 20px;
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

    h1.display-6 {
        font-size: 2.5rem;
        font-weight: 600;
    }

    .notification-table {
        border-collapse: separate;
        border-spacing: 0 1.5rem;
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
    }
    .notification-table th:last-child,
.notification-table td:last-child {
    min-width: 160px; /* you can adjust this width if needed */
    white-space: nowrap;
}


    .notification-table thead th {
        background: #f8f9fa;
        color: #6c5ce7;
        font-size: 1.3rem;
        padding: 1.5rem;
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

    .form-label {
        font-size: 1.1rem;
        font-weight: 500;
    }

    .form-control {
        font-size: 1.1rem;
        padding: 0.8rem 1.2rem;
    }

    .alert-custom {
        padding: 1.8rem;
        font-size: 1.2rem;
    }

    .alert-custom i {
        font-size: 1.8rem;
        margin-right: 1.2rem;
    }

    .btn-danger {
        border-radius: 50px !important;
        padding: 0.5rem 1.2rem;
        background: transparent;
        color: red;
        border: none;
        transition: all 0.3s ease;
    }

    .btn-danger:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
    }

    .btn-danger i {
       
    }

    .container {
        max-width: 1300px;
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

            <div class="glass-card p-5 rounded-5">
                <div class="header-bar mb-4">
                    <h1 class="display-6 fw-bold text-purple mb-3 d-flex align-items-center">
                        <i class="fas fa-tags me-2" style="color: #6c5ce7; font-size: 1.5rem;"></i>
                        <span>Coupons</span>
                    </h1>
                    <div class="accent-line"></div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <form action="{{ route('admin.coupon.store') }}" method="POST" class="glass-card p-4">
                            @csrf
                            <div class="mb-4">
                                <label for="code" class="form-label text-purple">Promo Code</label>
                                <input type="text" class="form-control @error('code') is-invalid @enderror" 
                                       id="code" name="code" required maxlength="50">
                                @error('code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="discount_percentage" class="form-label text-purple">Discount Percentage</label>
                                <input type="number" step="0.01" class="form-control @error('discount_percentage') is-invalid @enderror" 
                                       id="discount_percentage" name="discount_percentage" required min="0" max="100">
                                @error('discount_percentage')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="max_discount_amount" class="form-label text-purple">Max Discount Amount</label>
                                <input type="number" step="0.01" class="form-control @error('max_discount_amount') is-invalid @enderror" 
                                       id="max_discount_amount" name="max_discount_amount" required min="0">
                                @error('max_discount_amount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="expiry_date" class="form-label text-purple">Expiry Date</label>
                                <input type="date" class="form-control @error('expiry_date') is-invalid @enderror" 
                                       id="expiry_date" name="expiry_date" required>
                                @error('expiry_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-purple w-100">
                                <i class="fas fa-plus me-2"></i>Add Promo Code
                            </button>
                        </form>
                    </div>

                    <div class="col-md-6">
                        <div class="table-responsive">
                            <table class="notification-table">
                                <thead>
                                    <tr>
                                        <th>Promo Code</th>
                                        <th>Discount (%)</th>
                                        <th>Max Discount</th>
                                        <th>Expiry Date</th>
                                        <th>Created At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($promoCodes as $coupon)
                                    <tr>
                                        <td>{{ $coupon->code }}</td>
                                        <td>{{ $coupon->discount_percentage }}%</td>
                                        <td>{{ $coupon->max_discount_amount }}</td>
                                        <td>{{ $coupon->expiry_date }}</td>
                                        <td>{{ $coupon->created_at }}</td>
                                        <td>
                                            <form action="{{ route('admin.coupons.destroy', ['promo_id' => $coupon->promo_id]) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-danger" style="margin-left: 1rem;">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 