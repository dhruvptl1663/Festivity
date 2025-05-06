@include('components.header')
@php
use Illuminate\Support\Facades\Storage;
@endphp

<div class="decorator-profile-container" style="margin-top:100px;">
    <div class="decorator-header">
        <div class="decorator-profile-section">
            <div class="decorator-profile-image">
                {{-- Display the actual image path for debugging purposes --}}
                {{-- <div style="font-size: 10px; color: red;">
                    Icon: {{ $decorator->decorator_icon ?? 'null' }}<br>
                    Profile: {{ $decorator->profile_image ?? 'null' }}
                </div> --}}
                
                <img src="{{ $decorator->decorator_icon ? asset('storage/' . $decorator->decorator_icon) : 
                           ($decorator->profile_image ? asset('storage/' . $decorator->profile_image) : 
                            url('https://placehold.co/400x300/lightgray/darkgray?text=No+Image')) }}" 
                     alt="{{ $decorator->decorator_name }}"
                     onerror="this.onerror=null; this.src='{{ url('https://placehold.co/400x300/lightgray/darkgray?text=No+Image') }}'">
            </div>
            <div class="decorator-info">
                <h1>{{ $decorator->decorator_name }}</h1>
                <div class="decorator-rating">
                    <div class="rating-badge">
                        <svg class="rating-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                        </svg>
                        <span>{{ number_format($decorator->rating, 1) }}</span>
                    </div>
                    <span class="rating-count">({{ $totalFeedbacks }} reviews)</span>
                </div>
                <div class="decorator-location">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                        <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10"/>
                        <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                    </svg>
                    <span>{{ $decorator->location }}</span>
                </div>
                <div class="decorator-stats">
                    <div class="stat-item">
                        <span class="stat-number">{{ $totalEvents }}</span>
                        <span class="stat-label">Events</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">{{ $totalPackages }}</span>
                        <span class="stat-label">Packages</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">{{ $completedBookings }}</span>
                        <span class="stat-label">Completed Orders</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="decorator-contact">
            <a href="mailto:{{ $decorator->email }}" class="contact-btn email-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                    <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z"/>
                </svg>
                Email
            </a>
            <a href="tel:{{ $decorator->contact_number }}" class="contact-btn phone-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
                    <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
                </svg>
                Call
            </a>
        </div>
    </div>

    <div class="decorator-about">
        <h2>About {{ $decorator->decorator_name }}</h2>
        <p>{{ $decorator->description }}</p>
    </div>

    <!-- Events Section -->
    <div class="decorator-section">
        <div class="section-header">
            <h2>Events</h2>
            <a href="{{ route('events', ['decorator_id' => $decorator->decorator_id]) }}" class="view-all">View All</a>
        </div>
        
        <div class="events-grid">
            @forelse($events as $event)
                <div class="event-card">
                    <a href="{{ route('eventdetails.show', ['id' => $event->event_id]) }}">
                        <div class="event-image">
                            @if(!empty($event->image))
                                <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" onerror="this.src='{{ url('https://placehold.co/400x300/lightgray/darkgray?text=No+Image') }}'">
                            @else
                                <img src="{{ url('https://placehold.co/400x300/lightgray/darkgray?text=No+Image') }}" alt="{{ $event->title }}">
                            @endif
                            <div class="event-price">₹{{ $event->price }}</div>
                        </div>
                        <div class="event-details">
                            <h3>{{ $event->title }}</h3>
                            <div class="event-rating">
                                <svg class="rating-icon-small" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                                </svg>
                                <span>{{ number_format($event->rating, 1) }}</span>
                                <span class="rating-count">({{ $event->rating_count }})</span>
                            </div>
                            <p class="event-description">{{ Str::limit($event->description, 100) }}</p>
                        </div>
                    </a>
                </div>
            @empty
                <div class="no-items">No events available from this decorator yet.</div>
            @endforelse
        </div>
    </div>

    <!-- Packages Section -->
    <div class="decorator-section">
        <div class="section-header">
            <h2>Packages</h2>
            <a href="{{ route('packages.index', ['decorator_id' => $decorator->decorator_id]) }}" class="view-all">View All</a>
        </div>
        
        <div class="packages-grid">
            @forelse($packages as $package)
                <div class="package-card">
                    <a href="{{ route('packagedetails', ['package' => $package->package_id]) }}">
                        <div class="package-image">
                            @if($package->packageEvents->isNotEmpty() && $package->packageEvents->first()->event->image)
                                <img src="{{ asset('storage/' . $package->packageEvents->first()->event->image) }}" alt="{{ $package->title }}" onerror="this.src='{{ url('https://placehold.co/400x300/lightgray/darkgray?text=No+Image') }}'">
                            @else
                                <img src="{{ url('https://placehold.co/400x300/lightgray/darkgray?text=No+Image') }}" alt="{{ $package->title }}">
                            @endif
                            <div class="package-price">₹{{ $package->price }}</div>
                        </div>
                        <div class="package-details">
                            <h3>{{ $package->title }}</h3>
                            <div class="package-rating">
                                <svg class="rating-icon-small" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                                </svg>
                                <span>{{ number_format($package->rating, 1) }}</span>
                                <span class="rating-count">({{ $package->rating_count }})</span>
                            </div>
                            <p class="package-description">{{ Str::limit($package->description, 100) }}</p>
                            <div class="package-events-count">Includes {{ $package->packageEvents->count() }} events</div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="no-items">No packages available from this decorator yet.</div>
            @endforelse
        </div>
    </div>

    <!-- Feedback Section -->
    <div class="decorator-section">
        <div class="section-header">
            <h2>Customer Feedback</h2>
        </div>
        
        <div class="feedback-container">
            @forelse($feedbacks as $feedback)
                <div class="feedback-card">
                    <div class="feedback-header">
                        <div class="customer-info">
                            <div class="customer-name">{{ $feedback->user->name }}</div>
                            <div class="booking-ref">
                                @if($feedback->event_id)
                                    <a href="{{ route('eventdetails.show', ['id' => $feedback->event_id]) }}">{{ $feedback->event->title }}</a>
                                @elseif($feedback->package_id)
                                    <a href="{{ route('packagedetails', ['package' => $feedback->package_id]) }}">{{ $feedback->package->title }}</a>
                                @endif
                            </div>
                        </div>
                        <div class="feedback-rating">
                            @for($i = 1; $i <= 5; $i++)
                                <svg class="star {{ $i <= $feedback->rating ? 'filled' : '' }}" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                                </svg>
                            @endfor
                        </div>
                    </div>
                    <div class="feedback-content">
                        <p>{{ $feedback->comment }}</p>
                    </div>
                    <div class="feedback-date">
                        {{ $feedback->created_at->format('M d, Y') }}
                    </div>
                </div>
            @empty
                <div class="no-items">No feedback available for this decorator yet.</div>
            @endforelse

            @if($feedbacks->count() > 3 && $totalFeedbacks > $feedbacks->count())
                <div class="view-more-container">
                    <a href="{{ route('decorator.feedbacks', ['id' => $decorator->decorator_id]) }}" class="view-more-btn">View All Feedbacks</a>
                </div>
            @endif
        </div>
    </div>
</div>

<x-footer />

<style>
    .decorator-profile-container {
        max-width: 1200px;
        margin: 80px auto 50px;
        padding: 0 20px;
        font-family: 'Inter', sans-serif;
    }

    .decorator-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 40px;
        flex-wrap: wrap;
        background: linear-gradient(145deg, #ffffff, #f8f9fa);
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    }

    .decorator-profile-section {
        display: flex;
        gap: 30px;
        flex: 1;
        min-width: 300px;
    }

    .decorator-profile-image {
        width: 180px;
        height: 180px;
        border-radius: 50%;
        overflow: hidden;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        border: 5px solid white;
        transition: all 0.3s ease;
    }

    .decorator-profile-image:hover {
        transform: scale(1.03);
    }

    .decorator-profile-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .decorator-info {
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .decorator-info h1 {
        font-size: 32px;
        font-weight: 700;
        margin-bottom: 12px;
        color: #333;
        font-family: 'Inter', sans-serif;
        letter-spacing: -0.5px;
    }

    .decorator-rating {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }

    .rating-badge {
        display: flex;
        align-items: center;
        background: linear-gradient(145deg, #EBFFF0, #DBFFDE);
        padding: 6px 12px;
        border-radius: 30px;
        margin-right: 10px;
        box-shadow: 0 4px 10px rgba(40, 167, 69, 0.15);
    }

    .rating-icon {
        width: 20px;
        height: 20px;
        fill: #28a745;
        margin-right: 5px;
    }

    .rating-icon-small {
        width: 16px;
        height: 16px;
        fill: #28a745;
        margin-right: 3px;
    }

    .rating-count {
        color: #6c757d;
        font-size: 14px;
    }

    .decorator-location {
        display: flex;
        align-items: center;
        margin-bottom: 18px;
        color: #495057;
        font-weight: 500;
    }

    .decorator-location svg {
        margin-right: 8px;
        color: #5D5FEF;
    }

    .decorator-stats {
        display: flex;
        gap: 15px;
        margin-top: 15px;
    }

    .stat-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 14px 18px;
        background: linear-gradient(145deg, #ffffff, #f8f9fa);
        border-radius: 12px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }

    .stat-item:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .stat-number {
        font-size: 20px;
        font-weight: 700;
        color: #212529;
    }

    .stat-label {
        font-size: 14px;
        color: #6c757d;
        margin-top: 4px;
    }

    .decorator-contact {
        display: flex;
        gap: 15px;
        margin-top: 20px;
    }

    .contact-btn {
        display: flex;
        align-items: center;
        padding: 12px 24px;
        border-radius: 30px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        letter-spacing: 0.3px;
    }

    .contact-btn svg {
        margin-right: 10px;
    }

    .email-btn {
        background: linear-gradient(145deg, #EBFFF0, #DBFFDE);
        color: #28a745;
        box-shadow: 0 4px 15px rgba(40, 167, 69, 0.15);
    }

    .phone-btn {
        background: linear-gradient(145deg, #e7f5ff, #d0ebff);
        color: #0d6efd;
        box-shadow: 0 4px 15px rgba(13, 110, 253, 0.15);
    }

    .contact-btn:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .decorator-about {
        background: linear-gradient(145deg, #ffffff, #f8f9fa);
        padding: 35px;
        border-radius: 16px;
        margin-bottom: 40px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    }

    .decorator-about h2 {
        font-size: 26px;
        font-weight: 700;
        margin-bottom: 18px;
        color: #333;
        font-family: 'Inter', sans-serif;
        letter-spacing: -0.5px;
        position: relative;
        padding-bottom: 12px;
    }
    
    .decorator-about h2:after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 0;
        width: 60px;
        height: 4px;
        background: linear-gradient(90deg, #28a745, #5D5FEF);
        border-radius: 2px;
    }

    .decorator-about p {
        color: #495057;
        line-height: 1.7;
        font-size: 15px;
    }

    .decorator-section {
        margin-bottom: 50px;
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .section-header h2 {
        font-size: 26px;
        font-weight: 700;
        color: #333;
        font-family: 'Inter', sans-serif;
        letter-spacing: -0.5px;
        position: relative;
        padding-bottom: 8px;
    }
    
    .section-header h2:after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 0;
        width: 40px;
        height: 3px;
        background: linear-gradient(90deg, #28a745, #5D5FEF);
        border-radius: 2px;
    }

    .view-all {
        color: #5D5FEF;
        font-weight: 600;
        text-decoration: none;
        padding: 8px 16px;
        border-radius: 30px;
        background-color: #f0f1ff;
        transition: all 0.3s ease;
    }
    
    .view-all:hover {
        background-color: #e6e7ff;
        box-shadow: 0 4px 12px rgba(93, 95, 239, 0.15);
    }

    .events-grid, .packages-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 25px;
    }

    .event-card, .package-card {
        background: #ffffff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.07);
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .event-card:hover, .package-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    }

    .event-card a, .package-card a {
        text-decoration: none;
        color: inherit;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .event-image, .package-image {
        position: relative;
        height: 200px;
        overflow: hidden;
    }

    .event-image img, .package-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    
    .event-card:hover .event-image img, 
    .package-card:hover .package-image img {
        transform: scale(1.05);
    }

    .event-price, .package-price {
        position: absolute;
        bottom: 15px;
        right: 15px;
        background: rgba(255, 255, 255, 0.9);
        padding: 6px 14px;
        border-radius: 30px;
        font-weight: 700;
        color: #333;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .event-details, .package-details {
        padding: 20px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .event-details h3, .package-details h3 {
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 12px;
        color: #333;
        line-height: 1.4;
    }

    .event-rating, .package-rating {
        display: flex;
        align-items: center;
        margin-bottom: 12px;
    }

    .event-description, .package-description {
        font-size: 14px;
        color: #495057;
        margin-bottom: 15px;
        line-height: 1.5;
        flex-grow: 1;
    }

    .package-events-count {
        font-size: 13px;
        color: #5D5FEF;
        font-weight: 600;
        padding: 5px 12px;
        background-color: #f0f1ff;
        border-radius: 20px;
        display: inline-block;
        margin-top: auto;
    }

    .feedback-container {
        display: flex;
        flex-direction: column;
        gap: 25px;
    }

    .feedback-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 25px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.07);
        transition: all 0.3s ease;
    }
    
    .feedback-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
    }

    .feedback-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 18px;
    }

    .customer-info {
        display: flex;
        flex-direction: column;
    }

    .customer-name {
        font-weight: 700;
        margin-bottom: 6px;
        color: #333;
    }

    .booking-ref {
        font-size: 13px;
        color: #6c757d;
    }

    .booking-ref a {
        color: #5D5FEF;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.2s ease;
    }
    
    .booking-ref a:hover {
        color: #4648c8;
    }

    .feedback-rating {
        display: flex;
    }

    .star {
        width: 18px;
        height: 18px;
        fill: #e2e2e2;
        margin-right: 3px;
    }

    .star.filled {
        fill: #ffc107;
    }

    .feedback-content {
        margin-bottom: 15px;
        line-height: 1.6;
        color: #495057;
        font-size: 15px;
    }

    .feedback-date {
        text-align: right;
        font-size: 13px;
        color: #6c757d;
        font-weight: 500;
    }

    .view-more-container {
        text-align: center;
        margin-top: 25px;
    }

    .view-more-btn {
        display: inline-block;
        background: linear-gradient(145deg, #f8f9fa, #e9ecef);
        padding: 12px 30px;
        border-radius: 30px;
        color: #333;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .view-more-btn:hover {
        background: linear-gradient(145deg, #f0f1ff, #e6e7ff);
        box-shadow: 0 8px 20px rgba(93, 95, 239, 0.15);
        transform: translateY(-3px);
        color: #5D5FEF;
    }

    .no-items {
        text-align: center;
        padding: 40px;
        background: linear-gradient(145deg, #ffffff, #f8f9fa);
        border-radius: 16px;
        color: #6c757d;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.07);
        font-weight: 500;
    }

    @media (max-width: 768px) {
        .decorator-header {
            flex-direction: column;
            padding: 25px;
        }

        .decorator-profile-section {
            margin-bottom: 25px;
            width: 100%;
        }

        .decorator-stats {
            flex-wrap: wrap;
            justify-content: space-between;
        }
        
        .stat-item {
            width: calc(33% - 10px);
        }

        .events-grid, .packages-grid {
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        }
        
        .event-image, .package-image {
            height: 180px;
        }
    }

    @media (max-width: 576px) {
        .decorator-profile-section {
            flex-direction: column;
            align-items: center;
            text-align: center;
            gap: 20px;
        }

        .decorator-info {
            align-items: center;
        }
        
        .section-header h2:after,
        .decorator-about h2:after {
            left: 50%;
            transform: translateX(-50%);
        }

        .decorator-stats {
            justify-content: center;
            gap: 10px;
        }
        
        .decorator-contact {
            flex-direction: column;
            width: 100%;
        }
        
        .contact-btn {
            width: 100%;
            justify-content: center;
        }
        
        .event-image, .package-image {
            height: 160px;
        }
        
        .decorator-about, 
        .decorator-header {
            padding: 20px;
        }
        
        .decorator-about h2,
        .section-header h2 {
            text-align: center;
        }
        
        .decorator-profile-image {
            width: 150px;
            height: 150px;
        }
        
        .decorator-about p {
            text-align: center;
        }
        
        .section-header {
            flex-direction: column;
            gap: 10px;
        }
    }
</style>
