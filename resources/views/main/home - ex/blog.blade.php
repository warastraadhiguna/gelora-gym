<!-- Blog -->
<section class="blog-section">
	<div class="container">
		<div class="section-header text-center">
			<h5>Baca Blog Kami</h5>
			<h2>Berita dan Informasi</h2>
			{{-- <p class="sub-title">Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took</p> --}}
		</div>
		<div class="row justify-content-center">
			<?php $totalShow = count($lastestBlogs) == 5 || count($lastestBlogs) == 4 ? 3 : count($lastestBlogs)   ?>
			@for($i = 0; $i < $totalShow   ; $i++)
			<?php $blog =  $lastestBlogs[$i]?>
				<div class="col-12 col-md-6 col-lg-4">
				<div class="blog-widget">
					<a href="{{ URL::to('/blog') . "/" . $blog->id; }}" class="blog-img">
						<img src="{{ URL::to('/storage'); }}/{{ $blog->image_url  }}" alt="">
					</a>
					<div class="date-col">
						<span>{{ DateFormat($blog->created_at, "D MMMM Y") }}</span>
					</div>
					<div class="blog-content text-center">
						<h6>{{ $blog->blogCategory->name }}</h6>
						<h5>{{ $blog->title }}</h5>
						<p>{{ $blog->summary }}</p>
						<a href="{{ URL::to('/blog') . "/" . $blog->id; }}" class="readmore-btn" tabindex="-1"><i class="fas fa-chevron-circle-right"></i> Lanjut baca</a>
					</div>
				</div>
				</div>
			@endfor	
		</div>
	</div>
</section>
<!-- /Blog -->