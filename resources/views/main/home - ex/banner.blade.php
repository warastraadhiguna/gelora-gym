<!-- Home Banner -->
<section class="section section-banner" style="background: #f9f9f9 url({{ URL::to('/storage'); }}/{{ $company->banner_url  }}) no-repeat bottom center;">
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-6">
			</div>
			<div class="col-12 col-md-6">
				<div class="banner-wrapper">
					<div class="banner-header">
						<h1>{{ $company->name  }}</h1>
                        <h5>{{ $company->tagline  }}</h5>
						<p>{{ $company->note  }}</p>
						<div class="btn-col">
							<ul>
								@if(auth()->check())
								<li><a href="{{ URL::to('/building'); }}" class="btn btn-notfill">Pesan Sekarang</a></li>
								@else
								<li><a href="{{ URL::to('/login'); }}" class="btn btn-notfill">Login</a></li>
								@endif
							</ul>
						</div>
					</div>	
				</div>
			</div>
		</div>
	</div>
</section>
<!-- /Home Banner -->