@include('components.header')

<!-- Main Package Details Container (Reduced Scope) -->
<div style="width: 100%; margin-top: 80px; min-height: 520px; /* Adjust min-height if needed, removed fixed height */ position: relative; /* Removed overflow: hidden */ padding-bottom: 80px; /* Add padding if buttons get too close to the edge */">
    <!-- Package Image Slider -->
    <div class="swiper package-swiper" style="width: 450px; height: 450px; left: 85.31px; top: 66.94px; position: absolute; border-radius: 28.13px">
        <div class="swiper-wrapper">
            @foreach($package->packageEvents as $packageEvent)
                @if($packageEvent->event->image)
                    <div class="swiper-slide">
                        <img
                            style="width: 100%; height: 100%; object-fit: cover"
                            src="{{ asset('storage/' . $packageEvent->event->image) }}"
                            alt="{{ $packageEvent->event->title }}"
                        />
                    </div>
                @endif
            @endforeach
        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>

    <!-- Rating Badge -->
    <div class="rating-badge" style="
        left: 577.5px;
        top: 144px;
        position: absolute;
        display: flex;
        align-items: center;
        gap: 5px;
        font-family: Inter, sans-serif;
    ">
        <svg class="rating-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
        </svg>
        <span style="margin-right: 5px">{{ number_format($package->rating, 1) }}</span>
    </div>

    <!-- Rating Count Text -->
    <div style="
        left: 668.63px;
        top: 144px;
        position: absolute;
        color: gray;
        font-size: 16px;
        font-family: Inter;
        font-weight: 500;
        line-height: 29.53px;
        word-wrap: break-word;
    ">
        {{ $package->rating_count }} Ratings & Reviews
    </div>

    <!-- Package Title -->
    <div style="left: 577.5px; top: 78.75px; position: absolute; color: black; font-size: 36px; font-family: Inter; font-weight: 600; line-height: 54px; word-wrap: break-word">
        {{ $package->title }}
    </div>

    <!-- Package Price -->
    <div style="left: 577.5px; top: 190.13px; position: absolute; color: black; font-size: 28.13px; font-family: Inter; font-weight: 500; line-height: 42.19px; word-wrap: break-word">
        ₹ {{ number_format($package->price, 2) }}
    </div>

    <!-- Original Price (Strikethrough) -->
    <div style="left: 702.38px; margin-left: 40px; top: 196.31px; position: absolute; color: lightgray; font-size: 18px; font-family: Inter; font-weight: 500; text-decoration: line-through; line-height: 29.53px; word-wrap: break-word">
        ₹ {{ number_format($package->price + 1000, 2) }}
    </div>

    <!-- Package Description -->
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
        {{ $package->description }}
    </div>

    <!-- Decorator Information -->
    <div style="left: 577.5px; top: 360px; /* Adjusted top slightly */ position: absolute; display: flex; align-items: center; gap: 15px;">
        <div class="posts-avatar-flex">
            <div class="avatar-wrapper">
                <img width="Auto" height="Auto" alt=""
                     src="{{ asset('storage/' . $package->decorator->decorator_icon) }}"
                     loading="eager">
            </div>
            <div class="avatar-text-block">
                <h5 class="no-wrap">{{ $package->decorator->decorator_name ?? 'Unknown Decorator' }}</h5>
            </div>
        </div>
    </div>

    <!-- Action Buttons (Bookmark, Cart, Book) -->
    <div style="position: absolute; top: 459.56px; right: 37.5px; display: flex; align-items: center; gap: 15px;">
        <div style="width: 28.13px; height: 25.51px; margin-right: 15px">
            <img
                id="bookmark-icon"
                src="{{ auth()->check() && $isBookmarked ? asset('assets/images/Icons/like_red.png') : asset('assets/images/Icons/like_gray.png') }}"
                alt="Like Icon"
                style="cursor: pointer; transition: transform 0.3s ease;"
                onmouseover="this.style.transform='scale(1.2)'"
                onmouseout="this.style.transform='scale(1)'"
                data-package-id="{{ $package->package_id }}" {{-- Corrected attribute --}}
                data-is-bookmarked="{{ $isBookmarked ? 'true' : 'false' }}"
                onclick="toggleBookmark(this)">
        </div>

        <div style="width: 28.13px; height: 28.55px; margin-right: 15px">
            <img
                id="cart-icon"
                src="{{ auth()->check() && $isInCart ? asset('assets/images/Icons/cart_fill.png') : asset('assets/images/Icons/cart_gray.png') }}"
                alt="Cart Icon"
                style="cursor: pointer; transition: transform 0.3s ease;"
                onmouseover="this.style.transform='scale(1.2)'"
                onmouseout="this.style.transform='scale(1)'"
                data-package-id="{{ $package->package_id }}"
                onclick="toggleCart(this)"
            >
        </div>

        <button 
            onclick="addToCartAndRedirect({{ $package->package_id }}, 'package')"
            style="
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
            cursor: pointer;">
            Book Package
        </button>
    </div>
</div> <!-- End of Main Package Details Container -->


<!-- Included Events Section (Moved Outside and Adjusted Styling) -->
<div style="
    /* Removed absolute positioning */
    max-width: 1200px; /* Optional: constrain width */
    margin: 40px auto; /* Center section with top/bottom margin */
    padding: 24px 48px; /* Match padding with Feedback section */
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
    /* Removed z-index, left, top */
">
    <h3 style="
        font-size: 20px;
        font-weight: 600;
        color: #212529;
        margin-bottom: 20px;
        font-family: 'Inter', sans-serif;
    ">Included Events</h3>

    <div style="
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 16px;
    ">
        @foreach($package->packageEvents as $packageEvent)
            <a href="{{ route('eventdetails.show', ['id' => $packageEvent->event_id]) }}"
               style="
                text-decoration: none;
                color: inherit;
                display: flex;
                flex-direction: column;
                align-items: center;
                padding: 12px;
                border-radius: 12px;
                background: #f8f9fa;
                transition: all 0.2s ease;
                cursor: pointer;
            "
               onmouseover="this.style.transform='translateY(-2px)'"
               onmouseout="this.style.transform='translateY(0)'">
                <div style="
                    width: 80px;
                    height: 80px;
                    border-radius: 12px;
                    overflow: hidden;
                    margin-bottom: 8px;
                ">
                    <img
                        src="{{ asset('storage/' . $packageEvent->event->image) }}"
                        alt="{{ $packageEvent->event->title }}"
                        style="
                            width: 100%;
                            height: 100%;
                            object-fit: cover;
                        "
                    />
                </div>
                <h4 style="
                    font-size: 16px;
                    font-weight: 500;
                    color: #212529;
                    margin: 0 0 4px 0;
                    text-align: center;
                    font-family: 'Inter', sans-serif;
                ">
                    {{ $packageEvent->event->title }}
                </h4>
                <p style="
                    font-size: 14px;
                    color: #6c757d;
                    text-align: center;
                    margin: 0;
                    font-family: 'Inter', sans-serif;
                ">
                    {{ Str::limit($packageEvent->event->description, 50) }}
                </p>
            </a>
        @endforeach
    </div>
</div>


<!-- Feedback & Ratings Section -->
<div style="border-top: 1px solid #dee2e6; background: #f9fafb; border-radius: 24px 24px 0 0;">
    <div style="padding: 48px">
        <h2 style="font-size: 24px; font-weight: 700; margin: 0 0 24px 10px; /* Added bottom margin */ font-family: 'Inter', sans-serif;">Feedback & Ratings</h2>

        @if($package->feedback->isEmpty())
            <div style="text-align: center; padding: 40px; background: #F8F9FA; border-radius: 12px; font-family: 'Inter', sans-serif;">
                <p style="color: #6C757D">No feedback yet</p>
            </div>
        @else
            @foreach($package->feedback as $review)
                <div style="
                    background: #ffffff;
                    border-radius: 16px;
                    padding: 24px;
                    margin-bottom: 24px;
                    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
                    display: flex;
                    gap: 16px;
                    align-items: flex-start;
                    transition: transform 0.2s ease;"
                onmouseover="this.style.transform='translateY(-4px)'"
                onmouseout="this.style.transform='translateY(0)'">
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
                        font-weight: 600;">
                        {{ strtoupper(substr($review->user->name, 0, 1)) }}
                    </div>

                    <div style="flex: 1;">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span style="font-weight: 600; font-size: 16px; color: #212529; font-family: 'Inter', sans-serif;">
                                {{ $review->user->name }}
                            </span>
                            <div style="display: flex; gap: 2px;">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg style="width: 18px; height: 18px; fill: {{ $i <= $review->rating ? '#FFC107' : '#E4E5E9' }}" viewBox="0 0 24 24">
                                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                                    </svg>
                                @endfor
                            </div>
                        </div>

                        <p style="margin-top: 10px; color: #495057; font-size: 15px; font-family: 'Inter', sans-serif; line-height: 1.5;">
                            {{ $review->comment }}
                        </p>
                        <div style="font-size: 12px; color: #868e96; margin-top: 8px; font-family: 'Inter', sans-serif;">
                            {{ $review->created_at->diffForHumans() }}
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>

<!-- ADDED: Custom Alert HTML Structure -->
<div id="customAlert" class="custom-alert">
    <svg class="alert-icon" viewBox="0 0 24 24">
        <!-- Using a generic checkmark/error icon placeholder, you might want to swap this -->
        <path fill="currentColor" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
         <!-- Alternative Error Icon Path (Example) -->
        <!-- <path fill="currentColor" d="M11 15h2v2h-2v-2zm0-8h2v6h-2V7zm.99-5C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z"/> -->
    </svg>
    <span id="alertMessage"></span>
</div>

{{-- Assuming you have a footer component --}}
{{-- <x-footer /> --}}

<style>
    /* --- Swiper Styles --- */
    .swiper {
        /* position, width, height, etc. are already inline */
        /* Keep existing styles */
    }
    .swiper-button-next,
    .swiper-button-prev {
        color: #fff;
        background: rgba(0, 0, 0, 0.3);
        width: 44px;
        height: 44px;
        border-radius: 50%;
        transition: all 0.3s ease;
        z-index: 10; /* Ensure they are above images */
        opacity: 0;
    }
    .swiper:hover .swiper-button-next,
    .swiper:hover .swiper-button-prev {
        opacity: 1;
    }
    .swiper-button-next:hover,
    .swiper-button-prev:hover {
        background: rgba(0, 0, 0, 0.5);
        transform: scale(1.1);
    }
    .swiper-button-next::after,
    .swiper-button-prev::after {
        font-size: 20px;
    }
    .swiper-button-next { right: 20px; }
    .swiper-button-prev { left: 20px; }
    .swiper-pagination {
        position: absolute;
        bottom: 10px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 10; /* Ensure they are above images */
    }
    .swiper-pagination-bullet {
        width: 10px;
        height: 10px;
        background: #fff;
        opacity: 0.7;
        margin: 0 4px;
    }
    .swiper-pagination-bullet-active {
        background: var(--primary, #DBFFDE); /* Use primary color or fallback */
        opacity: 1;
    }

    /* --- Rating Badge Styles --- */
    .rating-badge {
        /* Positioned inline */
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
    .rating-badge:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    .rating-icon {
        width: 16px;
        height: 16px;
        fill: #212529; /* Changed fill to match eventdetails */
    }

    /* --- Decorator Avatar Styles --- */
    .posts-avatar-flex {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .avatar-wrapper { /* Add basic styles for wrapper if needed */
       width: 40px; /* Example size */
       height: 40px; /* Example size */
       border-radius: 50%;
       overflow: hidden;
       background-color: #eee; /* Placeholder bg */
    }
    .avatar-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .avatar-text-block h5 {
        margin: 0;
        font-size: 16px;
        font-weight: 500;
        color: #333;
    }

    /* --- General Body/Font Styles (Optional, place higher up or in global CSS) --- */
    body {
        font-family: 'Inter', sans-serif; /* Ensure Inter is loaded */
    }

    /* Fix for inline onmouseover/out JS - close quotes properly */
    #bookmark-icon:hover, #bookmark-icon:focus { transform: scale(1.2); }
    #bookmark-icon { transition: transform 0.3s ease; } /* Apply transition here */

    /* Ensure hover effects work correctly */
    img[onclick]:hover {
      /* Styles defined inline */
    }
    a[onmouseover]:hover {
        /* Styles defined inline */
    }
     div[onmouseover]:hover {
        /* Styles defined inline */
    }

    /* ADDED: Custom Alert CSS from eventdetails.blade.php */
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
        visibility: hidden; /* Start hidden */
    }

    .custom-alert.show {
        opacity: 1;
        transform: translateY(0);
        visibility: visible; /* Become visible */
    }

    .custom-alert.success {
        background: #4CAF50; /* Green */
        color: white;
    }

    .custom-alert.error {
        background: #F44336; /* Red */
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
    document.addEventListener('DOMContentLoaded', function() {
        // Ensure Swiper is available
        if (typeof Swiper !== 'undefined') {
            const swiper = new Swiper('.package-swiper', {
                loop: true,
                speed: 800,
                spaceBetween: 10,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                    dynamicBullets: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                // Removed breakpoints assuming 1 slide view is always desired
                slidesPerView: 1,
            });
        } else {
            console.error('Swiper library is not loaded');
        }

        // Initialize cart icon state when page loads
        const cartIcon = document.getElementById('cart-icon'); // Use ID selector
        if (cartIcon) {
            const packageId = cartIcon.dataset.packageId;
            if (packageId && isItemInCart(packageId)) {
                cartIcon.src = "{{ asset('assets/images/Icons/cart_fill.png') }}";
            } else {
                cartIcon.src = "{{ asset('assets/images/Icons/cart_gray.png') }}"; // Ensure default state
            }
        }
    });
</script>

<script>
    // Ensure CSRF token is available if not already globally defined
    const csrfToken = document.querySelector('meta[name="csrf-token"]') ? document.querySelector('meta[name="csrf-token"]').getAttribute('content') : '{{ csrf_token() }}'; // Fallback

    // --- REPLACED showAlert FUNCTION ---
    let alertTimeoutId = null; // Variable to hold the timeout ID

    function showAlert(message, isSuccess) {
        const alert = document.getElementById('customAlert');
        const alertMessage = document.getElementById('alertMessage');
        // Optional: Change the icon based on success/error if you have different SVG paths
        // const alertIcon = alert.querySelector('.alert-icon path');

        // Clear any existing timeout to prevent premature hiding if called again quickly
        if (alertTimeoutId) {
            clearTimeout(alertTimeoutId);
        }

        // Set the class for styling (success or error)
        alert.className = `custom-alert ${isSuccess ? 'success' : 'error'}`;
        // if (alertIcon) {
        //     alertIcon.setAttribute('d', isSuccess ? 'M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z' : 'M11 15h2v2h-2v-2zm0-8h2v6h-2V7zm.99-5C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z'); // Example path change
        // }

        // Update the message text
        alertMessage.textContent = message;

        // Force reflow to ensure the transition plays correctly if the class was just removed
        void alert.offsetWidth;

        // Add the 'show' class to trigger the animation
        alert.classList.add('show');

        // Automatically hide the alert after 3 seconds
        alertTimeoutId = setTimeout(() => {
            alert.classList.remove('show');
            alertTimeoutId = null; // Clear the timeout ID
        }, 3000);
    }
    // --- END OF REPLACED showAlert FUNCTION ---


    // Bookmark functionality (Uses the new showAlert)
    function toggleBookmark(icon) {
        // Check if user is authenticated
        const isAuthenticated = {{ auth()->check() ? 'true' : 'false' }};
        if (!isAuthenticated) {
            window.location.href = "{{ route('login') }}";
            return;
        }

        const packageId = icon.dataset.packageId; // Make sure this matches the data attribute
        if (!packageId) {
            console.error('Package ID not found on the icon element.');
            showAlert('Action failed: Missing package identifier.', false); // Uses new alert
            return;
        }

        fetch("{{ route('bookmarks.toggle') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ package_id: packageId }) // Send package_id
        })
        .then(response => {
             if (!response.ok) {
                // Try to parse error message from JSON response
                return response.json().then(data => {
                    throw new Error(data.message || `HTTP error! status: ${response.status}`);
                }).catch(() => {
                    // Fallback if parsing fails
                    throw new Error(`HTTP error! status: ${response.status}`);
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
                showAlert(data.message, data.status === 'bookmarked'); // Use new alert, check status for success type
            } else {
                console.error('Invalid response format received:', data);
                throw new Error('Received an invalid response from the server.');
            }
        })
        .catch(error => {
            console.error('Bookmark toggle error:', error);
            showAlert(error.message || 'Failed to update bookmark. Please try again later.', false); // Use new alert
        });
    }

    function toggleCart(icon) {
    if (!{{ auth()->check() ? 'true' : 'false' }}) {
        window.location.href = "{{ route('login') }}";
        return;
    }

    const packageId = icon.dataset.packageId;
    if (!packageId) {
        console.error('Package ID not found on the icon element.');
        showAlert('Action failed: Missing package identifier.', false);
        return;
    }

    fetch("{{ route('cart.toggle') }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ package_id: packageId })
    })
    .then(response => {
        if (!response.ok) {
            return response.json().then(data => {
                throw new Error(data.message || 'Server error occurred.');
            });
        }
        return response.json();
    })
    .then(data => {
        if (data.is_in_cart !== undefined && data.message) {
            icon.src = data.is_in_cart
                ? "{{ asset('assets/images/Icons/cart_fill.png') }}"
                : "{{ asset('assets/images/Icons/cart_gray.png') }}";
            icon.dataset.isInCart = data.is_in_cart;
            showAlert(data.message, data.is_in_cart);
        } else {
            throw new Error('Unexpected server response.');
        }
    })
    .catch(error => {
        console.error('Cart toggle error:', error);
        showAlert(error.message || 'Failed to update cart. Please try again.', false);
    });
}

// Function to add to cart and redirect to cart page
function addToCartAndRedirect(itemId, itemType) {
    if (!{{ auth()->check() ? 'true' : 'false' }}) {
        window.location.href = "{{ route('login') }}";
        return;
    }

    const payload = {};
    
    if (itemType === 'event') {
        payload.event_id = itemId;
    } else if (itemType === 'package') {
        payload.package_id = itemId;
    }

    fetch("{{ route('cart.toggle') }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify(payload)
    })
    .then(response => {
        if (!response.ok) {
            return response.json().then(data => {
                throw new Error(data.message || 'Server error occurred.');
            });
        }
        return response.json();
    })
    .then(data => {
        // Redirect to cart page regardless of response (as long as it's successful)
        window.location.href = "{{ route('cart') }}";
    })
    .catch(error => {
        console.error('Error:', error);
        showAlert(error.message || 'Error adding item to cart', false);
    });
}

</script>