@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card decorator-form">
                <div class="card-header">
                    <h3 class="mb-0">Notification Details</h3>
                    <div class="btn-group float-end">
                        <a href="{{ route('admin.notifications.index') }}" class="btn btn-secondary btn-xs">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <p class="form-control-plaintext">{{ $notification->title }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Recipient</label>
                        <p class="form-control-plaintext">{{ $notification->user->name }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Message</label>
                        <p class="form-control-plaintext">{{ $notification->message }}</p>
                    </div