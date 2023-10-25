
<script type="text/javascript"
    src="{{ config('midtrans.snap_url') }}"
    data-client-key="{{ config('midtrans.client_key') }}"></script>
<!-- Breadcrumb -->
<div class="breadcrumb-bar-two">
    <div class="container">
        <div class="row align-items-center inner-banner">
            <div class="col-md-12 col-12 text-center">
                <h2 class="breadcrumb-title">Booking</h2>
                <nav aria-label="breadcrumb" class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ URL::to('/') }}">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page">Pembayaran Pesanan</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- /Breadcrumb -->

<!-- Page Content -->
<div class="content">
    <div class="container">
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
                                <img src="{{ URL::to('/storage') . '/' .  $building->image_url }}" alt="User Image">
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
                                    <li>Waktu &nbsp; <span>{{ DateFormat($nowTime, " : D MMMM Y") }}</span></li>
                                </ul>
                                <ul class="booking-fee">
                                    <?php 
                                      $total = 0;  
                                    ?>
                                    @foreach($receipt->receiptDetails as $key => $receiptDetail)
                                    <?php 
                                      $total = $total + $receiptDetail->price;
                                    ?>
                                    <li>{{ "- " .$receiptDetail->schedule->court->name. '('. DateFormat($receiptDetail->booking_date, "D MMMM Y ") . $receiptDetail->schedule->operationalTime->name .')' }}  <span>Rp. {{ NumberFormat($receiptDetail->schedule->price) }}</span></li> 
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
                        <!-- Personal Information -->
                        <div class="info-widget">
                            <h4 class="card-title">Data Pemesan</h4>
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group card-label">
                                        <label>Nama</label>
                                        <input type="text"  name="name" class="form-control" value="{{ $receipt->name }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group card-label">
                                        <label>Email</label>
                                        <input name="email" class="form-control" value="{{ $receipt->email}}" type="email" readonly>  
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group card-label">
                                        <label>Telepon</label>
                                        <input name="phone" class="form-control" value="{{ $receipt->phone }}" type="text" readonly>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group card-label">
                                        <label>Catatan</label>
                                        <input name="note" class="form-control" type="text" value="{{ $receipt->note }}" readonly>        
                                    </div>
                                </div>                                    
                            </div>
                        </div>
                        <!-- /Personal Information -->
                        
                        <div class="payment-widget">
                            <!-- Terms Accept -->
                            <div class="terms-accept">
                              <div class="custom-checkbox">
                                <label for="terms_accept"><a href="#">Bila jadwal belum dibayarkan dalam 30 menit, maka jadwal dapat dibooking pelanggan lain!</a></label>
                              </div>
                            </div>
                            <!-- /Terms Accept -->                          
                            <!-- Submit Section -->
                            <div class="submit-section mt-4">
                                <button class="btn btn-primary submit-btn" id="pay-button">Bayar Sekarang</button>    
                            </div>
                            <!-- /Submit Section -->
                            
                        </div>
                    <!-- /Checkout Form -->                        
                    </div>
                </div>
                
            </div>
        </div>    
    </div>

</div>		
<!-- /Page Content -->    


<script type="text/javascript">
  // For example trigger on button clicked, or any time you need
  var payButton = document.getElementById('pay-button');
  payButton.addEventListener('click', function () {
    // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
    window.snap.pay('{{ $snapToken }}', {
      onSuccess: function(result){
        /* You may add your own implementation here */
        alert("Pembayaran Sukses!"); 
        const url = '<?= URL::to('/success-booking/' . $receipt->id); ?>';
        window.open(url,  '_self');        
      },
      onPending: function(result){
        /* You may add your own implementation here */
        alert("Sedang menunggu pembayaran anda!"); console.log(result);
      },
      onError: function(result){
        /* You may add your own implementation here */
        alert("Pembayaran Gagal!"); console.log(result);
      },
      onClose: function(){
        /* You may add your own implementation here */
        alert('Anda menutup pop up tanpa melakukan pembayaran');
      }
    })
  });
</script>