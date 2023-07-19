@if($receipt->status=='0')
    <span
    class="badge rounded-pill bg-danger-light">Belum Bayar</span>
@elseif($receipt->status=='1')
    <span
    class="badge rounded-pill bg-success-light">Sudah Bayar</span>
@else
    <span
    class="badge rounded-pill bg-primary-light">Selesai</span>  
@endif