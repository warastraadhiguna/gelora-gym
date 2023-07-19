	<!-- Home Banner -->
<section class="banner-section">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-lg-6">
				<div class="banner-content aos" data-aos="fade-up">
					<h1>{{ $company->name  }}<br/><span>{{ $company->tagline  }}</span></h1>
					<img src="{{ URL::to('/')}}/assets/img/icons/header-icon.svg" class="header-icon" alt="header-icon">
					<p>{{ $company->note  }}</p>
					<a href="{{ URL::to('/building')}}" class="btn">Lihat Jadwal</a>
					<div class="banner-arrow-img">
						<img src="{{ URL::to('/')}}/assets/img/down-arrow-img.png" class="img-fluid" alt="">
					</div>
				</div>
				<div class="search-box-one aos" >
					<form action="{{ URL::to('/search-building')}}" method="POST">
						@csrf
						<div class="search-input search-line">
							{{-- <i class="feather-search bficon"></i> --}}
							<div class="form-group mb-0">
								<select style="border: 0;" class="form-select form-control" name="type_id">
									<option value="">-Pilih Olahraga-</option>
									@foreach ($types as $type)
										<option value="{{ $type->id }}">{{ $type->name }}</option>
									@endforeach
								</select>		
								<select style="border: 0;" class="form-select form-control" name="start_time">
									<option value="">-Jam Awal Penggunaan-</option>
									@foreach(GetTimes() as $time)
										<option value="{{ $time }}">{{ $time }}</option>
									@endforeach
								</select>		
                                <select  style="border: 0;" class="form-select form-control" name="court_quantity">
                                    <option value="">-Jumlah Lapangan-</option>
                                    @foreach(GetCourtQuantity() as $quantity)
                                        <option value="{{ $quantity }}">{{ $quantity}}</option>
                                    @endforeach
                                </select>														
							</div>
						</div>
						<div class="search-input search-line">
							<div class="form-group mb-0">
								<input type="text" class="form-select datetimepicker" 
								placeholder="Pilih Tanggal" onkeydown="return false"
								name="date">									
								<select style="border: 0;" class="form-select form-control ms-2" name="end_time">
									<option value="">-Jam Akhir Penggunaan-</option>
									@foreach(GetTimes() as $time)
										<option value="{{ $time }}">{{ $time}}</option>
									@endforeach
								</select>				
								<br/>															<br/>			
							</div>							
						</div>			

						<div class="search-input search-calendar-line">
							<div class="form-group mt-5 me-4">
								<div class="form-search-btn">
										<button class="btn" type="submit">Cari</button>
									</div>
							</div>
						</div>		
					</form>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="banner-img aos" data-aos="fade-up">
					<img src="{{ URL::to('/')}}/assets/img/banner-img.png" class="img-fluid" alt="">
					<div class="banner-img1">
						<img src="{{ URL::to('/')}}/assets/img/banner-img1.png" class="img-fluid" alt="">
					</div>
					<div class="banner-img2">
						<img src="{{ URL::to('/')}}/assets/img/banner-img2.png" class="img-fluid" alt="">
					</div>
					<div class="banner-img3">
						<img src="{{ URL::to('/')}}/assets/img/banner-img3.png" class="img-fluid" alt="">
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- /Home Banner -->