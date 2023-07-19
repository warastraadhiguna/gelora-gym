<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                @if(isset($type))
                <form action="{{ URL::to('/admin/building/type/' . $type->id); }}" method="POST" autocomplete="off" enctype="multipart/form-data">
                    @method('PUT')
                @else
                <form action="{{ URL::to('/admin/building/type'); }}" method="POST" autocomplete="off" enctype="multipart/form-data">
                @endif
                    @csrf
                    <div class="form-group">
                        <label for="">Jenis </label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid                        
                        @enderror" placeholder="Jenis Gedung" value="{{ isset($type)? $type->name : old('name') }}">
                        @error('name') 
                            <div class="invalid-feedback">
                            {{ $message }}    
                            </div>                   
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Gambar</label>
                        <input type="file" name="image_url" id="image_url" class="form-control @error('image_url') is-invalid                        
                        @enderror" placeholder="Gambar" value={{ isset($type)? $type->image_url :old('image_url') }}>
                        @error('image_url') 
                            <div class="invalid-feedback">
                            {{ $message }}    
                            </div>                   
                        @enderror        
                        
                        @if(isset($type))
                            <img src="{{ URL::to('storage/' .$type->image_url); }}"  width="20%" alt="">
                        @endif
                    </div>                        

                    <div class="form-group">
                        <label for="">Index</label>
                        <input type="number" name="index" id="index" class="form-control @error('index') is-invalid                        
                        @enderror" value="{{ isset($type)? $type->index : old('index') }}">
                        @error('index') 
                            <div class="invalid-feedback">
                            {{ $message }}    
                            </div>                   
                        @enderror
                    </div>  

                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>