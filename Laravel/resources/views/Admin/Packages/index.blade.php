@extends('layouts.admin')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 60vh;">
    <div class="table-responsive" style="max-width: 700px; margin: 0 auto;">
        <style>
            table.small-table th, table.small-table td {
                padding: 0.3rem 1.2rem 0.3rem 0.5rem !important;
                font-size: 0.85rem !important;
            }
            table.small-table th {
                background: #343a40;
                color: #fff;
            }
            table.small-table tr:nth-child(even) td {
                background: #f8f9fa;
            }
        </style>
        <table class="table table-sm table-hover small-table mb-0">
        <h2>Packages</h2>
            <thead>
                <tr>
                    <th>Package Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($packages as $package)
                <tr>
                    <td>{{ $package->name }}</td>
                    <td>{{ $package->description }}</td>
                    <td>{{ $package->price }}</td>
                    <td>
                        <!-- Add edit/delete buttons here -->
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection