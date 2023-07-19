<!-- Breadcrumb -->
<div class="breadcrumb-bar-two">
    <div class="container">
        <div class="row align-items-center inner-banner">
            <div class="col-md-12 col-12 text-center">
                <h2 class="breadcrumb-title">Booking</h2>
                <nav aria-label="breadcrumb" class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ URL::to('/') }}">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page">Status Pembayaran</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- /Breadcrumb -->


<div class="content success-page-cont">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-6">

                <div class="card success-card">
                    <div class="card-body">
                        <div class="success-cont">
                            <i class="fas fa-check"></i>
                            <h3>Pesanan berhasil dibayarkan!</h3>
                            <p>Pesanan tanggal {{ DateFormat($receipt->created_at, "D MMMM Y H:m:s") }} di<br><strong>{{ $building->name }}</strong><br><strong>{{ $building->address }}</strong></p>
                            <a href="{{ URL::to('receipt' .'/' . $receipt->id)}}" class="btn btn-primary view-inv-btn">Lihat Detail</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>