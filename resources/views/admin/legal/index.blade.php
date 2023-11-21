@include('sweetalert::alert')

<form action="{{ URL::to('/admin/legal') }}" method="POST" autocomplete="off">
    @method('PUT')
    @csrf
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="">Privacy Policy</label>
            <textarea name="privacy_policy" class="summernote form-control @error('privacy_policy') is-invalid                        
            @enderror">{{ isset($legal)? $legal->privacy_policy :old('privacy_policy') }}</textarea>
            @error('privacy_policy') 
                <div class="invalid-feedback">
                {{ $message }}    
                </div>                   
            @enderror                        
        </div>                 
        <div class="form-group">
            <label for="">Return & Refund Policy</label>
            <textarea name="return_refund_policy" class="summernote form-control @error('return_refund_policy') is-invalid                        
            @enderror">{{ isset($legal)? $legal->return_refund_policy :old('return_refund_policy') }}</textarea>
            @error('return_refund_policy') 
                <div class="invalid-feedback">
                {{ $message }}    
                </div>                   
            @enderror                        
        </div>  
        <div class="form-group">
            <label for="">Terms & Conditions</label>
            <textarea name="terms_conditions" class="summernote form-control @error('terms_conditions') is-invalid                        
            @enderror">{{ isset($legal)? $legal->terms_conditions :old('terms_conditions') }}</textarea>
            @error('terms_conditions') 
                <div class="invalid-feedback">
                {{ $message }}    
                </div>                   
            @enderror                        
        </div> 
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</div>
</form>