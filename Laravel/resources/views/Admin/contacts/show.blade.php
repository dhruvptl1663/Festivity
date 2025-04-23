@extends('layouts.admin')

@push('styles')
<link rel="stylesheet" href="{{ asset('dashboard/css/contact.css') }}">
@endpush

@section('content')
<div class="section-main">
    <div class="container">
        <div class="card contact-card">
            <div class="card-header">
                <h2>Contact Message Details</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="contact-info-item">
                            <strong><i class="icon-user"></i> Name</strong>
                            <p>{{ $contact->name }}</p>
                        </div>
                        <div class="contact-info-item">
                            <strong><i class="icon-mail"></i> Email</strong>
                            <p>{{ $contact->email }}</p>
                        </div>
                        <div class="contact-info-item">
                            <strong><i class="icon-phone"></i> Phone</strong>
                            <p>{{ $contact->phone }}</p>
                        </div>
                        <div class="contact-info-item">
                            <strong><i class="icon-calendar"></i> Date Sent</strong>
                            <p>{{ $contact->created_at->format('F d, Y h:i A') }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="contact-info-item">
                            <strong><i class="icon-message-square"></i> Message</strong>
                            <p>{{ $contact->message }}</p>
                        </div>
                        @if($contact->image)
                        <div class="contact-info-item">
                            <strong><i class="icon-image"></i> Attached Image</strong>
                            <div>
                                <img src="{{ asset('storage/' . $contact->image) }}" alt="Contact Image" class="contact-image">
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="mt-4">
                    <a href="{{ route('admin.contacts.index') }}" class="btn-contact btn-secondary">
                        <i class="icon-arrow-left"></i> Back to List
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
