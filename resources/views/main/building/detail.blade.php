<!-- Breadcrumb -->
{{-- <div class="breadcrumb-bar-two">
    <div class="container">
        <div class="row align-items-center inner-banner">
            <div class="col-md-12 col-12 text-center">
                <h2 class="breadcrumb-title">Gedung</h2>
                <nav aria-label="breadcrumb" class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ URL::to('/') }}">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page">Gedung Olaraga</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div> --}}
<!-- /Breadcrumb -->

<!-- Page Content -->
<div class="content">
    <div class="container mt-5">

        <!-- Doctor Widget -->
        <div class="card">
            <div class="card-body">
                <div class="doctor-widget">
                    <div class="doc-info-left">
                        <div class="doctor-img">
                            <img src="{{ URL::to('/storage') . '/' .  $building->image_url }}" class="img-fluid" alt="{{ $building->name }}">
                        </div>
                        <div class="doc-info-cont">
                            <h4 class="doc-name">{{ $building->name }}</h4>
                            <p class="doc-speciality">{{ $building->note }}</p>

                            <div class="clinic-details">
                                <p class="doc-location"><a target="_blank" href="{{ $building->google_location_url }}"><i class="fas fa-map-marker-alt me-2"></i><u> {{ $building->address }}</u></a></p>
                                <hr/>                                
                                <p class="doc-department"><img src="{{ URL::to('/storage') . '/' .  $building->type->image_url }}" class="img-fluid" alt="Speciality">{{  $building->type->name }}</p>                                
                                <ul class="clinic-gallery">
                                    @foreach($building->courts as $court)         
                                    <li>
                                        <a href="{{ URL::to('/storage') . '/' . $court->image_url }}" data-fancybox="gallery">
                                            <img title="{{ $court->name }}" src="{{ URL::to('/storage') . '/' . $court->image_url }}" alt="{{ $court->name }}">
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
                            <a href="https://wa.me/{{ $building->phone }}" class="btn btn-white call-btn">
                                <i class="fas fa-phone"></i>
                            </a>
                            @if($building->is_bookable == '1')
                            <a class="apt-btn" href="{{ URL::to('/booking') . "/" . $building->id  . "?type_id=" . $type_id . "&date=" . $date . "&start_time=". $start_time . "&end_time=" . $end_time. "&court_quantity=" . $court_quantity}}">Booking</a>                                
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Doctor Widget -->
        
        <!-- Doctor Details Tab -->
        <div class="card">
            <div class="card-body pt-0">
            
                <!-- Tab Menu -->
                <nav class="user-tabs mb-4">
                    <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
                        <li class="nav-item">
                            <a class="nav-link active" href="#doc_overview" data-bs-toggle="tab">Ringkasan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#doc_court" data-bs-toggle="tab">Lapangan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#doc_business_hours" data-bs-toggle="tab">Jam Operasional</a>
                        </li>
                    </ul>
                </nav>
                <!-- /Tab Menu -->
                
                <!-- Tab Content -->
                <div class="tab-content pt-0">
                
                    <!-- Overview Content -->
                    <div role="tabpanel" id="doc_overview" class="tab-pane fade show active">
                        <div class="row">
                            <div class="col-md-12 col-lg-9">
                            
                                <!-- About Details -->
                                <div class="widget about-widget">
                                    <h4 class="widget-title">Keunggulan Kami</h4>
                                    <p>
                                        {{ $building->note }}
                                    </p>
                                </div>
                                <!-- /About Details -->
                    
                                <!-- Services List -->
                                <div class="service-list">
                                    <h4>Fasilitas</h4>
                                    <ul class="clearfix">
                                        @foreach(explode(';',$building->facilities) as $facility)
                                        <li>{{ $facility }} </li>
                                        @endforeach
                                        
                                    </ul>
                                </div>
                                <!-- /Services List -->
                            </div>
                        </div>
                    </div>
                    <!-- /Overview Content -->
                    
                    <!-- Locations Content -->
                    <div role="tabpanel" id="doc_court" class="tab-pane fade">
                    @foreach($building->courts as $court)                    
                        <!-- Location List -->
                        <div class="location-list">
                            <div class="row">
                            
                                <!-- Clinic Content -->
                                <div class="col-md-6">
                                    <div class="clinic-content">
                                        <h4 class="clinic-name"><a href="#">{{ $court->name }} ({{ $court->code }})</a></h4>
                                        <p class="doc-speciality">{{ $court->note }}</p>

                                        <div class="clinic-details mb-0">

                                            <ul>
                                                <li>
                                                    <a href="{{ URL::to('/storage') . '/' . $court->image_url }}" data-fancybox="gallery2">
                                                        <img src="{{ URL::to('/storage') . '/' . $court->image_url }}" alt="{{ $court->name }}">
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Clinic Content -->
                                
                                <div class="col-md-6">
                                    <div class="consult-price">
                                        {{ $court->price }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Location List -->
                    @endforeach          

                    </div>
                    <!-- /Locations Content -->
                    
                    <!-- Business Hours Content -->
                    <div role="tabpanel" id="doc_business_hours" class="tab-pane fade">
                        <div class="row">
                            <div class="col-md-6 offset-md-3">
                            
                                <!-- Business Hours Widget -->
                                <div class="widget business-widget">
                                    <div class="widget-content">
                                        <div class="listing-hours">
                                            @if($building->is_active == '0')
                                            <div class="listing-day current">
                                                <div class="day">Hari Ini <span>{{ DateFormat(date("Y-m-d"), "D MMMM Y") }}</span></div>
                                                <div class="time-items">
                                                    <span class="open-status"><span class='badge bg-danger-light'>Tutup</span></span>
                                                </div>
                                            </div>                                                
                                            @endif

                                            @foreach(explode(';',$building->operational_times) as $operational_time)
                                            <?php  $time = explode('~',$operational_time)?>
                                            @if(sizeof($time) > 1)
                                            <div class="listing-day">
                                                <div class="day">{{ $time[0]  }}</div>
                                                <div class="time-items">
                                                    @if($time[1] == "Libur")
                                                        <span class='badge bg-danger-light'>{{ $time[1] }}</span>
                                                    @else
                                                        {{ $time[1] }}
                                                    @endif
                                                    </span>
                                                </div>
                                            </div>
                                            @endif
                                            @endforeach                                            

                                        </div>
                                    </div>
                                </div>
                                <!-- /Business Hours Widget -->
                        
                            </div>
                        </div>
                    </div>
                    <!-- /Business Hours Content -->
                    
                </div>
            </div>
        </div>
        <!-- /Doctor Details Tab -->

    </div>
</div>		
<!-- /Page Content -->
