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
                <h2 class="breadcrumb-title">Detail Blog</h2>
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
                <div class="blog-view">
                    <div class="blog blog-single-post">
                        <div class="blog-image">
                            <a href="javascript:void(0);"><img alt="" src="{{ URL::to('/storage') }}/{{ $blog->image_url  }}" class="img-fluid"></a>
                        </div>
                        <h3 class="blog-title">{{ $blog->title  }} </h3>
                        <div class="blog-info clearfix">
                            <div class="post-left">
                                <ul>
                                    <li>
                                        <div class="post-author">
                                            <a href="#"><i class="far fa-user"></i><span>{{ $blog->user->name }}</span></a>
                                        </div>
                                    </li>
                                    <li><i class="far fa-calendar"></i>{{ DateFormat($blog->created_at, "D MMMM Y") }}</li>
                                    <li><i class="fa fa-tags"></i>{{ $blog->blogCategory->name }}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="blog-content">
                            <p>{!! $blog->contain !!}</p>
                        </div>
                    </div>
                    
                    <div class="card blog-share clearfix">
                        <div class="card-header">
                            <h4 class="card-title">Share the post</h4>
                        </div>
                        <div class="card-body">
                            <ul class="social-share">
                                <li><a target="_blank" href="https://api.whatsapp.com/send?text={{ $blog->title . '~' . URL::to('/blog') . '/' . $blog->id   }}" title="Whatsapp"><i class="fab fa-whatsapp"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        
            @include('main.blog.sidebar')
            
        </div>
    </div>
</div>		