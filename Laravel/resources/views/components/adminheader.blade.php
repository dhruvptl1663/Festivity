
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
                                        <div class="icon"><i class="icon-mail"></i></div>
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
                <div class="button-show-hide">
                    <i class="icon-menu-left"></i>
                </div>
            </div>
            
            <div class="header-grid">
                <div class="user-profile">
                    <div class="profile-container">
                        <div class="profile-card">
                            <div class="profile-avatar">
                                <div class="avatar-initials">
                                    {{ getInitials(Auth::guard('admin')->user()->name) }}
                                </div>
                            </div>
                            <div class="profile-meta">
                                <span class="profile-name">{{ Auth::guard('admin')->user()->name }}</span>
                                <span class="profile-role">Admin</span>
                            </div>
                            <div class="profile-indicator">
                                <i class="fas fa-chevron-down"></i>
                            </div>
</div>
                        <div class="profile-dropdown">
                            <a href="{{ route('admin.profile.edit') }}" class="dropdown-item">
                                <i class="fas fa-user-cog"></i> Edit Profile
                            </a>
                            <form action="{{ route('admin.logout') }}" method="POST" class="logout-form">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="fas fa-sign-out-alt"></i> Log Out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
:root {
    --primary-color: #6366f1;
    --primary-hover: #4f46e5;
    --background-light: #f8fafc;
    --text-dark: #1e293b;
    --text-light: #64748b;
    --shadow-sm: 0 1px 3px rgba(0,0,0,0.12);
    --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.1);
    --transition-fast: all 0.2s ease;
}

.profile-container {
    position: relative;
    margin-left: auto;
}

.profile-card {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 0.75rem 1.25rem;
    border-radius: 12px;
    background: white;
    box-shadow: var(--shadow-sm);
    transition: var(--transition-fast);
    text-decoration: none;
    color: var(--text-dark);
}

.profile-card:hover {
    box-shadow: var(--shadow-md);
    transform: translateY(-1px);
}

.profile-avatar {
    position: relative;
}

.avatar-initials {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--primary-color) 0%, #8b5cf6 100%);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 2.2rem;
}

.profile-meta {
    display: flex;
    flex-direction: column;
    line-height: 1.4;
}

.profile-name {
    font-weight: 600;
    font-size: 1rem;
    color: var(--text-dark);
    line-height: 1.2;
}

.profile-role {
    font-size: 0.85rem;
    color: var(--text-light);
    letter-spacing: 0.5px;
    font-weight: 500;
    margin-top: 0.2rem;
}

.dropdown-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem 1.5rem;
    color: var(--text-dark);
    text-decoration: none;
    font-size: 0.95rem;
    transition: background 0.2s ease;
}

.profile-indicator {
    margin-left: 1rem;
    color: var(--text-light);
    transition: transform 0.2s ease;
}

.profile-card:hover .profile-indicator {
    color: var(--primary-color);
}

.profile-dropdown {
    position: absolute;
    top: 100%;
    right: 0;
    width: 220px;
    background: white;
    border-radius: 8px;
    box-shadow: var(--shadow-md);
    padding: 0.5rem 0;
    margin-top: 0.5rem;
    opacity: 0;
    visibility: hidden;
    transform: translateY(10px);
    transition: var(--transition-fast);
    z-index: 1000;
}

.profile-container:hover .profile-dropdown {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.dropdown-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem 1.5rem;
    color: var(--text-dark);
    text-decoration: none;
    font-size: 1.2rem;
    transition: background 0.2s ease;
}

.dropdown-item:hover {
    background: var(--background-light);
}

.dropdown-item i {
    width: 24px;
    text-align: center;
    color: var(--text-light);
    font-size: 1.1rem;
}

@media (max-width: 768px) {
    .profile-meta {
        display: none;
    }
    
    .profile-card {
        padding: 0.5rem;
    }
    
    .profile-indicator {
        display: none;
    }
    
    .profile-dropdown {
        width: 200px;
        right: -10px;
    }
}
</style>