@include('sweetalert::alert')

<a href="{{ URL::to('/admin/web/blog/create') }}" class="btn btn-primary mb-3"><i class="fas fa-plus" aria-hidden="true"></i> Tambah</a>  


  <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>Data Blog</th>        
                        <th>Gambar</th>                        
                        <th width="20%">Action</th> 
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($blogs as $blog)
                    <tr>
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td>
                          <table class="table-borderless">
                            <tbody>
                              <tr>
                                <td>Kategori</td>
                                <td>:</td>      
                                <td>{{ $blog->blogCategory->name  }}</td>                                                            
                              </tr>
                              <tr>
                                <td>Judul</td>
                                <td>:</td>      
                                <td>{{ $blog->title  }}</td>       
                              </tr>
                              <tr>
                                <td>Ringkasan</td>
                                <td>:</td>      
                                <td>{{ $blog->summary  }}</td>                      
                              </tr>    
                              <tr>
                                <td>Status</td>
                                <td>:</td>      
                                <td>{{ $blog->is_published === "1" ? "Publikasi" : "Non Publikasi"  }}</td>                                                            
                              </tr>                 
                            </tbody>
                          </table>
                        </td>          
                        <td class="align-middle"><img src="{{ URL::to('storage/' .$blog->image_url) }}"  width="100%" alt=""></td>                 
                        <td class="align-middle">
                            <div class="d-flex">
                                <a href="{{ URL::to('/admin/web/blog/' . $blog->id . "/edit") }}" class="btn btn-success mx-2  btn-sm"> <i class="fas fa-edit"></i> Edit</a>  
                                
                                <form action="{{ URL::to('/admin/web/blog/' . $blog->id) }}" method="POST">
                                    @method('delete')
                                    @csrf
                                    <button onclick="return confirm('Anda yakin menghapus data ini?')" type="submit" class="btn btn-danger  btn-sm"><i class="fas fa-times"></i> Hapus</button>      
                                </form>
                            </div>
                    
                        </td>                                    
                    </tr>            
                    @endforeach     
                  </tbody>


                </table>