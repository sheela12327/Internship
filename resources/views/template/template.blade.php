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
		
			@stack('styles')
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
		
		@yield('scripts')

		<script>
    	$(document).ready(function() {

			// -----------------------
			// Add to Cart AJAX
			// -----------------------
			$(document).on('click', '.add-to-cart-btn', function(e) {
				e.preventDefault();

				let btn = $(this);
				let product_id = btn.data('id');
				let name = btn.data('name') || '';
				let price = btn.data('price') || 0;
				let image = btn.data('image') || '';

				$.ajax({
					url: "{{ route('cart.add') }}",
					type: "POST",
					data: {
						_token: "{{ csrf_token() }}",
						product_id: product_id,
						name: name,
						price: price,
						image: image,
						quantity: 1
					},
					success: function(response) {
						if(response.success){
							// Update cart count
							$('#cart-count').text(response.cart_count ?? 0);

							// Toggle button
							btn.html('<i class="fa fa-check"></i> Added').prop('disabled', true);

							// Optional: toast instead of alert
							// alert('Product added to cart');
						} else {
							alert(response.message || 'Error adding product');
						}
					},
					error: function(err){
						console.error(err);
						alert('Something went wrong!');
					}
				});
			});

			// -----------------------
			// Add to Wishlist AJAX
			// -----------------------
			$(document).on('click', '.add-to-wishlist', function(e) {
				e.preventDefault();

				let btn = $(this);
				let product_id = btn.data('id');

				$.ajax({
					url: "{{ route('wishlist.add') }}",
					type: "POST",
					data: {
						_token: "{{ csrf_token() }}",
						product_id: product_id
					},
					success: function(response){
						if(response.success){
							$('#wishlist-count').text(response.wishlist_count ?? 0);
							// Optional toast
							// alert('Added to wishlist');
						}
					},
					error: function(err){
						console.error(err);
						alert('Something went wrong!');
					}
				});
			});

		});
    </script>
	<script src="{{ asset('js/product.js') }}"></script>
    </body>
</html>