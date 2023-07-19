@include('sweetalert::alert')

<a href="{{ URL::to('/admin/web/blog-category/create'); }}" class="btn btn-primary mb-3"><i class="fas fa-plus" aria-hidden="true"></i> Tambah</a>  


  <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                        <th width="10%">No</th>
                        <th>Nama</th>                    
                        <th width="20%">Action</th> 
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($blogCategories as $blogCategory)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $blogCategory->name  }}</td>                      
                        <td>
                            <div class="d-flex">
                                <a href="{{ URL::to('/admin/web/blog-category/' . $blogCategory->id . "/edit") }}" class="btn btn-success mx-2 btn-sm"> <i class="fas fa-edit    "></i> Edit</a>  
                                
                                <form action="{{ URL::to('/admin/web/blog-category/' . $blogCategory->id) }}" method="POST">
                                    @method('delete')
                                    @csrf
                                    <button onclick="return confirm('Anda yakin menghapus data ini?')" blogCategory="submit" class="btn btn-danger btn-sm"><i class="fas fa-times"></i> Hapus</button>      
                                </form>
                            </div>
                    
                        </td>                                    
                    </tr>            
                    @endforeach     
                  </tbody>


                </table>