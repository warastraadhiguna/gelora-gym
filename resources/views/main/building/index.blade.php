<!-- Breadcrumb -->
{{-- <div class="breadcrumb-bar-two">
    <div class="container">
        <div class="row align-items-center inner-banner">
            <div class="col-md-12 col-12 text-center">
                <h2 class="breadcrumb-title">Cari</h2>
                <nav aria-label="breadcrumb" class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ URL::to('/') }}">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page">Cari Gedung Olaraga</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div> --}}
<!-- /Breadcrumb -->

<!-- Page Content -->
<div class="content">
    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-md-12 col-lg-4 col-xl-3 theiaStickySidebar">
                <form action="{{ URL::to('/search-building')}}" method="POST">
                    @csrf            
                <!-- Search Filter -->
                <div class="card search-filter">
                    <div class="card-header text-bg-secondary">
                        <h4 class="card-title text-center text-light mb-0">Filter Pencarian</h4>
                    </div>
                    <div class="card-body">
                        <div class="filter-widget">
                            <div>
                                <select class="form-select" name="type_id">
                                    <option value="">-Pilih Gedung-</option>   
                                    @foreach ($types as $type)
                                        <option value="{{ $type->id }}" {{ $type_id == $type->id ? "selected" : "" }}>{{ $type->name }}</option>
                                    @endforeach
                                </select>		
                            </div>
                        </div>
                        <hr/>                        
                        <div class="text-center">
                            <h5 class="text-bg-secondary">Filter detail</h5>
                            <small class="text-dark text-bg-warning">Isi semua filter detail untuk mendapatkan data tertentu..</small>
                        </div>
                        <br/>
                        <div class="filter-widget">
                            <div>
                                <input type="text" class="form-select datetimepicker" 
                                onkeydown="return false"
                                placeholder="Pilih Tanggal" name="date" value='{{ $date? DateFormat($date, "DD/MM/YYYY") : "" }}'>	
                            </div>			
                        </div>                    
                        <div class="filter-widget">
                            <div>
                                <select class="form-select" name="start_time">
                                    <option value="">-Jam Awal Penggunaan-</option>
                                    @foreach(GetTimes() as $time)
                                        <option value="{{ $time }}" {{ $start_time == $time ? "selected" : "" }}>{{ $time }}</option>
                                    @endforeach
                                </select>	
                            </div>			
                        </div> 
                        <div class="filter-widget">
                            <div>
                                <select class="form-select" name="end_time">
                                    <option value="">-Jam Akhir Penggunaan-</option>
                                    @foreach(GetTimes() as $time)
                                        <option value="{{ $time }}" {{ $end_time == $time ? "selected" : "" }}>{{ $time}}</option>
                                    @endforeach
                                </select>	
                            </div>			
                        </div>     
                        <div class="filter-widget">
                            <div>
                                <select class="form-select" name="court_quantity">
                                    <option value="">-Jumlah Lapangan-</option>
                                    @foreach(GetCourtQuantity() as $quantity)
                                        <option value="{{ $quantity }}" {{ $court_quantity == $quantity ? "selected" : "" }}>{{ $quantity}}</option>
                                    @endforeach
                                </select>	
                            </div>			
                        </div>                            
                        <hr/>                                                       
                        <div class="btn-search">
                            <button type="submit" class="btn w-100" id="focusToElement">Cari</button>
                        </div>	
                    </div>
                </div>
                <!-- /Search Filter -->    
                </form>                       
            </div>
            
            <div class="col-md-12 col-lg-8 col-xl-9">
                @if(count($buildings) == 0)
                    <div class="card">
                        <div class="card-body">
                        <h3>Data Tidak Diketemukan . . . .</h3>
                        </div>
                    </div>
                @endif

                @foreach ($buildings as $building)
                <!-- Doctor Widget -->
                <div class="card">
                    <div class="card-body">
                        <div class="doctor-widget">
                            <div class="doc-info-left">
                                <div class="doctor-img">
                                    <a href="{{ URL::to('/building') . "/" . $building->id }}">
                                        <img src="{{ URL::to('/storage') . '/' .  $building->image_url }}" class="img-fluid" alt="User Image">
                                    </a>
                                </div>
                                <div class="doc-info-cont">
                                    <h4 class="doc-name"><a href="{{ URL::to('/building') . "/" . $building->id }}">{{ $building->name }}</a></h4>
                                    <p class="doc-speciality">
                                        {{ $building->note }}
                                    </p>
                                    <p>
                                        <i class="fas fa-map-marker-alt"></i>                                <a style="text-decoration: underline;" target="_blank" href="{{ $building->google_location_url }}">
                                        {{ $building->address }}
                                            </a>
                                    </p>
                                    
                                    <p class="doc-department"><img src="{{ URL::to('/storage') . '/' .  $building->type->image_url }}" class="img-fluid" alt="Speciality">{{ $building->type->name }}</p>

                                    
                                    <div class="clinic-details">
                                        <ul class="clinic-gallery">
                                            @foreach($building->courts as $court)
                                            <li>
                                                <a href="{{ URL::to('/storage') . '/' . $court->image_url }}" data-fancybox="gallery">
                                                    <img  title="{{ $court->name }}" src="{{ URL::to('/storage') . '/' . $court->image_url }}" alt="Lapangan">
                                                </a>
                                            </li> 
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="clinic-services">
                                        @foreach($building->courts as $court)                           
                                        <span>{{ $court->name }}</span> 
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="doc-info-right">
                                <div class="clinic-booking">
                                    <a class="view-pro-btn" href="{{ URL::to('/building') . "/" . $building->id . "?type_id=" . $type_id . "&date=" . $date . "&start_time=". $start_time . "&end_time=" . $end_time. "&court_quantity=" . $court_quantity  }}">Lihat</a>
                            @if($building->is_bookable == '1')                                    
                                    <a class="apt-btn" href="{{ URL::to('/booking') . "/" . $building->id . "?type_id=" . $type_id . "&date=" . $date . "&start_time=". $start_time . "&end_time=" . $end_time. "&court_quantity=" . $court_quantity }}">Booking</a>
                            @endif                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Doctor Widget -->
                @endforeach                
            </div>
        </div>
    </div>
</div>		
<!-- /Page Content -->
<script>
function myFunction() {
  const element = document.getElementById("test");
  element.scrollIntoView();
}
</script>