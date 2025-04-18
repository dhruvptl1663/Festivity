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
                data-package-id="{{ $package->package_id }}"
                data-is-bookmarked="{{ $isBookmarked ? 'true' : 'false' }}"
                onclick="toggleBookmark(this)">
        </div>

        <div style="width: 28.13px; height: 28.55px; margin-right: 15px">
            <img
                src="{{ asset('assets/images/Icons/cart_gray.png') }}"
                alt="Cart Icon"
                style="cursor: pointer; transition: transform 0.3s ease;"
                onmouseover="this.style.transform='scale(1.2)'"
                onmouseout="this.style.transform='scale(1)'"
                data-package-id="{{ $package->package_id }}"
                onclick="addToCart(this)">
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
        fill: #212529;
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
    });
</script>

<script>
    // Ensure CSRF token is available if not already globally defined
    const csrfToken = document.querySelector('meta[name="csrf-token"]') ? document.querySelector('meta[name="csrf-token"]').getAttribute('content') : '{{ csrf_token() }}'; // Fallback

    function toggleBookmark(icon) {
        const packageId = icon.dataset.packageId;
        const isBookmarked = icon.dataset.isBookmarked === 'true';

        fetch(`/packages/${packageId}/toggle-bookmark`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/json',
                'Accept': 'application/json', // Good practice
            },
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            icon.src = data.bookmarked ? '{{ asset('assets/images/Icons/like_red.png') }}' : '{{ asset('assets/images/Icons/like_gray.png') }}';
            icon.dataset.isBookmarked = data.bookmarked ? 'true' : 'false';
            // Optional: Provide user feedback (e.g., a small temporary message)
        })
        .catch(error => {
             console.error('Error toggling bookmark:', error);
             alert('Could not update bookmark. Please try again.'); // User feedback
        });
    }

    function addToCart(cartIcon) {
        const packageId = cartIcon.dataset.packageId;

        fetch('/cart/packages', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
            body: JSON.stringify({ package_id: packageId })
        })
        .then(response => {
             if (!response.ok) {
                // Try to parse error message if server sends JSON error
                 return response.json().then(err => { throw err; });
             }
             return response.json();
         })
        .then(data => {
            if (data.success) {
                alert(data.message || 'Package added to cart successfully!'); // Use server message if available
                // Optional: Update cart icon indicator somewhere on the page
            } else {
                alert(data.message || 'Error adding package to cart'); // Use server message
            }
        })
        .catch(error => {
            console.error('Error adding to cart:', error);
            // Check if error object has a message property
            const errorMessage = error?.message || 'Could not add item to cart. Please try again.';
            alert(errorMessage);
        });
    }


</script>