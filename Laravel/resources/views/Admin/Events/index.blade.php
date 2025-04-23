@extends('layouts.admin')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 60vh;">
    <div class="table-responsive" style="max-width: 750px; margin: 0 auto;">
        <h3>Events</h3>
        <table class="table table-sm table-hover">
            <thead>
                <tr>
                    <th>Event Image</th>
                    <th>Event Name</th>
                    <th>Category</th>
                    <th>Decorator</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($events as $event)
                <tr>
                    <td>
                        <img src="{{ $event->image_url }}" alt="{{ $event->title }}" width="50" height="50" class="rounded">
                    </td>
                    <td>{{ $event->title }}</td>
                    <td>{{ $event->category->category_name ?? 'N/A' }}</td>
                    <td>{{ $event->decorator->decorator_name ?? 'N/A' }}</td>
                    <td>₹{{ number_format($event->price, 0) }}</td>
                    <td>
                        @if($event->is_live)
                            <span class="badge bg-success">Live</span>
                        @else
                            <span class="badge bg-warning">Pending</span>
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('admin.events.approve', $event->event_id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm" {{ $event->is_live ? 'disabled' : '' }}>
                                <i class="fas fa-check"></i> Approve
                            </button>
                        </form>
                        <form action="{{ route('admin.events.decline', $event->event_id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm" {{ !$event->is_live ? 'disabled' : '' }}>
                                <i class="fas fa-times"></i> Decline
                            </button>
                        </form>
                     
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection