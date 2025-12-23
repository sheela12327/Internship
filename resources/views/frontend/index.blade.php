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
								<a href="#" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
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

					<!-- Section Title -->
					<div class="col-md-12">
						<div class="section-title">
							<h3 class="title">Featured Products</h3>
							<div class="section-nav">
								<ul class="section-tab-nav tab-nav">
									@foreach($categories as $key => $category)
										<li class="{{ $key == 0 ? 'active' : '' }}">
											<a data-toggle="tab" href="#tab{{$category->id}}">{{ $category->name }}</a>
										</li>
									@endforeach
								</ul>
							</div>
						</div>
					</div>
					<!-- /Section Title -->

					<!-- Products Tab & Slick -->
					<div class="col-md-12">
						<div class="row">
							<div class="products-tabs">
								@foreach($categories as $key => $category)
								<div id="tab{{$category->id}}" class="tab-pane {{ $key == 0 ? 'active' : '' }}">
									<div class="products-slick" data-nav="#slick-nav-{{$category->id}}">

										@forelse($category->products as $product)
										<!-- product -->
										<div class="product">
											<div class="product-img">
												<img src="{{ $product->image ? asset('storage/'.$product->image) : asset('frontend/img/default.png') }}" alt="{{ $product->name }}">
												@if($product->is_new ?? false)
												<div class="product-label">
													<span class="new">NEW</span>
												</div>
												@endif
											</div>
											<div class="product-body">
												<p class="product-category">{{ $category->name }}</p>
												<h3 class="product-name">
													<a href="{{ route('product.show', $product->id) }}">{{ $product->name }}</a>
												</h3>
												<h4 class="product-price">Rs.{{ $product->price }}
													@if($product->old_price)
														<del class="product-old-price">Rs.{{ $product->old_price }}</del>
													@endif
												</h4>
												<div class="product-rating">
													@for($i=0; $i<5; $i++)
														<i class="fa fa-star{{ $i < $product->rating ? '' : '-o' }}"></i>
													@endfor
												</div>
												<div class="product-btns">
													<button class="add-to-wishlist"><i class="fa fa-heart-o"></i></button>
													<button class="add-to-compare"><i class="fa fa-exchange"></i></button>
													<button class="quick-view"><i class="fa fa-eye"></i></button>
												</div>
											</div>
											<button class="add-to-cart-btn">
												<i class="fa fa-shopping-cart"></i> add to cart
											</button>
										</div>
										<!-- /product -->
										@empty
											<p>No products in this category.</p>
										@endforelse

									</div>
									<div id="slick-nav-{{$category->id}}" class="products-slick-nav"></div>
								</div>
								@endforeach
							</div>
						</div>
					</div>
					<!-- /Products Tab & Slick -->

				</div>
			</div>
		</div>
		<!-- /SECTION -->



		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<!-- section title -->
					<div class="col-md-12">
						<div class="section-title">
							<h3 class="title">Top selling</h3>
							<div class="section-nav">
								<ul class="section-tab-nav tab-nav">
									<li class="active"><a data-toggle="tab" href="#tab2">Summer Collection</a></li>
									<li><a data-toggle="tab" href="#tab2">Winter Collection</a></li>
									<li><a data-toggle="tab" href="#tab2">FootWear</a></li>
									<li><a data-toggle="tab" href="#tab2">Accessories</a></li>
									<li><a data-toggle="tab" href="#tab2">Bags</a></li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /section title -->

					<!-- Products tab & slick -->
					<div class="col-md-12">
						<div class="row">
							<div class="products-tabs">
								<!-- tab -->
								<div id="tab2" class="tab-pane fade in active">
									<div class="products-slick" data-nav="#slick-nav-2">
										<!-- product -->
										<div class="product">
											<div class="product-img">
												<img src="{{asset('frontend/img/product06.png')}}" alt="">
												<div class="product-label">
													<span class="sale">-30%</span>
													<span class="new">NEW</span>
												</div>
											</div>
											<div class="product-body">
												<p class="product-category">Category</p>
												<h3 class="product-name"><a href="#">product name goes here</a></h3>
												<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
												<div class="product-rating">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
												</div>
												<div class="product-btns">
													<button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
													<button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
													<button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
												</div>
											</div>
											<button class="add-to-cart-btn" disabled>
												<i class="fa fa-shopping-cart"></i> add to cart
											</button>

										</div>
										<!-- /product -->

										<!-- product -->
										<div class="product">
											<div class="product-img">
												<img src="{{asset('frontend/img/product07.png')}}" alt="">
												<div class="product-label">
													<span class="new">NEW</span>
												</div>
											</div>
											<div class="product-body">
												<p class="product-category">Category</p>
												<h3 class="product-name"><a href="#">product name goes here</a></h3>
												<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
												<div class="product-rating">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star-o"></i>
												</div>
												<div class="product-btns">
													<button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
													<button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
													<button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
												</div>
											</div>
											<button class="add-to-cart-btn" disabled>
												<i class="fa fa-shopping-cart"></i> add to cart
											</button>

										</div>
										<!-- /product -->

										<!-- product -->
										<div class="product">
											<div class="product-img">
												<img src="{{asset('frontend/img/product08.png')}}" alt="">
												<div class="product-label">
													<span class="sale">-30%</span>
												</div>
											</div>
											<div class="product-body">
												<p class="product-category">Category</p>
												<h3 class="product-name"><a href="#">product name goes here</a></h3>
												<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
												<div class="product-rating">
												</div>
												<div class="product-btns">
													<button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
													<button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
													<button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
												</div>
											</div>
											<button class="add-to-cart-btn" disabled>
												<i class="fa fa-shopping-cart"></i> add to cart
											</button>

										</div>
										<!-- /product -->

										<!-- product -->
										<div class="product">
											<div class="product-img">
												<img src="{{asset('frontend/img/product09.png')}}" alt="">
											</div>
											<div class="product-body">
												<p class="product-category">Category</p>
												<h3 class="product-name"><a href="#">product name goes here</a></h3>
												<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
												<div class="product-rating">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
												</div>
												<div class="product-btns">
													<button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
													<button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
													<button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
												</div>
											</div>
											<button class="add-to-cart-btn" disabled>
												<i class="fa fa-shopping-cart"></i> add to cart
											</button>

										</div>
										<!-- /product -->

										<!-- product -->
										<div class="product">
											<div class="product-img">
												<img src="{{asset('frontend/img/product01.png')}}" alt="">
											</div>
											<div class="product-body">
												<p class="product-category">Category</p>
												<h3 class="product-name"><a href="#">product name goes here</a></h3>
												<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
												<div class="product-rating">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
												</div>
												<div class="product-btns">
													<button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
													<button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
													<button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
												</div>
											</div>
											<button class="add-to-cart-btn" disabled>
												<i class="fa fa-shopping-cart"></i> add to cart
											</button>

										</div>
										<!-- /product -->
									</div>
									<div id="slick-nav-2" class="products-slick-nav"></div>
								</div>
								<!-- /tab -->
							</div>
						</div>
					</div>
					<!-- /Products tab & slick -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

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