@extends('layouts.admin')

@push('styles')
<link rel="stylesheet" href="{{ asset('dashboard/css/contact.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endpush

@section('content')
<div class="section-main">
    <div class="container">
        <div class="card contact-card">
            <div class="card-header">
                <h2>Contact Messages</h2>
            </div>
            <div class="card-body">
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
                                    <a href="{{ route('admin.contacts.show', $contact->id) }}" class="btn-contact btn-info">
                                        <i class="icon-eye"></i> View
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">No contact messages found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($contacts->hasPages())
                <div class="mt-4">
                    {{ $contacts->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
