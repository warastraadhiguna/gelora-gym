<!-- Blog Sidebar -->
<div class="col-lg-4 col-md-12 sidebar-right theiaStickySidebar">

    <!-- Search -->
    <div class="card search-widget">
        <div class="card-body">
            <form  class="search-form" action="{{ URL::to('/blog') }}" method="POST" autocomplete="off">
            <div class="input-group">
                    @csrf
                    <input type="hidden" name="category" value="<?= isset($category)? $category : '0'; ?>"/>
                    <input type="text" id='searchBlogString' name='searchBlogString' placeholder="Cari..." class="form-control" value="{{ isset($search)? $search : '' }}">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
            </div>
            </form>
        </div>
    </div>
    <!-- /Search -->

    <!-- Latest Posts -->
    <div class="card post-widget">
        <div class="card-header">
            <h4 class="card-title">Latest Posts</h4>
        </div>
        <div class="card-body">
            <ul class="latest-posts">
                @foreach ($lastestBlogs as $lastestBlog)	                            
                <li>
                    <div class="post-thumb">
                        <a href="{{ URL::to('/blog') . "/" . $lastestBlog->id }}">
                            <img class="img-fluid" src="{{ URL::to('/storage') }}/{{ $lastestBlog->image_url  }}" alt="">
                        </a>
                    </div>
                    <div class="post-info">
                        <h4>
                            <a href="{{ URL::to('/blog') . "/" . $lastestBlog->id }}">{{ $lastestBlog->blogCategory->name . " - " .  $lastestBlog->title}}</a>
                        </h4>
                        <p>{{ DateFormat($lastestBlog->created_at, "D MMMM Y") }}</p>
                    </div>
                </li>
                @endforeach	                              
            </ul>
        </div>
    </div>
    <!-- /Latest Posts -->

    <!-- Categories -->
    <div class="card category-widget">
        <div class="card-header">
            <h4 class="card-title">Kategori Blog</h4>
        </div>
        <div class="card-body">
            <ul class="categories">
                @foreach ($blogCategories as $blogCategory)		                            
                <li><a href="#" onclick="reloadPageByCategory({{ $blogCategory->id }})">{{ $blogCategory->name }} <span>({{ $blogCategory->blogs_count  }})</span></a></li>
                @endforeach	                            
            </ul>
        </div>
    </div>
    <!-- /Categories -->
    
</div>
<!-- /Blog Sidebar -->

<script>
const url = '<?= URL::to('/blog'); ?>';    

function reloadPageByCategory(category){
    const search = '<?= isset($search)? $search : ''; ?>';    
    window.open(url + '?search='+ search +'&category='+ category +'&page=1', '_self');
}  

// function reloadPageBySearch(){
//     const category = '< ?= isset($category)? $category : ''; ?>';   
//     const search = document.getElementById("searchBlogString").value;
//     window.open(url + '?search='+ search +'&category='+ category +'&page=1', '_self');
// }    
// </script>