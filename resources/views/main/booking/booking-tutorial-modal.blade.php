 
<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Lihat Pesan Harian</button>
    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Lihat Pesan Berulang</button>
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
   <div class="row">   
        <div class="col-md-12">         
            <input type="text" class="form-control text-center btn-outline-dark border-0 text-danger bg" value="Tekan jadwal tertentu untuk memilih, dan tekan ulang untuk membatalkan." readonly/>
        </div>	
    </div>	    
    <div class="row">
        <div class="col-md-12">       
            <div class="form-group">
                <img src="{{ asset('/img/booking.gif') }}" alt="Cara Booking" width="45%">  
            </div> 
        </div>	        
    </div>	
  </div>
  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
   <div class="row">   
        <div class="col-md-12">         
            <input type="text" class="form-control text-center btn-outline-dark border-0 text-danger bg" value="Masukkan semua data yang diinginkan." readonly/>
        </div>	
    </div>	    
    <div class="row">
        <div class="col-md-12">       
            <div class="form-group">
                <img src="{{ asset('/img/booking1.gif') }}" alt="Cara Booking" width="45%">  
            </div> 
        </div>	        
    </div>	
  </div>
</div>