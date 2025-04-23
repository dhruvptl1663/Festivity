@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Checkout') }}</div>

                <div class="card-body">
                    <form id="paymentForm">
                        <input type="hidden" id="amount" value="{{ $amount }}">
                        <input type="hidden" id="promo_code" value="{{ $promo_code ?? '' }}">
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Proceed to Payment</button>
                        </div>
                    </form>

                    <div id="paymentError" class="alert alert-danger d-none"></div>
                    <div id="paymentSuccess" class="alert alert-success d-none"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
document.getElementById('paymentForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Get form values
    const amount = parseFloat(document.getElementById('amount').value);
    const promoCode = document.getElementById('promo_code').value;
    
    // Make API call to get Razorpay order
    fetch('/payment/initiate', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
            amount: amount,
            promo_code: promoCode
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            // Initialize Razorpay payment
            var options = {
                key: data.key,
                amount: data.amount,
                currency: data.currency,
                name: data.name,
                description: 'Festivity Booking',
                order_id: data.order_id,
                handler: function (response) {
                    // Verify payment
                    fetch('/payment/verify', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            razorpay_payment_id: response.razorpay_payment_id,
                            razorpay_order_id: response.razorpay_order_id,
                            razorpay_signature: response.razorpay_signature,
                            amount: amount,
                            discount_amount: data.discount_amount
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            document.getElementById('paymentSuccess').classList.remove('d-none');
                            document.getElementById('paymentSuccess').textContent = data.message;
                            // Redirect to booking confirmation page
                            window.location.href = '/booking/' + data.booking_id;
                        } else {
                            document.getElementById('paymentError').classList.remove('d-none');
                            document.getElementById('paymentError').textContent = data.message;
                        }
                    });
                },
                prefill: {
                    name: '{{ Auth::user()->name }}',
                    email: '{{ Auth::user()->email }}'
                },
                theme: {
                    color: '#3399cc'
                }
            };
            var rzp1 = new Razorpay(options);
            rzp1.open();
        } else {
            document.getElementById('paymentError').classList.remove('d-none');
            document.getElementById('paymentError').textContent = data.message;
        }
    })
    .catch(error => {
        document.getElementById('paymentError').classList.remove('d-none');
        document.getElementById('paymentError').textContent = 'Error: ' + error.message;
    });
});
</script>
@endsection