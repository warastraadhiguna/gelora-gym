        <!-- Doctors Section -->
        <section class="doctors-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 aos" data-aos="fade-up">
                        <div class="section-header-one section-header-slider">
                            <h2 class="section-title">Gedung Olahraga</h2>
                        </div>
                    </div>
                    <div class="col-md-6 aos" data-aos="fade-up">
                        <div class="owl-nav slide-nav-2 text-end nav-control"></div>
                    </div>
                </div>
                <div class="owl-carousel doctor-slider-one owl-theme aos" data-aos="fade-up">
                    @foreach ($buildings as $building)
                    <!-- Doctor Item -->
                    <div class="item">
                        <div class="doctor-profile-widget">
                            <div class="doc-pro-img">
                                <a href="{{ URL::to('/building') . "/" . $building->id }}">
                                    <div class="doctor-profile-img">
                                        <img src="{{ URL::to('/storage') }}/{{ $building->image_url  }}" class="img-fluid" alt="">
                                    </div>
                                </a>
                                {{-- <div class="doctor-amount">
                                    <span>{{ $building->address }}</span>
                                </div> --}}
                            </div>
                            <div class="doc-content">
                                <div class="doc-pro-info">
                                    <div class="doc-pro-name">
                                        <a href="{{ URL::to('/building') . "/" . $building->id }}">{{ $building->name }}</a>
                                        <p>{{ $building->type->name }}</p>
                                    </div>
                                    <div class="reviews-ratings">
                                        <p>
                                            <span><i class="fas fa-star"></i>{{ $building->star }}</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="doc-pro-location">
                                    <p><i class="feather-map-pin"></i> {{ $building->address }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Doctor Item -->
                    @endforeach		

                </div>
            </div>
        </section>
        <!-- /Doctors Section -->