			<!-- Header -->
			<header class="header">
				<nav class="navbar navbar-expand-lg header-nav">
					<div class="navbar-header">
						<a id="mobile_btn" href="javascript:void(0);">
							<span class="bar-icon">
								<span></span>
								<span></span>
								<span></span>
							</span>
						</a>
						<a href="{{ URL::to('/') }}" class="navbar-brand logo">
							<img src="{{ URL::to('/storage') }}/{{ $company->logo_url  }}" class="img-fluid" alt="Logo">
						</a>
					</div>
					<div class="main-menu-wrapper">
						<div class="menu-header">
							<a href="{{ URL::to('/') }}" class="menu-logo">
								<img src="{{ URL::to('/storage') }}/{{ $company->logo_url  }}" class="img-fluid" alt="Logo">
							</a>
							<a id="menu_close" class="menu-close" href="javascript:void(0);">
								<i class="fas fa-times"></i>
							</a>
						</div>
						<ul class="main-nav">
							<li class="{{ Request::is('/')? 'active' : '' }}">
								<a href="{{ URL::to('/') }}">Home</a>
							</li>
							{{-- <li class="has-submenu">
								<a href="">Doctors <i class="fas fa-chevron-down"></i></a>
								<ul class="submenu">
									<li><a href="doctor-dashboard.html">Doctor Dashboard</a></li>
									<li><a href="appointments.html">Appointments</a></li>
								</ul>
							</li>	 --}}
							<li class="{{ Request::is('building*')? 'active' : '' }}">
								<a href="{{ URL::to('/building') }}">Pilih Gedung</a>
							</li>							
							<li class="{{ Request::is('blog*')? 'active' : '' }}">
								<a href="{{ URL::to('/blog') }}">Blog</a>
							</li>
							<li class="login-link">
								<a href="{{ URL::to('/login') }}">Login</a>
							</li>
						</ul>		 
					</div>		 
					<ul class="nav header-navbar-rht">
						<li class="nav-item contact-item">
							<div class="header-contact-img">
								<i class="fas fa-phone-square-alt"></i>							
							</div>
							<div class="header-contact-detail">
								<p class="contact-header">Contact</p>
								<p class="contact-info-header">{{ $company->phone }}</p>
							</div>
						</li>

						@if(auth()->check())
						<!-- User Menu -->
						<li class="nav-item dropdown has-arrow logged-item">
							<a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
								<span class="user-img">
									<img class="rounded-circle" src="{{ GetPhotoProfile() }}" width="31" alt="User">
								</span>
							</a>
								<div class="dropdown-menu dropdown-menu-end">
								<div class="user-header">
									<div class="avatar avatar-sm">
										<img src="{{ GetPhotoProfile() }}" alt="User Image" class="avatar-img rounded-circle">
									</div>
									<div class="user-text">
										<h6>{{ auth()->user()->name }}</h6>
										<p class="text-muted mb-0">{{ auth()->user()->role }}</p>
									</div>
								</div>
								<a class="dropdown-item" href="{{ auth()->user()->role== "user"? URL::to('/dashboard') : URL::to('admin/dashboard')  }}">Dashboard</a>
								<a class="dropdown-item" href="{{ URL::to('/logout') }}">Logout</a>
								</div>
						</li>
						<!-- /User Menu -->		
						@else
						<li class="nav-item">
							<a class="nav-link header-login" href="{{ URL::to('/login') }}">Login</a>
						</li>
						@endif										
					</ul>
				</nav>
			</header>
			<!-- /Header -->