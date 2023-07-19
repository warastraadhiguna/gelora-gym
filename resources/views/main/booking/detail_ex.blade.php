<!-- Breadcrumb -->
<div class="breadcrumb-bar">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-12 col-12">
                <nav aria-label="breadcrumb" class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Booking</li>
                    </ol>
                </nav>
                <h2 class="breadcrumb-title">Booking</h2>
            </div>
        </div>
    </div>
</div>
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
                <div class="submit-section proceed-btn text-end form-search-btn">
                    <a href="{{ URL::to('/checkout') . "/" . $building->id }}" class="btn btn-primary submit-btn">Proses Pemesanan</a>
                </div>
                <!-- /Submit Section -->                        
                    </div>
                </div>

                @foreach($building->courts as $court)
                
                <div class="row">
                    <div class="col-12 col-sm-4 col-md-6">
                        <h4 class="mb-1">{{ $court->name }}</h4>
                        <p class="text-muted">                                        
                            {{ $court->price }}
                            <a class="btn btn-sm btn-warning" data-bs-toggle="collapse" href="#scheduleCollapse{{ $court->id }}" role="button" aria-expanded="{{ $element== 'scheduleCollapse' . $court->id?'true':'false'}}" aria-controls="scheduleCollapse{{ $court->id }}">
                            Lihat Jadwal
                            </a>
                        </p>
                    </div>
                </div>
                

                <div class="collapse{{ $element== 'scheduleCollapse' . $court->id?' show':''}}" id="scheduleCollapse{{ $court->id }}">             
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
                                                <a href="{{ URL::to('/booking') . '/' . $building->id . "?page=" . ($page - 1). '&element=scheduleCollapse' . $court->id }}">
                                                    <i class="fa fa-chevron-left"></i>
                                                </a>
                                            </li>                 
                                        @endif
                                                                                                                                        @for($i = 0; $i < 7; $i++)
                                            <li>
                                                <span>{{ DateFormat($nowTime, "dddd") }}</span>
                                                <span class="slot-date">{{ DateFormat($nowTime, "D MMMM Y") }}</span>
                                            </li>
                                            <?php $nowTime->addDay(1); ?>
                                        @endfor

                                            <li class="right-arrow">
                                                <a href="{{ URL::to('/booking') . '/' . $building->id . "?page=" . ($page + 1) . '&element=scheduleCollapse'. $court->id }}">
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
                                                <a title="Rp. {{ NumberFormat($schedule->price) }}" id="{{ 'link_' . $schedule->id . '_' . $i }}" class="timing" href="#" onclick="reserve({{ $schedule->id }}, {{ $i }})">
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

         
<script>

window.onload = function(){ 
    const bookedSchedulesString = '{{ $bookedSchedulesString }}';
    const bookedSchedulesArray = bookedSchedulesString.split(";");
    bookedSchedulesArray.forEach(bookedSchedules => {
        if(bookedSchedules){
            let element = document.getElementById(bookedSchedules);
            if(element)
            element.className = "timing booked";
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