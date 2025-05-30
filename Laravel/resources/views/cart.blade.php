@include('components.header')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<!-- Flatpickr for Date/Time Picker -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<!-- Cart Section -->
<div class="cart-container">
    <h2 class="cart-title">Your Events Cart <span class="cart-count">{{ $cartItems->count() }} items</span></h2>

    <!-- Cart Items Wrapper -->
    <div class="cart-items">
        @forelse($cartItems as $item)
        <div class="cart-card" data-id="{{ $item['id'] }}" data-price="{{ $item['price'] }}" onclick="handleCardClick('{{ $item['type'] }}', {{ $item['id'] }})">
        <div class="image-container">
    @if($item['type'] === 'event')
        <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" class="cart-event-image">
    @else
        <div class="package-image-slider">
            @foreach($item['images'] as $index => $image)
                <img src="{{ asset('storage/' . $image) }}" 
                     alt="{{ $item['name'] }} - Event {{ $index + 1 }}" 
                     class="cart-event-image package-slide" 
                     data-index="{{ $index }}">
            @endforeach
        </div>
    @endif
</div>
            <div class="cart-details">
                <h3 class="event-title">{{ $item['name'] }}</h3>
                <p class="event-description">{{ $item['desc'] }}</p>
                
                <!-- Event Date/Time Picker -->
                <div class="date-time-picker-container" onclick="event.stopPropagation();">
                    <label for="event_datetime_{{ $item['id'] }}" class="datetime-label">Select Date & Time:</label>
                    <input type="text" id="event_datetime_{{ $item['id'] }}" class="event-datetime-picker" 
                           placeholder="Select date and time" data-itemid="{{ $item['id'] }}" data-itemtype="{{ $item['type'] }}" required>
                </div>
            </div>
            <div class="event-meta">
                <div class="price-section">
                    <span class="event-price">₹{{ number_format($item['price'], 0, '', ',') }}</span>
                    @if($item['original_price'] > $item['price'])
                    <span class="original-price">₹{{ number_format($item['original_price'], 0, '', ',') }}</span>
                    @endif
                </div>
                <button class="remove-btn" aria-label="Remove {{ $item['name'] }}" 
                        onclick="event.stopPropagation(); deleteCartItem('{{ $item['id'] }}')">
                    <svg class="trash-icon" viewBox="0 0 24 24" focusable="false" aria-hidden="true">
                        <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/>
                    </svg>
                </button>
            </div>
        </div>
        @empty
        <div class="cart-empty">
            <p>Your cart is empty</p>
        </div>
        @endforelse
    </div>

    <!-- Actions: Promo Code & Summary -->
    <div class="cart-actions">
        <!-- Promo Code Section -->
        <div class="promo-section">
            <div class="promo-input-group">
                <svg class="gift-icon" viewBox="0 0 24 24" focusable="false" aria-hidden="true">
                    <path d="M20 6h-2.18c.11-.31.18-.65.18-1 0-1.66-1.34-3-3-3-1.05 0-1.96.54-2.5 1.35L12 4l-1.5-1.65C10.16 1.54 9.05 1 8 1 6.34 1 5 2.34 5 4c0 .35.07.69.18 1H4c-1.11 0-1.99.89-1.99 2L2 19c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V8c0-1.11-.89-2-2-2zm-5-2c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zm11 15H4v-2h16v2zm0-5H4V8h5.08L7 10.83 8.62 12 12 7.4l3.38 4.6L17 10.83 14.92 8H20v6z"/>
                </svg>
                <input type="text" class="promo-input" id="promoInput" placeholder="Enter promo code">
                <button type="button" class="promo-apply-btn" onclick="applyPromoCode()">Apply</button>
            </div>
        </div>

        <!-- Cart Summary -->
        <div class="cart-summary">
            <div class="summary-grid">
                <div class="summary-row">
                    <span>Subtotal:</span>
                    <span>₹{{ number_format($subtotal, 0, '', ',') }}</span>
                </div>
                @if($discount > 0)
                <div class="summary-row">
                    <span>Discount:</span>
                    <span class="discount">- ₹{{ number_format($discount, 0, '', ',') }}</span>
                </div>
                @endif
                <div class="summary-row total">
                    <span>Total:</span>
                    <span>₹{{ number_format($total, 0, '', ',') }}</span>
                </div>
            </div>
            <div class="checkout-btn-container">
                <button class="checkout-btn" id="checkoutBtn" type="button" data-total="{{ $total }}">
                    Proceed to Checkout
                    <svg class="arrow-icon" viewBox="0 0 24 24" focusable="false" aria-hidden="true">
                        <path d="M12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8z"/>
                    </svg>
                </button>
            </div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Set up Razorpay config data from PHP
    const cartData = {
        total: {{ Illuminate\Support\Js::from($total) }},
        userId: {{ Illuminate\Support\Js::from(Auth::id()) }},
        userName: {{ Illuminate\Support\Js::from(Auth::user()->name) }},
        userEmail: {{ Illuminate\Support\Js::from(Auth::user()->email) }},
        userPhone: {{ Illuminate\Support\Js::from(Auth::user()->phone ?? '') }}
    };
    
    // Initialize date/time pickers for all items in cart
    const datePickers = document.querySelectorAll('.event-datetime-picker');
    
    // Get tomorrow's date as the minimum selectable date
    const tomorrow = new Date();
    tomorrow.setDate(tomorrow.getDate() + 2); // At least 2 days in the future
    
    // Format min date for flatpickr
    const minDate = tomorrow.toISOString().split('T')[0];
    
    // Initialize each date picker
    datePickers.forEach(picker => {
        // Add click handler to prevent event bubbling
        picker.addEventListener('click', function(e) {
            e.stopPropagation();
        });
        
        flatpickr(picker, {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            minDate: minDate,
            maxDate: new Date().fp_incr(90), // Allow booking up to 90 days in advance
            minuteIncrement: 30,
            time_24hr: false,
            position: "auto",
            disableMobile: false,
            onChange: function(selectedDates, dateStr, instance) {
                // Store the selected date/time with the item
                instance.element.setAttribute('data-selected-datetime', dateStr);
            },
            onOpen: function(selectedDates, dateStr, instance) {
                // Add click handler to calendar to prevent event bubbling
                setTimeout(() => {
                    const calendar = document.querySelector('.flatpickr-calendar');
                    if (calendar) {
                        calendar.addEventListener('click', function(e) {
                            e.stopPropagation();
                        });
                    }
                }, 100);
            }
        });
    });
    
    // Function to validate dates and collect selections
    function validateDatesAndGetSelections() {
        const dateTimeSelections = [];
        const dateTimePickers = document.querySelectorAll('.event-datetime-picker');
        let allDatesSelected = true;
        
        dateTimePickers.forEach(picker => {
            const itemId = picker.getAttribute('data-itemid');
            const itemType = picker.getAttribute('data-itemtype');
            const selectedDateTime = picker.getAttribute('data-selected-datetime');
            
            if (!selectedDateTime) {
                allDatesSelected = false;
                picker.classList.add('error-highlight');
            } else {
                picker.classList.remove('error-highlight');
                dateTimeSelections.push({
                    id: itemId,
                    type: itemType,
                    datetime: selectedDateTime
                });
            }
        });
        
        return {
            valid: allDatesSelected,
            selections: dateTimeSelections
        };
    }
    
    // Handle checkout button click
    const checkoutBtn = document.getElementById('checkoutBtn');
    
    // Remove any existing event listeners to prevent duplicates
    const newBtn = checkoutBtn.cloneNode(true);
    checkoutBtn.parentNode.replaceChild(newBtn, checkoutBtn);
    
    // Add new click handler
    newBtn.addEventListener('click', async function(e) {
        // Prevent any default behavior
        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation();
        
        // Prevent multiple clicks while processing
        if (newBtn.disabled) return;
        newBtn.disabled = true;

        // Validate dates first
        const validation = validateDatesAndGetSelections();
        if (!validation.valid) {
            // Show error message and return immediately
            Swal.fire({
                title: 'Missing Information',
                text: 'Please select a date and time for all items in your cart',
                icon: 'warning',
                allowOutsideClick: false,
                confirmButtonText: 'OK'
            }); 0
            return;
        }

        // Show loading state
        const loading = Swal.fire({
            title: 'Processing...',
            text: 'Please wait while we prepare your payment',
            allowOutsideClick: false,
            showConfirmButton: false,
            willOpen: () => {
                Swal.showLoading();
            }
        });

        try {
            // Get promo code if applied
            const promoInput = document.getElementById('promoInput');
            const promoCode = promoInput ? promoInput.value : '';

            // Get CSRF token from meta tag
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            // Store the selected date/time information with each item
            const dateTimeSelections = validation.selections;
            
            // Prepare data for Razorpay
            const paymentInitiationResponse = await fetch('/payment/initiate', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    amount: cartData.total,
                    promo_code: promoCode,
                    date_time_selections: dateTimeSelections
                })
            });

            // Parse payment initiation response
            const paymentData = await paymentInitiationResponse.json();
            
            // Close loading dialog
            loading.close();
            
            // Re-enable the button after processing
            newBtn.disabled = false;

            if (paymentData.status !== 'success') {
                throw new Error(paymentData.message || 'Failed to initiate payment');
            }

            console.log('Payment data received:', paymentData);  

            // Open Razorpay payment form
            const options = {
                key: paymentData.key,
                amount: paymentData.amount,
                currency: paymentData.currency,
                name: 'Festivity',
                description: 'Event & Package Booking',
                order_id: paymentData.order_id,
                handler: async function (response) {
                    // Show processing payment message
                    const processingPayment = Swal.fire({
                        title: 'Processing Payment...',
                        text: 'Please wait while we confirm your payment',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        willOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    try {
                        // Verify payment with our server
                        const verifyResponse = await fetch('/payment/verify', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                razorpay_payment_id: response.razorpay_payment_id,
                                razorpay_order_id: response.razorpay_order_id,
                                razorpay_signature: response.razorpay_signature,
                                amount: paymentData.amount / 100, // Convert back from paise to rupees
                                promo_code: promoCode,
                                discount_amount: paymentData.discount_amount || 0,
                                date_time_selections: dateTimeSelections
                            })
                        });

                        const verifyData = await verifyResponse.json();
                        
                        // Close processing payment dialog
                        processingPayment.close();

                        if (verifyData.status === 'success') {
                            console.log('Payment verification successful', verifyData);  

                            // Payment verified successfully - redirect to the congratulations page
                            if (verifyData.redirect) {
                                window.location.href = verifyData.redirect;
                            } else {
                                // Fallback to orders page if no redirect URL is provided
                                window.location.href = '{{ route('orders') }}';
                            }
                        } else {
                            throw new Error(verifyData.message || 'Payment verification failed');
                        }
                    } catch (error) {
                        console.error('Payment verification error:', error);
                        processingPayment.close();
                        
                        Swal.fire({
                            title: 'Payment Verification Failed',
                            text: error.message || 'There was a problem verifying your payment. Please contact support.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                },
                prefill: {
                    name: cartData.userName,
                    email: cartData.userEmail,
                    contact: cartData.userPhone
                },
                theme: {
                    color: '#2962FF'
                },
                modal: {
                    ondismiss: function() {
                        Swal.fire({
                            title: 'Payment Cancelled',
                            text: 'You have cancelled the payment. Your booking is not confirmed.',
                            icon: 'info',
                            confirmButtonText: 'OK'
                        });
                    }
                }
            };

            console.log('Initializing Razorpay with options:', options);  

            const razorpayPayment = new Razorpay(options);
            
            // Delay opening the payment modal slightly to ensure it works properly
            setTimeout(() => {
                razorpayPayment.open();
            }, 100);   
            
        } catch (error) {
            console.error('Error:', error);
            // Close loading dialog and re-enable button
            if (typeof loading.close === 'function') {
                loading.close();
            }
            if (newBtn) {
                newBtn.disabled = false;
            }
            
            // Show error message
            Swal.fire({
                title: 'Error',
                text: error.message || 'An error occurred during checkout. Please try again.',
                icon: 'error',
                allowOutsideClick: false,
                confirmButtonText: 'OK'
            });
        }
    });
});
</script>
        </div>
    </div>
</div>

<style>
    *, *::before, *::after {
        box-sizing: border-box;
    }
    
    /* Date Time Picker Styles */
    .date-time-picker-container {
        margin-top: 15px;
        background: #f8f9fa;
        padding: 10px 15px;
        border-radius: 8px;
        border-left: 3px solid var(--primary-blue);
    }
    
    .datetime-label {
        display: block;
        font-size: 14px;
        font-weight: 500;
        margin-bottom: 5px;
        color: #555;
    }
    
    .event-datetime-picker {
        width: 100%;
        padding: 10px 12px;
        border-radius: 6px;
        border: 1px solid #ddd;
        font-size: 14px;
        background-color: white;
        transition: all 0.2s ease;
        cursor: pointer;
    }
    
    .event-datetime-picker:focus {
        border-color: var(--primary-blue);
        box-shadow: 0 0 0 2px rgba(41, 98, 255, 0.1);
        outline: none;
    }
    
    /* Flatpickr Calendar Customization */
    .flatpickr-calendar {
        border-radius: 10px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        border: none;
    }
    
    .flatpickr-day.selected {
        background: var(--primary-blue);
        border-color: var(--primary-blue);
    }
    
    .flatpickr-day:hover {
        background: rgba(41, 98, 255, 0.1);
    }

    :root {
        margin-top: 60px;
        --primary-green: #00C853;
        --primary-blue: #2962FF;
        --error-red: #FF5252;
        --text-dark: #2D3748;
        --text-light: #718096;
        --border-color: #E2E8F0;
        --background-light: #F8FAFC;
        --font-family-base: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
    }

    .package-image-slider {
    position: relative;
    width: 100%;
    height: 100%;
}

.package-slide {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    transition: opacity 0.5s ease-in-out;
}

.package-slide.active {
    opacity: 1;
}

    body {
       font-family: var(--font-family-base);
       line-height: 1.6;
       color: var(--text-dark);
       margin: 0;
    }

    .cart-container {
        max-width: 1200px;
        width: 100%;
        margin-left: auto;
        margin-right: auto;
        padding: 0 20px;
        margin-top: 40px;
        margin-bottom: 60px;
    }

    .cart-title {
        font-size: clamp(24px, 5vw, 32px);
        font-weight: 700;
        margin-bottom: 40px;
        color: var(--text-dark);
        display: flex;
        align-items: baseline;
        gap: 12px;
        flex-wrap: wrap;
    }

    .cart-count {
        font-size: 16px;
        color: var(--text-light);
        font-weight: 500;
        white-space: nowrap;
    }

    .cart-items {
         display: flex;
         flex-direction: column;
         gap: 25px;
    }

    .cart-card {
        display: grid;
        grid-template-columns: 150px 1fr auto;
        gap: 20px 25px;
        align-items: center;
        background: #ffffff;
        border-radius: 16px;
        padding: 20px;
        border: 1px solid var(--border-color);
        transition: box-shadow 0.3s ease, transform 0.3s ease;
        overflow: hidden;
        cursor: pointer;
    }

    .cart-card:hover {
        box-shadow: 0 8px 25px -5px rgba(0, 0, 0, 0.1), 0 4px 15px -6px rgba(0, 0, 0, 0.07);
        transform: translateY(-3px);
    }

    .image-container {
        position: relative;
        width: 150px;
        height: 120px;
        border-radius: 12px;
        overflow: hidden;
        grid-column: 1 / 2;
    }

    .cart-event-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .availability-tag {
        position: absolute;
        bottom: 10px;
        left: 10px;
        background: rgba(255, 255, 255, 0.95);
        padding: 5px 14px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        color: var(--primary-green);
        backdrop-filter: blur(3px);
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .availability-tag.limited {
        color: #f59e0b;
    }

    .cart-details {
        display: flex;
        flex-direction: column;
        gap: 6px;
        grid-column: 2 / 3;
    }

    .event-title {
        font-size: 18px;
        font-weight: 600;
        color: var(--text-dark);
        line-height: 1.4;
    }

    .event-location {
        font-size: 14px;
        color: var(--text-light);
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .event-meta {
         grid-column: 3 / 4;
         display: flex;
         flex-direction: column;
         align-items: flex-end;
         gap: 15px;
         justify-self: end;
    }

    .price-section {
        display: flex;
        align-items: baseline;
        gap: 8px;
        flex-wrap: wrap;
        justify-content: flex-end;
    }

    .event-price {
        font-size: 18px;
        font-weight: 700;
        color: var(--primary-green);
        white-space: nowrap;
    }

    .original-price {
        font-size: 14px;
        color: var(--text-light);
        text-decoration: line-through;
        white-space: nowrap;
    }

    .remove-btn {
        background: transparent;
        border: none;
        padding: 8px;
        cursor: pointer;
        transition: background-color 0.2s ease, transform 0.1s ease;
        border-radius: 8px;
        line-height: 0;
    }

    .remove-btn:hover {
        background-color: #FEE2E2;
    }
    .remove-btn:active {
        transform: scale(0.95);
    }

    .trash-icon {
        width: 22px;
        height: 22px;
        fill: var(--error-red);
    }

    /* Actions: Promo Code & Summary */
    .cart-actions {
        margin-top: 40px;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(min(100%, 320px), 1fr));
        gap: 30px;
        align-items: start;
    }

    .promo-section {
    }

    .promo-input-group {
        display: flex;
        align-items: center;
        gap: 10px;
        background: white;
        border-radius: 12px;
        padding: 6px 6px 6px 16px;
        border: 1px solid var(--border-color);
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .promo-input-group:focus-within {
        border-color: var(--primary-blue);
        box-shadow: 0 0 0 3px rgba(41, 98, 255, 0.15);
    }

    .gift-icon {
        width: 24px;
        height: 24px;
        fill: var(--primary-blue);
        flex-shrink: 0;
    }

    .promo-input {
        flex-grow: 1;
        border: none;
        padding: 12px 0;
        font-family: inherit;
        font-size: 14px;
        color: var(--text-dark);
        min-width: 80px;
        background: transparent;
    }

    .promo-input::placeholder {
        color: var(--text-light);
        opacity: 0.8;
    }

    .promo-input:focus {
        outline: none;
    }

    .promo-apply-btn {
        background: var(--primary-blue);
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 8px;
        font-family: inherit;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: background-color 0.2s ease, transform 0.1s ease;
        white-space: nowrap;
        flex-shrink: 0;
    }

    .promo-apply-btn:hover {
        background: #1C4FCC;
    }
     .promo-apply-btn:active {
         transform: scale(0.98);
     }

    .cart-summary {
        background: #ffffff;
        border: 1px solid var(--border-color);
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }

    .summary-grid {
        display: grid;
        gap: 18px;
        margin-bottom: 28px;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 16px;
        color: var(--text-dark);
    }

    .summary-row span:first-child {
        color: var(--text-light);
    }
    .summary-row span:last-child {
        font-weight: 500;
    }

    .summary-row.total {
        font-size: 18px;
        font-weight: 600;
        padding-top: 20px;
        margin-top: 4px;
        border-top: 1px dashed var(--border-color);
    }

     .summary-row.total span:first-child {
         color: var(--text-dark);
         font-weight: 600;
     }
     .summary-row.total span:last-child {
         font-weight: 700;
         font-size: 20px;
     }

    .discount {
        color: var(--primary-green) !important;
        font-weight: 600 !important;
    }

    .checkout-btn {
        width: 100%;
        padding: 16px;
        background: var(--primary-green);
        color: white;
        border: none;
        border-radius: 12px;
        font-family: inherit;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        transition: background-color 0.2s ease, transform 0.1s ease, box-shadow 0.2s ease;
        box-shadow: 0 4px 10px rgba(0, 200, 83, 0.2);
    }

    .checkout-btn:hover {
        background: #00B34A;
        box-shadow: 0 6px 15px rgba(0, 200, 83, 0.3);
    }
    .checkout-btn:active {
        transform: scale(0.98);
        box-shadow: 0 2px 5px rgba(0, 200, 83, 0.2);
    }

    .arrow-icon {
        width: 20px;
        height: 20px;
        fill: white;
        transition: transform 0.2s ease;
    }
    .checkout-btn:hover .arrow-icon {
        transform: translateX(3px);
    }

    /* --- RESPONSIVE ADJUSTMENTS --- */

    @media (max-width: 768px) {
         .cart-container {
             padding: 0 15px;
             margin-top: 30px;
             margin-bottom: 40px;
         }
         .cart-title {
             margin-bottom: 30px;
         }
         .cart-items {
             gap: 20px;
         }
        .cart-card {
            grid-template-columns: 100px 1fr; 
            grid-template-rows: auto auto; 
            gap: 15px;
            padding: 15px;
            align-items: start; 
        }

         .image-container {
             width: 100px;
             height: 100px;
             grid-row: 1 / 3; 
             grid-column: 1 / 2;
             align-self: center; 
         }

         .cart-details {
            grid-column: 2 / 3; 
            grid-row: 1 / 2;
            gap: 4px;
         }

         .event-meta {
             grid-column: 2 / 3; 
             grid-row: 2 / 3;
             flex-direction: row; 
             justify-content: space-between;
             align-items: center;
             gap: 10px;
             margin-top: 10px; 
             width: 100%; 
             justify-self: start; 
             align-items: center; 
         }
         .price-section {
             justify-content: flex-start; 
         }
         .remove-btn {
            padding: 6px; 
         }
         .trash-icon {
            width: 20px;
            height: 20px;
         }
         .event-price { font-size: 17px; }
         .original-price { font-size: 13px; }

        .cart-actions {
             margin-top: 30px;
             gap: 25px;
        }
        .promo-input-group {
             padding: 4px 4px 4px 12px;
        }
        .promo-apply-btn {
             padding: 10px 20px;
        }
        .cart-summary { padding: 25px; }
        .checkout-btn { padding: 14px; font-size: 15px;}
    }

     @media (max-width: 480px) {
          .cart-title { font-size: 22px; gap: 8px; margin-bottom: 25px; }
          .cart-count { font-size: 14px; }
         .cart-card {
             grid-template-columns: 1fr; 
             grid-template-rows: auto; 
             gap: 12px;
         }
          .image-container {
             width: 100%;
             height: 180px; 
             grid-row: auto; 
             grid-column: auto; 
             align-self: auto;
         }
         .availability-tag {
             bottom: 8px; left: 8px; padding: 4px 10px; font-size: 11px;
         }
          .cart-details {
             grid-column: auto;
             grid-row: auto;
             margin-top: 5px; 
             gap: 2px;
         }
         .event-title { font-size: 16px; }
         .event-location { font-size: 13px; }
         .event-meta {
             grid-column: auto;
             grid-row: auto;
             flex-direction: column; 
             align-items: flex-start;
             gap: 8px;
             margin-top: 8px;
         }
          .remove-btn {
             align-self: flex-end; 
             margin-top: 0; 
             padding: 8px; 
         }

        /* Adjust promo input for very small screens if needed */
         .promo-input-group {
            flex-wrap: wrap; 
            padding: 10px 10px 10px 15px;
         }
         .promo-apply-btn {
            flex-grow: 1; 
            margin-top: 5px; 
         }

         .cart-summary { padding: 20px; }
         .summary-grid { gap: 15px; margin-bottom: 20px;}
         .summary-row { font-size: 15px; }
         .summary-row.total { font-size: 17px; padding-top: 15px; }
         .summary-row.total span:last-child { font-size: 18px; }
         .checkout-btn { padding: 12px; font-size: 14px; gap: 8px;}
         .arrow-icon { width: 18px; height: 18px; }
     }
</style>

<script>
function updateCartCount() {
    fetch('/cart/count', {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(response => response.json())
    .then(data => {
        const cartBadge = document.querySelector('.cart-badge');
        if (cartBadge) {
            cartBadge.textContent = data.count;
        }
    });
}

function removeFromCart(type, id) {
    fetch('/cart/toggle', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
            [type === 'event' ? 'event_id' : 'package_id']: id
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'removed') {
            // Remove the item from the DOM
            const item = document.querySelector(`[data-id="${id}"]`);
            if (item) {
                item.remove();
            }
            // Update the cart count
            updateCartCount();
        }
    });
}

// Add event listener for cart toggle
function handleCartToggle(type, id) {
    fetch('/cart/toggle', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
            [type === 'event' ? 'event_id' : 'package_id']: id
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'added') {
            // Update the cart count
            updateCartCount();
        }
    });
}

function handleCardClick(type, id) {
    event.stopPropagation(); // Prevent event bubbling
    
    if (type === 'event') {
        window.location.href = `/eventdetails/${id}`;
    } else if (type === 'package') {
        window.location.href = `/packagedetails/${id}`;
    }
}

// Initialize package image sliders
function initializeSliders() {
    const sliders = document.querySelectorAll('.package-image-slider');
    
    sliders.forEach(slider => {
        const slides = slider.querySelectorAll('.package-slide');
        let currentSlide = 0;
        
        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.classList.remove('active');
                if (i === index) {
                    slide.classList.add('active');
                }
            });
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        }

        // Start the slideshow
        showSlide(currentSlide);
        setInterval(nextSlide, 2000); // Changed to 1.5 seconds
    });
}

// Initialize sliders when page loads
window.addEventListener('load', initializeSliders);

function deleteCartItem(id) {
    Swal.fire({
        title: 'Remove Item?',
        text: 'Are you sure you want to remove this item from your cart?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, remove it',
        cancelButtonText: 'Cancel',
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`/cart/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const cartCard = document.querySelector(`[data-id="${id}"]`);
                    if (cartCard) cartCard.remove();

                    const cartCount = document.querySelector('.cart-count');
                    if (cartCount) {
                        const currentCount = parseInt(cartCount.textContent.match(/\d+/)[0]);
                        cartCount.textContent = `${currentCount - 1} items`;
                    }

                    updateCartTotals();

                    Swal.fire({
                        title: 'Removed!',
                        text: 'Item removed from cart.',
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false
                    });
                } else {
                    Swal.fire('Error', data.message || 'Failed to remove item from cart', 'error');
                }
            })
            .catch(error => {
                console.error('Error deleting cart item:', error);
                Swal.fire('Error', 'An error occurred while removing the item', 'error');
            });
        }
    });
}


function applyPromoCode() {
    console.log('Apply promo code clicked');
    const promoCode = document.getElementById('promoInput').value;
    console.log('Promo code:', promoCode);
    
    const subtotalElement = document.querySelector('.summary-row span:nth-child(2)');
    console.log('Subtotal element:', subtotalElement);
    
    const subtotal = parseFloat(subtotalElement.textContent.replace('₹', '').replace(/,/g, ''));
    console.log('Parsed subtotal:', subtotal);

    fetch('/promo-code/apply', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
            code: promoCode,
            cart_total: subtotal
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            // Update the discount and total in the cart summary
            const summaryGrid = document.querySelector('.summary-grid');
            const totalRow = document.querySelector('.summary-row.total');
            
            // Remove existing discount row if any
            const existingDiscountRow = document.querySelector('.summary-row .discount')?.closest('.summary-row');
            if (existingDiscountRow) {
                existingDiscountRow.remove();
            }

            // Add new discount row
            const discountRow = document.createElement('div');
            discountRow.className = 'summary-row';
            discountRow.innerHTML = `
                <span>Promo Discount:</span>
                <span class="discount">- ₹${data.discount.toLocaleString()}</span>
            `;
            summaryGrid.insertBefore(discountRow, totalRow);

            // Update total
            const newTotal = subtotal - data.discount;
            totalRow.querySelector('span:last-child').textContent = `₹${newTotal.toLocaleString()}`;

            // Show success message
            Swal.fire({
                title: 'Success!',
                text: data.message,
                icon: 'success',
                timer: 2000,
                showConfirmButton: false
            });
        } else {
            Swal.fire({
                title: 'Error!',
                text: data.message,
                icon: 'error'
            });
        }
    })
    .catch(error => {
        console.error('Error applying promo code:', error);
        Swal.fire({
            title: 'Error!',
            text: 'Failed to apply promo code. Please try again.',
            icon: 'error'
        });
    });
}

function updateCartTotals() {
    const cartItems = document.querySelectorAll('.cart-card');
    if (cartItems.length === 0) {
        // Show empty cart message
        const emptyMessage = document.querySelector('.empty-cart');
        if (!emptyMessage) {
            const cartItemsContainer = document.querySelector('.cart-items');
            const message = document.createElement('p');
            message.className = 'empty-cart';
            message.textContent = 'Your cart is empty';
            cartItemsContainer.appendChild(message);
        }
    }

    // Update the subtotal and total
    const subtotalElement = document.querySelector('.summary-row span:nth-child(2)');
    const totalElement = document.querySelector('.summary-row.total span:nth-child(2)');
    if (subtotalElement && totalElement) {
        const subtotal = Array.from(cartItems)
            .reduce((sum, item) => {
                const price = parseFloat(item.dataset.price || 0);
                return sum + price;
            }, 0);

        subtotalElement.textContent = `₹${subtotal.toLocaleString()}`;
        totalElement.textContent = `₹${subtotal.toLocaleString()}`;
    }
}

document.querySelector('.checkout-btn').addEventListener('click', async function() {
    try {
        // Get total amount from the total element
        const totalElement = document.querySelector('.summary-row.total span:last-child');
        if (!totalElement) {
            throw new Error('Total amount not found');
        }
        
        const total = totalElement.textContent.replace('₹', '').replace(',', '');
        if (!total || total <= 0) {
            throw new Error('Invalid total amount');
        }

        // Redirect to congratulations page
        window.location.href = '/congratulations';
    } catch (error) {
        console.error('Checkout error:', error);
        await Swal.fire({
            title: 'Error!',
            text: error.message || 'Failed to proceed with checkout',
            icon: 'error'
        });
    }
});
</script>

<x-footer />