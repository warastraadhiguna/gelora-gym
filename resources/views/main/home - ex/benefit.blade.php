<!--  Choose Us -->
<section class="choose-us">
	<div class="container">
		<div class="row">
			<div class="col-12 col-lg-6">
				<div class="left">
					<div class="section-header">
						<h5>Keunggulan Kami</h5>
						<h2>{{ $company->name }} <br>{{ $company->tagline }}</h2>
					</div>
					<div class="row">
					@foreach ($benefits as $benefit)
						<div class="col-12 col-lg-6">
							<div class="choose-col">
								<div class="top-title d-flex align-items-center">
									<span><img src="assets/img/check-mark.png" alt=""></span>
									<span>{{ $benefit->name }}</span>
								</div>
								<p>{{ $benefit->note }}</p>
							</div>
						</div>
                    @endforeach								
					</div>
				</div>
			</div>
			<div class="col-12 col-lg-6">
				<div class="right">
				</div>
			</div>
		</div>
	</div>
</section>
<!--  /Choose Us -->