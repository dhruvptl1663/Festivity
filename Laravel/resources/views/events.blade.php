﻿<x-header/>

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
        <a href="#" class="category">Haldi</a>
        <a href="#" class="category">Baby Shower</a>
        <a href="#" class="category">Birthday</a>
        <a href="#" class="category">Mehdi</a>
        <a href="#" class="category">Wedding</a>

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
                        <a href="#" class="submenu-link">Price: High to Low</a>
                    </div>
                    <div class="submenu-item">
                        <a href="#" class="submenu-link">Price: Low to High</a>
                    </div>
                    <div class="submenu-item">
                        <a href="#" class="submenu-link">Newest</a>
                    </div>
                    <div class="submenu-item">
                        <a href="#" class="submenu-link">Customer Review</a>
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
                                <div class="latest-image-wrapper"><img width="Auto" height="Auto" alt=""
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
                                        <h5 class="no-wrap">{{ $event->price }}</h5>
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

<script src="js/jquery-3.5.1.min.dc5e7f18c8.js?site=6706104d4f29e916e4cae2ad" type="text/javascript"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="assets/js/mainScript.js" type="text/javascript"></script>
</body>

</html>
