<x-header/>

<!-- Title Starts -->
<section class="section">
    <div class="w-layout-blockcontainer container w-container">
        <div class="space-page-top"></div>
        <div class="about-block">
            <div class="text-block slide-from-left-animation">
                <div data-w-id="55686b65-573b-6b1e-27a8-356f0a4302e2" class="subheading-flex">
                    <h5>Explore & Book</h5>
                </div>
                <h1 data-w-id="2b428689-5a35-99ff-f397-e68c91393ae6">Events</h1>
            </div>
            <h5 data-w-id="2b428689-5a35-99ff-f397-e68c91393ae8" style="opacity:0" class="max-width-50rem">Make your
                special occasion unforgettable -reserve your event today!</h5>
        </div>
    </div>
</section>
<!-- Title Ends -->

<div class="space-2rem"></div>

<!-- Filter Starts -->
<section class="filter">
    <div class="advanced-search-container">
        <button id="toggle-advanced-search" class="btn-primary">
            <i class="fas fa-filter"></i> Advanced Filters
        </button>
        
        <form id="advanced-search-form" action="{{ route('events') }}" method="GET" class="advanced-search-form">
            <div class="search-row">
                <div class="search-field">
                    <label for="keyword">Search</label>
                    <input type="text" id="keyword" name="keyword" placeholder="Search by event title or description" value="{{ request('keyword') }}">
                </div>
            </div>
            
            <div class="search-row">
                <div class="search-field">
                    <label for="category_id">Category</label>
                    <select id="category_id" name="category_id">
                        <option value="all">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->category_id }}" {{ request('category_id') == $category->category_id ? 'selected' : '' }}>
                                {{ $category->category_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="search-field">
                    <label for="decorator_id">Decorator</label>
                    <select id="decorator_id" name="decorator_id">
                        <option value="all">All Decorators</option>
                        @foreach($decorators as $decorator)
                            <option value="{{ $decorator->decorator_id }}" {{ request('decorator_id') == $decorator->decorator_id ? 'selected' : '' }}>
                                {{ $decorator->decorator_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <div class="search-row">
                <div class="search-field price-range">
                    <label>Price Range</label>
                    <div class="range-slider">
                        <div class="price-inputs">
                            <div>
                                <label for="min_price">Min ₹</label>
                                <input type="number" id="min_price" name="min_price" min="{{ $minPrice }}" max="{{ $maxPrice }}" value="{{ request('min_price', $minPrice) }}">
                            </div>
                            <div>
                                <label for="max_price">Max ₹</label>
                                <input type="number" id="max_price" name="max_price" min="{{ $minPrice }}" max="{{ $maxPrice }}" value="{{ request('max_price', $maxPrice) }}">
                            </div>
                        </div>
                        <div class="slider-container">
                            <input type="range" id="price-range-slider-min" min="{{ $minPrice }}" max="{{ $maxPrice }}" value="{{ request('min_price', $minPrice) }}" class="slider">
                            <input type="range" id="price-range-slider-max" min="{{ $minPrice }}" max="{{ $maxPrice }}" value="{{ request('max_price', $maxPrice) }}" class="slider">
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="search-row">
                <div class="search-field">
                    <label for="min_rating">Minimum Rating</label>
                    <div class="rating-selector">
                        <div class="stars-container">
                            <input type="hidden" name="min_rating" id="min_rating" value="{{ request('min_rating', 0) }}">
                            <button type="button" class="rating-star-btn" data-rating="1" {{ request('min_rating', 0) >= 1 ? 'data-selected="true"' : '' }}>★</button>
                            <button type="button" class="rating-star-btn" data-rating="2" {{ request('min_rating', 0) >= 2 ? 'data-selected="true"' : '' }}>★</button>
                            <button type="button" class="rating-star-btn" data-rating="3" {{ request('min_rating', 0) >= 3 ? 'data-selected="true"' : '' }}>★</button>
                            <button type="button" class="rating-star-btn" data-rating="4" {{ request('min_rating', 0) >= 4 ? 'data-selected="true"' : '' }}>★</button>
                            <button type="button" class="rating-star-btn" data-rating="5" {{ request('min_rating', 0) >= 5 ? 'data-selected="true"' : '' }}>★</button>
                            <button type="button" class="clear-rating-btn" title="Clear rating">✕</button>
                        </div>
                        <span id="rating-display">{{ request('min_rating', 0) == 0 ? 'Any rating' : (request('min_rating', 0) . ' star' . (request('min_rating', 0) != 1 ? 's' : '') . ' & above') }}</span>
                    </div>
                </div>
                
                <div class="search-field sort-field">
                    <label for="sort">Sort By</label>
                    <select id="sort" name="sort">
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                        <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                        <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                        <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Customer Review</option>
                    </select>
                </div>
            </div>
            
            <div class="search-actions">
                <button type="submit" class="btn-primary">Apply Filters</button>
                <a href="{{ route('events') }}" class="btn-secondary">Clear All</a>
            </div>
        </form>
    </div>

    <div class="category-container">
        <div class="categories-wrapper">
            @foreach($categories as $index => $category)
                <a href="{{ route('events', ['category_id' => $category->category_id]) }}" 
                   class="category {{ $index >= 5 ? 'hidden-category' : '' }} {{ request('category_id') == $category->category_id ? 'selected' : '' }}" 
                   data-category-id="{{ $category->category_id }}">{{ $category->category_name }}</a>
            @endforeach
            @if(count($categories) > 5)
                <button class="more-categories-btn">More +</button>
            @endif
        </div>

        <div class="menu">
            <div class="item">
                <a href="#" class="link">
                    <span>Sort - {{ request('sort') ? ucfirst(str_replace('_', ' ', request('sort'))) : 'Featured' }}</span>
                    <svg viewBox="0 0 360 360" xml:space="preserve">
                            <g id="SVGRepo_iconCarrier">
                                <path id="XMLID_225_" d="M325.607,79.393c-5.857-5.857-15.355-5.858-21.213,0.001l-139.39,139.393L25.607,79.393
                                c-5.857-5.857-15.355-5.858-21.213,0.001c-5.858,5.858-5.858,15.355,0,21.213l150.004,150c2.813,2.813,6.628,4.393,10.606,4.393
                                s7.794-1.581,10.606-4.394l149.996-150C331.465,94.749,331.465,85.251,325.607,79.393z"/>
                            </g>
                        </svg>
                </a>
                <div class="submenu">
                    <div class="submenu-item">
                        <a href="{{ route('events', array_merge(request()->except('sort'), ['sort' => 'price_high'])) }}" class="submenu-link {{ request('sort') == 'price_high' ? 'active' : '' }}">Price: High to Low</a>
                    </div>
                    <div class="submenu-item">
                        <a href="{{ route('events', array_merge(request()->except('sort'), ['sort' => 'price_low'])) }}" class="submenu-link {{ request('sort') == 'price_low' ? 'active' : '' }}">Price: Low to High</a>
                    </div>
                    <div class="submenu-item">
                        <a href="{{ route('events', array_merge(request()->except('sort'), ['sort' => 'newest'])) }}" class="submenu-link {{ request('sort') == 'newest' ? 'active' : '' }}">Newest</a>
                    </div>
                    <div class="submenu-item">
                        <a href="{{ route('events', array_merge(request()->except('sort'), ['sort' => 'rating'])) }}" class="submenu-link {{ request('sort') == 'rating' ? 'active' : '' }}">Customer Review</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
<!-- Filter Ends -->


<!-- Post Starts -->
<section class="section">
    <div class="w-layout-blockcontainer container padding-9rem w-container">
        <!-- <div class="posts-title-flex flip-from-left-animation">
            <h3>Latest <span>Posts</span></h3>
            <div class="posts-text-block">
                <h5>Our recent articles</h5>
                <p>Simplify your tasks and maintaining the cleanliness.</p>
            </div>
        </div> -->
        <div class="space-4rem"></div>
        <div class="slide-up-animation w-dyn-list">
            <div role="list" class="posts-flex w-dyn-items">
                @if($events->isEmpty())
                    <p>No events available.</p>
                @else
                    @foreach($events as $event)
                        <div role="listitem" class="w-dyn-item"><a
                                href="{{ route('eventdetails.show', ['id' => $event->event_id]) }}"
                                class="posts-card w-inline-block">
                                <div class="latest-image-wrapper">
                                    @if($event->rating)
                                        <div class="rating-badge">
                                            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                                            </svg>
                                            {{ number_format($event->rating, 1) }}
                                        </div>
                                    @endif
                                    <img width="Auto" height="Auto" alt=""
                                         src="{{ asset('storage/' . $event->image) }}"
                                         loading="eager"
                                         sizes="100vw"
                                         srcset="{{ asset('storage/' . $event->image) }} 500w, {{ asset('storage/' . $event->image) }} 800w, {{ asset('storage/' . $event->image) }} 1080w, {{ asset('storage/' . $event->image) }} 1152w"
                                         class="image-absolute">
                                    <div class="posts-arrow-wrapper"><img width="24" height="24" alt=""
                                                                          src="assets/Images/Icons/66a5f61b61b9f0a48636ca35_arrow_outward.svg"
                                                                          loading="eager" class="arrow"></div>
                                </div>
                                <div class="latest-posts-details-flex">
                                    <div class="posts-category-date-flex">
                                        <div class="badge-post">
                                            <h5 class="no-wrap font-black">{{ $event->category->category_name ?? 'N/A' }}</h5>
                                        </div>
                                        <h5 class="no-wrap">₹{{ number_format($event->price, 0) }}</h5>
                                    </div>
                                    <div class="horizontal-line"></div>
                                    <div class="posts-avatar-flex">
                                        <div class="avatar-wrapper"><img width="Auto" height="Auto" alt=""
                                                                         src="{{ asset('storage/' . $event->decorator->decorator_icon) }}"
                                                                         loading="eager"></div>
                                        <div class="avatar-text-block">
                                            <h5 class="no-wrap">{{ $event->decorator->decorator_name ?? 'Unknown Decorator' }}</h5>

                                        </div>
                                    </div>
                                </div>
                                <h4>{{ $event->title }}</h4>
                            </a>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="space-7rem"></div>
    </div>
</section>
<!-- Post Ends -->
<x-footer/>

<style>
    .category-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        padding: 0 1rem;
        max-width: 1200px;
        margin: 0 auto;
        gap: 10px;
    }
    
    .categories-wrapper {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        flex: 1;
        margin-right: 20px;
        position: relative;
    }
    
    .category {
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        padding: 8px 20px;
        border-radius: 30px;
        display: inline-block;
        white-space: nowrap;
        margin: 5px 2px;
        text-align: center;
        background-color: rgba(var(--primary-rgb), 0.05);
    }
    
    .hidden-category {
        display: none;
    }
    
    .more-categories-btn {
        background-color: var(--primary-light);
        color: var(--dark-gray);
        border: none;
        padding: 8px 20px;
        border-radius: 30px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-weight: 500;
        margin: 5px 2px;
    }
    
    .more-categories-btn:hover {
        background-color: var(--primary);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    
    .more-categories-btn.expanded {
        background-color: var(--primary);
        color: white;
    }
    
    .category::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        width: 0;
        height: 2px;
        background: var(--primary);
        transition: all 0.3s ease;
        transform: translateX(-50%);
    }
    
    .category.selected {
        color: var(--black);
        background-color: transparent;
        transform: scale(1.05);
        border: 1.5px solid var(--primary);
        font-weight: 600;
        letter-spacing: 0.3px;
    }
    
    .category.selected::after {
        width: 80%;
    }
    
    .category:hover {
        transform: translateY(-2px);
        background-color: var(--primary-light);
        color: var(--dark-gray);
    }
    
    .category:hover::after {
        width: 40%;
    }
    
    .category:active {
        transform: scale(0.98);
    }
    
    .menu {
        min-width: 140px;
        margin-left: auto;
    }

    .rating-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background: linear-gradient(135deg, var(--primary), var(--primary-light));
        color: var(--black);
        padding: 6px 12px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        gap: 4px;
        font-weight: 600;
        font-size: 0.9rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        transform: translateY(0);
        transition: all 0.3s ease;
        z-index: 1;
    }
    .rating-badge svg {
        width: 16px;
        height: 16px;
        fill: var(--black);
        filter: drop-shadow(0 1px 1px rgba(0, 0, 0, 0.1));
    }
    .posts-card:hover .rating-badge {
        transform: translateY(-3px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
    }
    
    /* Advanced Search Form Styles */
    .advanced-search-container {
        max-width: 1200px;
        margin: 0 auto 20px;
        padding: 0 1rem;
    }
    
    #toggle-advanced-search {
        display: block;
        margin: 0 auto 10px;
        background-color: var(--primary);
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 4px;
        cursor: pointer;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    #toggle-advanced-search:hover {
        background-color: var(--secondary);
        transform: translateY(-2px);
    }
    
    .advanced-search-form {
        padding: 20px;
        border-radius: 8px;
        background-color: #f9f9f9;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        margin-bottom: 20px;
        display: none;
    }
    
    .advanced-search-form.active {
        display: block;
    }
    
    .search-row {
        display: flex;
        gap: 15px;
        margin-bottom: 15px;
        flex-wrap: wrap;
    }
    
    .search-field {
        flex: 1;
        min-width: 250px;
    }
    
    .search-field label {
        display: block;
        margin-bottom: 5px;
        font-weight: 500;
        color: #333;
    }
    
    .search-field input[type="text"],
    .search-field input[type="number"],
    .search-field select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
    }
    
    .price-range {
        flex: 2;
    }
    
    .range-slider {
        width: 100%;
    }
    
    .price-inputs {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
    }
    
    .price-inputs input {
        width: 100px;
    }
    
    .slider-container {
        position: relative;
        height: 40px;
    }
    
    .slider {
        -webkit-appearance: none;
        width: 100%;
        height: 5px;
        border-radius: 5px;
        background: #d3d3d3;
        outline: none;
        position: absolute;
        pointer-events: none;
    }
    
    .slider::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: var(--primary);
        cursor: pointer;
        pointer-events: auto;
    }
    
    .slider::-moz-range-thumb {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: var(--primary);
        cursor: pointer;
        pointer-events: auto;
    }
    
    .rating-selector {
        display: flex;
        align-items: center;
    }
    
    .stars-container {
        display: flex;
        align-items: center;
        margin-bottom: 8px;
    }
    
    .rating-star-btn {
        background: none;
        border: none;
        font-size: 28px;
        color: #ccc;
        cursor: pointer;
        transition: transform 0.2s, color 0.2s;
        padding: 0 3px;
        line-height: 1;
    }
    
    .rating-star-btn:hover {
        transform: scale(1.2);
    }
    
    .rating-star-btn[data-selected="true"] {
        color: #ffc107;
    }
    
    .clear-rating-btn {
        background: none;
        border: none;
        font-size: 18px;
        color: #999;
        cursor: pointer;
        margin-left: 10px;
        padding: 5px;
        line-height: 1;
    }
    
    .clear-rating-btn:hover {
        color: #ff5252;
    }
    
    #rating-display {
        display: block;
        font-size: 14px;
        color: #666;
        margin-top: 4px;
    }
    
    .search-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 20px;
    }
    
    .btn-primary {
        background-color: var(--primary);
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 4px;
        cursor: pointer;
        font-weight: 500;
    }
    
    .btn-secondary {
        background-color: #f1f1f1;
        color: #333;
        border: 1px solid #ddd;
        padding: 10px 20px;
        border-radius: 4px;
        cursor: pointer;
        text-decoration: none;
        font-weight: 500;
    }
    
    .btn-primary:hover, .btn-secondary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    
    @media (max-width: 768px) {
        .search-row {
            flex-direction: column;
        }
        
        .search-field {
            width: 100%;
        }
    }
</style>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const categories = document.querySelectorAll('.category');
    const eventsList = document.querySelector('.w-dyn-items');
    const storageUrl = '{{ asset("storage") }}';
    const arrowIconUrl = '{{ asset("assets/Images/Icons/66a5f61b61b9f0a48636ca35_arrow_outward.svg") }}';

    // More categories button functionality
    const moreButton = document.querySelector('.more-categories-btn');
    if (moreButton) {
        moreButton.addEventListener('click', function() {
            // Get all categories beyond the first 5
            const allCategories = document.querySelectorAll('.category');
            const categoriesToToggle = Array.from(allCategories).filter((_, index) => index >= 5);
            
            if (this.textContent === 'More +') {
                // Show more categories
                categoriesToToggle.forEach(category => {
                    category.classList.remove('hidden-category');
                });
                this.textContent = 'Less -';
                this.classList.add('expanded');
            } else {
                // Hide categories beyond the first 5
                categoriesToToggle.forEach(category => {
                    category.classList.add('hidden-category');
                });
                this.textContent = 'More +';
                this.classList.remove('expanded');
            }
        });
    }

    // Advanced search toggle
    const toggleBtn = document.getElementById('toggle-advanced-search');
    const searchForm = document.getElementById('advanced-search-form');
    
    toggleBtn.addEventListener('click', function() {
        searchForm.classList.toggle('active');
        if (searchForm.classList.contains('active')) {
            toggleBtn.textContent = 'Hide Advanced Filters';
        } else {
            toggleBtn.innerHTML = '<i class="fas fa-filter"></i> Advanced Filters';
        }
    });
    
    // Show form if there are active filters
    if (window.location.search && window.location.search.length > 1) {
        searchForm.classList.add('active');
        toggleBtn.textContent = 'Hide Advanced Filters';
    }
    
    // Price range slider
    const minPriceInput = document.getElementById('min_price');
    const maxPriceInput = document.getElementById('max_price');
    const minSlider = document.getElementById('price-range-slider-min');
    const maxSlider = document.getElementById('price-range-slider-max');
    
    // Update input when slider changes
    minSlider.addEventListener('input', function() {
        minPriceInput.value = this.value;
        if (parseInt(minSlider.value) > parseInt(maxSlider.value)) {
            maxSlider.value = minSlider.value;
            maxPriceInput.value = minSlider.value;
        }
    });
    
    maxSlider.addEventListener('input', function() {
        maxPriceInput.value = this.value;
        if (parseInt(maxSlider.value) < parseInt(minSlider.value)) {
            minSlider.value = maxSlider.value;
            minPriceInput.value = maxSlider.value;
        }
    });
    
    // Update slider when input changes
    minPriceInput.addEventListener('input', function() {
        minSlider.value = this.value;
        if (parseInt(minPriceInput.value) > parseInt(maxPriceInput.value)) {
            maxPriceInput.value = minPriceInput.value;
            maxSlider.value = minPriceInput.value;
        }
    });
    
    maxPriceInput.addEventListener('input', function() {
        maxSlider.value = this.value;
        if (parseInt(maxPriceInput.value) < parseInt(minPriceInput.value)) {
            minPriceInput.value = maxPriceInput.value;
            minSlider.value = maxPriceInput.value;
        }
    });
    
    // Simple direct approach for star rating
    function initRatingSystem() {
        console.log('Initializing rating system...');
        const ratingStars = document.querySelectorAll('.rating-star-btn');
        const clearRatingBtn = document.querySelector('.clear-rating-btn');
        const ratingInput = document.getElementById('min_rating');
        const ratingDisplay = document.getElementById('rating-display');
        
        console.log('Found elements:', {
            stars: ratingStars?.length,
            clearBtn: !!clearRatingBtn,
            input: !!ratingInput,
            display: !!ratingDisplay
        });
        
        if (ratingStars.length && clearRatingBtn && ratingInput && ratingDisplay) {
            // Handle star click
            ratingStars.forEach(star => {
                star.onclick = function() {
                    console.log('Star clicked:', this.dataset.rating);
                    const rating = parseInt(this.dataset.rating);
                    ratingInput.value = rating;
                    
                    // Update UI
                    ratingStars.forEach(s => {
                        if (parseInt(s.dataset.rating) <= rating) {
                            s.setAttribute('data-selected', 'true');
                        } else {
                            s.removeAttribute('data-selected');
                        }
                    });
                    
                    ratingDisplay.textContent = rating + ' star' + (rating !== 1 ? 's' : '') + ' & above';
                };
            });
            
            // Handle clear button click
            clearRatingBtn.onclick = function() {
                console.log('Clear rating clicked');
                ratingInput.value = 0;
                ratingStars.forEach(s => s.removeAttribute('data-selected'));
                ratingDisplay.textContent = 'Any rating';
            };
            
            console.log('Rating system initialized successfully');
        } else {
            console.error('Could not initialize rating system - missing elements');
        }
    }
    
    // Call the initialization function
    initRatingSystem();
});
</script>

<script src="js/jquery-3.5.1.min.dc5e7f18c8.js?site=6706104d4f29e916e4cae2ad" type="text/javascript"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="assets/js/mainScript.js" type="text/javascript"></script>

</body>

</html>
