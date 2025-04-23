@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Add New Decorator</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.decorators.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="decorator_name" class="form-label">Name</label>
                            <input type="text" class="form-control @error('decorator_name') is-invalid @enderror" id="decorator_name" name="decorator_name" required>
                            @error('decorator_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="decorator_icon" class="form-label">Profile Picture</label>
                            <input type="file" class="form-control @error('decorator_icon') is-invalid @enderror" id="decorator_icon" name="decorator_icon">
                            @error('decorator_icon')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="rating" class="form-label">Rating</label>
                            <input type="number" step="0.1" class="form-control @error('rating') is-invalid @enderror" id="rating" name="rating" min="0" max="5">
                            @error('rating')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="availability" class="form-label">Availability</label>
                            <select class="form-control" id="availability" name="availability" required>
                                <option value="1">Available</option>
                                <option value="0">Not Available</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Create Decorator</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection