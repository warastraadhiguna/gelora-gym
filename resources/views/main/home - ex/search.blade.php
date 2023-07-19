<!-- Search Section -->
<section class="search-section">
	<div class="container">
		<div class="row">
			<div class="col-12 col-lg-6 col-xl-8">
				<div class="search-box">
					<h2>Pilih Lapangan, <br>& Pesan Sekarang!</h2>
					<div class="form-col">
						{{-- <form method="post" action="search.html"> --}}
							<ul class="d-flex flex-wrap">
								<li>
                                    <select class="form-control" id="homeBuildingSelect">
                                        <option value="">Cari Gedung</option>
                                        @foreach ($types as $type)
                                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                                            @endforeach
                                    </select>
								</li>
                                <li>									<input type="submit" value="Cari" class="btn-submit form-control" onclick="homeBuildingSearch()"></li>
								<li>

								</li>
							</ul>
						{{-- </form> --}}
					</div>
				</div>
			</div>
			<div class="col-12 col-lg-6 col-xl-4">               
			</div>
		</div>
	</div>
	<div class="search-right-img">
		<img src="{{ URL::to('/img/home-search.png'); }}" alt="">
	</div>
</section>
<!-- Search Section -->
