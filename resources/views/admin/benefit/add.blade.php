<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                @if(isset($benefit))
                <form action="{{ URL::to('/admin/web/benefit/' . $benefit->id); }}" method="POST" autocomplete="off" enctype="multipart/form-data">
                    @method('PUT')
                @else
                <form action="{{ URL::to('/admin/web/benefit'); }}" method="POST" autocomplete="off" enctype="multipart/form-data">
                @endif
                    @csrf
                    <div class="form-group">
                        <label for="">Judul </label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid                        
                        @enderror" placeholder="Judul" value="{{ isset($benefit)? $benefit->name : old('name') }}">
                        @error('name') 
                            <div class="invalid-feedback">
                            {{ $message }}    
                            </div>                   
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Catatan </label>
                        <textarea name="note" id="note" class="form-control @error('note') is-invalid                        
                        @enderror">{{ isset($benefit)? $benefit->note : old('note') }}</textarea>
                        @error('note') 
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