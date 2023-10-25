@include('sweetalert::alert')

<a href="{{ URL::to('/admin/building/create') }}" class="btn btn-primary mb-3"><i class="fas fa-plus" aria-hidden="true"></i> Tambah</a>  


  <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>Data Gedung</th>        
                        <th>Gambar</th>                        
                        <th width="20%">Action</th> 
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($buildings as $building)
                    <tr>
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td>
                          <table class="table-borderless">
                            <tbody>
                              <tr>
                                <td>Jenis</td>
                                <td>:</td>      
                                <td>{{ $building->type->name  }}</td>                                                            
                              </tr>
                              <tr>
                                <td>Kode</td>
                                <td>:</td>      
                                <td>{{ $building->code  }}</td>                                                            
                              </tr>     
                              <tr>
                                <td>Nama</td>
                                <td>:</td>      
                                <td>{{ $building->name  }}</td>                                                            
                              </tr>
                              <tr>
                                <td>Telepon</td>
                                <td>:</td>      
                                <td>{{ $building->phone  }}</td>                                                            
                              </tr>                                                
                              <tr>
                                <td>Alamat</td>
                                <td>:</td>      
                                <td>{{ $building->address  }}</td>                                                            
                              </tr>                                         <tr>
                                <td>Catatan</td>
                                <td>:</td>      
                                <td>{{ $building->note  }}</td>                                     
                              </tr>      
                              <tr>
                                <td>Jam Operasional</td>
                                <td>:</td>      
                                <td>{{ $building->operational_times  }}</td>                                     
                              </tr>                                  
                              <tr>
                                <td>Fasilitas</td>
                                <td>:</td>      
                                <td>{{ $building->facilities  }}</td>                                     
                              </tr>                                          
                              <tr>
                                <td>Google Map</td>
                                <td>:</td>      
                                <td>{{ $building->google_location_url  }}</td>                 
                              </tr>      
                              <tr>
                                <td>Star</td>
                                <td>:</td>      
                                <td>{{ $building->star   }}</td>
                              </tr>             
                              <tr>
                                <td>Status Booking</td>
                                <td>:</td>      
                                <td>{{ $building->is_bookable === "1" ? "Bisa dibooking" : "Tidak bisa dibooking"  }}</td>
                              </tr>  
                              <tr>
                                <td>Status</td>
                                <td>:</td>      
                                <td>{{ IsActive($building->is_active)   }}</td>
                              </tr>                 
                            </tbody>
                          </table>
                        </td>          
                        <td class="align-middle"><img src="{{ URL::to('storage/' .$building->image_url) }}"  width="100%" alt=""></td>                 
                        <td class="align-middle text-center">
                          <a href="{{ URL::to('/admin/court?building_id=' . $building->id) }}" class="btn btn-primary mr-2 mb-2  btn-sm"> <i class="fas fa-band-aid"></i> Lapangan</a>          
                          <a href="{{ URL::to('/admin/building/' . $building->id . "/edit") }}" class="btn btn-success mr-2 mb-2  btn-sm"> <i class="fas fa-edit"></i> Edit</a>  
                          
                          <form action="{{ URL::to('/admin/building/' . $building->id) }}" method="POST">
                              @method('delete')
                              @csrf
                              <button onclick="return confirm('Anda yakin menghapus data ini?')" type="submit" class="btn btn-danger  btn-sm"><i class="fas fa-times"></i> Hapus</button>      
                          </form>                    
                        </td>                                    
                    </tr>            
                    @endforeach     
                  </tbody>


                </table>