@include('sweetalert::alert')

<a href="{{ URL::to('/building') }}" class="btn btn-primary mb-3"><i class="fas fa-plus" aria-hidden="true"></i>
    Tambah</a>
{{-- <button type="button" class="btn btn-info mb-3" data-toggle="modal"
    data-target="#filter-modal">
    <i class="fas fa-calendar-week"></i> Mingguan
</button>        --}}
<button type="button" class="btn btn-warning mb-3" data-toggle="modal"
    data-target="#filter-modal">
    <i class="fas fa-filter"></i> Filter
</button>   
<button type="button" class="btn btn-success mb-3" data-toggle="modal"
    data-target="#revenue-modal">
    <i class="fas fa-money-bill"></i> Pendapatan
</button> 

<div class="alert alert-info" role="alert">
  Filter : {{ DateFormat($startDate, "DD MMMM Y") }} - {{ DateFormat($endDate, "DD MMMM Y") }} ({{ $status === '0'? "Belum Bayar" : ($status === '1'? "Bayar" : ($status == ''? "Semua" : "Selesai")) }})
</div>

<?php 
    $belumBayarTotal=0; 
    $bayarTotal=0;     
?>
<table id="example1" class="table table-bordered table-striped" width="100%">
    <thead>
        <tr>
            <th width="5%">No</th>
            <th>Penyewa</th>
            <th>Detail</th>
            <th>Keuangan</th>
            <th width="10%">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($receipts as $receipt)
        <tr>
            <td class="align-middle">{{ $loop->iteration }}</td>
            <td>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Nama</label>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                        </div>
                        <div class="form-group">
                            <label>Telepon</label>
                        </div>
                        <div class="form-group">
                            <label>Catatan</label>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <label>:</label>
                        </div>
                        <div class="form-group">
                            <label>:</label>
                        </div>
                        <div class="form-group">
                            <label>:</label>
                        </div>
                        <div class="form-group">
                            <label>:</label>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>{{ $receipt->name }}</label>
                        </div>
                        <div class="form-group">
                            <label>{{ $receipt->email }}</label>
                        </div>
                        <div class="form-group">
                            <label>{{ $receipt->phone }}</label>
                        </div>
                        <div class="form-group">
                            <label>{{ $receipt->note }}</label>
                        </div>
                    </div>
                </div>
            </td>
            <td>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Jenis</label>
                        </div>
                        <div class="form-group">
                            <label>Nota</label>
                        </div>
                        <div class="form-group">
                            <label>Tanggal</label>
                        </div>
                        <div class="form-group">
                            <label>Gedung</label>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <label>:</label>
                        </div>
                        <div class="form-group">
                            <label>:</label>
                        </div>
                        <div class="form-group">
                            <label>:</label>
                        </div>
                        <div class="form-group">
                            <label>:</label>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>{{ $receipt->receiptDetails[0]->schedule->court->building->type->name }}</label>
                        </div>
                        <div class="form-group">
                            <label>{{ $receipt->number }}</label>
                        </div>
                        <div class="form-group">
                            <label>{{ DateFormat($receipt->created_at, "D MMMM Y") }}</label>
                        </div>
                        <div class="form-group">
                            <label>{{ $receipt->receiptDetails[0]->schedule->court->building->name }}</label>
                        </div>                        
                    </div>
                </div>
            </td>
            <td>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Biaya</label>
                        </div>
                        <div class="form-group">
                            <label>Disc.</label>
                        </div>
                        <div class="form-group">
                            <label>Total</label>
                        </div>
                        <div class="form-group">
                            <label>Bayar</label>
                        </div>                        
                        <div class="form-group">
                            <label>Status</label>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <label>:</label>
                        </div>
                        <div class="form-group">
                            <label>:</label>
                        </div>
                        <div class="form-group">
                            <label>:</label>
                        </div>
                        <div class="form-group">
                            <label>:</label>
                        </div>                        
                        <div class="form-group">
                            <label>:</label>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>
                                <?php
                            $total = 0;
                                foreach ($receipt->receiptDetails as $receiptDetail) {
                                    $total = $total + $receiptDetail->price;                                                       
                                }

                                echo "Rp. " . NumberFormat($total);
                                ?></label>
                        </div>
                        <div class="form-group">
                            <label>{{ "Rp. " .  NumberFormat($receipt->discount) }}</label>
                        </div>
                        <div class="form-group">
                            <label>{{ "Rp. " .  NumberFormat($total - $receipt->discount) }}</label>
                        </div>                        
                        <div class="form-group">
                            <label>
                        <?php
                            $paymentTotal = 0;
                                foreach ($receipt->payments as $payment) {
                                    $paymentTotal = $paymentTotal + $payment->value;
                                }

                                echo "Rp. " . NumberFormat( $paymentTotal );

                                $belumBayarTotal = $belumBayarTotal + ($total - $receipt->discount - $paymentTotal);
                                $bayarTotal = $bayarTotal + ($total - $receipt->discount);
                                ?>
                            </label>
                        </div>

                        <div class="form-group">
                            <label>{{ $receipt->status === '0'? "Belum Bayar" : ($receipt->status === '1'? "Bayar" : ($receipt->status === '2'? "Selesai" : "Block")) }}</label>
                        </div>                        
                    </div>
                </div>                
            </td>
            <td class="align-middle text-center">
                <?php 
                    $paymentNow = $total - $receipt->discount - $paymentTotal;
                ?>

                @if($receipt->status != "2" && $receipt->status != "1" && $paymentTotal == "0")
                <button type="button" class="btn btn-outline-warning btn-sm my-2" data-toggle="modal"
                    data-target="#update-discount" onclick="AddReceiptId({{ $receipt->id}}, {{ $paymentNow + $receipt->discount }})">
                    <i class="fas fa-percent"></i> Discount
                </button>                                    
                @endif
                @if($receipt->status != "2" && $receipt->status != "1")
                <button type="button" class="btn btn-outline-success btn-sm my-2" data-toggle="modal"
                    data-target="#update-payment" onclick="AddReceiptIdDetail({{ $receipt->id}}, {{ $paymentNow + $receipt->discount }}, {{ $receipt->payments }})">
                    <i class="fas fa-money-check-alt"></i> Bayar
                </button>                                    
                @endif

                @if($receipt->status != "2" )
                    <form action="{{ URL::to('/admin/receipt') }}" method="POST" autocomplete="off">
                        @csrf
                        <input type="hidden" name="receipt_id" value="{{ $receipt->id }}"/>
                        <input type="hidden" name="status" value="2">
                        <input type="hidden" name="value" value="{{ $paymentNow }}">                    
                        <button type="submit"  onclick="return confirm('Anda yakin menyelesaikan nota {{ $receipt->number }} dan membayar semua tagihannya?')" class="btn btn-warning btn-sm my-2"> <i class="fas fa-pen"></i> Selesai</button>
                    </form>
                @endif 

                @if($receipt->status === "3" && $receipt->discount == "0" && $paymentTotal == "0")
                <button type="button" class="btn btn-primary btn-sm my-2"  onclick="copyLink('{{ URL::to('/midtrans-payment/' . $receipt->id)  }}')">
                    <i class="fas fa-link"></i> Link
                </button>                                    
                @endif                
                <a target="_blank" href="{{ URL::to('/admin/receipt/' . $receipt->id) }}" class="btn btn-success btn-sm"> <i class="fas fa-eye"></i> Lihat</a>                  
                @if(auth()->user()->role === "superadmin")
                <form action="{{ URL::to('/admin/receipt/' . $receipt->id) }}" method="POST">
                    @method('delete')
                    @csrf
                    <button onclick="return confirm('Anda yakin menghapus data ini?')" type="submit"
                        class="btn btn-danger btn-sm my-2"><i class="fas fa-times"></i> Hapus</button>
                </form>                    
                @endif

                @if($receipt->status === '0')
                    
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>


</table>
{{-- <div class="modal fade" id="weekly-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Nota Pesanan Mingguan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ URL::to('/admin/week'); }}" method="POST" autocomplete="off">
                    @csrf
                    <input type="hidden" name="receipt_id" id="receipt_id"/>
                    <div class="form-group">
                        <label for="">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="1">Bayar 
                            </option>
                            <option value="2">Selesai 
                            </option>                            
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div> --}}
<div class="modal fade" id="update-payment">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Cicil Bayar</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="receipt_id_payment" id="receipt_id_payment"/>
                <input type="hidden" name="payment_payment" id="payment_payment"/>
                <label>Nilai Bayar</label>
                <input type="number" class="form-control mb-3" id="value_payment" name="value" value="0">    

                <button type="submit" class="btn btn-outline-success" onclick="addPayment()">Tambah</button>   
                <hr/>               
                <div class="text-center text-bold">Histori Pembayaran</div>      
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Nilai</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="payment-body-table">

                    </tbody>
                </table>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="update-discount">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ubah Discount</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ URL::to('/admin/receipt') }}" method="POST" autocomplete="off">
                    @csrf
                    <input type="hidden" name="receipt_id" id="receipt_id"/>
                    <input type="hidden" name="status" value="-1"/>
                    <input type="hidden" name="payment" id="payment"/>

                    <input type="number" class="form-control mb-3" name="discount" value="0">    

                    <button type="submit" class="btn btn-outline-warning">Ubah</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="filter-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Filter</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Tanggal Awal</label>
                            <input class="form-control" type="date" name="startDate" id="startDateFilter" value="{{ $startDate }}">
                        </div>           
                        <div class="form-group">
                            <label for="">Status</label>                            
                            <select name="status" id="statusFilter" class="form-control">
                                <option value="" {{ $status === '' ? "selected" : "" }}>Semua 
                                </option>                                 
                                <option value="0" {{ $status === '0' ? "selected" : "" }}>Belum Bayar 
                                </option>                                
                                <option value="1" {{ $status === '1' ? "selected" : "" }}>Bayar 
                                </option>
                                <option value="2" {{ $status === '2' ? "selected" : "" }}>Selesai 
                                </option>           
                                <option value="3" {{ $status === '3' ? "selected" : "" }}>Block 
                                </option>                    
                            </select>                            
                        </div>                                        
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Tanggal Awal</label>
                            <input class="form-control" type="date" name="endDate" id="endDateFilter" value="{{ $endDate }}">
                        </div>                            
                    </div>                    
                </div>                
                <button onclick="reloadPage()" class="btn btn-primary">Cari</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="revenue-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Pendapatan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="example" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>                   
                    <tbody>
                        <tr>
                            <td width="30%">Filter</td>
                            <td width="1%">:</td>
                            <td>{{ DateFormat($startDate, "DD MMMM Y") }} - {{ DateFormat($endDate, "DD MMMM Y") }} ({{ $status === '0'? "Belum Bayar" : ($status === '1'? "Bayar" : ($status == ''? "Semua" : "Selesai")) }})</td>
                        </tr>
                        <tr>
                            <td width="30%">Belum bayar</td>
                            <td width="1%">:</td>
                            <td>Rp. {{ NumberFormat($belumBayarTotal) }}</td>
                        </tr>
                        <tr>
                            <td width="30%">Bayar</td>
                            <td width="1%">:</td>
                            <td>Rp. {{ NumberFormat($bayarTotal) }}</td>
                        </tr>   
                        <tr>
                            <td width="30%">Total</td>
                            <td width="1%">:</td>
                            <td>Rp. {{ NumberFormat($bayarTotal + $belumBayarTotal) }}</td>
                        </tr>                                                                     
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script>
    const AddReceiptId = (id, payment) =>{
        document.getElementById("receipt_id").value=id;
        document.getElementById("payment").value=payment;    
    }


    const deletePayment = (id) =>{
        if(confirm("Anda yakin menghapus data ini?")){
            const myFormData = {
                "_token": "{{ csrf_token() }}",
            };            
            $.ajax({
                type: 'DELETE',
                url: "<?= URL::to('/admin/payment'); ?>" + "/" + id,
                data: myFormData,                
                success: function(data) {
                    if(data){
                        alert(data);
                    }else{
                        alert("Data berhasil dihapus!");
                        location.reload();
                    }
                },
                error: function (e) {
                    alert(e.statusText);
                }
            });
        }

    };

    const addPayment = () =>{
        const receipt_id = document.getElementById("receipt_id_payment").value;
        const payment = Number(document.getElementById("payment_payment").value);
        const valueString = document.getElementById("value_payment").value;        
        const reg = /^\d+$/;
        if(!reg.test(valueString))
        {
            alert("Nilai harus angka");
            return;
            
        }

        const value = Number(valueString);
        if(!Number.isInteger(value) || value < 0){
            alert("Nilai harus positif lebih dari 0");
            return;
        }

        if(value > payment){
            alert("Nilai bayar tidak boleh lebih dari sisa pembayaran");
            return;
        }

        const myFormData = {
            receipt_id, payment, value, "_token": "{{ csrf_token() }}",
        };            

        $.ajax({
            type: 'POST',
            url: "<?= URL::to('/admin/payment'); ?>",
            data: myFormData,                
            success: function(data) {
                if(data){
                    alert(data);
                }else{
                    alert("Data berhasil ditambah!");
                    location.reload();
                }
            },
            error: function (e) {
                alert(e.statusText);
            }
        });
    };

  const AddReceiptIdDetail = (id, paymentNow, payments) => {
    document.getElementById("receipt_id_payment").value=id;
    document.getElementById("payment_payment").value=paymentNow;  

    $("#payment-body-table").find("tr").remove();

    payments.forEach((payment, i) => {
        const createdAt = new Date(payment.created_at) ;

      let row =
        "<tr><td>" +
        (i + 1) +
        "</td><td>" +  createdAt.getDate() + "-" +  (createdAt.getMonth() + 1) + "-" + createdAt.getFullYear()
         +
        "</td><td>" +
        payment.value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") +
        '</td><td  align="center" ><button onclick="deletePayment('+ payment.id +')" id="delete_' +
        payment.id +
        '" class="text-danger">Hapus</button></td></tr>';
      $("#payment-body-table").append(row);
    });
  };

  function reloadPage(){
    const startDateFilter = document.getElementById("startDateFilter").value;
    const endDateFilter = document.getElementById("endDateFilter").value;
    const statusFilter = document.getElementById("statusFilter").value;

    window.open(window.location.pathname + '?startDate=' + startDateFilter + '&endDate=' + endDateFilter + '&status=' + statusFilter, '_self');
  }    

  function copyLink(data)
  {
        // Copy the text inside the text field
    navigator.clipboard.writeText(data);
    
    // Alert the copied text
    alert("Data sudah disimpan di clipboard :" + data);
  }
</script>