@extends('template.template')

@section('pagecontent')
<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- shop -->
					<div class="col-md-4 col-xs-6">
						<div class="shop">
							<div class="shop-img">
								<img src="{{asset('frontend/img/shop01.png')}}" alt="">
							</div>
							<div class="shop-body">
								<h3>Summer<br>Collection</h3>
								<a href="#" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
							</div>
						</div>
					</div>
					<!-- /shop -->

					<!-- shop -->
					<div class="col-md-4 col-xs-6">
						<div class="shop">
							<div class="shop-img">
								<img src="{{asset('frontend/img/shop03.png')}}" alt="">
							</div>
							<div class="shop-body">
								<h3>Winter<br>Collection</h3>
								<a href="#" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
							</div>
						</div>
					</div>
					<!-- /shop -->

					<!-- shop -->
					<div class="col-md-4 col-xs-6">
						<div class="shop">
							<div class="shop-img">
								<img src="{{asset('frontend/img/shop02.png')}}" alt="">
							</div>
							<div class="shop-body">
								<h3>Foot<br>Wear</h3>
								<a href="{{route('shop')}}" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
							</div>
						</div>
					</div>
					<!-- /shop -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- SECTION -->
		<div class="section">
			<div class="container">
				<div class="row">
					<!-- section title -->
					<div class="col-md-12">
						<div class="section-title">
							<h3 class="title">Featured Products</h3>
							<div class="section-nav">
								<ul class="section-tab-nav tab-nav">
									@foreach($productsByCategory as $slug => $products)
										<li class="{{ $loop->first ? 'active' : '' }}">
											<a data-toggle="tab" href="#{{ $slug }}">
												{{ ucfirst($slug) }}
											</a>
										</li>
									@endforeach
								</ul>
							</div>
						</div>
					</div>

					<!-- Products tab -->
					<div class="col-md-12">
						<div class="row">
							<div class="products-tabs">
								@foreach($productsByCategory as $slug => $products)
									<div id="{{ $slug }}" class="tab-pane {{ $loop->first ? 'active' : 'fade' }}">
										<div class="products-slick" data-nav="#slick-nav-{{ $slug }}">
											@foreach($products as $product)
												@include('partials.product-card', ['product' => $product])
											@endforeach
										</div>
										<div id="slick-nav-{{ $slug }}" class="products-slick-nav"></div>
									</div>
								@endforeach

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Featured Products Section -->


		<!-- TOP SELLING SECTION -->
		<div class="section">
			<div class="container">
				<div class="row">
					<!-- section title -->
					<div class="col-md-12">
						<div class="section-title">
							<h3 class="title">Top Selling</h3>
						</div>
					</div>

					<!-- products -->
					<div class="col-md-12">
						<div class="row">
							<div class="products-slick" data-nav="#slick-nav-top-selling">
								@forelse($topSelling as $product)
									@include('partials.product-card', ['product' => $product])
								@empty
									<p>No top selling products yet.</p>
								@endforelse

							</div>
							<div id="slick-nav-top-selling" class="products-slick-nav"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /TOP SELLING SECTION -->


		<!-- NEWSLETTER -->
		<div id="newsletter" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="newsletter">
							<p>Sign Up for the <strong>NEWSLETTER</strong></p>
							<form>
								<input class="input" type="email" placeholder="Enter Your Email">
								<button class="newsletter-btn"><i class="fa fa-envelope"></i> Subscribe</button>
							</form>
							<ul class="newsletter-follow">
								<li>
									<a href="#"><i class="fa fa-facebook"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-twitter"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-instagram"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-pinterest"></i></a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /NEWSLETTER -->

@endsection