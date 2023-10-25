@if(isset($question))
<form action="{{ URL::to('/admin/web/question/' . $question->id) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
    @method('PUT')
@else
<form action="{{ URL::to('/admin/web/question') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
@endif
    @csrf
<div class="row">
    <div class="col-md-6">
            <div class="form-group">
                <label for="">Pertanyaan</label>
                <input type="text" name="question" id="question" class="form-control @error('question') is-invalid                        
                @enderror" placeholder="Pertanyaan" value="{{ isset($question)? $question->question : old('question') }}">
                @error('question') 
                    <div class="invalid-feedback">
                    {{ $message }}    
                    </div>                   
                @enderror
            </div>  
            <div class="form-group">
                <label for="">Jawaban</label>
                <textarea name="answer" id="answer" class="form-control @error('answer') is-invalid                        
                @enderror">{{ isset($question)? $question->answer :old('answer') }}</textarea>
                @error('answer') 
                    <div class="invalid-feedback">
                    {{ $message }}    
                    </div>                   
                @enderror                        
            </div>         
            <div class="form-group">
                <label for="">Urutan</label>
                <input type="number" name="index" id="index" class="form-control @error('index') is-invalid                        
                @enderror" placeholder="Urutan" value="{{ isset($question)? $question->index : old('index') }}">
                @error('index') 
                    <div class="invalid-feedback">
                    {{ $message }}    
                    </div>                   
                @enderror
            </div>              
            <div class="form-group">
                <label for="">Status</label>
                <select name="is_published" id="is_published" class="form-control @error('is_published') is-invalid                        
                @enderror">
                    <option value="1" {{ isset($question)? ("1" == $question->is_published?"selected" : ""):"selected"  }}>Publikasi</option>
                    <option value="0" {{  isset($question)? ("0" == $question->is_published?"selected" : ""):""  }}>Non Publikasi</option>
                </select>
                @error('is_published') 
                    <div class="invalid-feedback">
                    {{ $message }}    
                    </div>                   
                @enderror
            </div>                

            <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</div>
</form>