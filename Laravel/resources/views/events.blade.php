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


    <div class="category-container">
        @foreach($categories as $category)
            <a href="#" class="category" data-category-id="{{ $category->category_id }}">{{ $category->category_name }}</a>
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
                        <a href="{{ route('events', ['sort' => 'price_high']) }}" class="submenu-link {{ request('sort') == 'price_high' ? 'active' : '' }}">Price: High to Low</a>
                    </div>
                    <div class="submenu-item">
                        <a href="{{ route('events', ['sort' => 'price_low']) }}" class="submenu-link {{ request('sort') == 'price_low' ? 'active' : '' }}">Price: Low to High</a>
                    </div>
                    <div class="submenu-item">
                        <a href="{{ route('events', ['sort' => 'newest']) }}" class="submenu-link {{ request('sort') == 'newest' ? 'active' : '' }}">Newest</a>
                    </div>
                    <div class="submenu-item">
                        <a href="{{ route('events', ['sort' => 'rating']) }}" class="submenu-link {{ request('sort') == 'rating' ? 'active' : '' }}">Customer Review</a>
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
                                href="post/guide-to-keeping-your-home-spotless.html"
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
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const categories = document.querySelectorAll('.category');
    const eventsList = document.querySelector('.w-dyn-items');
    const storageUrl = '{{ asset("storage") }}';
    const arrowIconUrl = '{{ asset("assets/Images/Icons/66a5f61b61b9f0a48636ca35_arrow_outward.svg") }}';

    // Star SVG icon
    const starIcon = `<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
    </svg>`;

    categories.forEach(category => {
        category.addEventListener('click', function(e) {
            e.preventDefault();
            categories.forEach(cat => cat.classList.remove('selected'));
            this.classList.add('selected');

            const categoryId = this.dataset.categoryId;
            eventsList.innerHTML = '<p>Loading events...</p>';

            fetch(`/events/category/${categoryId}`)
                .then(response => response.json())
                .then(events => {
                    if (!events.length) {
                        eventsList.innerHTML = '<p>No events available for this category.</p>';
                        return;
                    }

                    const eventsHtml = events.map(event => `
                        <div role="listitem" class="w-dyn-item">
                            <a href="#" class="posts-card w-inline-block">
                                <div class="latest-image-wrapper">
                                    ${event.rating ? `<div class="rating-badge">${starIcon} ${parseFloat(event.rating).toFixed(1)}</div>` : ''}
                                    <img width="Auto" height="Auto" alt=""
                                         src="${storageUrl}/${event.image}"
                                         loading="eager"
                                         sizes="100vw"
                                         srcset="${storageUrl}/${event.image} 500w, ${storageUrl}/${event.image} 800w, ${storageUrl}/${event.image} 1080w, ${storageUrl}/${event.image} 1152w"
                                         class="image-absolute">
                                    <div class="posts-arrow-wrapper">
                                        <img width="24" height="24" alt=""
                                             src="${arrowIconUrl}"
                                             loading="eager" class="arrow">
                                    </div>
                                </div>
                                <div class="latest-posts-details-flex">
                                    <div class="posts-category-date-flex">
                                        <div class="badge-post">
                                            <h5 class="no-wrap font-black">${event.category.category_name}</h5>
                                        </div>
                                        <h5 class="no-wrap">₹${parseInt(event.price)}</h5>
                                    </div>
                                    <div class="horizontal-line"></div>
                                    <div class="posts-avatar-flex">
                                        <div class="avatar-wrapper">
                                            <img width="Auto" height="Auto" alt=""
                                                 src="${storageUrl}/${event.decorator.decorator_icon}"
                                                 loading="eager">
                                        </div>
                                        <div class="avatar-text-block">
                                            <h5 class="no-wrap">${event.decorator.decorator_name}</h5>
                                        </div>
                                    </div>
                                </div>
                                <h4>${event.title}</h4>
                            </a>
                        </div>
                    `).join('');

                    eventsList.innerHTML = eventsHtml;
                })
                .catch(error => {
                    console.error('Error:', error);
                    eventsList.innerHTML = '<p>Error loading events.</p>';
                });
        });
    });
});
</script>

<script src="js/jquery-3.5.1.min.dc5e7f18c8.js?site=6706104d4f29e916e4cae2ad" type="text/javascript"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="assets/js/mainScript.js" type="text/javascript"></script>

</body>

</html>
