<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                @if(isset($blogCategory))
                <form action="{{ URL::to('/admin/web/blog-category/' . $blogCategory->id) }}" method="POST" autocomplete="off">
                    @method('PUT')
                @else
                <form action="{{ URL::to('/admin/web/blog-category') }}" method="POST" autocomplete="off">
                @endif
                    @csrf
                    <div class="form-group">
                        <label for="">Nama </label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid                        
                        @enderror" placeholder="Nama Kategori" value="{{ isset($blogCategory)? $blogCategory->name : old('name') }}">
                        @error('name') 
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