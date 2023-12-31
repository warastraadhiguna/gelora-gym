<div class="breadcrumb-bar">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-12 col-12">
                <nav aria-label="breadcrumb" class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail Nota</li>
                    </ol>
                </nav>
                <h2 class="breadcrumb-title">Detail Nota</h2>
            </div>
        </div>
    </div>
</div>


<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="invoice-content">
                    <div class="invoice-item">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="invoice-logo">
                                    <img src="{{ URL::to('/storage') }}/{{ $company->logo_url  }}" alt="logo">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="invoice-info invoice-info2">
                                    <strong class="customer-text text-center mt-5"><u>Nota Penyewaan</u> </strong>
                                    <p class="invoice-details text-center">
                                        {{ $receipt->number}} 
                                    </p>
                                </div>
                            </div>                            
                            <div class="col-md-4">
                                <p class="invoice-details">
                                    {{ DateFormat($receipt->created_at, "D MMMM Y HH:mm:ss") }}
                                    <br/>
                                    @include('main.booking.status')
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="invoice-item">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="invoice-info">
                                    <strong class="customer-text">Yth.</strong>
                                    <p class="invoice-details invoice-details-two">
                                        {{ $receipt->name }}<br>
                                        ({{ $receipt->phone }})
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="invoice-info">
                                    <strong class="customer-text"> Gedung Olahraga</strong>
                                    <p class="invoice-details invoice-details-two">
                                        {{ $building->name }}<br>
                                        ({{ $building->address }})
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="invoice-item invoice-table-wrap">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="invoice-table table table-bordered">
                                        <thead>
                                            <tr>
                                                <th width="20%">Lapangan</th>
                                                <th  width="25%" class="text-center">Tanggal</th>
                                                <th class="text-center">Jadwal</th>
                                                <th  width="20%" class="text-center">Harga</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($receiptDetailArray as $receipsDetail)
                                            <tr>

                                                <td class="align-middle">{{ $receipsDetail['court']}}</td>
                                                <td class="text-center align-middle">{{ $receipsDetail['date']}}</td>
                                                <td class="text-center align-middle">{{ $receipsDetail['schedule']}}</td>
                                                <td class="text-center align-middle">Rp. {{ NumberFormat($receipsDetail['price']) }}</td>
                                            </tr>

                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tbody>
                                            <tr>
                                                <th class="text-center" colspan="3">Total</th>
                                                <th class="text-center"><span>Rp. {{ NumberFormat($total) }}</span></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="other-info">
                        <h4>Catatan</h4>
                        <p class="text-muted mb-0">{{ $receipt->note ? $receipt->note : "-" }}.</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>