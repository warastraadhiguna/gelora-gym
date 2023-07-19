@include('sweetalert::alert')

<form action="{{ URL::to('/admin/social-media/' . $company->id); }}" method="POST" autocomplete="off" enctype="multipart/form-data">
    @method('PUT')
    @csrf    
<div class="row">
    <div class="col-md-6">
            <div class="form-group">
                <label for="">Instagram</label>
                <input type="text" name="instagram" id="instagram" class="form-control @error('instagram') is-invalid                        
                @enderror" placeholder="Instagram" value="{{ isset($company)? $company->instagram : old('instagram') }}">
                @error('instagram') 
                    <div class="invalid-feedback">
                    {{ $message }}    
                    </div>                   
                @enderror
            </div>     
            <div class="form-group">
                <label for="">Youtube</label>
                <input type="text" name="youtube" id="youtube" class="form-control @error('youtube') is-invalid                        
                @enderror" placeholder="Youtube" value="{{ isset($company)? $company->youtube : old('youtube') }}">
                @error('youtube') 
                    <div class="invalid-feedback">
                    {{ $message }}    
                    </div>                   
                @enderror
            </div> 
    </div>

    <div class="col-md-6"> 
        <div class="form-group">
            <label for="">Facebook</label>
            <input type="text" name="facebook" id="facebook" class="form-control @error('facebook') is-invalid                        
            @enderror" placeholder="Facebook" value="{{ isset($company)? $company->facebook : old('facebook') }}">
            @error('facebook') 
                <div class="invalid-feedback">
                {{ $message }}    
                </div>                   
            @enderror
        </div>     
        <div class="form-group">
            <label for="">Google Map</label>
            <input type="text" name="google_map" id="google_map" class="form-control @error('google_map') is-invalid                        
            @enderror" placeholder="Google Map" value="{{ isset($company)? $company->google_map : old('google_map') }}">
            @error('google_map') 
                <div class="invalid-feedback">
                {{ $message }}    
                </div>                   
            @enderror
        </div>             
    </div>
</div>
{{-- < ?php echo  $company->google_map;?> --}}
<button type="submit" class="btn btn-primary">Simpan</button>  
</form>