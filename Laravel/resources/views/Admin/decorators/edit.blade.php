@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Edit Decorator</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.decorators.update', $decorator) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="decorator_name" class="form-label">Name</label>
                            <input type="text" class="form-control @error('decorator_name') is-invalid @enderror" id="decorator_name" name="decorator_name" value="{{ $decorator->decorator_name }}" required>
                            @error('decorator_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $decorator->email }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password (leave blank to keep current)</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="decorator_icon" class="form-label">Profile Picture</label>
                            <input type="file" class="form-control @error('decorator_icon') is-invalid @enderror" id="decorator_icon" name="decorator_icon">
                            @if($decorator->decorator_icon)
                                <img src="{{ asset('storage/' . $decorator->decorator_icon) }}" alt="{{ $decorator->decorator_name }}" width="100" height="100" class="mt-2">
                            @endif
                            @error('decorator_icon')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="rating" class="form-label">Rating</label>
                            <input type="number" step="0.1" class="form-control @error('rating') is-invalid @enderror" id="rating" name="rating" value="{{ $decorator->rating }}" min="0" max="5">
                            @error('rating')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="availability" class="form-label">Availability</label>
                            <select class="form-control" id="availability" name="availability" required>
                                <option value="1" {{ $decorator->availability ? 'selected' : '' }}>Available</option>
                                <option value="0" {{ !$decorator->availability ? 'selected' : '' }}>Not Available</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Decorator</button>
                    </form>
                </div>
            </div>
        </div