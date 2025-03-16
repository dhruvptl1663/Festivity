<x-header/>

<!-- Title Starts -->
<section class="section">
    <div class="w-layout-blockcontainer container w-container">
        <div class="space-page-top"></div>
        <div class="about-block">
            <div class="text-block slide-from-left-animation">
                <div data-w-id="55686b65-573b-6b1e-27a8-356f0a4302e2" class="subheading-flex">
                    <h5>Explore &amp; Book</h5>
                </div>
                <h1 data-w-id="2b428689-5a35-99ff-f397-e68c91393ae6">Packages</h1>
            </div>
            <h5 data-w-id="2b428689-5a35-99ff-f397-e68c91393ae8" style="opacity:0" class="max-width-50rem">Double the joy, triple the fun -book a package for all your events!
            </h5>
        </div>
    </div>
</section>
<!-- Title Ends -->

<div class="space-2rem"></div>

<!-- Filter Starts -->
<section class="filter">
    <div class="line"></div>

    <div class="category-container">
            @foreach($eventCounts as $eventCount)
                <a class="category {{ request('event_count') == $eventCount['id'] ? 'selected' : '' }}" href="{{ route('packages.index', ['event_count' => $eventCount['id']]) }}" class="event-filter-link {{ request('event_count') == $eventCount['id'] ? 'active' : '' }}">
                    {{ $eventCount['name'] }}
                </a>
            @endforeach

            <div class="menu">
        <div class="item">
            <a href="#" class="link">
                <span>Sort - Featured</span>
                <svg viewBox="0 0 360 360" xml:space="preserve">
                        <g id="SVGRepo_iconCarrier">
                            <path id="XMLID_225_" d="M325.607,79.393c-5.857-5.857-15.355-5.858-21.213,0.001l-139.39,139.393L25.607,79.393
                            c-5.857-5.857-15.355-5.858-21.213,0.001c-5.858,5.858-5.858,15.355,0,21.213l150.004,150c2.813,2.813,6.628,4.393,10.606,4.393
                            s7.794-1.581,10.606-4.394l149.996-150C331.465,94.749,331.465,85.251,325.607,79.393z">
                            </path>
                        </g>
                    </svg>
            </a>
            <div class="submenu">
                <div class="submenu-item">
                    <a href="{{ route('packages.index', ['sort' => 'price_high']) }}" class="submenu-link {{ request('sort') == 'price_high' ? 'active' : '' }}">Price: High to Low</a>
                </div>
                <div class="submenu-item">
                    <a href="{{ route('packages.index', ['sort' => 'price_low']) }}" class="submenu-link {{ request('sort') == 'price_low' ? 'active' : '' }}">Price: Low to High</a>
                </div>
                <div class="submenu-item">
                    <a href="{{ route('packages.index', ['sort' => 'newest']) }}" class="submenu-link {{ request('sort') == 'newest' ? 'active' : '' }}">Newest</a>
                </div>
                <div class="submenu-item">
                    <a href="{{ route('packages.index', ['sort' => 'rating']) }}" class="submenu-link {{ request('sort') == 'rating' ? 'active' : '' }}">Customer Review</a>
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
        <div class="space-4rem"></div>
        <div class="slide-up-animation w-dyn-list">
            <div role="list" class="posts-flex w-dyn-items">
                @if($packages->isEmpty())
                    <p>No packages available.</p>
                @else
                    @foreach($packages as $package)
                    <div role="listitem" class="w-dyn-item">
                        <a href="{{ route('packages.show', $package->package_id) }}" class="posts-card w-inline-block">
                            <div class="latest-image-wrapper">
                                @if($package->rating)
                                    <div class="rating-badge">
                                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                                        </svg>
                                        {{ number_format($package->rating, 1) }}
                                    </div>
                                @endif
                                <div class="swiper package-swiper">
                                    <div class="swiper-wrapper">
                                        @foreach($package->packageEvents as $packageEvent)
                                            @if($packageEvent->event->image)
                                                <div class="swiper-slide">
                                                    <img width="Auto" height="Auto" 
                                                        alt="{{ $packageEvent->event->title }}"
                                                        src="{{ asset('storage/' . $packageEvent->event->image) }}" 
                                                        loading="eager" 
                                                        class="image-absolute">
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="swiper-pagination"></div>
                                    <div class="swiper-button-prev"></div>
                                    <div class="swiper-button-next"></div>
                                </div>
                            </div>
                            <div class="latest-posts-details-flex">
                                <div class="posts-category-date-flex">
                                    <div class="badge-post">
                                        <h5 class="no-wrap font-black">{{ $package->packageEvents->count() }} Events</h5>
                                    </div>
                                    <h5 class="no-wrap">₹{{ number_format($package->price, 0) }}</h5>
                                </div>
                                <div class="horizontal-line"></div>
                                <div class="posts-avatar-flex">
                                    <div class="avatar-wrapper">
                                        @if($package->decorator && $package->decorator->decorator_icon)
                                        <img width="Auto" height="Auto" alt="{{ $package->decorator->decorator_name }}"
                                            src="{{ asset('storage/' . $package->decorator->decorator_icon) }}"
                                            loading="eager">
                                        @endif
                                    </div>
                                    <div class="avatar-text-block">
                                        <h5 class="no-wrap">{{ $package->decorator->decorator_name ?? 'Decorator' }}</h5>
                                        <div class="avatar-line"></div>
                                    </div>
                                </div>
                            </div>
                            <h4>{{ $package->title }}</h4>
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

<x-footer />

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const swipers = document.querySelectorAll('.package-swiper');
    swipers.forEach(swiperElement => {
        new Swiper(swiperElement, {
            loop: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            effect: 'fade',
            fadeEffect: {
                crossFade: true
            },
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
        });
    });

    // Category filtering
    const categories = document.querySelectorAll('.category');
    const packagesList = document.querySelector('.w-dyn-items');
    const storageUrl = '{{ asset("storage") }}';
    const arrowIconUrl = '{{ asset("assets/Images/Icons/66a5f61b61b9f0a48636ca35_arrow_outward.svg") }}';

    categories.forEach(category => {
        category.addEventListener('click', function() {
            const categoryId = this.dataset.categoryId;
            window.location.href = `{{ route('packages.index') }}?category_id=${categoryId}`;
        });
    });
});
</script>

<style>
.swiper {
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
    border-radius: 12px;
}

.swiper-slide {
    width: 100%;
    height: 100%;
    position: relative;
}

.swiper-slide img.image-absolute {
    width: 100%;
    height: 100%;
    object-fit: cover;
    position: absolute;
    top: 0;
    left: 0;
}

.swiper-button-next,
.swiper-button-prev {
    color: #fff;
    background: rgba(0, 0, 0, 0.3);
    width: 35px;
    height: 35px;
    border-radius: 50%;
    transition: all 0.3s ease;
}

.swiper-button-next:hover,
.swiper-button-prev:hover {
    background: rgba(0, 0, 0, 0.5);
    transform: scale(1.1);
}

.swiper-button-next:after,
.swiper-button-prev:after {
    font-size: 15px;
}

.swiper-pagination-bullet {
    background: #fff;
    opacity: 0.7;
}

.swiper-pagination-bullet-active {
    background: var(--primary);
    opacity: 1;
}

.latest-image-wrapper {
    position: relative;
    padding-top: 66.67%;
    overflow: hidden;
    border-radius: 12px;
    background: var(--light-gray);
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
    z-index: 2;
}

.rating-badge svg {
    width: 16px;
    height: 16px;
    fill: var(--black);
}

.posts-card:hover .swiper-button-next,
.posts-card:hover .swiper-button-prev {
    opacity: 1;
}

.swiper-button-next,
.swiper-button-prev {
    opacity: 0;
    transition: all 0.3s ease;
}

.category {
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        padding: 8px 20px;
        border-radius: 30px;
        margin: 0 5px;
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
</style>
<script src="js/jquery-3.5.1.min.dc5e7f18c8.js?site=6706104d4f29e916e4cae2ad" type="text/javascript"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="assets/js/mainScript.js" type="text/javascript"></script>

</body>
</html>