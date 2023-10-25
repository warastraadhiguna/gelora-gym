@if(isset($blog))
<form action="{{ URL::to('/admin/web/blog/' . $blog->id) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
    @method('PUT')
@else
<form action="{{ URL::to('/admin/web/blog') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
@endif
    @csrf
<div class="row">
    <div class="col-md-6">
            <div class="form-group">
                <label for="">Kategori</label>
                <select name="blog_category_id" id="blog_category_id" class="form-control @error('blog_category_id') is-invalid                        
                @enderror" value="{{ isset($blog)? $blog->title : old('blog_category_id') }}">
                    <option value="">--Kategori--</option>
                    @foreach ($blogCategories as $blogCategory)
                        <option value="{{ $blogCategory->id }}" {{isset($blog)? ($blogCategory->id == $blog->blog_category_id?"selected" : ""):old('blog_category_id')  }}>{{ $blogCategory->name }}</option>
                    @endforeach
                </select>
                @error('blog_category_id') 
                    <div class="invalid-feedback">
                    {{ $message }}    
                    </div>                   
                @enderror
            </div>           
        
            <div class="form-group">
                <label for="">Judul</label>
                <input type="text" name="title" id="title" class="form-control @error('title') is-invalid                        
                @enderror" placeholder="Judul" value="{{ isset($blog)? $blog->title : old('title') }}">
                @error('title') 
                    <div class="invalid-feedback">
                    {{ $message }}    
                    </div>                   
                @enderror
            </div>  
            <div class="form-group">
                <label for="">Ringkasan</label>
                <textarea name="summary" id="summary" class="form-control @error('summary') is-invalid                        
                @enderror">{{ isset($blog)? $blog->summary :old('summary') }}</textarea>
                @error('summary') 
                    <div class="invalid-feedback">
                    {{ $message }}    
                    </div>                   
                @enderror                        
            </div>         
            <div class="form-group">
                <label for="">Status</label>
                <select name="is_published" id="is_published" class="form-control @error('is_published') is-invalid                        
                @enderror">
                    <option value="1" {{ isset($blog)? ("1" == $blog->is_published?"selected" : ""):"selected"  }}>Publikasi</option>
                    <option value="0" {{  isset($blog)? ("0" == $blog->is_published?"selected" : ""):""  }}>Non Publikasi</option>
                </select>
                @error('is_published') 
                    <div class="invalid-feedback">
                    {{ $message }}    
                    </div>                   
                @enderror
            </div>                
            
            <div class="form-group">
                <label for="">Gambar Depan (377 x 291)</label>
                <input type="file" name="image_url" id="image_url" class="form-control @error('image_url') is-invalid                        
                @enderror" placeholder="Gambar" value={{ isset($blog)? $blog->image_url :old('image_url') }}>
                @error('image_url') 
                    <div class="invalid-feedback">
                    {{ $message }}    
                    </div>                   
                @enderror        
                
                @if(isset($blog))
                    <img src="{{ URL::to('storage/' .$blog->image_url) }}"  width="20%" alt="">
                @endif
            </div>               
            <button type="submit" class="btn btn-primary">Simpan</button>
    </div>

    <div class="col-md-6">        
        <div class="form-group">
            <label for="">Konten</label>
            <textarea name="contain" id="summernote" class="form-control @error('contain') is-invalid                        
            @enderror">{{ isset($blog)? $blog->contain :old('contain') }}</textarea>
            @error('contain') 
                <div class="invalid-feedback">
                {{ $message }}    
                </div>                   
            @enderror                        
        </div>           
    </div>
</div>
</form>