@include('sweetalert::alert')
<div class="breadcrumb-bar">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-12 col-12">
                <nav aria-label="breadcrumb" class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Profile Settings</li>
                    </ol>
                </nav>
                <h2 class="breadcrumb-title">Profile Settings</h2>
            </div>
        </div>
    </div>
</div>


<div class="content">
    <div class="container-fluid">
        <div class="row">

            @include('main.user.menu')

            <div class="col-md-7 col-lg-8 col-xl-9">
                <div class="card">
                    <div class="card-body">

                        <form action="{{ URL::to('/profile'); }}" method="POST" autocomplete="off" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                            <div class="row form-row">
                                <div class="col-12 col-md-12">
                                    <div class="form-group">
                                        <div class="change-avatar">
                                            <div class="profile-img">
                                                <img src="{{ GetPhotoProfile(); }}" alt="User Image">
                                            </div>
                                            <div class="upload-img">
                                                <div class="change-photo-btn">
                                                    <span><i class="fa fa-upload"></i> Unggah Foto</span>
                                                    <input name="image_url" type="file" class="upload">
                                                </div>
                                                <small class="form-text text-muted">Hanya JPG, GIF atau PNG. Ukuran maksimal
                                                    2MB</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid                        
                                        @enderror" placeholder="Nama" value="{{ auth()->user()->name }}">
                                        @error('name') 
                                            <div class="invalid-feedback">
                                            {{ $message }}    
                                            </div>                   
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" name="username" id="username" class="form-control @error('username') is-invalid                        
                                        @enderror" placeholder="Username" value="{{ auth()->user()->username }}">
                                        @error('username') 
                                            <div class="invalid-feedback">
                                            {{ $message }}    
                                            </div>                   
                                        @enderror  
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid                        
                                        @enderror" placeholder="Email" value="{{ auth()->user()->email }}" {{ auth()->user()->google_id? "readonly" : "" }}>
                                        @error('email') 
                                            <div class="invalid-feedback">
                                            {{ $message }}    
                                            </div>                   
                                        @enderror  
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Telepon</label>
                                        <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid                        
                                        @enderror" placeholder="Telepon" value="{{ auth()->user()->phone }}">
                                        @error('phone') 
                                            <div class="invalid-feedback">
                                            {{ $message }}    
                                            </div>                   
                                        @enderror  
                                    </div>
                                </div>
                            </div>
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Simpan</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>