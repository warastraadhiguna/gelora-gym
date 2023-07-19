@include('sweetalert::alert')

<a href="{{ URL::to('/building'); }}" class="btn btn-primary mb-3"><i class="fas fa-plus" aria-hidden="true"></i>
    Tambah</a>
<button type="button" class="btn btn-info mb-3" data-toggle="modal"
    data-target="#filter-modal">
    <i class="fas fa-calendar-week"></i> Mingguan
</button>       
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
    $selesaiTotal=0;     
?>
<table id="example1" class="table table-bordered table-striped" width="100%">
    <thead>
        <tr>
            <th width="5%">No</th>
            <th width="45%">Penyewa</th>
            <th width="40%">Detail</th>
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
                            <label>Gedung</label>
                        </div>
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
                            <label>Biaya</label>
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
                        <div class="form-group">
                            <label>:</label>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>{{ $receipt->receiptDetails[0]->schedule->court->building->name }}</label>
                        </div>
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
                            <label>
                                <?php
                            $total = 0;
                                foreach ($receipt->receiptDetails as $receiptDetail) {
                                    $total = $total + $receiptDetail->price;

                                    if($receipt->status == '0'){
                                        $belumBayarTotal = $belumBayarTotal + $receiptDetail->price;    
                                    }
                                    else if($receipt->status == '1'){
                                        $bayarTotal = $bayarTotal + $receiptDetail->price;    
                                    }           
                                    else if($receipt->status == '2'){
                                        $selesaiTotal = $selesaiTotal + $receiptDetail->price;    
                                    }                                                               
                                }

                                echo "Rp. " . NumberFormat($total);
                                ?></label>
                        </div>
                        <div class="form-group">
                            <label>{{ $receipt->status === '0'? "Belum Bayar" : ($receipt->status === '1'? "Bayar" : "Selesai") }}</label>
                        </div>
                    </div>
                </div>
            </td>
            <td class="align-middle text-center">
                @if($receipt->status != "2" )
                <button type="button" class="btn btn-warning btn-sm my-2" data-toggle="modal"
                    data-target="#update-modal" onclick="AddReceiptId({{ $receipt->id }})">
                    <i class="fas fa-pen"></i> Status
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
            </td>
        </tr>
        @endforeach
    </tbody>


</table>
<div class="modal fade" id="weekly-modal">
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
                <form action="{{ URL::to('/admin/receipt'); }}" method="POST" autocomplete="off">
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
                            <td width="30%">Selesai</td>
                            <td width="1%">:</td>
                            <td>Rp. {{ NumberFormat($selesaiTotal) }}</td>
                        </tr>   
                        <tr>
                            <td width="30%">Total</td>
                            <td width="1%">:</td>
                            <td>Rp. {{ NumberFormat($selesaiTotal + $bayarTotal + $belumBayarTotal) }}</td>
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
    const AddReceiptId = (id) =>{
        document.getElementById("receipt_id").value=id;
    }

  function reloadPage(){
    const startDateFilter = document.getElementById("startDateFilter").value;
    const endDateFilter = document.getElementById("endDateFilter").value;
    const statusFilter = document.getElementById("statusFilter").value;

    window.open(window.location.pathname + '?startDate=' + startDateFilter + '&endDate=' + endDateFilter + '&status=' + statusFilter, '_self');
  }    
</script>