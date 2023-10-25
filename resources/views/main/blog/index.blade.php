<!-- Breadcrumb -->
<div class="breadcrumb-bar">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-12 col-12">
                <nav aria-label="breadcrumb" class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Blog</li>
                    </ol>
                </nav>
                <h2 class="breadcrumb-title">List Blog</h2>
            </div>
        </div>
    </div>
</div>
<!-- /Breadcrumb -->

<!-- Page Content -->
<div class="content">
    <div class="container">
    
        <div class="row">
            <div class="col-lg-8 col-md-12">
                @if($choosenCategory)
                <div class="row">
                   <div class="col-md-6 col-sm-12">                    
                        <h3>Kategori : {{ $choosenCategory->name }} <i class="fa fa-times" style="color:red" onclick="reloadPageByCategory(0)"></i></h3>
                        
                    </div>    
                </div>
                <hr/>                    
                @endif

                @if($totalPage > 0)
                <div class="row blog-grid-row">
                    @foreach ($blogs as $blog)		
                    <div class="col-md-6 col-sm-12">
                        <!-- Blog Post -->
                        <div class="blog grid-blog">
                            <div class="blog-image">
                                <a href="{{ URL::to('/blog') . "/" . $blog->id }}"><img class="img-fluid" src="{{ URL::to('/storage') }}/{{ $blog->image_url  }}" alt="Post Image"></a>
                            </div>
                            <div class="blog-content">
                                <ul class="entry-meta meta-item">
                                    <li>
                                        <div class="post-author">
                                            <a href="#"><i class="far fa-user"></i> <span> {{ $blog->user->name }}</span></a>
                                        </div>
                                    </li>
                                    <li><i class="far fa-clock"></i> {{ DateFormat($blog->created_at, "D MMMM Y") }}</li>
                                </ul>
                                <h3 class="blog-title"><a href="{{ URL::to('/blog') . "/" . $blog->id }}">{{ $blog->blogCategory->name }} – {{ $blog->title  }}</a></h3>
                                <p class="mb-0">{{ $blog->summary }}</p>
                            </div>
                        </div>
                        <!-- /Blog Post -->
                        
                    </div>
                    @endforeach	   
                </div>
                <!-- Blog Pagination -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="blog-pagination">
                            <nav>
                                <ul class="pagination justify-content-center">
                                    <li class="page-item {{ $page ==1? 'disabled' : "" }}">
                                        <a class="page-link" href="#"  onclick="reloadPage({{ -1 }})" tabindex="-1"><i class="fas fa-angle-double-left"></i></a>
                                    </li>
                                    @for($i = 1; $i <= $totalPage; $i++)
                                    <li class="page-item {{ $page == $i? 'active' : "" }}">
                                        <a class="page-link" href="#" onclick="reloadPage({{ $i }})">{{ $i }}</a>
                                    </li>
                                    @endfor   

                                    <li class="page-item {{$page == $totalPage? 'disabled' : "" }}">
                                        <a class="page-link" href="#" onclick="reloadPage({{ -2 }})"><i class="fas fa-angle-double-right"></i></a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <!-- /Blog Pagination -->
                @else
                <div class="row">
                    <div class="col-md-12">
                        <p>Data tidak diketemukan . . . .</p>
                    </div>
                </div>
                @endif                
            </div>
            
            @include('main.blog.sidebar')
            
        </div>
    </div>
</div>	

<script>
  function reloadPage(page){
    const search = '<?= $search; ?>';
    const category = <?= $category; ?>;
    if(page == -1 )
    {
        let nowPage = <?= $page; ?>;
        if(nowPage > 1)
        {
            page = nowPage - 1;    
        }
    }
    else if (page == -2)
    {
        let nowPage = <?= $page; ?>;
        let totalPage = <?= $totalPage; ?>;      
        if(nowPage != totalPage)
        {
            page = nowPage + 1;     
        }  
    }

    window.open(window.location.pathname + '?search='+ search +'&category='+ category +'&page=' + page, '_self');
  }
</script>