@include('sweetalert::alert')

<form action="{{ URL::to('/admin/company/' . $company->id) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
    @method('PUT')
    @csrf    
<div class="row">
    <div class="col-md-6">
            <div class="form-group">
                <label for="">Nama</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid                        
                @enderror" placeholder="Nama Perusahaan" value="{{ isset($company)? $company->name : old('name') }}">
                @error('name') 
                    <div class="invalid-feedback">
                    {{ $message }}    
                    </div>                   
                @enderror
            </div>
            <div class="form-group">
                <label for="">Alamat</label>
                <textarea name="address" id="address" class="form-control @error('address') is-invalid                        
                @enderror" placeholder="Alamat">{{ isset($company)? $company->address : old('address') }}</textarea>
                @error('address') 
                    <div class="invalid-feedback">
                    {{ $message }}    
                    </div>                   
                @enderror
            </div>          
           
            <div class="form-group">
                <label for="">Kota</label>
                <input type="text" name="city" id="city" class="form-control @error('city') is-invalid                        
                @enderror" placeholder="Kota" value="{{ isset($company)? $company->city : old('city') }}">
                @error('city') 
                    <div class="invalid-feedback">
                    {{ $message }}    
                    </div>                   
                @enderror
            </div>               
        <div class="form-group">
            <label for="">Email</label>
            <input type="text" type="email" id="email" class="form-control @error('email') is-invalid                        
            @enderror" placeholder="Email" value="{{ isset($company)? $company->email : old('email') }}">
            @error('email') 
                <div class="invalid-feedback">
                {{ $message }}    
                </div>                   
            @enderror
        </div>  
            <div class="form-group">
                <label for="">Gambar</label>
                <input type="file" name="logo_url" id="logo_url" class="form-control @error('logo_url') is-invalid                        
                @enderror" placeholder="Gambar" value={{ isset($company)? $company->logo_url :old('logo_url') }}>
                @error('logo_url') 
                    <div class="invalid-feedback">
                    {{ $message }}    
                    </div>                   
                @enderror        
                
                @if(isset($company))
                    <img src="{{ URL::to('storage/' .$company->logo_url) }}"  width="20%" alt="">
                @endif
            </div>    
    </div>

    <div class="col-md-6"> 
        <div class="form-group">
            <label for="">Tagline</label>
            <input type="text" name="tagline" id="tagline" class="form-control @error('tagline') is-invalid                        
            @enderror" placeholder="Tagline" value="{{ isset($company)? $company->tagline : old('tagline') }}">
            @error('tagline') 
                <div class="invalid-feedback">
                {{ $message }}    
                </div>                   
            @enderror
        </div>              
        <div class="form-group">
            <label for="">Catatan</label>
            <textarea name="note" id="note" class="form-control @error('note') is-invalid                        
            @enderror" placeholder="Catatan">{{ isset($company)? $company->note : old('note') }}</textarea>
            @error('note') 
                <div class="invalid-feedback">
                {{ $message }}    
                </div>                   
            @enderror
        </div>     
        <div class="form-group">
            <label for="">Telpon</label>
            <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid                        
            @enderror" placeholder="Telpon" value="{{ isset($company)? $company->phone : old('phone') }}">
            @error('phone') 
                <div class="invalid-feedback">
                {{ $message }}    
                </div>                   
            @enderror
        </div>   
        <div class="form-group">
            <label for="">Icon</label>
            <input type="file" name="icon_url" id="icon_url" class="form-control @error('icon_url') is-invalid                        
            @enderror" placeholder="Icon" value={{ isset($company)? $company->icon_url :old('icon_url') }}>
            @error('icon_url') 
                <div class="invalid-feedback">
                {{ $message }}    
                </div>                   
            @enderror        
            
            @if(isset($company))
                <img src="{{ URL::to('storage/' .$company->icon_url) }}"  width="20%" alt="">
            @endif
        </div> 
    </div>
</div>
<button type="submit" class="btn btn-primary">Simpan</button>  
</form>