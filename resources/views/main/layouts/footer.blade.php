       <!-- Footer -->
        <footer class="footer footer-one">
            <div class="footer-top aos" data-aos="fade-up">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-4">
                            <div class="footer-widget footer-about">
                                <div class="footer-logo">
                                    <img src="{{ URL::to('/storage'); }}/{{ $company->logo_url  }}" alt="logo">
                                </div>
                                <div class="footer-about-content">
                                    <p>{{ $company->note  }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-4">
                            <div class="footer-widget footer-menu">
                                <h2 class="footer-title">Gedung Olahraga</h2>
                                <ul>
                                    <li><a href="{{ URL::to('/building'); }}">Pilih Olahraga</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-4">
                            <div class="footer-widget footer-menu">
                                <h2 class="footer-title">Kategori Artikel</h2>
                                <ul>
										@foreach ($blogCategories as $blogCategory)										
										<li><a href="#" onclick="searchBlogByCategory({{ $blogCategory->id }})">{{ $blogCategory->name }} </a></li>
										@endforeach	 
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="footer-widget footer-contact">
                                <h2 class="footer-title">Hubungi Kami</h2>
                                <div class="footer-contact-info">
                                    <div class="footer-address">
                                        <p><i class="feather-map-pin"></i> <a target="_blank" href="{{ $company->google_map }}" style="text-decoration: underline;"> {{ $company->address . ' ' .   $company->city}}</a></p>
                                    </div>
                                    <div class="footer-address">
                                        <p><i class="feather-phone-call"></i> {{ $company->phone }}</p>
                                    </div>
                                    <div class="footer-address mb-0">
                                        <p><i class="feather-mail"></i> {{ $company->email }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6">
                            <div class="footer-widget">
                                <h2 class="footer-title">Lebih Dekat</h2>
                                <div class="social-icon">
                                    <ul>
                                        <li>
                                            <a href="{{ $company->facebook  }}" target="_blank"><i class="fab fa-facebook"></i> </a>
                                        </li>
                                        <li>
                                            <a href="{{ $company->instagram  }}" target="_blank"><i class="fab fa-instagram"></i></a>
                                        </li>
                                        <li>
                                            <a href="{{ $company->youtube  }}" target="_blank"><i class="fab fa-youtube"></i> </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="footer-bottom">
                <div class="container">
                    <!-- Copyright -->
                    <div class="copyright">
                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <div class="copyright-text">
                                    <p class="mb-0"> Copyright © 2023 <a
                                            href="https://themeforest.net/user/dreamguys/portfolio"
                                            target="_blank">Dreamguys.</a> All Rights Reserved</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">

                                <!-- Copyright Menu -->
                                <div class="copyright-menu">
                                    <ul class="policy-menu">
                                        <li><a href="privacy-policy.html">Privacy Policy</a></li>
                                        <li><a href="terms-condition.html">Terms and Conditions</a></li>
                                    </ul>
                                </div>
                                <!-- /Copyright Menu -->

                            </div>
                        </div>
                    </div>
                    <!-- /Copyright -->
                </div>
            </div> --}}
        </footer>
        <!-- /Footer -->

        <!-- Cursor -->
        <div class="mouse-cursor cursor-outer"></div>
        <div class="mouse-cursor cursor-inner"></div>
        <!-- /Cursor -->

    </div>
    <!-- /Main Wrapper -->

    <!-- ScrollToTop -->
    <div class="progress-wrap active-progress">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"
                style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919px, 307.919px; stroke-dashoffset: 228.265px;">
            </path>
        </svg>
    </div>
    <!-- /ScrollToTop -->

	  <script>
		function searchBlogByCategory(category)
		{		
			const url = '<?= URL::to('/blog'); ?>';
			window.open(url + '?category='+ category,  '_self');
		}
		</script>    
    <!-- jQuery -->
    <script src="{{ URL::to('/')}}/assets/js/jquery-3.6.4.min.js"></script>

    <!-- Bootstrap Bundle JS -->
    <script src="{{ URL::to('/')}}/assets/js/bootstrap.bundle.min.js"></script>

    <!-- Feather Icon JS -->
    <script src="{{ URL::to('/')}}/assets/js/feather.min.js"></script>

    <script src="{{ URL::to('/assets/plugins/theia-sticky-sidebar/ResizeSensor.js'); }}"></script>
    <script src="{{ URL::to('/assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js'); }}"></script>

    <!-- Datepicker JS -->
    <script src="{{ URL::to('/')}}/assets/js/moment.min.js"></script>
    <script src="{{ URL::to('/')}}/assets/js/bootstrap-datetimepicker.min.js"></script>

	<!-- Select2 JS -->
	<script src="{{ URL::to('/')}}/assets/plugins/select2/js/select2.min.js"></script>

    <!-- Owl Carousel JS -->
    <script src="{{ URL::to('/')}}/assets/js/owl.carousel.min.js"></script>

    <!-- Slick JS -->
    <script src="{{ URL::to('/')}}/assets/js/slick.js"></script>

    <!-- Animation JS -->
    <script src="{{ URL::to('/')}}/assets/js/aos.js"></script>

    @if(Request::is('/'))
    <!-- Counter JS -->
    <script src="{{ URL::to('/')}}/assets/js/counter.js"></script>        
    @endif


    <!-- BacktoTop JS -->
    <script src="{{ URL::to('/')}}/assets/js/backToTop.js"></script>

    <!-- Fancybox JS -->
    <script src="{{ URL::to('/')}}/assets/plugins/fancybox/jquery.fancybox.min.js"></script>

    <!-- Custom JS -->
    <script src="{{ URL::to('/')}}/assets/js/script.js"></script>
    <script>
    $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
    });
    
    </script>
</body>

</html>