<!-- Decorator Sidebar and Header Component -->

<div class="section-menu-left">
    <div class="box-logo">
        <a href="{{ route('decorator.dashboard') }}">
            <img width="auto" height="auto" alt="Logo" 
            src="{{ asset('assets/Images/Brand/main_logo_small.png') }}" 
            loading="eager" class="logo" style="height:45px;">
        </a>
        <div class="button-show-hide">
            <i class="icon-menu-left"></i>
        </div>
    </div>
    <div class="center">
        <div class="center-item">
            <div class="center-heading">Main Menu</div>
            <ul class="menu-list">
                <li class="menu-item">
                    <a href="{{ route('decorator.dashboard') }}" class="">
                        <div class="icon"><i class="icon-grid"></i></div>
                        <div class="text">Dashboard</div>
                    </a>
                </li>
            </ul>
        </div>
        <div class="center-item">
            <div class="center-heading">Manage Content</div>
            <ul class="menu-list">
                <li class="menu-item">
                    <a href="{{ route('decorator.events') }}" class="">
                        <div class="icon"><i class="icon-calendar"></i></div>
                        <div class="text">Events</div>
                    </a>
                </li>
                
                <li class="menu-item">
                    <a href="{{ route('decorator.packages') }}" class="">
                        <div class="icon"><i class="icon-box"></i></div>
                        <div class="text">Packages</div>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="{{ route('decorator.bookings') }}" class="">
                        <div class="icon"><i class="icon-file-plus"></i></div>
                        <div class="text">Bookings</div>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="{{ route('decorator.feedbacks') }}" class="">
                        <div class="icon"><i class="icon-star"></i></div>
                        <div class="text">Feedbacks</div>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="{{ route('decorator.profile') }}" class="">
                        <div class="icon"><i class="icon-user"></i></div>
                        <div class="text">My Profile</div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="section-content-right">
    <div class="header-dashboard">
        <div class="wrap">
            <div class="header-left">
                <a href="{{ route('decorator.dashboard') }}">
                    <img class="" id="logo_header_mobile" alt="Festivity Logo" src="{{ asset('assets/Images/Brand/main_logo_small.png') }}"
                        data-width="154px" data-height="52px">
                </a>
                <div class="button-show-hide">
                    <i class="icon-menu-left"></i>
                </div>
            </div>
            
        </div>
    </div>