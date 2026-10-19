@include('sweetalert::alert')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="invoice-content">
                    <div class="invoice-item">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="invoice-logo">
                                    <img src="{{ URL::to('/storage') }}/{{ $company->logo_url  }}" width="50%" alt="logo">
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
                                    {{ DateFormat($receipt->created_at, "D MMMM Y H:m:s") }}
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
                                                <th class="text-center">No</th>
                                                <th>Lapangan</th>
                                                <th class="text-center">Tanggal</th>
                                                <th class="text-center">Jadwal</th>
                                                <th class="text-center">Harga</th>
                                                @if($receipt->status !== '2' )
                                                <th class="text-center">#</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($receiptDetailArray as $receipsDetail)
                                            <tr>
                                                <td class="text-center align-center">{{ $loop->iteration }}</td>
                                                <td class="align-center">{{ $receipsDetail['court']}}</td>
                                                <td class="align-center"> 
                                                    {{ $receipsDetail['date']}}
                                                </td>
                                                <td class="text-center align-center">{{ $receipsDetail['schedule']}}</td>
                                                <td class="text-center align-center">Rp. {{ NumberFormat($receipsDetail['price']) }}</td>
                                                @if($receipt->status !== '2' )
                                                <th class="text-center align-center">
                                                    <button type="button" class="btn btn-warning" data-toggle="modal"
                                                        data-target="#update-modal" onclick="AddReceiptId({{ $receipt->id }}, '{{ $receipsDetail['real_date'] }}')">
                                                        <i class="fas fa-pen"></i>Ubah
                                                    </button>   
                                                </th>
                                                @endif
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tbody>
                                            <tr>
                                                <th class="text-center" colspan="4">Total</th>
                                                <th class="text-center"><span>Rp. {{ NumberFormat($total) }}</span></th>
                                                @if($receipt->status !== '2' )                                                
                                                <th></th>
                                                @endif
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

<div class="modal fade" id="update-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ubah Status</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ URL::to('/admin/receipt-date-change') }}" method="POST" autocomplete="off">
                    @csrf                 
                    <input type="hidden" name="receipt_id" id="receipt_id"/>
                    <input type="hidden" name="booking_date" id="booking_date"/>

                    <div class="form-group">
                        <label for="">Tanggal Baru</label>
                        <input class="form-control" value="" name="new_date"  id="new_date" type="date"/> 
                    </div>
                    <button type="submit" onclick="return confirm('Anda yakin mengubah data ini?')" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script>
    const AddReceiptId = (id, bookingDate) =>{
        document.getElementById("receipt_id").value=id;
        document.getElementById("booking_date").value=bookingDate;

        document.getElementById("new_date").value=bookingDate;
    }
</script>
