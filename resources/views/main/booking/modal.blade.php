<form id="booking-filter" action="{{ URL::to('/booking-filter')}}" method="POST">
    @csrf       
    <div class="row mt-5">   
        <div class="col-md-12">         
            <input type="text" class="form-control text-center btn-outline-dark border-0 text-danger bg" value="Isi semua, untuk mendapatkan data tertentu." readonly/>
        </div>	
    </div>	        
    <hr/>      
    <input type="hidden" name="building_id" value="{{ $building_id }}"/>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>Tanggal Dipilih</label>                     
                <input type="text" class="form-select datetimepicker" id="datepicker"  placeholder="Pilih Tanggal" onkeydown="return false" name="date" value="{{ $date ? DateFormat($date, "DD/MM/YYYY") : '' }}">	
            </div>	    
            <div class="form-group">
                <label>Jumlah Lapangan</label>                    
                <select class="form-select" name="court_quantity" >
                    @foreach(GetCourtQuantity() as $quantity)
                        <option value="{{ $quantity }}" {{ $court_quantity == $quantity ? "selected" : "" }}>{{ $quantity}}</option>
                    @endforeach
                </select>	
            </div>	                 
        </div>	
        <div class="col-md-4">           
            <div class="form-group">
                <label>Jam Awal</label>                
                <select class="form-select"  name="start_time">
                    <option value="">-Jam Awal Penggunaan-</option>
                    @foreach(GetTimes() as $time)
                        <option value="{{ $time }}" {{ $start_time == $time ? "selected" : "" }}>{{ $time }}</option>
                    @endforeach
                </select>	
            </div>	                        
            <div class="form-group">
                <label>Jam Akhir</label>                      
                <select class="form-select" name="end_time">
                    <option value="">-Jam Akhir Penggunaan-</option>
                    @foreach(GetTimes() as $time)
                        <option value="{{ $time }}" {{ $end_time == $time ? "selected" : "" }}>{{ $time}}</option>
                    @endforeach
                </select>	
            </div>	            
        </div>	    
        <div class="col-md-4">       
            <div class="form-group">
                <label>Periode</label>                    
                <select class="form-select" name="repeatedDay" >
                    @foreach(GetRepeatedDays() as $repeatedDaySingle)
                        <option value="{{ $repeatedDaySingle[0] }}" {{ $repeatedDay == $repeatedDaySingle[0] ? "selected" : "" }}>{{ $repeatedDaySingle[1]}}</option>
                    @endforeach
                </select>	
            </div>	            
            <div class="form-group">
                <label>Berulang</label>                    
                <select class="form-select" name="repeatedPeriod" >
                    @foreach(GetRepeatedPeriods() as $repeatedPeriodSingle)
                        <option value="{{ $repeatedPeriodSingle[0] }}" {{ $repeatedPeriod == $repeatedPeriodSingle[0] ? "selected" : "" }}>{{ $repeatedPeriodSingle[1]}}</option>
                    @endforeach
                </select>	
            </div>	 
        </div>	   
        <div class="col-12 col-md-6 offset-md-3">       
            <div class="card">
                <div class="card-body" style=" background-color: #f8f9fa;border: 2px solid #9e9b9b; ">
                    <h5 class="card-title">Pilihan Lapangan </h5>
                    <small>(kosongi saja jika tidak memilih spesifik lapangan)</small>
                    @foreach($building->courts as $key => $court)     
                        <div class="form-check mt-4">
                            <input class="form-check-input" name="courd_id[]" type="checkbox" value="{{ $court->id }}" id="checkbox{{ $key }}" style="width: 25px;height: 25px;" {{ in_array($court->id , $courtIdArray)? "checked" : ""  }}>
                            <label class="form-check-label mt-1" for="checkbox{{ $key }}">
                                {{ $court->name }}
                            </label>
                        </div>
                    @endforeach  
                </div>
            </div>
        </div>	        
    </div>     
    <hr/>
    <button type="button" id="booking-filter-submit" class="btn btn-danger">Terapkan</button>    
    <button type="button" class="btn btn-warning" id="btnClose">Batal</button>
</form> 
