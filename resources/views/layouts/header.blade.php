<header>
	<!-- TOP HEADER -->
	<div id="top-header">
		<div class="container">
			<ul class="header-links pull-left">
				<li><a href="#"><i class="fa fa-phone"></i> +977 9847741752</a></li>
				<li><a href="#"><i class="fa fa-envelope-o"></i> eshop@gmail.com</a></li>
				<li><a href="#"><i class="fa fa-map-marker"></i> Ratnachowk, Pokhara</a></li>
			</ul>
			<ul class="header-links pull-right">
                <li><a href="#"><i class="fa fa-rupee"></i> NRS</a></li>

                @auth
                <!-- ACCOUNT DROPDOWN -->
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-user-o"></i> {{ Auth::user()->name }} 
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('profile.edit') }}" style="color: black"><i class="fa fa-user"></i> Profile</a></li>

                        <li> 
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="color: black">
                                <i class="fa fa-sign-out"></i> Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
                @else
                <li><a href="{{ route('register') }}"><i class="fa fa-user-o"></i>Register</a></li>
                @endauth
            </ul>
		</div>
	</div>
	<!-- /TOP HEADER -->

	<!-- NAVIGATION -->
	<nav id="navigation">
		<!-- container -->
		<div class="container">
			<!-- responsive-nav -->
			<div id="responsive-nav">
				<!-- NAV -->
				<ul class="main-nav nav navbar-nav">
					<li class="active"><a href="{{route('home')}}">Home</a></li>
					<li><a href="#">About Us</a></li>
					{{-- <li><a href="#">Categories</a></li> --}}
					<li class="dropdown category-dropdown">
					<a href="#" class="dropdown-toggle">
						Categories <i class="fa fa-caret-down"></i>
					</a>
					<ul class="dropdown-menu">
						<li><a href="#">Summer Collections</a></li>
						<li><a href="#">Winter Collections</a></li>
						<li><a href="#">Footwear</a></li>
						<li><a href="#">Bags</a></li>
						<li><a href="#">Accessories</a></li>
					</ul>
				</li>
					<li><a href="#">Contact Us</a></li>
					<li><a href="#">Shop</a></li>
					
				<style>
					.category-dropdown:hover .dropdown-menu {
						display: block;
						margin-top: 0;
					}

					.category-dropdown .dropdown-menu {
						border-radius: 4px;
						padding: 10px 0;
					}

				</style>

				</ul>
				<!-- /NAV -->
			</div>
			<!-- /responsive-nav -->
		</div>
		<!-- /container -->
	</nav>
	<!-- /NAVIGATION -->
	
	<!-- MAIN HEADER -->
	<div id="header">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!-- LOGO -->
				<div class="col-md-3">
					<div class="header-logo">
						<a href="#" class="logo">
							<img src="./img/logo.png" alt="">
						</a>
					</div>
				</div>
				<!-- /LOGO -->

				<!-- SEARCH BAR -->
				<div class="col-md-6">
					<div class="header-search">
						<form>
							<input class="input" placeholder="Search here" class="search">
							<button class="search-btn">Search</button>	
						</form>
					</div>
				</div>
				<!-- /SEARCH BAR -->
				<style>
					.header-search .input {
						border-radius: 40px 0 0 40px; /* left side rounded */
					}

				</style>

				<!-- ACCOUNT -->
				<div class="col-md-3 clearfix">
					<div class="header-ctn">
						<!-- Wishlist -->
						<div>
							<a href="#">
								<i class="fa fa-heart-o"></i>
								<span>Your Wishlist</span>
								<div class="qty" id="wishlist-count">0</div>
							</a>
						</div>

						<!-- Cart -->
						<div class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
								<i class="fa fa-shopping-cart"></i>
								<span>Your Cart</span>
								<div class="qty" id="cart-count">0</div>
							</a>
							<div class="cart-dropdown">
								<div class="cart-list" id="cart-items">
									<!-- JS will populate this -->
								</div>
								<div class="cart-summary">
									<small id="cart-total-items">0 Item(s) selected</small>
									<h5 id="cart-subtotal">SUBTOTAL: $0.00</h5>
								</div>
								<div class="cart-btns">
									<a href="{{ route('cart') }}">View Cart</a>
									<a href="#">Checkout  <i class="fa fa-arrow-circle-right"></i></a>
								</div>
							</div>
						</div>

						<!-- /Cart -->

						<!-- Menu Toogle -->
						<div class="menu-toggle">
							<a href="#">
								<i class="fa fa-bars"></i>
								<span>Menu</span>
							</a>
						</div>
						<!-- /Menu Toogle -->
					</div>
				</div>
				<!-- /ACCOUNT -->
			</div>
			<!-- row -->
		</div>
		<!-- container -->
	</div>
	<!-- /MAIN HEADER -->
</header>
<!-- /HEADER -->

<script>
// Load cart and wishlist from localStorage
let cart = JSON.parse(localStorage.getItem('cart')) || [];
let wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];

// Update cart & wishlist counts in header
function updateHeaderCounts() {
    // Cart count
    const cartCount = cart.reduce((sum, item) => sum + item.qty, 0);
    document.getElementById('cart-count').textContent = cartCount;
    document.getElementById('cart-total-items').textContent = `${cartCount} Item(s) selected`;

    // Cart subtotal
    const subtotal = cart.reduce((sum, item) => sum + item.price * item.qty, 0);
    document.getElementById('cart-subtotal').textContent = `SUBTOTAL: $${subtotal.toFixed(2)}`;

    // Wishlist count
    document.getElementById('wishlist-count').textContent = wishlist.length;
}

// Render cart dropdown items
function renderCartDropdown() {
    const cartContainer = document.getElementById('cart-items');
    cartContainer.innerHTML = '';

    cart.forEach(item => {
        cartContainer.innerHTML += `
            <div class="product-widget">
                <div class="product-img">
                    <img src="${item.image}" alt="${item.name}">
                </div>
                <div class="product-body">
                    <h3 class="product-name"><a href="#">${item.name}</a></h3>
                    <h4 class="product-price"><span class="qty">${item.qty}x</span>$${item.price}</h4>
                </div>
                <button class="delete" data-id="${item.id}"><i class="fa fa-close"></i></button>
            </div>
        `;
    });

    // Delete item from cart
    document.querySelectorAll('#cart-items .delete').forEach(btn => {
        btn.addEventListener('click', () => {
            const id = btn.dataset.id;
            cart = cart.filter(item => item.id != id);
            localStorage.setItem('cart', JSON.stringify(cart));
            updateHeaderCounts();
            renderCartDropdown();
        });
    });
}

// Add to cart button logic
document.querySelectorAll('.add-to-cart-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        const id = btn.dataset.id;
        const name = btn.dataset.name;
        const price = parseFloat(btn.dataset.price);
        const image = btn.dataset.image;

        const existing = cart.find(item => item.id == id);
        if(existing){
            existing.qty += 1;
        } else {
            cart.push({id, name, price, image, qty: 1});
        }

        localStorage.setItem('cart', JSON.stringify(cart));
        updateHeaderCounts();
        renderCartDropdown();
        alert(`${name} added to cart`);
    });
});

// Wishlist logic (optional, if you have wishlist buttons)
document.querySelectorAll('.add-to-wishlist').forEach(btn => {
    btn.addEventListener('click', () => {
        const id = btn.dataset.id;
        const name = btn.dataset.name;
        const image = btn.dataset.image;

        if(!wishlist.find(item => item.id == id)){
            wishlist.push({id, name, image});
        }

        localStorage.setItem('wishlist', JSON.stringify(wishlist));
        updateHeaderCounts();
        alert(`${name} added to wishlist`);
    });
});

// Initialize
updateHeaderCounts();
renderCartDropdown();
</script>

	