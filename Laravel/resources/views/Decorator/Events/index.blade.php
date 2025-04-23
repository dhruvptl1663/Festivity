@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">My Events</h1>
        <a href="{{ route('decorator.events.create') }}" class="btn btn-primary">Create New Event</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($events->isEmpty())
        <div class="alert alert-info">
            No events found. Create your first event by clicking the "Create New Event" button above.
        </div>
    @else
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Event Name</th>
                                <th>Category</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($events as $event)
                                <tr>
                                    <td>{{ $event->name }}</td>
                                    <td>{{ $event->category->name }}</td>
                                    <td>{{ $event->date }}</td>
                                    <td>
                                        <span class="badge bg-{{ $event->status == 'approved' ? 'success' : ($event->status == 'pending' ? 'warning' : 'danger') }}">
                                            {{ ucfirst($event->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('decorator.events.edit', $event) }}" class="btn btn-sm btn-primary">Edit</a>
                                            <form action="{{ route('decorator.events.destroy', $event) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this event?')">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection