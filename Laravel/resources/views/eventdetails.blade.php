@include('components.header')

<div style="width: 100%; margin-top: 80px; height: 607.5px; position: relative; overflow: hidden">
    <img
        style="width: 450px; height: 450px; left: 85.31px; top: 66.94px; position: absolute; border-radius: 28.13px"
        src="{{ asset('storage/' . $event->image) }}"
        alt="Royal Wedding Setup Image"
    />

    <div class="rating-badge">
        <svg class="rating-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
        </svg>
        <span style="margin-right: 5px">{{ $event->rating }}</span>
    </div>

    <div style="left: 668.63px; top: 144px; position: absolute; color: gray; font-size: 16px; font-family: Inter; font-weight: 500; line-height: 29.53px; word-wrap: break-word">
        {{ $event->rating_count }} Ratings & Reviews
    </div>

    <div style="left: 577.5px; top: 78.75px; position: absolute; color: black; font-size: 36px; font-family: Inter; font-weight: 600; line-height: 54px; word-wrap: break-word">
        {{ $event->title }}
    </div>

    <div style="left: 577.5px; top: 190.13px; position: absolute; color: black; font-size: 28.13px; font-family: Inter; font-weight: 500; line-height: 42.19px; word-wrap: break-word">
        ₹ {{ $event->price}}
    </div>

    <div style="left: 702.38px; margin-left: 40px; top: 196.31px; position: absolute; color: lightgray; font-size: 18px; font-family: Inter; font-weight: 500; text-decoration: line-through; line-height: 29.53px; word-wrap: break-word">
        ₹ {{ $event->price + 1000}}
    </div>

    <div style="
        max-width: calc(100% - 615px);
        left: 577.5px;
        top: 269.44px;
        position: absolute;
        color: #838383;
        font-size: 15.75px;
        font-family: Inter;
        font-weight: 500;
        line-height: 23.63px;
        word-wrap: break-word;
        padding-right: 37.5px;
        box-sizing: border-box;">
        {{ $event->description }}
    </div>

    <div style="position: absolute; top: 459.56px; right: 37.5px; display: flex; align-items: center; gap: 15px;">
        <div style="width: 28.13px; height: 25.51px; margin-right: 15px">
            <img
                id="bookmark-icon"
                src="{{ auth()->check() && $isBookmarked ? asset('assets/images/Icons/like_red.png') : asset('assets/images/Icons/like_gray.png') }}"
                alt="Like Icon"
                style="cursor: pointer; transition: transform 0.3s ease;"
                onmouseover="this.style.transform='scale(1.2)'"
                onmouseout="this.style.transform='scale(1)'"
                data-event-id="{{ $event->event_id }}"
                data-is-bookmarked="{{ $isBookmarked ? 'true' : 'false' }}"
                onclick="toggleBookmark(this)"
            >
        </div>

        <div style="width: 28.13px; height: 28.55px; margin-right: 15px">
            <img
                src="{{ asset('assets/images/Icons/cart_gray.png') }}"
                alt="Cart Icon"
                style="cursor: pointer; transition: transform 0.3s ease;"
                onmouseover="this.style.transform='scale(1.2)'"
                onmouseout="this.style.transform='scale(1)'"
                data-event-id="{{ $event->event_id }}"
                onclick="addToCart(this)"
            >
        </div>

        <button style="
            width: 300.56px;
            height: 57.38px;
            background: #DBFFDE;
            border: 1px solid #D9D9D9;
            border-radius: 28.13px;
            font-size: 22.5px;
            font-family: Inter, sans-serif;
            font-weight: 500;
            line-height: 40.5px;
            color: black;
            cursor: pointer;
        ">
            Book Now
        </button>
    </div>
</div>

<div style=" border-top: 1px solid #dee2e6; background: #f9fafb; border-radius: 24px 24px 0 0;">

    <div style=" padding: 48px">
        <h2 style="font-size: 24px; font-weight: 700;  margin: 0 10px; font-family: 'Inter', sans-serif;">Reviews & Ratings</h2>

        @if($event->feedback->count() > 0)
            @foreach($event->feedback as $feedback)
                <div style="
                    background: #ffffff;
                    border-radius: 16px;
                    padding: 24px;
                    margin-bottom: 24px;
                    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
                    display: flex;
                    gap: 16px;
                    align-items: flex-start;
                    transition: transform 0.2s ease;
                "
                onmouseover="this.style.transform='translateY(-4px)'"
                onmouseout="this.style.transform='translateY(0)'"
                >
                    <div style="
                        width: 56px;
                        height: 56px;
                        border-radius: 50%;
                        background: linear-gradient(135deg, #e0e0e0, #f8f8f8);
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        font-size: 20px;
                        color: #495057;
                        font-weight: 600;
                    ">
                        {{ strtoupper(substr($feedback->user->name, 0, 1)) }}
                    </div>

                    <div style="flex: 1;">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span style="font-weight: 600; font-size: 16px; color: #212529; font-family: 'Inter', sans-serif;">
                                {{ $feedback->user->name }}
                            </span>
                            <div style="display: flex; gap: 2px;">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg style="width: 18px; height: 18px; fill: {{ $i <= $feedback->rating ? '#FFC107' : '#E4E5E9' }}" viewBox="0 0 24 24">
                                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                                    </svg>
                                @endfor
                            </div>
                        </div>

                        <p style="margin-top: 10px; color: #495057; font-size: 15px; font-family: 'Inter', sans-serif; line-height: 1.5;">
                            {{ $feedback->comment }}
                        </p>
                        <div style="font-size: 12px; color: #868e96; margin-top: 8px; font-family: 'Inter', sans-serif;">
                            {{ $feedback->created_at->diffForHumans() }}
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div style="text-align: center; padding: 40px; background: #F8F9FA; border-radius: 12px; font-family: 'Inter', sans-serif;">
                <p style="color: #6C757D">No reviews yet</p>
            </div>
        @endif
    </div>
</div>

<div id="customAlert" class="custom-alert">
    <svg class="alert-icon" viewBox="0 0 24 24">
        <path fill="currentColor" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
    </svg>
    <span id="alertMessage"></span>
</div>

<x-footer />

<style>
    .rating-badge {
        left: 577.5px;
        top: 144px;
        position: absolute;
        display: flex;
        align-items: center;
        gap: 5px;
        color: black;
        background: #DBFFDE;
        border-radius: 28.13px;
        padding: 6px 12px;
        font-size: 16px;
        font-weight: 600;
        font-family: Inter, sans-serif;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .rating-icon {
        width: 16px;
        height: 16px;
        fill: black;
        filter: drop-shadow(0 1px 1px rgba(0, 0, 0, 0.1));
    }

    .rating-badge:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
    }

    .custom-alert {
        position: fixed;
        bottom: 30px;
        right: 30px;
        padding: 16px 24px;
        border-radius: 12px;
        font-family: 'Inter', sans-serif;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
        opacity: 0;
        transform: translateY(100%);
        transition: opacity 0.3s cubic-bezier(0.4, 0, 0.2, 1), transform 0.3s cubic-bezier(0.4, 0, 0.2, 1); /* Separate transitions */
        z-index: 1000;
        max-width: 400px;
        visibility: hidden; 
    }

    .custom-alert.show {
        opacity: 1;
        transform: translateY(0);
        visibility: visible; 
    }

    .custom-alert.success {
        background: #4CAF50; 
        color: white;
    }

    .custom-alert.error {
        background: #F44336; 
        color: white;
    }

    .alert-icon {
        width: 24px;
        height: 24px;
        flex-shrink: 0;
    }

    #alertMessage {
        line-height: 1.4;
    }
</style>

<script>
let alertTimeoutId = null;

function showAlert(message, isSuccess) {
    const alert = document.getElementById('customAlert');
    const alertMessage = document.getElementById('alertMessage');

    
    if (alertTimeoutId) {
        clearTimeout(alertTimeoutId);
    }

    alert.className = `custom-alert ${isSuccess ? 'success' : 'error'}`;

    alertMessage.textContent = message;
    void alert.offsetWidth;

    alert.classList.add('show');

    // Automatically hide the alert after 3 seconds
    alertTimeoutId = setTimeout(() => {
        alert.classList.remove('show');
        alertTimeoutId = null;
    }, 3000);
}

function toggleBookmark(icon) {
    if (!{{ auth()->check() ? 'true' : 'false' }}) {
        window.location.href = "{{ route('login') }}";
        return;
    }

    const eventId = icon.dataset.eventId;
    if (!eventId) {
        console.error('Event ID not found on the icon element.');
        showAlert('Action failed: Missing event identifier.', false);
        return;
    }

    fetch("{{ route('bookmarks.toggle') }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ event_id: eventId })
    })
    .then(response => {
        if (!response.ok) {
            return response.json().then(data => {
                throw new Error(data.message || 'An unexpected server error occurred.');
            });
        }
        return response.json();
    })
    .then(data => {
        if (data.is_bookmarked !== undefined && data.message) {
            icon.src = data.is_bookmarked
                ? "{{ asset('assets/images/Icons/like_red.png') }}"
                : "{{ asset('assets/images/Icons/like_gray.png') }}";
            icon.dataset.isBookmarked = data.is_bookmarked;
            showAlert(data.message, data.is_bookmarked);
        } else {
            console.error('Invalid response format received:', data);
            throw new Error('Received an invalid response from the server.');
        }
    })
    .catch(error => {
        console.error('Bookmark toggle error:', error);
        showAlert(error.message || 'Failed to update bookmark. Please try again later.', false);
    });
}

// Cart functionality
function addToCart(cartIcon) {
    const eventId = cartIcon.dataset.eventId;
    
    if (!eventId) {
        console.error('Event ID not found on the cart icon element.');
        showAlert('Action failed: Missing event identifier.', false);
        return;
    }

    // Get existing cart items from cookie
    let cart = getCartItems();
    
    // Check if item is already in cart
    const existingItem = cart.find(item => item.event_id === eventId);
    
    if (existingItem) {
        // Remove from cart
        cart = cart.filter(item => item.event_id !== eventId);
        cartIcon.src = "{{ asset('assets/images/Icons/cart_gray.png') }}";
        showAlert('Removed from cart', false);
    } else {
        // Add to cart
        cart.push({
            event_id: eventId,
            event_title: "{{ $event->title }}",
            event_price: "{{ $event->price }}"
        });
        cartIcon.src = "{{ asset('assets/images/Icons/cart_fill.png') }}";
        showAlert('Added to cart', true);
    }

    // Save updated cart to cookie
    saveCartItems(cart);
}

// Get cart items from cookie
function getCartItems() {
    const cartString = document.cookie.replace(/(?:(?:^|.*;)\s*cart\s*\=\s*([^;]*).*$)|^.*$/, "$1");
    return cartString ? JSON.parse(decodeURIComponent(cartString)) : [];
}

// Save cart items to cookie
function saveCartItems(cart) {
    const cartString = encodeURIComponent(JSON.stringify(cart));
    document.cookie = `cart=${cartString}; path=/; max-age=31536000`; // Cookie expires in 1 year
}

// Check if item is in cart
function isItemInCart(eventId) {
    const cart = getCartItems();
    return cart.some(item => item.event_id === eventId);
}

// Initialize cart icon state when page loads
document.addEventListener('DOMContentLoaded', () => {
    const cartIcon = document.querySelector('img[src*="cart"]');
    if (cartIcon) {
        const eventId = cartIcon.dataset.eventId;
        if (eventId && isItemInCart(eventId)) {
            cartIcon.src = "{{ asset('assets/images/Icons/cart_fill.png') }}";
        }
    }
});
</script>