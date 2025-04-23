@extends('layouts.admin')

@section('content')
<h2>Notifications</h2>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card decorator-table">
                <div class="card-header">
                    <h3 class="mb-0">Notifications</h3>
                    <a href="{{ route('admin.notifications.create') }}" class="btn btn-primary btn-xs float-end">Send New</a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-sm table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center" style="width: 150px;">Title</th>
                                    <th class="text-center" style="width: 200px;">Recipient</th>
                                    <th class="text-center" style="width: 150px;">Status</th>
                                    <th class="text-center" style="width: 150px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($notifications as $notification)
                                    <tr>
                                        <td class="text-center align-middle">{{ $notification->title }}</td>
                                        <td class="text-center align-middle">
                                            {{ $notification->user ? $notification->user->name : 'User Not Found' }}
                                        </td>
                                        <td class="text-center align-middle">
                                            <span class="badge {{ $notification->is_read ? 'bg-secondary' : 'bg-primary' }}">
                                                {{ $notification->is_read ? 'Read' : 'Unread' }}
                                            </span>
                                        </td>
                                        <td class="text-center align-middle">
                                            <div class="btn-group">
                                                <a href="{{ route('admin.notifications.show', $notification) }}" 
                                                   class="btn btn-info btn-xs">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <form action="{{ route('admin.notifications.destroy', $notification) }}" 
                                                      method="POST" 
                                                      class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="btn btn-danger btn-xs"
                                                            onclick="return confirm('Are you sure you want to delete this notification?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
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
        </div>
    </div>
</div>
@endsection