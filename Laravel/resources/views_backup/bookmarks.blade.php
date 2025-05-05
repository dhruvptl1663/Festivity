@include('components.header')

<div class="container" style="margin-top: 120px; margin-bottom: 100px; max-width: 1200px; padding: 0 20px;">
    <h1 style="font-size: 36px; font-weight: 700; margin-bottom: 40px; font-family: 'Inter', sans-serif; position: relative; display: inline-block;">
        My Bookmarks
        <span style="position: absolute; bottom: -10px; left: 0; width: 40%; height: 4px; background: linear-gradient(90deg, #C1E4C4, transparent); border-radius: 2px;"></span>
    </h1>
    
    @if($bookmarks->isEmpty())
        <div class="empty-state" style="text-align: center; padding: 80px 0; background-color: #f9f9f9; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.03);">
            <div style="width: 100px; height: 100px; margin: 0 auto 30px; background: rgba(193, 228, 196, 0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                <img src="{{ asset('assets/Images/Icons/bookmark_empty.png') }}" alt="No Bookmarks" style="width: 50px; opacity: 0.7;">
            </div>
            <h3 style="font-size: 24px; font-weight: 600; margin-bottom: 15px; color: #333;">No Bookmarks Yet</h3>
            <p style="color: #666; font-size: 16px; max-width: 500px; margin: 0 auto 30px; line-height: 1.6;">You haven't bookmarked any events or packages. Browse and bookmark items to save them for later.</p>
            <div style="display: flex; gap: 20px; justify-content: center;">
                <a href="{{ route('events') }}" class="btn" style="background-color: #f5f5f5; color: #333; padding: 14px 28px; border-radius: 30px; text-decoration: none; font-weight: 500; box-shadow: 0 4px 12px rgba(0,0,0,0.05); transition: all 0.3s ease;">
                    <i class="fas fa-calendar-day" style="margin-right: 8px;"></i>Browse Events
                </a>
                <a href="{{ route('packages.index') }}" class="btn" style="background-color: #DBFFDE; color: #333; padding: 14px 28px; border-radius: 30px; text-decoration: none; font-weight: 500; box-shadow: 0 4px 12px rgba(0,0,0,0.05); transition: all 0.3s ease;">
                    <i class="fas fa-box-open" style="margin-right: 8px;"></i>Browse Packages
                </a>
            </div>
        </div>
    @else
        <!-- Events Section -->
        @if($events->isNotEmpty())
        <div class="bookmark-section">
            <h2 style="font-size: 24px; font-weight: 600; margin-bottom: 30px; font-family: 'Inter', sans-serif; display: flex; align-items: center; gap: 12px;">
                <i class="fas fa-calendar-day" style="color: #C1E4C4; background: rgba(193, 228, 196, 0.2); width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; border-radius: 10px;"></i>
                Bookmarked Events
            </h2>
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 30px; margin-bottom: 60px;">
                @foreach($events as $event)
                <div class="bookmark-card" style="border-radius: 20px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.05); transition: transform 0.3s ease, box-shadow 0.3s ease; background: white; position: relative;">
                    <div style="height: 200px; overflow: hidden; position: relative;">
                        <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;">
                        <div class="bookmark-card-overlay" style="position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,0.6) 0%, transparent 100%); opacity: 0.6;"></div>
                        <div class="bookmark-actions" style="position: absolute; top: 16px; right: 16px; display: flex; gap: 12px; z-index: 10;">
                            <button onclick="toggleBookmark(this, 'event', {{ $event->event_id }})" class="action-btn" style="background: rgba(255,255,255,0.95); backdrop-filter: blur(4px); border-radius: 50%; width: 42px; height: 42px; display: flex; align-items: center; justify-content: center; border: none; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                                <img src="{{ asset('assets/Images/Icons/like_red.png') }}" alt="Unbookmark" style="width: 20px; height: 20px; transition: transform 0.3s ease; object-fit: contain;">
                            </button>
                            <button onclick="addToCart(this, 'event', {{ $event->event_id }})" class="action-btn" style="background: rgba(255,255,255,0.95); backdrop-filter: blur(4px); border-radius: 50%; width: 42px; height: 42px; display: flex; align-items: center; justify-content: center; border: none; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                                <img src="{{ asset('assets/Images/Icons/cart_gray.png') }}" alt="Add to Cart" style="width: 20px; height: 20px; transition: transform 0.3s ease;">
                            </button>
                        </div>
                        <div class="bookmark-price-tag" style="position: absolute; bottom: 16px; left: 16px; background: rgba(255,255,255,0.95); backdrop-filter: blur(4px); padding: 6px 12px; border-radius: 30px; font-weight: 600; color: #333; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                            &#x20B9;{{ number_format($event->price, 2) }}
                        </div>
                    </div>
                    <div style="padding: 24px; position: relative;">
                        <h3 style="font-size: 20px; font-weight: 600; margin-bottom: 14px; color: #333; line-height: 1.3;">{{ $event->title }}</h3>
                        <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 20px;">
                            <div style="display: flex; align-items: center; gap: 5px; background: rgba(255, 215, 0, 0.1); padding: 5px 10px; border-radius: 20px;">
                                <i class="fas fa-star" style="color: #FFD700;"></i>
                                <span style="font-weight: 500;">{{ number_format($event->rating, 1) }}</span>
                                <span style="color: #888; font-size: 14px;">({{ $event->rating_count }})</span>
                            </div>
                            <div style="display: flex; align-items: center; gap: 5px; color: #666;">
                                <i class="fas fa-calendar-alt"></i>
                                <span>Event</span>
                            </div>
                        </div>
                        <a href="{{ route('eventdetails.show', ['id' => $event->event_id]) }}" class="view-details" style="display: block; text-align: center; padding: 12px; background: #DBFFDE; color: #333; text-decoration: none; border-radius: 12px; font-weight: 600; transition: all 0.3s ease; box-shadow: 0 4px 10px rgba(193, 228, 196, 0.3);">
                            View Details
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Packages Section -->
        @if($packages->isNotEmpty())
        <div class="bookmark-section">
            <h2 style="font-size: 24px; font-weight: 600; margin-bottom: 30px; font-family: 'Inter', sans-serif; display: flex; align-items: center; gap: 12px;">
                <i class="fas fa-box-open" style="color: #C1E4C4; background: rgba(193, 228, 196, 0.2); width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; border-radius: 10px;"></i>
                Bookmarked Packages
            </h2>
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 30px;">
                @foreach($packages as $package)
                <div class="bookmark-card" style="border-radius: 20px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.05); transition: transform 0.3s ease, box-shadow 0.3s ease; background: white; position: relative;">
                    <div style="height: 200px; overflow: hidden; position: relative;">
                        @if($package->packageEvents->isNotEmpty() && $package->packageEvents->first()->event->image)
                            <img src="{{ asset('storage/' . $package->packageEvents->first()->event->image) }}" alt="{{ $package->title }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;">
                        @else
                            <div style="width: 100%; height: 100%; background-color: #f8f9fa; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-image" style="font-size: 40px; color: #ccc;"></i>
                            </div>
                        @endif
                        <div class="bookmark-card-overlay" style="position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,0.6) 0%, transparent 100%); opacity: 0.6;"></div>
                        <div class="bookmark-actions" style="position: absolute; top: 16px; right: 16px; display: flex; gap: 12px; z-index: 10;">
                            <button onclick="toggleBookmark(this, 'package', {{ $package->package_id }})" class="action-btn" style="background: rgba(255,255,255,0.95); backdrop-filter: blur(4px); border-radius: 50%; width: 42px; height: 42px; display: flex; align-items: center; justify-content: center; border: none; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                                <img src="{{ asset('assets/Images/Icons/like_red.png') }}" alt="Unbookmark" style="width: 20px; height: 20px; transition: transform 0.3s ease; object-fit: contain;">
                            </button>
                            <button onclick="addToCart(this, 'package', {{ $package->package_id }})" class="action-btn" style="background: rgba(255,255,255,0.95); backdrop-filter: blur(4px); border-radius: 50%; width: 42px; height: 42px; display: flex; align-items: center; justify-content: center; border: none; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                                <img src="{{ asset('assets/Images/Icons/cart_gray.png') }}" alt="Add to Cart" style="width: 20px; height: 20px; transition: transform 0.3s ease;">
                            </button>
                        </div>
                        <div class="bookmark-price-tag" style="position: absolute; bottom: 16px; left: 16px; background: rgba(255,255,255,0.95); backdrop-filter: blur(4px); padding: 6px 12px; border-radius: 30px; font-weight: 600; color: #333; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                            &#x20B9;{{ number_format($package->price, 2) }}
                        </div>
                    </div>
                    <div style="padding: 24px;">
                        <h3 style="font-size: 20px; font-weight: 600; margin-bottom: 14px; color: #333; line-height: 1.3;">{{ $package->title }}</h3>
                        <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 20px;">
                            <div style="display: flex; align-items: center; gap: 5px; background: rgba(255, 215, 0, 0.1); padding: 5px 10px; border-radius: 20px;">
                                <i class="fas fa-star" style="color: #FFD700;"></i>
                                <span style="font-weight: 500;">{{ number_format($package->rating, 1) }}</span>
                                <span style="color: #888; font-size: 14px;">({{ $package->rating_count }})</span>
                            </div>
                            <div style="display: flex; align-items: center; gap: 5px; color: #666;">
                                <i class="fas fa-box"></i>
                                <span>Package</span>
                            </div>
                        </div>
                        <a href="{{ route('packagedetails', ['package' => $package->package_id]) }}" class="view-details" style="display: block; text-align: center; padding: 12px; background: #DBFFDE; color: #333; text-decoration: none; border-radius: 12px; font-weight: 600; transition: all 0.3s ease; box-shadow: 0 4px 10px rgba(193, 228, 196, 0.3);">
                            View Details
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    @endif
</div>

<!-- Alert Component -->
<div id="customAlert" class="custom-alert">
    <div class="alert-content">
        <div class="alert-icon">
            <svg viewBox="0 0 24 24" width="24" height="24">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
            </svg>
        </div>
        <span id="alertMessage">Item added to cart successfully!</span>
    </div>
</div>

<style>
    /* Card Hover Effect */
    .bookmark-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 16px 30px rgba(0,0,0,0.1);
    }
    
    /* Image Zoom Effect */
    .bookmark-card:hover img {
        transform: scale(1.05);
    }
    
    /* Action Button Hover Effects */
    .action-btn:hover {
        transform: scale(1.15);
        background: white;
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }
    
    .action-btn:hover img {
        transform: scale(1.1);
    }
    
    /* View Details Button Hover */
    .view-details:hover {
        background: #c1e4c4 !important;
        transform: translateY(-2px);
        box-shadow: 0 8px 15px rgba(193, 228, 196, 0.4) !important;
    }
    
    /* Empty State Button Hover */
    .empty-state .btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    }
    
    /* Custom Alert Styles */
    .custom-alert {
        position: fixed;
        top: 20px;
        right: 20px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        padding: 16px 20px;
        display: flex;
        align-items: center;
        z-index: 9999;
        opacity: 0;
        transform: translateY(-20px);
        transition: all 0.3s cubic-bezier(0.68, -0.55, 0.27, 1.55);
        pointer-events: none;
        max-width: 350px;
    }
    
    .custom-alert.show {
        opacity: 1;
        transform: translateY(0);
    }
    
    .custom-alert.success {
        border-left: 4px solid #4CAF50;
    }
    
    .custom-alert.error {
        border-left: 4px solid #f44336;
    }
    
    .alert-content {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    
    .alert-icon {
        flex-shrink: 0;
    }
    
    .alert-icon svg {
        fill: #4CAF50;
    }
    
    .error .alert-icon svg {
        fill: #f44336;
    }
    
    #alertMessage {
        font-size: 14px;
        color: #333;
        font-weight: 500;
    }
    
    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .container {
            padding: 0 15px;
        }
        
        h1 {
            font-size: 28px;
        }
        
        .bookmark-section h2 {
            font-size: 22px;
        }
    }
</style>

<script>
    // Alert functionality
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
        
        alertTimeoutId = setTimeout(() => {
            alert.classList.remove('show');
            alertTimeoutId = null;
        }, 3000);
    }
    
    // Bookmark toggle functionality
    function toggleBookmark(button, type, id) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        let data = {};
        
        if (type === 'event') {
            data = { event_id: id };
        } else if (type === 'package') {
            data = { package_id: id };
        }
        
        fetch("{{ route('bookmarks.toggle') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify(data)
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(data => {
                    throw new Error(data.message || `Error: ${response.status}`);
                });
            }
            return response.json();
        })
        .then(data => {
            if (data.status === 'removed') {
                // Remove the card with animation
                const card = button.closest('.bookmark-card');
                card.style.opacity = '0';
                card.style.transform = 'scale(0.8)';
                setTimeout(() => {
                    card.remove();
                    
                    // Check if section is empty and hide it if needed
                    const section = button.closest('.bookmark-section');
                    const remainingCards = section.querySelectorAll('.bookmark-card');
                    if (remainingCards.length === 0) {
                        section.style.display = 'none';
                        
                        // If all sections are empty, show empty state
                        const allSections = document.querySelectorAll('.bookmark-section');
                        let allEmpty = true;
                        allSections.forEach(section => {
                            if (section.style.display !== 'none') {
                                allEmpty = false;
                            }
                        });
                        
                        if (allEmpty) {
                            location.reload(); // Refresh to show empty state
                        }
                    }
                }, 300);
                
                showAlert('Item removed from bookmarks', true);
            } else {
                showAlert(data.message, data.status === 'added');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert(error.message || 'An error occurred', false);
        });
    }
    
    // Add to cart functionality
    function addToCart(button, type, id) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        let data = {};
        
        if (type === 'event') {
            data = { event_id: id };
        } else if (type === 'package') {
            data = { package_id: id };
        }
        
        fetch("{{ route('cart.toggle') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify(data)
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(data => {
                    throw new Error(data.message || `Error: ${response.status}`);
                });
            }
            return response.json();
        })
        .then(data => {
            // Update the cart icon
            button.querySelector('img').src = data.is_in_cart 
                ? "{{ asset('assets/Images/Icons/cart_fill.png') }}" 
                : "{{ asset('assets/Images/Icons/cart_gray.png') }}";
                
            showAlert(data.message, data.is_in_cart);
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert(error.message || 'An error occurred', false);
        });
    }
</script>

@include('components.footer')
