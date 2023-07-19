@include('sweetalert::alert')
<style>
.swal-wide{
    width:850px !important;
}    
</style>
<!-- Breadcrumb -->
{{-- <div class="breadcrumb-bar-two">
    <div class="container">
        <div class="row align-items-center inner-banner">
            <div class="col-md-12 col-12 text-center">
                <h2 class="breadcrumb-title">Booking</h2>
                <nav aria-label="breadcrumb" class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ URL::to('/') }}">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page">Booking Jadwal</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div> --}}
<!-- /Breadcrumb -->

<!-- Page Content -->
<div class="content">
    <div class="container">
        <div class="row"  id="bookingContent">
            <div class="col-12">

                <div class="card">
                    <div class="card-body">
                        <div class="booking-doc-info">
                            <a href="{{ URL::to('/building') . "/" . $building->id }}" class="booking-doc-img">
                                <img src="{{ URL::to('/storage') . '/' .  $building->image_url; }}" alt="User Image">
                            </a>
                            <div class="booking-info">
                                <h4><a href="{{ URL::to('/building') . "/" . $building->id }}">{{ $building->name }}</a></h4>
                                <p class="text-muted mb-0"> <a target="_blank" class="link-danger" href="{{ $building->google_location_url }}"><i class="fas fa-map-marker-alt me-2"></i><u> {{ $building->address }}</u></a></p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <!-- Submit Section -->
                        <a class="btn btn-outline-danger" onclick="showInformation(0)"> Filter Detail</a>          
                        <div class="submit-section proceed-btn text-end form-search-btn">
                            <a href="{{ URL::to('/checkout') . "/" . $building->id }}" class="btn btn-primary submit-btn">Proses Pemesanan</a>
                        </div>
                        <!-- /Submit Section -->      
                    </div>
                </div>  

                <div class="dct-appoinment">
                    <div class="card">              
                        <div class="card-body pt-0">
                            <div class="user-tabs">
                                <ul class="nav nav-tabs nav-tabs-bottom nav-justified flex-wrap">
                                @foreach($building->courts as $key => $court)                                    
                                    <li class="nav-item">
                                        <a class="nav-link {{(!$element && $key == 0) || $element == 'court'. $court->id? 'active' : '' }}" href="#court{{ $court->id }}" data-bs-toggle="tab">{{ $court->name }}</a>
                                        <p class="text-muted mt-3">{{ $court->price }}</p>
                                    </li>
                                @endforeach                                       
                                </ul>
                            </div>
                            <div class="tab-content">
                                @foreach($building->courts as $key => $court)           
                                <div class="tab-pane fade {{ (!$element && $key == 0) || $element == 'court'. $court->id? 'show active' : '' }}" id="court{{ $court->id }}">
                                    <!-- Schedule Widget -->
                                    <div class="card booking-schedule schedule-widget">
                                    
                                        <!-- Schedule Header -->
                                        <div class="schedule-header">
                                            <div class="row">
                                                <div class="col-md-12">
                                                
                                                    <!-- Day Slot -->
                                                    <div class="day-slot">
                                                        <ul>
                                                        @if($page>0)
                                                            <li class="left-arrow">
                                                                <a href="{{ URL::to('/booking') . '/' . $building->id . "?page=" . ($page - 1). '&element=court' . $court->id }}">
                                                                    <i class="fa fa-chevron-left"></i>
                                                                </a>
                                                            </li>                 
                                                        @endif
                                                        @for($i = 0; $i < 7; $i++)
                                                            <li>
                                                                <span>{{ DateFormat($nowTimes[$key], "dddd") }}</span>
                                                                <span class="slot-date">{{ DateFormat($nowTimes[$key], "D MMMM Y") }}</span>
                                                            </li>
                                                            <?php $nowTimes[$key]->addDay(1); ?>
                                                        @endfor

                                                            <li class="right-arrow">
                                                                <a href="{{ URL::to('/booking') . '/' . $building->id . "?page=" . ($page + 1) . '&element=court'. $court->id }}">
                                                                    <i class="fa fa-chevron-right"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <!-- /Day Slot -->
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /Schedule Header -->
                                        
                                        <!-- Schedule Content -->
                                        <div class="schedule-cont">
                                            <div class="row">
                                                <div class="col-md-12">

                                                    <!-- Time Slot -->
                                                    <div class="time-slot">
                                                        <ul class="clearfix">
                                                            @for($i = ($page * 7); $i < ($page * 7) + 7; $i++)
                                                            <li>
                                                                <?php 
                                                                    $specificSchedules = $court->schedules->where("operational_day_id", $nowDayNumber)->where("is_active", "1")->sortBy("operationalTime.index");  
                                                                    $nowDayNumber++;
                                                                    $nowDayNumber = $nowDayNumber>7 ? $nowDayNumber - 7 :$nowDayNumber;
                                                                ?>
                                                                @foreach($specificSchedules as $schedule)
                                                                
                                                                @if($i == 0 && (DateFormat($nowTime, "HH:mm") > $schedule->operationalTime->name))
                                                                @else
                                                                <a data-toggle="tooltip" title="Rp. {{ NumberFormat($schedule->price) }}" id="{{ 'link_' . $schedule->id . '_' . $i }}" class="timing" href="#" onclick="reserve({{ $schedule->id }}, {{ $i }})">
                                                                    <span>
                                                                        {{ $schedule->operationalTime->name }}
                                                                    </span> 
                                                                </a>
                                                                @endif

                                                                {{-- <button>Booked</button> --}}
                                                                @endforeach
                                                                @if(count($specificSchedules) == 0)
                                                                <a class="timing off" href="#">
                                                                    <span>
                                                                        Libur
                                                                    </span> 
                                                                </a>
                                                                @endif
                                                            </li>                                            
                                                            @endfor

                                                        </ul>
                                                    </div>
                                                    <!-- /Time Slot -->
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /Schedule Content -->
                                        
                                    </div>
                                    <!-- /Schedule Widget -->
                                </div>
                                @endforeach    
                            </div>
                        </div>
                    </div>
                </div>    
            </div>
        </div>
    </div>
</div>	
<script>
window.onload = function(){ 
    const errorMessage = '{{ $errorMessage }}';   
    const successMessage = '{{ $successMessage }}';         
    const showModalOnLoad = '{{ $showModalOnLoad }}';

    if(errorMessage){
        setTimeout(function() {
            showModal(errorMessage, 'error');
        }, 50);        
    }    
    if(successMessage){
        setTimeout(function() {
            showModal(successMessage, 'success');
        }, 50);        
    }      
    if(showModalOnLoad){
        setTimeout(function() {
            showInformation(1);
        }, 50);        
    }

    const tempBookingDetailString = '{{ $tempBookingDetailString }}';
    const tempBookingDetailArray = tempBookingDetailString.split(";");
    tempBookingDetailArray.forEach(tempBookingDetail => {
        if(tempBookingDetail){
            let element = document.getElementById(tempBookingDetail);
            if(element){
                element.className = "timing selected";
            }
        }
    });

    const bookedSchedulesString = '{{ $bookedSchedulesString }}';
    const bookedScheduleArray = bookedSchedulesString.split(";");
    bookedScheduleArray.forEach(bookedSchedules => {
        if(bookedSchedules){
            let element = document.getElementById(bookedSchedules);
            if(element){
                element.className = "timing booked";
                element.title = "Jadwal sudah dibooking pelanggan lain!!";
            }
        }
    });
};

document.addEventListener('click', event => {
  const link = event.target.closest('a[href="#"]');

  if (link === null) {
    return;
  }

  event.preventDefault();
});

function showModal(html, type) {
    swal({
        title: type == "success"? "Informasi" : "Peringatan",
        html,
        showCloseButton: true,
        showCancelButton: false,
        showConfirmButton: true,            
        focusConfirm: false,
        type,        
    });
}

function showInformation(showModalOnLoad) {
    swal({
        title: (showModalOnLoad? "<h5 class='bg-warning'>Terdapat data filter tersimpan, apakah anda akan menerapkan data filter ini?</h5>" : "") + '<strong>Filter Detail</strong>',
        html:'{!! $html !!}',
        showCloseButton: true,
        showCancelButton: false,
        showConfirmButton: false,            
        focusConfirm: false,
        customClass: 'swal-wide',            
        onOpen: function () {
            $('#datepicker').datetimepicker({
            format: 'DD/MM/YYYY'
            });
            $('#btnClose').click(function(){
                swal.close();
            });            
            $("#booking-filter-submit").click(function(){
                const confirmation = confirm("Anda yakin menerapkan filter? Menerapkan filter akan menghapus data booking yang lama.");
                console.log(confirmation);
                if (confirmation){
                    $('form#booking-filter').submit();
                }
            });                
        },                
    });
}

function reserve (id, iteration) 
{
    const linkId = 'link_' + id + '_' + iteration;
    const linkElement = document.getElementById(linkId);
    const bookingContentElement = document.getElementById("bookingContent");

    bookingContentElement.style.display= "none"
    if(linkElement.className == "timing"){
        const myFormData = {
            id,iteration,"_token": "{{ csrf_token() }}",
        };
        $.ajax({
            type: 'POST',
            url: "<?= URL::to('/reserve'); ?>",
            data: myFormData,
            success: function(data) {
                linkElement.className = "timing selected";
            },
            error: function (e) {
                alert(e.statusText);
            }
        });
    }
    else if(linkElement.className == "timing selected"){
        const myFormData = {
            id,iteration,"_token": "{{ csrf_token() }}",
        };

        $.ajax({
            type: 'POST',
            url: "<?= URL::to('/delete-reserve'); ?>",
            data: myFormData,
            success: function(data) {
                linkElement.className = "timing";
            },
            error: function (e) {
                alert(e.statusText);
            }
        });
    }
    else{
        alert("Jadwal sudah digunakan!!");
    }
    bookingContentElement.style.display= "block";
};
</script>