@if(isset($building))
<form action="{{ URL::to('/admin/building/' . $building->id) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
    @method('PUT')
@else
<form action="{{ URL::to('/admin/building') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
@endif
    @csrf
<div class="row">
    <div class="col-md-6">
            <div class="form-group">
                <label for="">Jenis Bangunan</label>
                <select name="type_id" id="type_id" class="form-control @error('type_id') is-invalid                        
                @enderror" placeholder="Title" value="{{ isset($building)? $building->title : old('type_id') }}">
                    <option value="">--Jenis--</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}" {{isset($building)? ($type->id == $building->type_id?"selected" : ""):old('type_id')  }}>{{ $type->name }}</option>
                    @endforeach
                </select>
                @error('type_id') 
                    <div class="invalid-feedback">
                    {{ $message }}    
                    </div>                   
                @enderror
            </div>           
        
            <div class="form-group">
                <label for="">Nama Bangunan</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid                        
                @enderror" placeholder="Nama Bangunan" value="{{ isset($building)? $building->name : old('name') }}">
                @error('name') 
                    <div class="invalid-feedback">
                    {{ $message }}    
                    </div>                   
                @enderror
            </div>  
            <div class="form-group">
                <label for="">Alamat</label>
                <textarea name="address" id="address" class="form-control @error('address') is-invalid                        
                @enderror">{{ isset($building)? $building->address :old('address') }}</textarea>
                @error('address') 
                    <div class="invalid-feedback">
                    {{ $message }}    
                    </div>                   
                @enderror                        
            </div>     
            <div class="form-group">
                <label for="">Jam Operasional (ex: Senin~07:00 - 19:00;Selasa~07:00 - 19:00)</label>
                <textarea name="operational_times" id="operational_times" class="form-control @error('operational_times') is-invalid                        
                @enderror">{{ isset($building)? $building->operational_times :old('operational_times') }}</textarea>
                @error('operational_times') 
                    <div class="invalid-feedback">
                    {{ $message }}    
                    </div>                   
                @enderror                        
            </div>            
            <div class="form-group">
                <label for="">Google Maps</label>
                <input type="text" name="google_location_url" id="google_location_url" class="form-control @error('google_location_url') is-invalid                        
                @enderror" placeholder="URL Google Maps" value="{{ isset($building)? $building->google_location_url : old('google_location_url') }}">
                @error('google_location_url') 
                    <div class="invalid-feedback">
                    {{ $message }}    
                    </div>                   
                @enderror
            </div>         
            <div class="form-group">
                <label for="">Status Booking</label>
                <select name="is_bookable" id="is_bookable" class="form-control @error('is_bookable') is-invalid                        
                @enderror">
                    <option value="1" {{ isset($building)? ("1" == $building->is_bookable?"selected" : ""):"selected"  }}>Bisa dibooking</option>
                    <option value="0" {{  isset($building)? ("0" == $building->is_bookable?"selected" : ""):""  }}>Tidak bisa dibooking</option>
                </select>
                @error('is_bookable') 
                    <div class="invalid-feedback">
                    {{ $message }}    
                    </div>                   
                @enderror
            </div>                        
            <div class="form-group">
                <label for="">Gambar</label>
                <input type="file" name="image_url" id="image_url" class="form-control @error('image_url') is-invalid                        
                @enderror" placeholder="Gambar" value={{ isset($building)? $building->image_url :old('image_url') }}>
                @error('image_url') 
                    <div class="invalid-feedback">
                    {{ $message }}    
                    </div>                   
                @enderror        
                
                @if(isset($building))
                    <img src="{{ URL::to('storage/' .$building->image_url) }}"  width="20%" alt="">
                @endif
            </div>               
            <button type="submit" class="btn btn-primary">Simpan</button>
    </div>

    <div class="col-md-6">        
        <div class="form-group">
            <label for="">Kode Bangunan</label>
            <input type="text" name="code" id="code" class="form-control @error('code') is-invalid                        
            @enderror" placeholder="Kode Bangunan" value="{{ isset($building)? $building->code : old('code') }}">
            @error('code') 
                <div class="invalid-feedback">
                {{ $message }}    
                </div>                   
            @enderror
        </div>          
        <div class="form-group">
            <label for="">Telpon</label>
            <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid                        
            @enderror" placeholder="Telpon" value="{{ isset($building)? $building->phone : old('phone') }}">
            @error('phone') 
                <div class="invalid-feedback">
                {{ $message }}    
                </div>                   
            @enderror
        </div>          
        <div class="form-group">
            <label for="">Catatan</label>
            <textarea name="note" id="note" class="form-control @error('note') is-invalid                        
            @enderror">{{ isset($building)? $building->note :old('note') }}</textarea>
            @error('note') 
                <div class="invalid-feedback">
                {{ $message }}    
                </div>                   
            @enderror                        
        </div>  

        <div class="form-group">
            <label for="">Fasilitas (ex: Kamar Mandi;Jakuzi;Parkiran)</label>
            <textarea name="facilities" id="facilities" class="form-control @error('facilities') is-invalid                        
            @enderror">{{ isset($building)? $building->facilities :old('facilities') }}</textarea>
            @error('facilities') 
                <div class="invalid-feedback">
                {{ $message }}    
                </div>                   
            @enderror                        
        </div>    
        <div class="form-group">
            <label for="">Bintang</label>
            <input type="text" name="star" id="star" class="form-control @error('star') is-invalid                        
            @enderror" placeholder="Bintang" value="{{ isset($building)? $building->star : old('star') }}">
            @error('star') 
                <div class="invalid-feedback">
                {{ $message }}    
                </div>                   
            @enderror
        </div>           
        <div class="form-group">
            <label for="">Status</label>
            <select name="is_active" id="is_active" class="form-control @error('is_active') is-invalid                        
            @enderror">
                <option value="1" {{ isset($building)? ("1" == $building->is_active?"selected" : ""):"selected"  }}>Aktif</option>
                <option value="0" {{  isset($building)? ("0" == $building->is_active?"selected" : ""):""  }}>Non Aktif</option>
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