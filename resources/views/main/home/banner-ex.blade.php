	<!-- Home Banner -->
<section class="banner-section">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-lg-6">
				<div class="banner-content aos" data-aos="fade-up">
					<h1>{{ $company->name  }}<br/><span>{{ $company->tagline  }}</span></h1>
					<img src="{{ URL::to('/')}}/assets/img/icons/header-icon.svg" class="header-icon" alt="header-icon">
					{{-- <p>{{ $company->note  }}</p> --}}
					{{-- <a href="{{ URL::to('/building')}}" class="btn">Lihat Jadwal</a> --}}
					{{-- <div class="banner-arrow-img">
						<img src="{{ URL::to('/')}}/assets/img/down-arrow-img.png" class="img-fluid" alt="">
					</div> --}}
				</div>
				<div class="search-box-one aos" >
					<form action="{{ URL::to('/search-building')}}" method="POST">
						@csrf
						<div class="search-input search-line">
							{{-- <i class="feather-search bficon"></i> --}}
							<div class="form-group mb-0">
								<input type="text" class="form-select datetimepicker" 
								placeholder="Pilih Tanggal" onkeydown="return false"
								name="date">									
								<select style="border: 0;" class="form-select form-control" name="type_id" id="type_id_option" onchange="changeType()">
									<option value="">-Pilih Gedung-</option>
									@foreach ($types as $type)
										<option value="{{ $type->id }}">{{ $type->name }}</option>
									@endforeach
								</select>		
								<select style="border: 0;" class="form-select form-control" name="building_id" id="building_id_option">
									<option value="">-Pilih Alamat-</option>
									{{-- @foreach ($buildings as $building)
										<option value="{{ $building->id }}">{{ $building->address }}</option>
									@endforeach --}}
								</select>						
							</div>
						</div>
						<div class="search-input search-line">
							<div class="form-group mb-0">
								<select style="border: 0;" class="form-select form-control" name="start_time">
									<option value="">-Jam Awal Penggunaan-</option>
									@foreach(GetTimes() as $time)
										<option value="{{ $time }}">{{ $time }}</option>
									@endforeach
								</select>		
								<select style="border: 0;" class="form-select form-control" name="end_time">
									<option value="">-Jam Akhir Penggunaan-</option>
									@foreach(GetTimes() as $time)
										<option value="{{ $time }}">{{ $time}}</option>
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
<script>
const buildingArray = <?= json_encode($buildings); ?>;
const typeIdSelect = document.getElementById("type_id_option");
const buildingIdSelect = document.getElementById("building_id_option");

changeType();
function changeType(){
	const typeId = typeIdSelect.value;

	if(!typeId){
		buildingIdSelect.value = "";
		buildingIdSelect.disabled  = true;
	}else{
		buildingIdSelect.disabled  = false;		
		for (i = buildingIdSelect.options.length-1; i >= 0; i--) {
			buildingIdSelect.options[i] = null;
		}

		let opt = document.createElement('option');
		opt.value = "";
		opt.innerHTML = "-Pilih Alamat-";
		buildingIdSelect.appendChild(opt);

		buildingArray.forEach(building => {
			if(building.type_id == typeId){
				let opt = document.createElement('option');
				opt.value = building.id;
				opt.innerHTML = building.address;
				buildingIdSelect.appendChild(opt);
			}
		});	
	}
}
</script>