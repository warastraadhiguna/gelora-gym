<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body bg-primary">
                Selamat data {{  auth()->user()->name }} di halaman admin 😊
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <a href="{{ URL::to('/admin/receipt' . "?startDate=" .  DateFormat($nowTime, "Y") ."-01-01&status=1") }}">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-receipt"></i></span>

                <div class="info-box-content">
                <span class="info-box-text">Booking</span>
                <span class="info-box-number">
                    {{ $booking }}
                    <small>Booking</small>
                </span>
                </div>
                <!-- /.info-box-content -->
            </div>          
        </a> 
    </div>

    <div class="col-md-3">
        <a href="{{ URL::to('/admin/user') }}">        
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>

                <div class="info-box-content">
                <span class="info-box-text">Member</span>
                <span class="info-box-number">
                    {{ $user }}
                    <small>Member</small>
                </span>
                </div>
                <!-- /.info-box-content -->
            </div>    
        </a>        
    </div>    
</div>
