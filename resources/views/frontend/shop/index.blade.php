@extends('template.template')

@section('pagecontent')






{{-- Maile gareko --}}
<!-- FEATURED PRODUCTS -->
<!-- FEATURED PRODUCTS -->
<div class="section">
<div class="container">

<div class="section-title">
    <h3 class="title">Featured Products</h3>
    <div class="section-nav">
        <ul class="section-tab-nav tab-nav">
            @foreach($categories as $key => $category)
                <li class="{{ $key==0 ? 'active' : '' }}">
                    <a data-toggle="tab" href="#featured-{{ $category->id }}">
                        {{ $category->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>

<div class="products-tabs">
@foreach($categories as $key => $category)
<div id="featured-{{ $category->id }}"
     class="tab-pane {{ $key==0 ? 'active' : '' }}">

    <div class="products-slick"
         data-nav="#featured-nav-{{ $category->id }}">

        @forelse($featuredByCategory[$category->id] as $product)
            @include('frontend.partials.product-card')
        @empty
            <p class="p-4">No featured products</p>
        @endforelse

    </div>
    <div id="featured-nav-{{ $category->id }}"
         class="products-slick-nav"></div>

</div>
@endforeach
</div>

</div>
</div>


<!-- HOT DEALS -->
<div class="section">
<div class="container">

<div class="section-title">
    <h3 class="title">Hot Deals</h3>
    <div class="section-nav">
        <ul class="section-tab-nav tab-nav">
            @foreach($categories as $key => $category)
                <li class="{{ $key==0 ? 'active' : '' }}">
                    <a data-toggle="tab" href="#hot-{{ $category->id }}">
                        {{ $category->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>

<div class="products-tabs">
@foreach($categories as $key => $category)
<div id="hot-{{ $category->id }}"
     class="tab-pane {{ $key==0 ? 'active' : '' }}">

    <div class="products-slick"
         data-nav="#hot-nav-{{ $category->id }}">

        @forelse($hotDealsByCategory[$category->id] as $product)
            @include('frontend.partials.product-card')
        @empty
            <p class="p-4">No hot deals</p>
        @endforelse

    </div>
    <div id="hot-nav-{{ $category->id }}"
         class="products-slick-nav"></div>

</div>
@endforeach
</div>

</div>
</div>
<!-- TOP SELLING -->
<div class="section">
<div class="container">

<div class="section-title">
    <h3 class="title">Top Selling</h3>
    <div class="section-nav">
        <ul class="section-tab-nav tab-nav">
            @foreach($categories as $key => $category)
                <li class="{{ $key==0 ? 'active' : '' }}">
                    <a data-toggle="tab" href="#top-{{ $category->id }}">
                        {{ $category->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>

<div class="products-tabs">
@foreach($categories as $key => $category)
<div id="top-{{ $category->id }}"
     class="tab-pane {{ $key==0 ? 'active' : '' }}">

    <div class="products-slick"
         data-nav="#top-nav-{{ $category->id }}">

        @forelse($topSellingByCategory[$category->id] as $product)
            @include('frontend.partials.product-card')
        @empty
            <p class="p-4">No top selling products</p>
        @endforelse

    </div>
    <div id="top-nav-{{ $category->id }}"
         class="products-slick-nav"></div>

</div>
@endforeach
</div>

</div>
</div>





		
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