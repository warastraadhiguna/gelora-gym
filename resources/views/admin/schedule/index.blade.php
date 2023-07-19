@include('sweetalert::alert')

<div class="row">
    <div class="col">
        <a href="{{ URL::to('/admin/schedule/create?court_id=') . $court_id; }}" id="add-button"
            style="visibility: {{ $court_id? 'visible' : 'hidden' }}" class="btn btn-primary mb-3"><i
                class="fas fa-plus" aria-hidden="true"></i> Tambah/Ubah</a>
    </div>
    <div class="col-3">
        <select name="court_id" id="court_id" class="form-control" placeholder="Title" onchange="reloadPage()">
            <option value="">--Lapangan--</option>
            @foreach ($courts as $court)
            <option value="{{ $court->id }}" {{$court->id == $court_id? "selected" : ""  }}>{{ $court->name }}</option>
            @endforeach
        </select>
    </div>
</div>
<div id="loading" class="display-4 text-center"> 
    <i class="fa fa-sync fa-spin"></i>
</div>
<div  id="schedule" style="display: none">
    <table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th width="5%">No</th>
            <th>Hari</th>
            <th colspan="4" class="text-center">Jadwal</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="align-middle">1</td>
            <td class="align-middle">Senin</td>
            @if(count($mondaySchedules) > 0)
            <td>
                @for($i = 0; $i < 6; $i++) <?php $mondaySchedule = $mondaySchedules[$i]  ?> <div class="row">
                    {{ $mondaySchedule->operationalTime->name }}
                    <input type="checkbox" {{ $mondaySchedule->is_active == "1"? "checked" : "" }} data-bootstrap-switch
                        data-off-color="danger" data-on-color="success" readonly>
                    (Rp. {{ NumberFormat($mondaySchedule->price) }})
                    </div>
                    @endfor
            </td>
            <td>
                @for($i = 6; $i < 12; $i++) <?php $mondaySchedule = $mondaySchedules[$i]  ?> <div class="row">
                    {{ $mondaySchedule->operationalTime->name }}
                    <input type="checkbox" {{ $mondaySchedule->is_active == "1"? "checked" : "" }} data-bootstrap-switch
                        data-off-color="danger" data-on-color="success" readonly>
                    (Rp. {{ NumberFormat($mondaySchedule->price) }})
                    </div>
                    @endfor
            </td>
            <td>
                @for($i = 12; $i < 18; $i++) <?php $mondaySchedule = $mondaySchedules[$i]  ?> <div class="row">
                    {{ $mondaySchedule->operationalTime->name }}
                    <input type="checkbox" {{ $mondaySchedule->is_active == "1"? "checked" : "" }} data-bootstrap-switch
                        data-off-color="danger" data-on-color="success" readonly>
                    (Rp. {{ NumberFormat($mondaySchedule->price) }})
                    </div>
                    @endfor
            </td>
            <td>
                @for($i = 18; $i < 24; $i++) <?php $mondaySchedule = $mondaySchedules[$i]  ?> <div class="row">
                    {{ $mondaySchedule->operationalTime->name }}
                    <input type="checkbox" {{ $mondaySchedule->is_active == "1"? "checked" : "" }} data-bootstrap-switch
                        data-off-color="danger" data-on-color="success" readonly>
                    (Rp. {{ NumberFormat($mondaySchedule->price) }})
                    </div>
                    @endfor
            </td>
            @else
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            @endif

        </tr>
        <tr>
            <td class="align-middle">2</td>
            <td class="align-middle">Selasa</td>
            @if(count($tuesdaySchedules) > 0)
            <td>
                @for($i = 0; $i < 6; $i++) <?php $tuesdaySchedule = $tuesdaySchedules[$i]  ?> <div class="row">
                    {{ $tuesdaySchedule->operationalTime->name }}
                    <input type="checkbox" {{ $tuesdaySchedule->is_active == "1"? "checked" : "" }}
                        data-bootstrap-switch data-off-color="danger" data-on-color="success" readonly>
                    (Rp. {{ NumberFormat($tuesdaySchedule->price) }})
                    </div>
                    @endfor
            </td>
            <td>
                @for($i = 6; $i < 12; $i++) <?php $tuesdaySchedule = $tuesdaySchedules[$i]  ?> <div class="row">
                    {{ $tuesdaySchedule->operationalTime->name }}
                    <input type="checkbox" {{ $tuesdaySchedule->is_active == "1"? "checked" : "" }}
                        data-bootstrap-switch data-off-color="danger" data-on-color="success" readonly>
                    (Rp. {{ NumberFormat($tuesdaySchedule->price) }})
                    </div>
                    @endfor
            </td>
            <td>
                @for($i = 12; $i < 18; $i++) <?php $tuesdaySchedule = $tuesdaySchedules[$i]  ?> <div class="row">
                    {{ $tuesdaySchedule->operationalTime->name }}
                    <input type="checkbox" {{ $tuesdaySchedule->is_active == "1"? "checked" : "" }}
                        data-bootstrap-switch data-off-color="danger" data-on-color="success" readonly>
                    (Rp. {{ NumberFormat($tuesdaySchedule->price) }})
                    </div>
                    @endfor
            </td>
            <td>
                @for($i = 18; $i < 24; $i++) <?php $tuesdaySchedule = $tuesdaySchedules[$i]  ?> <div class="row">
                    {{ $tuesdaySchedule->operationalTime->name }}
                    <input type="checkbox" {{ $tuesdaySchedule->is_active == "1"? "checked" : "" }}
                        data-bootstrap-switch data-off-color="danger" data-on-color="success" readonly>
                    (Rp. {{ NumberFormat($tuesdaySchedule->price) }})
                    </div>
                    @endfor
            </td>
            @else
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            @endif

        </tr>
        <tr>
            <td class="align-middle">3</td>
            <td class="align-middle">Rabu</td>
            @if(count($wednesdaySchedules) > 0)
            <td>
                @for($i = 0; $i < 6; $i++) <?php $wednesdaySchedule = $wednesdaySchedules[$i]  ?> <div class="row">
                    {{ $wednesdaySchedule->operationalTime->name }}
                    <input type="checkbox" {{ $wednesdaySchedule->is_active == "1"? "checked" : "" }}
                        data-bootstrap-switch data-off-color="danger" data-on-color="success" readonly>
                    (Rp. {{ NumberFormat($wednesdaySchedule->price) }})
                    </div>
                    @endfor
            </td>
            <td>
                @for($i = 6; $i < 12; $i++) <?php $wednesdaySchedule = $wednesdaySchedules[$i]  ?> <div class="row">
                    {{ $wednesdaySchedule->operationalTime->name }}
                    <input type="checkbox" {{ $wednesdaySchedule->is_active == "1"? "checked" : "" }}
                        data-bootstrap-switch data-off-color="danger" data-on-color="success" readonly>
                    (Rp. {{ NumberFormat($wednesdaySchedule->price) }})
                    </div>
                    @endfor
            </td>
            <td>
                @for($i = 12; $i < 18; $i++) <?php $wednesdaySchedule = $wednesdaySchedules[$i]  ?> <div class="row">
                    {{ $wednesdaySchedule->operationalTime->name }}
                    <input type="checkbox" {{ $wednesdaySchedule->is_active == "1"? "checked" : "" }}
                        data-bootstrap-switch data-off-color="danger" data-on-color="success" readonly>
                    (Rp. {{ NumberFormat($wednesdaySchedule->price) }})
                    </div>
                    @endfor
            </td>
            <td>
                @for($i = 18; $i < 24; $i++) <?php $wednesdaySchedule = $wednesdaySchedules[$i]  ?> <div class="row">
                    {{ $wednesdaySchedule->operationalTime->name }}
                    <input type="checkbox" {{ $wednesdaySchedule->is_active == "1"? "checked" : "" }}
                        data-bootstrap-switch data-off-color="danger" data-on-color="success" readonly>
                    (Rp. {{ NumberFormat($wednesdaySchedule->price) }})
                    </div>
                    @endfor
            </td>
            @else
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            @endif

        </tr>
        <tr>
            <td class="align-middle">4</td>
            <td class="align-middle">Kamis</td>
            @if(count($thursdaySchedules) > 0)
            <td>
                @for($i = 0; $i < 6; $i++) <?php $thursdaySchedule = $thursdaySchedules[$i]  ?> <div class="row">
                    {{ $thursdaySchedule->operationalTime->name }}
                    <input type="checkbox" {{ $thursdaySchedule->is_active == "1"? "checked" : "" }}
                        data-bootstrap-switch data-off-color="danger" data-on-color="success" readonly>
                    (Rp. {{ NumberFormat($thursdaySchedule->price) }})
                    </div>
                    @endfor
            </td>
            <td>
                @for($i = 6; $i < 12; $i++) <?php $thursdaySchedule = $thursdaySchedules[$i]  ?> <div class="row">
                    {{ $thursdaySchedule->operationalTime->name }}
                    <input type="checkbox" {{ $thursdaySchedule->is_active == "1"? "checked" : "" }}
                        data-bootstrap-switch data-off-color="danger" data-on-color="success" readonly>
                    (Rp. {{ NumberFormat($thursdaySchedule->price) }})
                    </div>
                    @endfor
            </td>
            <td>
                @for($i = 12; $i < 18; $i++) <?php $thursdaySchedule = $thursdaySchedules[$i]  ?> <div class="row">
                    {{ $thursdaySchedule->operationalTime->name }}
                    <input type="checkbox" {{ $thursdaySchedule->is_active == "1"? "checked" : "" }}
                        data-bootstrap-switch data-off-color="danger" data-on-color="success" readonly>
                    (Rp. {{ NumberFormat($thursdaySchedule->price) }})
                    </div>
                    @endfor
            </td>
            <td>
                @for($i = 18; $i < 24; $i++) <?php $thursdaySchedule = $thursdaySchedules[$i]  ?> <div class="row">
                    {{ $thursdaySchedule->operationalTime->name }}
                    <input type="checkbox" {{ $thursdaySchedule->is_active == "1"? "checked" : "" }}
                        data-bootstrap-switch data-off-color="danger" data-on-color="success" readonly>
                    (Rp. {{ NumberFormat($thursdaySchedule->price) }})
                    </div>
                    @endfor
            </td>
            @else
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            @endif

        </tr>
        <tr>
            <td class="align-middle">5</td>
            <td class="align-middle">Jumat</td>
            @if(count($fridaySchedules) > 0)
            <td>
                @for($i = 0; $i < 6; $i++) <?php $fridaySchedule = $fridaySchedules[$i]  ?> <div class="row">
                    {{ $fridaySchedule->operationalTime->name }}
                    <input type="checkbox" {{ $fridaySchedule->is_active == "1"? "checked" : "" }} data-bootstrap-switch
                        data-off-color="danger" data-on-color="success" readonly>
                    (Rp. {{ NumberFormat($fridaySchedule->price) }})
                    </div>
                    @endfor
            </td>
            <td>
                @for($i = 6; $i < 12; $i++) <?php $fridaySchedule = $fridaySchedules[$i]  ?> <div class="row">
                    {{ $fridaySchedule->operationalTime->name }}
                    <input type="checkbox" {{ $fridaySchedule->is_active == "1"? "checked" : "" }} data-bootstrap-switch
                        data-off-color="danger" data-on-color="success" readonly>
                    (Rp. {{ NumberFormat($fridaySchedule->price) }})
                    </div>
                    @endfor
            </td>
            <td>
                @for($i = 12; $i < 18; $i++) <?php $fridaySchedule = $fridaySchedules[$i]  ?> <div class="row">
                    {{ $fridaySchedule->operationalTime->name }}
                    <input type="checkbox" {{ $fridaySchedule->is_active == "1"? "checked" : "" }} data-bootstrap-switch
                        data-off-color="danger" data-on-color="success" readonly>
                    (Rp. {{ NumberFormat($fridaySchedule->price) }})
                    </div>
                    @endfor
            </td>
            <td>
                @for($i = 18; $i < 24; $i++) <?php $fridaySchedule = $fridaySchedules[$i]  ?> <div class="row">
                    {{ $fridaySchedule->operationalTime->name }}
                    <input type="checkbox" {{ $fridaySchedule->is_active == "1"? "checked" : "" }} data-bootstrap-switch
                        data-off-color="danger" data-on-color="success" readonly>
                    (Rp. {{ NumberFormat($fridaySchedule->price) }})
                    </div>
                    @endfor
            </td>
            @else
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            @endif

        </tr>
        <tr>
            <td class="align-middle">6</td>
            <td class="align-middle">Sabtu</td>
            @if(count($saturdaySchedules) > 0)
            <td>
                @for($i = 0; $i < 6; $i++) <?php $saturdaySchedule = $saturdaySchedules[$i]  ?> <div class="row">
                    {{ $saturdaySchedule->operationalTime->name }}
                    <input type="checkbox" {{ $saturdaySchedule->is_active == "1"? "checked" : "" }}
                        data-bootstrap-switch data-off-color="danger" data-on-color="success" readonly>
                    (Rp. {{ NumberFormat($saturdaySchedule->price) }})
                    </div>
                    @endfor
            </td>
            <td>
                @for($i = 6; $i < 12; $i++) <?php $saturdaySchedule = $saturdaySchedules[$i]  ?> <div class="row">
                    {{ $saturdaySchedule->operationalTime->name }}
                    <input type="checkbox" {{ $saturdaySchedule->is_active == "1"? "checked" : "" }}
                        data-bootstrap-switch data-off-color="danger" data-on-color="success" readonly>
                    (Rp. {{ NumberFormat($saturdaySchedule->price) }})
                    </div>
                    @endfor
            </td>
            <td>
                @for($i = 12; $i < 18; $i++) <?php $saturdaySchedule = $saturdaySchedules[$i]  ?> <div class="row">
                    {{ $saturdaySchedule->operationalTime->name }}
                    <input type="checkbox" {{ $saturdaySchedule->is_active == "1"? "checked" : "" }}
                        data-bootstrap-switch data-off-color="danger" data-on-color="success" readonly>
                    (Rp. {{ NumberFormat($saturdaySchedule->price) }})
                    </div>
                    @endfor
            </td>
            <td>
                @for($i = 18; $i < 24; $i++) <?php $saturdaySchedule = $saturdaySchedules[$i]  ?> <div class="row">
                    {{ $saturdaySchedule->operationalTime->name }}
                    <input type="checkbox" {{ $saturdaySchedule->is_active == "1"? "checked" : "" }}
                        data-bootstrap-switch data-off-color="danger" data-on-color="success" readonly>
                    (Rp. {{ NumberFormat($saturdaySchedule->price) }})
                    </div>
                    @endfor
            </td>
            @else
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            @endif

        </tr>
        <tr>
            <td class="align-middle">7</td>
            <td class="align-middle">Minggu</td>
            @if(count($sundaySchedules) > 0)
            <td>
                @for($i = 0; $i < 6; $i++) <?php $sundaySchedule = $sundaySchedules[$i]  ?> <div class="row">
                    {{ $sundaySchedule->operationalTime->name }}
                    <input type="checkbox" {{ $sundaySchedule->is_active == "1"? "checked" : "" }} data-bootstrap-switch
                        data-off-color="danger" data-on-color="success" readonly>
                    (Rp. {{ NumberFormat($sundaySchedule->price) }})
                    </div>
                    @endfor
            </td>
            <td>
                @for($i = 6; $i < 12; $i++) <?php $sundaySchedule = $sundaySchedules[$i]  ?> <div class="row">
                    {{ $sundaySchedule->operationalTime->name }}
                    <input type="checkbox" {{ $sundaySchedule->is_active == "1"? "checked" : "" }} data-bootstrap-switch
                        data-off-color="danger" data-on-color="success" readonly>
                    (Rp. {{ NumberFormat($sundaySchedule->price) }})
                    </div>
                    @endfor
            </td>
            <td>
                @for($i = 12; $i < 18; $i++) <?php $sundaySchedule = $sundaySchedules[$i]  ?> <div class="row">
                    {{ $sundaySchedule->operationalTime->name }}
                    <input type="checkbox" {{ $sundaySchedule->is_active == "1"? "checked" : "" }} data-bootstrap-switch
                        data-off-color="danger" data-on-color="success" readonly>
                    (Rp. {{ NumberFormat($sundaySchedule->price) }})
                    </div>
                    @endfor
            </td>
            <td>
                @for($i = 18; $i < 24; $i++) <?php $sundaySchedule = $sundaySchedules[$i]  ?> <div class="row">
                    {{ $sundaySchedule->operationalTime->name }}
                    <input type="checkbox" {{ $sundaySchedule->is_active == "1"? "checked" : "" }} data-bootstrap-switch
                        data-off-color="danger" data-on-color="success" readonly>
                    (Rp. {{ NumberFormat($sundaySchedule->price) }})
                    </div>
                    @endfor
            </td>
            @else
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            @endif

        </tr>
    </tbody>
    </table>
</div>
<script>
window.onload = (event) => {
  var loading = document.getElementById("loading");
  var schedule = document.getElementById("schedule");
  schedule.style.display = "block";
  loading.style.display = "none";
};

function reloadPage() {
    const court_id = $('select[name="court_id"]').val();
    window.open(window.location.pathname + (court_id ? ('?court_id=' + court_id) : ''), '_self');
}
</script>