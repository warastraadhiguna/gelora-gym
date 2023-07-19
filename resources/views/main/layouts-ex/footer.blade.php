			<!-- Footer -->
			<footer class="footer">
				
				<!-- Footer Top -->
				<div class="footer-top">
					<div class="container-fluid">
						<div class="row">
							<div class="col-lg-3 col-md-6">
							
								<!-- Footer Widget -->
								<div class="footer-widget footer-about">
									<div class="footer-logo">
										<img src="{{ URL::to('/storage'); }}/{{ $company->logo_url  }}" alt="logo">
									</div>
									<div class="footer-about-content">
										<p>{{ $company->note  }} </p>
										<div class="social-icon">
											<ul>
												<li>
													<a href="{{ $company->facebook  }}" target="_blank"><i class="fab fa-facebook"></i></a>
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
								<!-- /Footer Widget -->
								
							</div>
							
							<div class="col-lg-3 col-md-6">
							
								<!-- Footer Widget -->
								<div class="footer-widget footer-menu">
									<h2 class="footer-title">Gedung Olahraga</h2>
									<ul>
										<li><a href="{{ URL::to('/building'); }}">Cari Gedung</a></li>
									</ul>
								</div>
								<!-- /Footer Widget -->
								
							</div>
							
							<div class="col-lg-3 col-md-6">
							
								<!-- Footer Widget -->
								<div class="footer-widget footer-menu">
									<h2 class="footer-title">Kategori Blog</h2>
									<ul>
										@foreach ($blogCategories as $blogCategory)										
										<li><a href="#" onclick="searchBlogByCategory({{ $blogCategory->id }})">{{ $blogCategory->name }} </a></li>
										@endforeach	   
									</ul>
								</div>
								<!-- /Footer Widget -->
								
							</div>
							
							<div class="col-lg-3 col-md-6">
							
								<!-- Footer Widget -->
								<div class="footer-widget footer-contact">
									<h2 class="footer-title">Hubungi Kami</h2>
									<div class="footer-contact-info">
										<div class="footer-address">
											<span><i class="fas fa-map-marker-alt"></i></span>
											<p> <a target="_blank" href="{{ $company->google_map }}" style="color: white; text-decoration: underline;"> {{ $company->address . ' ' .   $company->city}}</a> </p>
										</div>
										<p>
											<i class="fas fa-mobile-alt"></i>
											{{ $company->phone }}
										</p>
										<p class="mb-0">
											<i class="fas fa-envelope"></i>
											{{ $company->email }}
										</p>
									</div>
								</div>
								<!-- /Footer Widget -->
								
							</div>
							
						</div>
					</div>
				</div>
				<!-- /Footer Top -->
				
				<!-- Footer Bottom -->
                <div class="footer-bottom">
					<div class="container-fluid">
					
						<!-- Copyright -->
						<div class="copyright">
							<div class="row">
								<div class="col-md-6 col-lg-6">
									<div class="copyright-text">
										<p class="mb-0">&copy; {{ date("Y") }} {{ $company->name }}. All rights reserved.</p>
									</div>
								</div>
								<div class="col-md-6 col-lg-6">
								
									<!-- Copyright Menu -->
									{{-- <div class="copyright-menu">
										<ul class="policy-menu">
											<li><a href="term-condition.html">Terms and Conditions</a></li>
											<li><a href="privacy-policy.html">Policy</a></li>
										</ul>
									</div> --}}
									<!-- /Copyright Menu -->
									
								</div>
							</div>
						</div>
						<!-- /Copyright -->
						
					</div>
				</div>
				<!-- /Footer Bottom -->
				
			</footer>
			<!-- /Footer -->
		   
	   </div>
	   <!-- /Main Wrapper -->
	  <script>
		function searchBlogByCategory(category)
		{		
			const url = '<?= URL::to('/blog'); ?>';
			window.open(url + '?category='+ category,  '_self');
		}

		function homeBuildingSearch()
		{
			const value = document.getElementById("homeBuildingSelect").value;
			const url = '<?= URL::to('/building'); ?>';
			window.open(url + '?type_id='+ value,  '_self');
		}
		</script>
		<!-- jQuery -->
		<script src="{{ URL::to('/assets/js/jquery-3.6.0.min.js'); }}"></script>
		
		<!-- Bootstrap Core JS -->
		<script src="{{ URL::to('/assets/js/bootstrap.bundle.min.js'); }}"></script>
		
		<!-- Slick JS -->
		<script src="{{ URL::to('/assets/js/slick.js'); }}"></script>


		<script src="{{ URL::to('/assets/plugins/theia-sticky-sidebar/ResizeSensor.js'); }}"></script>
		<script src="{{ URL::to('/assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js'); }}"></script>

		<!-- Datetimepicker JS -->
		<script src="{{ URL::to('/assets/js/moment.min.js'); }}"></script>
		<script src="{{ URL::to('/assets/js/bootstrap-datetimepicker.min.js'); }}"></script>
		<script src="{{ URL::to('/assets/plugins/daterangepicker/daterangepicker.js'); }}"></script>
		<!-- Fancybox JS -->
		<script src="{{ URL::to('/assets/plugins/fancybox/jquery.fancybox.min.js'); }}"></script>		



		<!-- Custom JS -->
		<script src="{{ URL::to('/assets/js/script.js'); }}"></script>		
	</body>
</html>