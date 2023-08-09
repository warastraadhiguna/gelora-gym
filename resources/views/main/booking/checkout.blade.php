@include('sweetalert::alert')

<!-- Breadcrumb -->
<div class="breadcrumb-bar">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-12 col-12">
                <nav aria-label="breadcrumb" class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pemesanan</li>
                    </ol>
                </nav>
                <h2 class="breadcrumb-title">Pemesanan</h2>
            </div>
        </div>
    </div>
</div>
<!-- /Breadcrumb -->

<!-- Page Content -->
<div class="content">
    <div class="container">

        @if(count($tempBookingDetails) > 0)
        <div class="row">
            <div class="col-md-7 col-lg-6 theiaStickySidebar">
            
                <!-- Booking Summary -->
                <div class="card booking-card">
                    <div class="card-header">
                        <h4 class="card-title">Ringkasan Pemesanan</h4>
                    </div>
                    <div class="card-body">
                    
                        <!-- Booking Doctor Info -->
                        <div class="booking-doc-info">
                            <a href="{{ URL::to('/building') . "/" . $building->id }}" class="booking-doc-img">
                                <img src="{{ URL::to('/storage') . '/' .  $building->image_url; }}" alt="User Image">
                            </a>
                            <div class="booking-info">
                                <h4><a href="{{ URL::to('/building') . "/" . $building->id }}">{{ $building->name }}</a></h4>
                                <div class="clinic-details">
                                    <p class="doc-location"><a target="_blank" href="{{ $building->google_location_url }}"><i class="fas fa-map-marker-alt me-2"></i><u> {{ $building->address }}</u></a></p>
                                </div>
                            </div>
                        </div>
                        <!-- Booking Doctor Info -->
                        
                        <div class="booking-summary">
                            <div class="booking-item-wrap">
                                <ul class="booking-date">
                                    <li>Waktu &nbsp;<span>{{ DateFormat($nowTime, " : D MMMM Y") }}</span></li>
                                </ul>
                                <ul class="booking-fee">
                                    @foreach($tempBookingDetails as $tempBookingDetail)
                                    <li><a onclick="deleteBooking({{ $tempBookingDetail->id }})" href="#" style="text-decoration:underline; color: red">hapus</a>{{ " " .$tempBookingDetail->schedule->court->name. '('. DateFormat($tempBookingDetail->booking_date, "D MMMM Y ") . $tempBookingDetail->schedule->operationalTime->name .')' }}  <span>Rp. {{ NumberFormat($tempBookingDetail->schedule->price) }}</span></li> 
                                    @endforeach
                                </ul>
                                <div class="booking-total">
                                    <ul class="booking-total-list">
                                        <li>
                                            <span>Total</span>
                                            <span class="total-cost">Rp. {{ NumberFormat($total) }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Booking Summary -->
                
            </div>
            <div class="col-md-5 col-lg-6">
                <div class="card">
                    <div class="card-body">
                    
                        <!-- Checkout Form -->
                        <form action="{{ URL::to('/payment'); }}" method="POST" autocomplete="off" >
                        @csrf
                            <!-- Personal Information -->
                            <div class="info-widget">
                                <h4 class="card-title">Data Pemesan</h4>
                                <div class="row">
                                    <input type="hidden" name="building_id" value="{{ $building->id }}"/>
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group card-label">
                                            <label>Nama</label>
                                            <input type="text"  name="name" class="form-control @error('name') is-invalid @enderror" value="{{ auth()->user()->name? auth()->user()->name : old('name') }}">
                                            @error('name') 
                                                <div class="invalid-feedback">
                                                {{ $message }}    
                                                </div>                   
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group card-label">
                                            <label>Email</label>
                                            <input name="email" class="form-control @error('email') is-invalid @enderror" value="{{ auth()->user()->email? auth()->user()->email : old('email') }}" type="email">
                                            @error('email') 
                                                <div class="invalid-feedback">
                                                {{ $message }}    
                                                </div>                   
                                            @enderror             
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group card-label">
                                            <label>Telepon</label>
                                            <input name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ auth()->user()->phone? auth()->user()->phone : old('phone') }}" type="text" required>
                                            @error('phone') 
                                                <div class="invalid-feedback">
                                                {{ $message }}    
                                                </div>                   
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group card-label">
                                            <label>Catatan</label>
                                            <input name="note" class="form-control @error('note') is-invalid @enderror" type="text" value="{{ old('note') }}">
                                            @error('note') 
                                                <div class="invalid-feedback">
                                                {{ $message }}    
                                                </div>                   
                                            @enderror              
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                            <!-- /Personal Information -->
                            
                            <div class="payment-widget">
                                <!-- Submit Section -->
                                <div class="submit-section mt-4">
                                    <button type="submit" onclick="return confirm('Apakah anda yakin data sudah benar?')" class="btn btn-primary submit-btn">Konfirmasi & Simpan</button>
                                </div>
                                <!-- /Submit Section -->
                                
                            </div>
                        </form>
                        <!-- /Checkout Form -->
                        
                    </div>
                </div>
                
            </div>
        </div>       
        @else
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h1 class="text-center"><a href="{{ URL::to('/booking/' . $building->id)}}"><u>Pilih jadwal Anda terlebih dahulu!!</u></a></h1>
                    </div>
                </div>
            </div>
        </div>
        @endif


    </div>

</div>		
<!-- /Page Content -->
<script>
    const deleteBooking = (id) =>{
        const result = confirm("Anda yakin menghapus data ini?");
        if (result) {
            const myFormData = {
                id,"_token": "{{ csrf_token() }}",
            };

            $.ajax({
                type: 'POST',
                url: "<?= URL::to('/delete-booking'); ?>",
                data: myFormData,
                success: function(data) {
                    if(data === "success"){
                        location.reload();
                    }
                },
                error: function (e) {
                    alert(e.statusText);
                }
            });
        }
    }
</script>
