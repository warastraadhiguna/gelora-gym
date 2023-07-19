        <!-- Specialities Section -->
        <section class="specialities-section-one">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 aos" data-aos="fade-up">
                        <div class="section-header-one section-header-slider">
                            <h2 class="section-title">Jenis Olahraga</h2>
                        </div>
                    </div>
                    <div class="col-md-6 aos" data-aos="fade-up">
                        <div class="owl-nav slide-nav-1 text-end nav-control"></div>
                    </div>
                </div>
                <div class="owl-carousel specialities-slider-one owl-theme aos" data-aos="fade-up">
                @foreach ($types as $type)                    
                    <div class="item">
                        <div class="specialities-item">
                            <div class="specialities-img">
                                <span><img src="{{ URL::to('/')}}/storage/{{ $type->image_url }}" alt=""></span>
                            </div>
                            <p>{{ $type->name }}</p>
                        </div>
                    </div>
                @endforeach                    
                {{-- <div class="specialities-btn aos" data-aos="fade-up">
                    <a href="search.html" class="btn">
                        See All Specialities
                    </a>
                </div> --}}
            </div>
        </section>
        <!-- /Specialities Section -->