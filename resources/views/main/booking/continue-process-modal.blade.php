   <div class="row">   
        <div class="col-md-12">         
            <input type="text" class="form-control text-center btn-outline-dark border-0 text-primary bg" value="Data berhasil disimpan sesuai filter yang anda terapkan." readonly/>
            <input type="text" class="form-control text-center btn-outline-dark border-0 text-primary bg" value="Total bayar saat ini adalah {{ $totalPaidString }}" readonly/>
             
        </div>	
    </div>	    
    <div class="row">
        <div class="col-md-12">       
            <div class="form-group">
                <a href="{{ URL::to('/checkout') . "/" . $building_id }}" class="btn btn-primary submit-btn m-1">Lanjutkan Pemrosesan</a>
            </div> 
        </div>	        
    </div>	 