        <!-- Articles Section -->
        <section class="articles-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 aos" data-aos="fade-up">
                        <div class="section-header-one text-center">
                            <h2 class="section-title">Artikel Terakhir</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
			<?php $totalShow = count($lastestBlogs) > 4 ? 4 : count($lastestBlogs)   ?>
			@for($i = 0; $i < $totalShow   ; $i++)
			<?php $blog =  $lastestBlogs[$i]?>
                    <div class="col-lg-6 col-md-6 d-flex aos" data-aos="fade-up">
                        <div class="articles-grid w-100">
                            <div class="articles-info">
                                <div class="articles-left">
                                    <a href="{{ URL::to('/blog') . "/" . $blog->id }}">
                                        <div class="articles-img">
                                            <img src="{{ URL::to('/storage') }}/{{ $blog->image_url  }}" class="img-fluid" alt="">
                                        </div>
                                    </a>
                                </div>
                                <div class="articles-right">
                                    <div class="articles-content">
                                        <ul class="articles-list nav">
                                            <li>
                                                <i class="feather-type"></i>{{ $blog->blogCategory->name }}
                                            </li>
                                            <li>
                                                <i class="feather-calendar"></i> {{ DateFormat($blog->created_at, "D MMMM Y") }}
                                            </li>
                                        </ul>
                                        <h4>
                                            <a href="{{ URL::to('/blog') . "/" . $blog->id }}">5 {{ $blog->title }}</a>
                                        </h4>
                                        <p>{{ $blog->summary }}</p>
                                        <a href="{{ URL::to('/blog') . "/" . $blog->id }}" class="btn">Lanjut baca</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
			@endfor	
                </div>
            </div>
        </section>
        <!-- /Articles Section -->