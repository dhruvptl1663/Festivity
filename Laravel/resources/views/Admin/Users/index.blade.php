@extends('layouts.admin')

@section('content')
<h2>User</h2>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card decorator-table">
                <div class="card-header">
                    <h3 class="mb-0">Users</h3>
                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-xs float-end">Add New</a>
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
                                    <th class="text-center" style="width: 150px;">Name</th>
                                    <th class="text-center" style="width: 200px;">Email</th>
                                    <th class="text-center" style="width: 150px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td class="text-center align-middle">{{ $user->name }}</td>
                                        <td class="text-center align-middle">{{ $user->email }}</td>
                                        <td class="text-center align-middle">
                                            <div class="btn-group">
                                              
                                                <a href="{{ route('admin.users.edit', $user) }}" 
                                                   class="btn btn-warning btn-xs">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.users.destroy', $user) }}" 
                                                      method="POST" 
                                                      class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="btn btn-danger btn-xs" 
                                                            onclick="return confirm('Are you sure?')">
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