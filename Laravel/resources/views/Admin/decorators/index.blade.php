@extends('layouts.admin')

@section('content')
<h2>Decorators</h2>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Decorators</h3>
                    <a href="{{ route('admin.decorators.create') }}" class="btn btn-primary float-end">Add New Decorator</a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
<style>
    /* Add this to your CSS file */
    .decorator-table {
        font-size: 0.9rem;
    }
    .decorator-table th {
        font-size: 0.95rem;
        padding: 0.5rem 0.75rem;
    }
    .decorator-table td {
        padding: 0.4rem 0.75rem;
    }
    .decorator-table .btn-group {
        display: inline-flex;
        gap: 0.2rem;
    }
    .decorator-table .btn-xs {
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
    }
    .decorator-table .profile-img {
        width: 25px;
        height: 25px;
        object-fit: cover;
    }
    .decorator-table .badge {
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
    }
    .decorator-table .table-responsive {
        overflow-x: auto;
    }
    .decorator-table .table {
        margin-bottom: 0;
    }
    .decorator-table .card-header {
        padding: 0.75rem 1.25rem;
    }
    .decorator-table .card-body {
        padding: 0.75rem;
    }
    
    /* Mobile responsive styles */
    @media (max-width: 768px) {
        .decorator-table th,
        .decorator-table td {
            padding: 0.3rem 0.5rem;
        }
        .decorator-table .btn-xs {
            padding: 0.2rem 0.4rem;
        }
    }
    </style>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Rating</th>
                                <th>Availability</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($decorators as $decorator)
                                <tr>
                                    <td>
                                        <img src="{{ asset('storage/' . $decorator->decorator_icon) }}" alt="{{ $decorator->decorator_name }}" width="50" height="50" class="rounded-circle me-2">
                                        {{ $decorator->decorator_name }}
                                    </td>
                                    <td>{{ $decorator->email }}</td>
                                    <td>{{ $decorator->rating }}</td>
                                    <td>{{ $decorator->availability ? 'Available' : 'Not Available' }}</td>
                                    <td>
                                      
                                        <a href="{{ route('admin.decorators.edit', $decorator) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('admin.decorators.destroy', $decorator) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
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
@endsection