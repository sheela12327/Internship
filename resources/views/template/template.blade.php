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
		$(document).on('click', '.add-to-cart-btn', function (e) {
			e.preventDefault();

			let product_id = $(this).data('id');

			$.ajax({
				url: "{{ route('cart.add') }}",
				type: "POST",
				data: {
					_token: "{{ csrf_token() }}",
					product_id: product_id,
					qty: 1
				},
				success: function (response) {
					if (response.status) {
						$('.cart-count').text(response.cart_count ?? 0);
						alert('Product added to cart');
					} else {
						alert(response.message);
					}
				}
			});
		});

		$(document).on('click', '.add-to-wishlist', function (e) {
			e.preventDefault();

			let product_id = $(this).data('id');

			$.ajax({
				url: "{{ route('wishlist.add') }}",
				type: "POST",
				data: {
					_token: "{{ csrf_token() }}",
					product_id: product_id
				},
				success: function (response) {
					if (response.status) {
						$('.wishlist-count').text(response.wishlist_count ?? 0);
						alert('Added to wishlist');
					}
				}
			});
		});
		</script>

		<script>
		document.querySelectorAll('.add-to-wishlist').forEach(btn=>{
			btn.addEventListener('click', ()=>{
				const product_id = btn.dataset.id;
				fetch('{{ route("wishlist.add") }}', {
					method:'POST',
					headers:{'X-CSRF-TOKEN':'{{ csrf_token() }}','Content-Type':'application/json'},
					body: JSON.stringify({product_id})
				})
				.then(res=>res.json())
				.then(data=>{
					if(data.success){
						alert('Added to wishlist');
						const countElem = document.getElementById('wishlist-count');
						if(countElem) countElem.textContent = data.wishlist_count;
					}
				});
			});
		});
		</script>
		@yield('scripts')

    </body>
</html>