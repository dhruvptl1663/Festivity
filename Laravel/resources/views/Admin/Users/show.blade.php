@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card decorator-form">
                <div class="card-header">
                    <h3 class="mb-0">User Details</h3>
                    <div class="btn-group float-end">
                        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning btn-xs">Edit</a>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary btn-xs">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <p class="form-control-plaintext">{{ $user->name }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <p class="form-control-plaintext">{{ $user->email }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <p class="form-control-plaintext">{{ ucfirst($user->role) }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <span class="badge {{ $user->status === 'active' ? 'bg-success' : 'bg-danger' }}">
                            {{ ucfirst($user->status) }}
                        </span>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Created At</label>
                        <p class="form-control-plaintext">{{ $user->created_at->format('Y-m-d H:i:s') }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Last Updated</label>
                        <p class="form-control-plaintext">{{ $user->updated_at->format('Y-m-d H:i:s') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection