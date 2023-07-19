<!-- Popular Section -->
<section class="section popular-section">
	<div class="container">
		<div class="section-header text-center">
			<h5>{{ $company->name }}</h5>
			<h2>Cabang</h2>
			{{-- <p class="sub-title">We merge two services consulting and brilliant client Services for the patient healthcare. Used latest technology in hospital.</p> --}}
		</div>
		<div class="row">
			<div class="col-12">
				<div class="solution-slider slider">
                    @foreach ($buildings as $building)
					<!-- Solution Widget -->
					<div class="profile-widget">
						<div class="doc-img">
							<a href="{{ URL::to('/building') . "/" . $building->id }}">
								<img class="img-fluid" alt="User Image" src="{{ URL::to('/storage'); }}/{{ $building->image_url  }}" width="200px">
							</a>
						</div>
						<div class="pro-content">
							<div class="specialities-img">
								<img src="{{ URL::to('/storage'); }}/{{ $building->type->image_url  }}" alt="">
							</div>
							<h5>{{ $building->type->name }}</h5>
							<h3 class="title">
								{{ $building->name }}
							</h3>
							<p class="speciality">{{ $building->note }}</p>
							<a href="{{ URL::to('/building') . "/" . $building->id }}" class="readmore-btn"><i class="fas fa-chevron-circle-right"></i> Buka Profil</a>
						</div>
					</div>
					<!-- /Solution Widget -->
                    @endforeach				

			

					
				</div>
			</div>
		</div>
	</div>
</section>
<!-- /Popular Section -->