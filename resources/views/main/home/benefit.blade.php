        <!-- Work Section -->
        <section class="work-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-12 work-img-info aos" data-aos="fade-up">
                        <div class="work-img">
                            <img src="{{ URL::to('/')}}/assets/img/work-img.png" class="img-fluid" alt="">
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12 work-details">
                        <div class="section-header-one aos" data-aos="fade-up">
                            {{-- <h5>How it Works</h5> --}}
                            <h2 class="section-title">Keunggulan Kami</h2>
                        </div>
                        <div class="row">
					@foreach ($benefits as $benefit)                            
                            <div class="col-lg-6 col-md-6 aos" data-aos="fade-up">
                                <div class="work-info">
                                    <div class="work-icon">
                                        <span><img src="{{ URL::to('/')}}/assets/img/icons/globe.svg" alt=""></span>
                                    </div>
                                    <div class="work-content">
                                        <h5>{{ $benefit->name }}</h5>
                                        <p>{{ $benefit->note }}</p>
                                    </div>
                                </div>
                            </div>
                    @endforeach		
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Work Section -->