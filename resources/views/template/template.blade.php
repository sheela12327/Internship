<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<title>MyShop</title>

		<!-- Google font -->
		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

		<!-- Bootstrap -->
		<link type="text/css" rel="stylesheet" href="{{asset('frontend/css/bootstrap.min.css')}}"/>

		<!-- Slick -->
		<link type="text/css" rel="stylesheet" href="{{asset('frontend/css/slick.css')}}"/>
		<link type="text/css" rel="stylesheet" href="{{asset('frontend/css/slick-theme.css')}}"/>

		<!-- nouislider -->
		<link type="text/css" rel="stylesheet" href="{{asset('frontend/css/nouislider.min.css')}}"/>

		<!-- Font Awesome Icon -->
		<link rel="stylesheet" href="{{asset('frontend/css/font-awesome.min.css')}}">

		<!-- Custom stlylesheet -->
		<link type="text/css" rel="stylesheet" href="{{asset('frontend/css/style.css')}}"/>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

    </head>
	<body> 
        <section id="header"> 
            @include('layouts.header')

        </section>
        <section id="pagecontent">
            @yield('pagecontent')

        </section>
        <section id="footer">
            @include('layouts.footer')

        </section>
        <script src="{{asset('frontend/js/jquery.min.js')}}"></script>
		<script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
		<script src="{{asset('frontend/js/slick.min.js')}}"></script>
		<script src="{{asset('frontend/js/nouislider.min.js')}}"></script>
		<script src="{{asset('frontend/js/jquery.zoom.min.js')}}"></script>
		<script src="{{asset('frontend/js/main.js')}}"></script>

		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script>
		$(document).ready(function(){
			// Add to Cart
			$('.add-to-cart-btn').click(function(e){
				e.preventDefault();
				let product_id = $(this).data('id');

				$.ajax({
					url: "{{ route('cart.add') }}",
					type: "POST",
					data: {
						_token: "{{ csrf_token() }}",
						product_id: product_id
					},
					success: function(response){
						if(response.success){
							$('.header-ctn .qty').text(response.cart_count); // Update cart count in header
							alert('Product added to cart!');
						}
					}
				});
			});

			// Add to Wishlist
			$('.add-to-wishlist').click(function(e){
				e.preventDefault();
				let product_id = $(this).data('id');

				$.ajax({
					url: "{{ route('wishlist.add') }}",
					type: "POST",
					data: {
						_token: "{{ csrf_token() }}",
						product_id: product_id
					},
					success: function(response){
						if(response.success){
							$('.header-ctn .qty').text(response.wishlist_count); // Update wishlist count
							alert('Product added to wishlist!');
						}
					}
				});
			});
		});
		</script>

    </body>
</html>