<!-- Page Content -->
<div class="content">
    <div class="container-fluid">
        
        <div class="row m-5">
            <div class="col-md-8 offset-md-2">
                
                <!-- Login Tab Content -->
                <div class="account-content">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-md-7 col-lg-6 login-left">
                            <img src="{{ URL::to('/img/login.png'); }}" class="img-fluid" alt="Login">	
                        </div>
                        <div class="col-md-12 col-lg-6 login-right">
                            <div class="login-header">
                                <h3>Login <span>{{ $company->name }}</span></h3>
                            </div>
                            @if(session()->has("loginError"))
                            <div class="alert alert-danger">
                                {{ session("loginError") }}
                            </div>                        
                            @endif

                            <form action="{{ URL::to('/login/do'); }}" method="POST" autocomplete="off">
                                @csrf
                                {{-- <div class="form-group form-focus">
                                    <input type="text"  name="username" class="form-control floating @error('username') is-invalid @enderror">
                                    <label class="focus-label">Username</label>
                                    @error('username') 
                                        <div class="invalid-feedback">
                                        {{ $message }}    
                                        </div>                   
                                    @enderror       
                                </div>
                                <div class="form-group form-focus">
                                    <input type="password" name="password" class="form-control floating @error('password') is-invalid @enderror">
                                    <label class="focus-label">Password</label>
                                    @error('password') 
                                            <div class="invalid-feedback">
                                            {{ $message }}    
                                            </div>                   
                                    @enderror      
                                </div>
                                <button class="btn btn-danger w-100 btn-lg login-btn" type="submit">Login</button>
                                <div class="login-or">
                                    <span class="or-line"></span>
                                    <span class="span-or">atau</span>
                                </div> --}}
                                <div class="row form-row social-login">
                                    <div class="col-12">
                                        <a href="{{ url('authorized/google') }}" class="btn btn-dark w-100"><i class="fab fa-google me-1"></i>Google Login</a>
                                    </div>
                                </div>
                                <div class="text-center dont-have">Belum punya akun? <a class="link-danger" href="{{ url('authorized/google') }}">Registrasi menggunakan Google</a></div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /Login Tab Content -->
                    
            </div>
        </div>

    </div>

</div>		
<!-- /Page Content -->