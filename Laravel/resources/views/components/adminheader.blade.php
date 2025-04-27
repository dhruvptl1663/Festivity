<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">

<head>
    <title>Festivity</title>
    <meta charset="utf-8">
    <meta name="author" content="themesflat.com">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    
    <!-- Add your admin CSS files -->
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/css/animate.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/css/animation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/font/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/icon/style.css') }}">
    <link href="{{ asset('assets/Images/Brand/icon_logo_small.png') }}" rel="shortcut icon" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/css/sweetalert.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/css/custom.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    @stack('styles')
</head>

<body class="body">
    <div id="wrapper">
        <div id="page" class="">
            <div class="layout-wrap">

                <!-- <div id="preload" class="preload-container">
    <div class="preloading">
        <span></span>
    </div>
</div> -->


                <div class="section-menu-left">
                    <div class="box-logo">
                        <a href="{{ url('/admin') }}">
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
                                    <a href="{{ url('/admin') }}" class="">
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


                                <li class="menu-item has-children">
                                    <a href="javascript:void(0);" class="menu-item-button">
                                        <div class="icon"><i class="icon-file-plus"></i></div>
                                        <div class="text">Orders</div>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="sub-menu-item">
                                            <a href="" class="">
                                                <div class="icon"><i class="icon-file-plus"></i></div>
                                                <div class="text">All Orders</div>
                                            </a>
                                        </li>
                                        <li class="sub-menu-item">
                                            <a href="" class="">
                                                <div class="icon"><i class="icon-map-marker"></i></div>
                                                <div class="text">Order Tracking</div>
                                            </a>
                                        </li>
                                    </ul>
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
                                <a href="index-2.html">
                                    <img class="" id="logo_header_mobile" alt="" src="images/logo/logo.png"
                                        data-light="images/logo/logo.png" data-dark="images/logo/logo.png"
                                        data-width="154px" data-height="52px" data-retina="images/logo/logo.png">
                                </a>
                                <div class="button-show-hide">
                                    <i class="icon-menu-left"></i>
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