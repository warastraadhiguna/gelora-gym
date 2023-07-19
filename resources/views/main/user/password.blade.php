@include('sweetalert::alert')
<div class="breadcrumb-bar">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-12 col-12">
                <nav aria-label="breadcrumb" class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Ubah Password</li>
                    </ol>
                </nav>
                <h2 class="breadcrumb-title">Ubah Password</h2>
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
                        <div class="row">
                            <div class="col-md-12 col-lg-6">
                                    <form action="{{ URL::to('/password'); }}" method="POST" autocomplete="off">
                                    @method('PUT')
                                    @csrf
                                    <div class="form-group">
                                        <label>Password Lama</label>
                                        <input name="oldPassword" type="password" class="form-control @error('oldPassword') is-invalid                        
                                        @enderror">
                                        @error('oldPassword') 
                                            <div class="invalid-feedback">
                                            {{ $message }}    
                                            </div>                   
                                        @enderror            
                                    </div>
                                    <div class="form-group">
                                        <label>Password Baru</label>
                                        <input name="password"  type="password" class="form-control @error('password') is-invalid                        
                                        @enderror">
                                        @error('password') 
                                            <div class="invalid-feedback">
                                            {{ $message }}    
                                            </div>                   
                                        @enderror         
                                    </div>
                                    <div class="form-group">
                                        <label>Konfirmasi Password Baru</label>
                                        <input name="repassword" type="password" class="form-control @error('repassword') is-invalid                        
                                        @enderror">
                                        @error('repassword') 
                                            <div class="invalid-feedback">
                                            {{ $message }}    
                                            </div>                   
                                        @enderror          
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
    </div>
</div>