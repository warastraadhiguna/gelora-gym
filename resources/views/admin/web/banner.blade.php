@include('sweetalert::alert')

<form action="{{ URL::to('/admin/web/banner/' . $company->id) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
    @method('PUT')
    @csrf    
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="">Banner</label>
            <input type="file" name="banner_url" id="banner_url" class="form-control @error('banner_url') is-invalid                        
            @enderror" placeholder="Banner" value={{ isset($company)? $company->banner_url :old('banner_url') }}>
            @error('banner_url') 
                <div class="invalid-feedback">
                {{ $message }}    
                </div>                   
            @enderror        
            
            @if(isset($company))
                <img src="{{ URL::to('storage/' .$company->banner_url) }}"  width="20%" alt="">
            @endif
        </div>    
    </div>
</div>
<button type="submit" class="btn btn-primary">Simpan</button>  
</form>