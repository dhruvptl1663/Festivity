@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Booking Confirmation') }}</div>

                <div class="card-body">
                    <h4>Thank you for your booking!</h4>
                    <p>Your booking ID is: {{ $booking->booking_id }}</p>
                    <p>Total Amount: ₹{{ number_format($booking->total_amount, 2) }}</p>
                    @if($booking->discount_amount > 0)
                        <p>Discount Applied: ₹{{ number_format($booking->discount_amount, 2) }}</p>
                    @endif

                    <h5>Items Booked:</h5>
                    <ul>
                        @foreach($booking->events as $event)
                            <li>Event: {{ $event->title }}</li>
                        @endforeach
                        @foreach($booking->packages as $package)
                            <li>Package: {{ $package->name }}</li>
                        @endforeach
                    </ul>

                    <a href="{{ route('home') }}" class="btn btn-primary">Return to Home</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection