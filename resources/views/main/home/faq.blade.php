        <!-- FAQ Section -->
        <section class="faq-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-header-one text-center aos" data-aos="fade-up">
                            <h5>Temukan Jawaban Anda</h5>
                            <h2 class="section-title">Pertanyaan Umum</h2>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-12 aos" data-aos="fade-up">
                        <div class="faq-img">
                            <img src="{{ URL::to('/')}}/assets/img/faq-img.png" class="img-fluid" alt="img">
                            <div class="faq-patients-count">
                                <div class="faq-smile-img">
                                    <img src="{{ URL::to('/')}}/assets/img/icons/smiling-icon.svg" alt="icon">
                                </div>
                                <div class="faq-patients-content">
                                    <h4><span class="count-digit">100</span>%</h4>
                                    <p>Kepuasan Pelanggan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="faq-info aos" data-aos="fade-up">
                            <div class="accordion" id="faq-details">
					@foreach ($questions as $key =>$question)       
                                <!-- FAQ Item -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading{{$key}}">
                                        <a href="javascript:void(0);" class="accordion-button {{ $key == 0? '' : 'collapsed' }}" data-bs-toggle="collapse"
                                            data-bs-target="#collapse{{$key}}" aria-expanded="{{ $key==0?'true' : 'false' }}"
                                            aria-controls="collapse{{$key}}">
                                            {{ $question->question }}
                                        </a>
                                    </h2>
                                    <div id="collapse{{$key}}" class="accordion-collapse collapse {{ $key == 0? 'show' : '' }}"
                                        aria-labelledby="heading{{$key}}" data-bs-parent="#faq-details">
                                        <div class="accordion-body">
                                            <div class="accordion-content">
                                                <p>{{ $question->answer }} </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /FAQ Item -->
                    @endforeach		

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /FAQ Section -->