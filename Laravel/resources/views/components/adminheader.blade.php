<!-- Admin Sidebar and Header Component -->

                <!-- <div id="preload" class="preload-container">
    <div class="preloading">
        <span></span>
    </div>
</div> -->


                <div class="section-menu-left">
                    <div class="box-logo">
                        <a href="{{ route('admin.dashboard') }}">
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
                            <div class="center-heading">Main Home</div>
                            <ul class="menu-list">
                                <li class="menu-item">
                                    <a href="{{ route('admin.dashboard') }}" class="">
                                        <div class="icon"><i class="icon-grid"></i></div>
                                        <div class="text">Dashboard</div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="center-item">
                        

                            <ul class="menu-list">

                                <li class="menu-item">
                                    <a href="{{ route('admin.events.index') }}" class="">
                                        <div class="icon"><i class="icon-calendar"></i></div>
                                        <div class="text">Events</div>
                                    </a>
                                </li>
                                
                                <li class="menu-item">
                                    <a href="{{ route('admin.packages.index') }}" class="">
                                        <div class="icon"><i class="icon-box"></i></div>
                                        <div class="text">Packages</div>
                                    </a>
                                </li>

                                <li class="menu-item">
                                    <a href="{{ route('admin.bookings.index') }}" class="">
                                        <div class="icon"><i class="icon-file-plus"></i></div>
                                        <div class="text">Orders</div>
                                    </a>
                                </li>

                                

                                <li class="menu-item has-children">
                                    <a href="javascript:void(0);" class="menu-item-button">
                                        <div class="icon"><i class="icon-user"></i></div>
                                        <div class="text">Users</div>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="sub-menu-item">
                                            <a href="{{ route('admin.users.index') }}" class="">
                                                <div class="text">View Users</div>
                                            </a>
                                        </li>
                                        <li class="sub-menu-item">
                                            <a href="{{ route('admin.users.create') }}" class="">
                                                <div class="text">Add User</div>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="menu-item has-children">
                                    <a href="javascript:void(0);" class="menu-item-button">
                                        <div class="icon"><i class="icon-user"></i></div>
                                        <div class="text">Decorators</div>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="sub-menu-item">
                                            <a href="{{ route('admin.decorators.index') }}" class="">
                                                <div class="icon"><i class="icon-users"></i></div>
                                                <div class="text">All Decorators</div>
                                            </a>
                                        </li>
                                        <li class="sub-menu-item">
                                            <a href="{{ route('admin.decorators.create') }}" class="">
                                                <div class="icon"><i class="icon-plus"></i></div>
                                                <div class="text">Add New</div>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="menu-item has-children">
                                    <a href="javascript:void(0);" class="menu-item-button">
                                        <div class="icon"><i class="icon-user"></i></div>
                                        <div class="text">Admin</div>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="sub-menu-item">
                                            <a href="{{ route('admin.admins.index') }}" class="">
                                                <div class="text">View Admins</div>
                                            </a>
                                        </li>
                                        <li class="sub-menu-item">
                                            <a href="{{ route('admin.admins.create') }}" class="">
                                                <div class="text">Add Admin</div>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="menu-item">
                                    <a href="{{ route('admin.coupon.index') }}" class="">
                                        <div class="icon"><i class="icon-tag"></i></div>
                                        <div class="text">Coupons</div>
                                    </a>
                                </li>

                                <li class="menu-item has-children">
                                    <a href="javascript:void(0);" class="menu-item-button">
                                        <div class="icon"><i class="icon-bell"></i></div>
                                        <div class="text">Notifications</div>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="sub-menu-item">
                                            <a href="{{ route('admin.notifications.index') }}" class="">
                                                <div class="text">All Notifications</div>
                                            </a>
                                        </li>
                                        <li class="sub-menu-item">
                                            <a href="{{ route('admin.notifications.create') }}" class="">
                                                <div class="text">Send Notification</div>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="menu-item">
                                    <a href="{{ route('admin.contacts.index') }}" class="">
                                        <div class="icon"><i class="icon-envelope"></i></div>
                                        <div class="text">Contact Messages</div>
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
                <a href="{{ route('admin.dashboard') }}">
                    <img class="" id="logo_header_mobile" alt="Festivity Logo" src="{{ asset('assets/Images/Brand/main_logo_small.png') }}"
                        data-width="154px" data-height="52px">
                </a>
                <div class="button-show-hide">
                    <i class="icon-menu-left"></i>
                </div>
            </div>
            <div class="header-right">
                <div class="dropdown">
                    <button class="btn dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="icon-user mr-2"></i> {{ auth()->user()->name ?? 'Admin' }}
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
                            <div class="header-grid">
                                
                                <div class="popup-wrap user type-header">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-expanded="false">
                                            <span class="header-user wg-user">
                                                <span class="image">
                                                    <img src="dashboard/images/avatar/user-1.png" alt="">
                                                </span>
                                                <span class="flex flex-column">
                                                    <span class="body-title mb-2">Festivity</span>
                                                    <span class="text-tiny">Admin</span>
                                                </span>
                                            </span>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end has-content"
                                            aria-labelledby="dropdownMenuButton3">
                                            
                                            <li>
                                            <form method="POST" action="{{ route('logout') }}" class="d-inline" style="margin-left: 100px;">
                    @csrf
                    <button type="submit" class="dropdown-item">
                        {{ __('Logout') }}
                    </button>
                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>