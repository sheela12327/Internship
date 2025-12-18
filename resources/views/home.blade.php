@extends('template.template')

@section('pagecontent')

<!-- SHOP COLLECTION SECTION -->
<div class="section">
    <div class="container">
        <div class="row">
            <!-- shop items -->
            <div class="col-md-4 col-xs-6">
                <div class="shop">
                    <div class="shop-img">
                        <img src="{{ asset('frontend/img/shop01.png') }}" alt="">
                    </div>
                    <div class="shop-body">
                        <h3>Summer<br>Collection</h3>
                        <a href="#" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-xs-6">
                <div class="shop">
                    <div class="shop-img">
                        <img src="{{ asset('frontend/img/shop03.png') }}" alt="">
                    </div>
                    <div class="shop-body">
                        <h3>Winter<br>Collection</h3>
                        <a href="#" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-xs-6">
                <div class="shop">
                    <div class="shop-img">
                        <img src="{{ asset('frontend/img/shop02.png') }}" alt="">
                    </div>
                    <div class="shop-body">
                        <h3>Foot<br>Wear</h3>
                        <a href="{{ route('shop') }}" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /SHOP COLLECTION -->

<!-- FEATURED PRODUCTS SECTION -->
<div class="section">
    <div class="container">
        <div class="row">
            <!-- Section title -->
            <div class="col-md-12">
                <div class="section-title">
                    <h3 class="title">Featured Products</h3>
                    <div class="section-nav">
                        <ul class="section-tab-nav tab-nav">
                            <!-- All tab -->
                            <li class="active">
                                <a data-toggle="tab" href="#tab-all">All</a>
                            </li>

                            <!-- Dynamic category tabs -->
                            @foreach($productsByCategory as $slug => $products)
                                <li>
                                    <a data-toggle="tab" href="#tab-{{ $slug }}">{{ ucfirst($slug) }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Products Tabs -->
            <div class="col-md-12">
                <div class="row">
                    <div class="products-tabs">
                        <!-- All products tab -->
                        <div id="tab-all" class="tab-pane active">
                            <div class="products-slick" data-nav="#slick-nav-all">
                                <!-- Static featured products -->
                                @foreach($staticFeatured as $product)
                                    @include('partials.static-product-card', ['product' => $product])
                                @endforeach

                                <!-- Dynamic featured products from admin -->
                                @foreach($featuredProducts as $product)
                                    @include('partials.product-card', ['product' => $product])
                                @endforeach
                            </div>
                            <div id="slick-nav-all" class="products-slick-nav"></div>
                        </div>

                        <!-- Products by category tabs -->
                        @foreach($productsByCategory as $slug => $products)
                            <div id="tab-{{ $slug }}" class="tab-pane">
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
<!-- /FEATURED PRODUCTS -->

<!-- TOP SELLING SECTION -->
<div class="section">
    <div class="container">
        <div class="row">
            <!-- Section title -->
            <div class="col-md-12">
                <div class="section-title">
                    <h3 class="title">Top Selling</h3>
                </div>
            </div>

            <!-- Products -->
            <div class="col-md-12">
                <div class="row">
                    <div class="products-slick" data-nav="#slick-nav-top-selling">
                        <!-- Static top-selling products -->
                        @foreach($staticTopSelling as $product)
                            @include('partials.static-product-card', ['product' => $product])
                        @endforeach

                        <!-- Dynamic top-selling products from admin -->
                        @foreach($topSelling as $product)
                            @include('partials.product-card', ['product' => $product])
                        @endforeach
                    </div>
                    <div id="slick-nav-top-selling" class="products-slick-nav"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /TOP SELLING -->

<!-- NEWSLETTER SECTION -->
<div id="newsletter" class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="newsletter">
                    <p>Sign Up for the <strong>NEWSLETTER</strong></p>
                    <form>
                        <input class="input" type="email" placeholder="Enter Your Email">
                        <button class="newsletter-btn"><i class="fa fa-envelope"></i> Subscribe</button>
                    </form>
                    <ul class="newsletter-follow">
                        <li><a href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="https://x.com/"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="https://www.instagram.com"><i class="fa fa-instagram"></i></a></li>
                        <li><a href="https://www.pinterest.com/"><i class="fa fa-pinterest"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /NEWSLETTER -->

@endsection
