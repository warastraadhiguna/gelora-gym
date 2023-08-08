<form id="booking-filter" action="{{ URL::to('/booking-filter')}}" method="POST">
    @csrf       
    <div class="row">   
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
    </div>	 
    <br/>
    <hr/>
    <button type="button" id="booking-filter-submit" class="btn btn-danger">Terapkan</button>    
    <button type="button" class="btn btn-warning" id="btnClose">Batal</button>
</form> 