<form action="{{ URL::to('/admin/weekly-booking'); }}" method="POST" autocomplete="off" enctype="multipart/form-data">
    @csrf
<input type="hidden" name="court_id" value="{{ $court_id }}"/>
<div class="row">
    @if($operational_day_id)

        @for($i = 0; $i < count($schedules); $i++)
        @if($i%6 == 0)            
        <div class="col-md-2">     
        @endif   
            <?php $schedule = $schedules[$i]  ?>
            <div class="form-group">
                <label for="">{{ $schedule->operationalTime->name }}</label>        
                <input type="checkbox" name="time_{{ $schedule->id }}"  data-bootstrap-switch data-off-color="danger" data-on-color="success">
            </div>
        @if($i%6 == 5 || $i == count($schedules)-1)
        </div>              
        @endif         
        @endfor
    @endif    
    <div class="col-md-4">    
        <div class="form-group">
            <select name="operational_day_id" id="operational_day_id" class="form-control @error('operational_day_id') is-invalid                        
            @enderror" placeholder="Hari"  onchange="reloadPage()">
                <option value="">--Hari--</option>
                @foreach ($operationalDays as $operationalDay)
                    <option value="{{ $operationalDay->id }}" 
                        {{isset($operational_day_id)? ($operationalDay->id == $operational_day_id? "selected" : ""):old('operational_day_id')  }}>{{ $operationalDay->name }}</option>
                @endforeach
            </select>
            @error('operational_day_id') 
                <div class="invalid-feedback">
                {{ $message }}    
                </div>                   
            @enderror
        </div>         
        @if($operational_day_id)
        <div class="form-group">
            <select name="user_id" id="user_id" class="form-control select2bs4 @error('user_id') is-invalid                        
            @enderror" placeholder="Member">
                <option value="">--Member--</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" 
                        {{ old('user_id')  }}>{{ $user->name }}({{ $user->phone }})
                    </option>
                @endforeach
            </select>
            @error('user_id') 
                <div class="invalid-feedback">
                {{ $message }}    
                </div>                   
            @enderror
        </div>           
        <button type="submit" class="btn btn-primary">Simpan</button>               
        @endif
    </div>          
</div>

</form>

<script>
  function reloadPage(){
    const court_id = <?= $court_id; ?>;

    const operational_day_id = $('select[name="operational_day_id"]').val();
    window.open(window.location.pathname + "?court_id=" + court_id + (operational_day_id? ('&operational_day_id=' + operational_day_id) : ''), '_self');
  }
</script>