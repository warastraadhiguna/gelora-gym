<form action="{{ URL::to('/admin/schedule') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
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
        </div>
    </div>
    <div id="schedule" style="display: none">
        <div class="row">
            @if($operational_day_id)
            <div class="col-md-6">
                @for($i = 0; $i < 8; $i++) <?php $operationalTime = $operationalTimes[$i]  ?> <div
                    class="form-group d-flex">
                    <label for="">{{ $operationalTime->name }}</label>
                    <input type="checkbox"
                        {{ isset($schedules) && count($schedules)>0 ? ($schedules[$i]->is_active == "1"? "checked" : "") : ""  }}
                        name="time_{{ $operationalTime->id }}" data-bootstrap-switch data-off-color="danger"
                        data-on-color="success">
                    <input type="number" class="form-control w-1" name="price_{{ $operationalTime->id }}"
                        value="{{ $operationalTime->price }}" />
            </div>
            @endfor
        </div>
        <div class="col-md-2">
            @for($i = 8; $i < 16; $i++) <?php $operationalTime = $operationalTimes[$i]  ?> <div class="form-group">
                <label for="">{{ $operationalTime->name }}</label>
                <input type="checkbox"
                    {{ isset($schedules) && count($schedules)>0 ? ($schedules[$i]->is_active == "1"? "checked" : "") : ""  }}
                    name="time_{{ $operationalTime->id }}" data-bootstrap-switch data-off-color="danger"
                    data-on-color="success">
        </div>
        @endfor
    </div>
    <div class="col-md-2">
        @for($i = 16; $i < 24; $i++) <?php $operationalTime = $operationalTimes[$i]  ?> <div class="form-group">
            <label for="">{{ $operationalTime->name }}</label>
            <input type="checkbox"
                {{ isset($schedules) && count($schedules)>0 ? ($schedules[$i]->is_active == "1"? "checked" : "") : ""  }}
                name="time_{{ $operationalTime->id }}" data-bootstrap-switch data-off-color="danger"
                data-on-color="success">
    </div>
    @endfor
    </div>
    @endif
    </div>
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