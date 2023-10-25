<div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
    <div class="profile-sidebar">
        <div class="widget-profile pro-widget-content">
            <div class="profile-info-widget">
                <a href="#" class="booking-doc-img">
                    <img src="{{ GetPhotoProfile() }}" alt="User Image">
                </a>
                <div class="profile-det-info">
                    <h3>{{ auth()->user()->name }}</h3>
                    <div class="patient-details">
                        <h5 class="mb-0"> 
                            @if(auth()->user()->role === "user")
                            {{ auth()->user()->role }}
                            @else
                            <a href="{{ URL::to('/admin/dashboard') }}">
                                <u>{{ auth()->user()->role }}</u>
                            </a>
                            @endif
                        </h5>
                    </div>                    
                </div>
            </div>
        </div>
        <div class="dashboard-widget">
            <nav class="dashboard-menu">
                <ul>
                    <li class="{{ Request::is('dashboard')? 'active' : '' }}">
                        <a href="{{ URL::to('/dashboard') }}">
                            <i class="fas fa-columns"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('profile')? 'active' : '' }}">
                        <a href="{{ URL::to('/profile') }}">
                            <i class="fas fa-user-cog"></i>
                            <span>Ubah Profil</span>
                        </a>
                    </li>
                    @if(!auth()->user()->google_id )
                    <li class="{{ Request::is('password')? 'active' : '' }}">
                        <a href="{{ URL::to('/password') }}">
                            <i class="fas fa-lock"></i>
                            <span>Ubah Password</span>
                        </a>
                    </li>                        
                    @endif
                    <li>
                        <a href="{{ URL::to('/logout') }}">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Logout</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>