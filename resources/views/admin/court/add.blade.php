@if(isset($court))
<form action="{{ URL::to('/admin/court/' . $court->id); }}" method="POST" autocomplete="off" enctype="multipart/form-data">
    @method('PUT')
@else
<form action="{{ URL::to('/admin/court'); }}" method="POST" autocomplete="off" enctype="multipart/form-data">
@endif
    @csrf
<input type="hidden" name="building_id" value="{{ $building_id }}"/>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="">Kode Lapangan</label>
            <input type="text" name="code" id="code" class="form-control @error('code') is-invalid                        
            @enderror" placeholder="Kode Lapangan" value="{{ isset($court)? $court->code : old('code') }}">
            @error('code') 
                <div class="invalid-feedback">
                {{ $message }}    
                </div>                   
            @enderror
        </div>      
        <div class="form-group">
            <label for="">Catatan</label>
            <input type="text" name="note" id="note" class="form-control @error('note') is-invalid                        
            @enderror" placeholder="Catatan" value="{{ isset($court)? $court->note : old('note') }}">
            @error('note') 
                <div class="invalid-feedback">
                {{ $message }}    
                </div>                   
            @enderror
        </div>             
        <div class="form-group">
            <label for="">Gambar</label>
            <input type="file" name="image_url" id="image_url" class="form-control @error('image_url') is-invalid                        
            @enderror" placeholder="Gambar" value={{ isset($court)? $court->image_url :old('image_url') }}>
            @error('image_url') 
                <div class="invalid-feedback">
                {{ $message }}    
                </div>                   
            @enderror        
            
            @if(isset($court))
                <img src="{{ URL::to('storage/' .$court->image_url); }}"  width="20%" alt="">
            @endif
        </div>               
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>

    <div class="col-md-6">        
        <div class="form-group">
            <label for="">Nama Lapangan</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid                        
            @enderror" placeholder="Nama Lapangan" value="{{ isset($court)? $court->name : old('name') }}">
            @error('name') 
                <div class="invalid-feedback">
                {{ $message }}    
                </div>                   
            @enderror
        </div>          
        <div class="form-group">
            <label for="">Informasi Harga</label>
            <input type="text" name="price" id="price" class="form-control @error('price') is-invalid                        
            @enderror" value="{{ isset($court)? $court->price : old('price') }}">
            @error('price') 
                <div class="invalid-feedback">
                {{ $message }}    
                </div>                   
            @enderror
        </div>       
            <div class="form-group">
                <label for="">Status</label>
                <select name="is_active" id="is_active" class="form-control @error('is_active') is-invalid                        
                @enderror">
                    <option value="1" {{ isset($court)? ("1" == $court->is_active?"selected" : ""):"selected"  }}>Aktif</option>
                    <option value="0" {{  isset($court)? ("0" == $court->is_active?"selected" : ""):""  }}>Non Aktif</option>
                </select>
                @error('is_active') 
                    <div class="invalid-feedback">
                    {{ $message }}    
                    </div>                   
                @enderror
            </div>             
    </div>
</div>
</form>