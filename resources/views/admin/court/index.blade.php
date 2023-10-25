@include('sweetalert::alert')

 

<div class="row">
  <div class="col">
    <a href="{{ URL::to('/admin/court/create?building_id=') . $building_id }}" id="add-button" style="visibility: {{ $building_id? 'visible' : 'hidden' }}" class="btn btn-primary mb-3"><i class="fas fa-plus" aria-hidden="true"></i> Tambah</a> 
  </div>
  <div class="col-3">
    <select name="building_id" id="building_id" class="form-control" placeholder="Title" onchange="reloadPage()">
    <option value="">--Gedung--</option>
    @foreach ($buildings as $building)
        <option value="{{ $building->id }}" {{$building->id == $building_id? "selected" : ""  }}>{{ $building->name }}</option>
    @endforeach
    </select>
  </div>
</div>
<table id="example1" class="table table-bordered table-striped">
    <thead>
      <tr>
          <th width="5%">No</th>
          <th>Data Lapangan</th>        
          <th>Gambar</th>                        
          <th width="15%">Action</th> 
      </tr>
    </thead>
    <tbody>
      @foreach($courts as $court)
      <tr>
          <td class="align-middle">{{ $loop->iteration }}</td>
          <td>
            <table class="table-borderless">
              <tbody>
                <tr>
                  <td>Gedung</td>
                  <td>:</td>      
                  <td>{{ $court->building->name  }}</td>  
                </tr>
                <tr>
                  <td>Kode</td>
                  <td>:</td>      
                  <td>{{ $court->code  }}</td>                                                            
                </tr>     
                <tr>
                  <td>Nama</td>
                  <td>:</td>      
                  <td>{{ $court->name  }}</td>                                                            
                </tr>
                <tr>
                  <td>Catatan</td>
                  <td>:</td>      
                  <td>{{ $court->note  }}</td>                                                            
                </tr>           
                <tr>
                  <td>Harga</td>
                  <td>:</td>      
                  <td>{{ $court->price }}</td>                                                            
                </tr>                  
                <tr>
                  <td>Status</td>
                  <td>:</td>      
                  <td>{{ IsActive($court->is_active)   }}</td>                                                            
                </tr>                 
              </tbody>
            </table>
          </td>          
          <td class="align-middle"><img src="{{ URL::to('storage/' .$court->image_url) }}"  width="100%" alt=""></td>                 
          <td class="align-middle text-center">
              {{-- <div class="d-flex"> --}}
                  <a href="{{ URL::to('/admin/schedule?court_id=' . $court->id) }}" class="btn btn-primary mb-1  btn-sm"> <i class="fas fa-calendar"></i> Jadwal</a>     

                  {{-- <a href="{{ URL::to('/admin/weekly-booking?court_id=' . $court->id) }}" class="btn btn-info mb-1 btn-sm"> <i class="fas fa-calendar-week"></i> Mingguan</a>    --}}

                  <a href="{{ URL::to('/admin/court/' . $court->id . "/edit") }}" class="btn btn-success mb-1 btn-sm"> <i class="fas fa-edit    "></i> Edit</a>  
                  
                  <form action="{{ URL::to('/admin/court/' . $court->id) }}" method="POST">
                      @method('delete')
                      @csrf
                      <button onclick="return confirm('Anda yakin menghapus data ini?')" type="submit" class="btn btn-danger  btn-sm"><i class="fas fa-times"></i> Hapus</button>      
                  </form>
              {{-- </div> --}}      
          </td>                                    
      </tr>            
      @endforeach     
    </tbody>
</table>

<script>
  function reloadPage(){
    const building_id = $('select[name="building_id"]').val();
    window.open(window.location.pathname + (building_id? ('?building_id=' + building_id) : ''), '_self');
  }
</script>