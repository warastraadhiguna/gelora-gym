<!-- Header -->
<header class="header header-fixed header-one">
    <div class="container">
        <nav class="navbar navbar-expand-lg header-nav">
            <div class="navbar-header">
                <a id="mobile_btn" href="javascript:void(0);">
                    <span class="bar-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </a>
                <a href="{{ URL::to('/'); }}" class="navbar-brand logo">
                    <img src="{{ URL::to('/storage'); }}/{{ $company->logo_url  }}" class="img-fluid" alt="Logo">
                </a>
            </div>
            <div class="main-menu-wrapper">
                <div class="menu-header">
                    <a href="{{ URL::to('/'); }}" class="menu-logo">
                        <img src="{{ URL::to('/storage'); }}/{{ $company->logo_url  }}" class="img-fluid" alt="Logo">
                    </a>
                    <a id="menu_close" class="menu-close" href="javascript:void(0);">
                        <i class="fas fa-times"></i>
                    </a>
                </div>
                <ul class="main-nav">
                    <li class="{{ Request::is('/')? 'active' : '' }}">
                        <a href="{{ URL::to('/'); }}">Home</a>
                    </li>
                    {{-- <li class="has-submenu active">
                        <a href="javascript:void(0);">Patients <i class="fas fa-chevron-down"></i></a>
                        <ul class="submenu">
                            <li class="has-submenu">
                                <a href="javascript:void(0);">Doctors</a>
                                <ul class="submenu inner-submenu">
                                    <li><a href="map-grid.html">Map Grid</a></li>
                                    <li><a href="map-list.html">Map List</a></li>
                                </ul>
                            </li>
                            <li class="has-submenu">
                                <a href="javascript:void(0);">Search Doctor</a>
                                <ul class="submenu inner-submenu">
                                    <li><a href="search.html">Search Doctor 1</a></li>
                                    <li><a href="search-2.html">Search Doctor 2</a></li>
                                </ul>
                            </li>
                            <li class="active"><a href="doctor-profile.html">Doctor Profile</a></li>
                            <li class="has-submenu">
                                <a href="javascript:void(0);">Booking</a>
                                <ul class="submenu inner-submenu">
                                    <li><a href="booking.html">Booking 1</a></li>
                                    <li><a href="booking-2.html">Booking 2</a></li>
                                </ul>
                            </li>
                            <li><a href="checkout.html">Checkout</a></li>
                            <li><a href="booking-success.html">Booking Success</a></li>
                            <li><a href="patient-dashboard.html">Patient Dashboard</a></li>
                            <li><a href="favourites.html">Favourites</a></li>
                            <li><a href="chat.html">Chat</a></li>
                            <li><a href="profile-settings.html">Profile Settings</a></li>
                            <li><a href="change-password.html">Change Password</a></li>
                        </ul>
                    </li> --}}
                    <li class="{{ Request::is('building*')? 'active' : '' }}">
                        <a href="{{ URL::to('/building'); }}">Pilih Olahraga</a>
                    </li>							
                    <li class="{{ Request::is('blog*')? 'active' : '' }}">
                        <a href="{{ URL::to('/blog'); }}">Artikel</a>
                    </li>
					@if(auth()->check())                    
                    <li class="has-submenu login-link">
                        <a href="">User <i class="fas fa-chevron-down"></i></a>
                        <ul class="submenu">
                            <li>
                                <a href="{{ auth()->user()->role== "user"? URL::to('/dashboard') : URL::to('admin/dashboard') ; }}">Dashboard</a></li>
                            <li>
                                <a href="{{ URL::to('/logout'); }}">Logout</a>
                            </li> 
                        </ul>
                    </li>                    
                    @endif	              
                </ul>
            </div>
            <ul class="nav header-navbar-rht">
					@if(auth()->check())
                    <!-- User Menu -->
                    <li class="nav-item dropdown has-arrow logged-item">
                        <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                            <span class="user-img">
                                <img class="rounded-circle" src="{{ GetPhotoProfile(); }}" width="31" alt="{{ auth()->user()->name }}">
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <div class="user-header">
                                <div class="avatar avatar-sm">
                                    <img src="{{ GetPhotoProfile(); }}" alt="User Image" class="avatar-img rounded-circle">
                                </div>
                                <div class="user-text">
                                    <h6>{{ auth()->user()->name }}</h6>
                                    <p class="text-muted mb-0">{{ auth()->user()->role }}</p>
                                </div>
                            </div>
                            <a class="dropdown-item" href="{{ auth()->user()->role== "user"? URL::to('/dashboard') : URL::to('admin/dashboard') ; }}">Dashboard</a>
                            <a class="dropdown-item" href="{{ URL::to('/logout'); }}">Logout</a>
                        </div>
                    </li>
                    <!-- /User Menu -->
					@else
                    <li class="register-btn">
                        <a href="{{ URL::to('/login'); }}" class="btn btn-danger log-btn"><i class="feather-lock"></i>Login</a>
                    </li>
                    @endif	
                
            </ul>
        </nav>
    </div>
</header>
<!-- /Header -->