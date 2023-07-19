@include('sweetalert::alert')
<form action="{{ URL::to('/admin/schedule'); }}" method="POST" autocomplete="off" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="court_id" value="{{ $court_id }}" />
    <div id="loading" class="display-4 text-center">
        <i class="fa fa-sync fa-spin"></i>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <select name="operational_day_id" id="operational_day_id" class="form-control @error('operational_day_id') is-invalid                        
            @enderror" placeholder="Hari" onchange="reloadPage()">
                    <option value="">--Hari--</option>
                    @foreach ($operationalDays as $operationalDay)
                    <option value="{{ $operationalDay->id }}"
                        {{isset($operational_day_id)? ($operationalDay->id == $operational_day_id? "selected" : ""):old('operational_day_id')  }}>
                        {{ $operationalDay->name }}</option>
                    @endforeach
                </select>
                @error('operational_day_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

        </div>
        <div class="col-md-3">
            @if($operational_day_id)
            <button type="submit" class="btn btn-primary">Simpan</button>
            @endif
            <a href="{{ URL::to('/admin/schedule?court_id=' . $court_id); }}" class="btn btn-warning">Kembali</a>            
        </div>
    </div>
    <div id="schedule" style="display: none">

        @if($operational_day_id)
        <table width="100%">
            <thead>
                <tr class="text-center">
                    <th width="1%" class="bg-dark"></th>                    
                    <th>Jam</th>
                    <th>Harga</th>                       
                    <th>Aktif</th>   
                    <th width="1%" class="bg-dark"></th>
                    <th>Jam</th>
                    <th>Harga</th>                       
                    <th>Aktif</th> 
                    <th width="1%" class="bg-dark"></th>                        
                    <th>Jam</th>
                    <th>Harga</th>                       
                    <th>Aktif</th>    
                    <th width="1%" class="bg-dark"></th>                        
                    <th>Jam</th>
                    <th>Harga</th>                       
                    <th>Aktif</th>           
                    <th width="1%" class="bg-dark"></th>
                </tr>
            </thead>
            <tbody>
                @for($j = 0; $j < 6; $j++)
                <tr class="text-center">
                    <td class="bg-dark"></td>                         
                    <td>
                        <?php $i=0 + $j; ?>
                        {{ $operationalTimes[$i]->name }}
                    </td>
                    <td>
                        <input type="number" class="form-control w-1"
                        name="price_{{ $operationalTimes[$i]->id }}" value="{{ isset($schedules) && count($schedules)>0 ? $schedules[$i]->price : "0"  }}"/>  
                    </td>                      
                    <td>
                        <input type="checkbox"
                        {{ isset($schedules) && count($schedules)>0 ? ($schedules[$i]->is_active == "1"? "checked" : "") : ""  }}
                        name="time_{{ $operationalTimes[$i]->id }}" data-bootstrap-switch data-off-color="danger"
                        data-on-color="success">
                    </td>     
                    <td class="bg-dark"></td>         
                    <td>
                        <?php $i=6 + $j; ?>
                        {{ $operationalTimes[$i]->name }}
                    </td>
                    <td>
                        <input type="number" class="form-control w-1"
                        name="price_{{ $operationalTimes[$i]->id }}" value="{{ isset($schedules) && count($schedules)>0 ? $schedules[$i]->price : "0"  }}"/>  
                    </td>                      
                    <td>
                        <input type="checkbox"
                        {{ isset($schedules) && count($schedules)>0 ? ($schedules[$i]->is_active == "1"? "checked" : "") : ""  }}
                        name="time_{{ $operationalTimes[$i]->id }}" data-bootstrap-switch data-off-color="danger"
                        data-on-color="success">
                    </td>     
                    <td class="bg-dark"></td>                        
                    <td>
                        <?php $i=12 + $j; ?>
                        {{ $operationalTimes[$i]->name }}
                    </td>
                    <td>
                        <input type="number" class="form-control w-1"
                        name="price_{{ $operationalTimes[$i]->id }}" value="{{ isset($schedules) && count($schedules)>0 ? $schedules[$i]->price : "0"  }}"/>  
                    </td>                      
                    <td>
                        <input type="checkbox"
                        {{ isset($schedules) && count($schedules)>0 ? ($schedules[$i]->is_active == "1"? "checked" : "") : ""  }}
                        name="time_{{ $operationalTimes[$i]->id }}" data-bootstrap-switch data-off-color="danger"
                        data-on-color="success">
                    </td>        
                    <td class="bg-dark"></td>                      
                    <td>
                        <?php $i=18 + $j; ?>
                        {{ $operationalTimes[$i]->name }}
                    </td>
                    <td>
                        <input type="number" class="form-control w-1"
                        name="price_{{ $operationalTimes[$i]->id }}" value="{{ isset($schedules) && count($schedules)>0 ? $schedules[$i]->price : "0"  }}"/>  
                    </td>                      
                    <td>
                        <input type="checkbox"
                        {{ isset($schedules) && count($schedules)>0 ? ($schedules[$i]->is_active == "1"? "checked" : "") : ""  }}
                        name="time_{{ $operationalTimes[$i]->id }}" data-bootstrap-switch data-off-color="danger"
                        data-on-color="success">
                    </td>                   
                    <td class="bg-dark"></td>                                   
                </tr>
                @endfor                
            </tbody>
        </table>
        @endif

    </div>
</form>

<script>
window.onload = (event) => {
    var loading = document.getElementById("loading");
    var schedule = document.getElementById("schedule");
    schedule.style.display = "block";
    loading.style.display = "none";
};

function reloadPage() {
    const court_id = <?= $court_id; ?>;

    const operational_day_id = $('select[name="operational_day_id"]').val();
    window.open(window.location.pathname + "?court_id=" + court_id + (operational_day_id ? ('&operational_day_id=' +
        operational_day_id) : ''), '_self');
}
</script>