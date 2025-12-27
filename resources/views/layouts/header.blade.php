<header>
	<!-- TOP HEADER -->
	<div id="top-header">
		<div class="container">
			<ul class="header-links pull-left">
				<li><a href="#"><i class="fa fa-phone"></i> +977 9847741752</a></li>
				<li><a href="#"><i class="fa fa-envelope-o"></i> myshop@gmail.com</a></li>
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
					<li class="{{ request()->routeIs('home') ? 'active' : '' }}">
						<a href="{{ route('home') }}">Home</a>
					</li>

					<li class="{{ request()->routeIs('aboutus') ? 'active' : '' }}">
						<a href="{{ route('aboutus') }}">About Us</a>
					</li>

					<li class="dropdown category-dropdown {{ request()->routeIs('category.*') ? 'active' : '' }}">
						<a href="#" class="dropdown-toggle">
							Categories <i class="fa fa-caret-down"></i>
						</a>

						<ul class="dropdown-menu">
							@forelse($headerCategories as $category)
								<li>
									<a href="{{ route('category.products', $category->slug) }}">
										{{ $category->name }}
									</a>
								</li>
							@empty
								<li><a href="#">No Categories</a></li>
							@endforelse
						</ul>
					</li>

					<li class="{{ request()->routeIs('contact') ? 'active' : '' }}">
						<a href="{{ route('contact') }}">Contact Us</a>
					</li>

					<li class="dropdown category-dropdown {{ request()->routeIs('pages.*') ? 'active' : '' }}">
						<a href="#" class="dropdown-toggle">
							Pages <i class="fa fa-caret-down"></i>
						</a>
						<ul class="dropdown-menu">
							<li><a href="{{route('orderinfo')}}" style="">Orders</a></li>
							<li><a href="#">Chats</a></li>
							<li><a href="{{route('shopnow')}}">Shop</a></li>
							
						</ul>
					</li>
				</ul>

					
				<style>
					.category-dropdown:hover .dropdown-menu {
						display: block;
						margin-top: 0;
					}

					.category-dropdown .dropdown-menu {
						border-radius: 4px;
						padding: 10px 0;
					}
					.main-nav > li.active > a {
						color: #D10024;              /* red */
						/* border-bottom: 1px solid #D10024; */
					}


				</style>

				
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
						<form action="{{ route('search.products') }}" method="GET">
							<input type="text" name="query" class="input search" placeholder="Search here" required>
							<button type="submit" class="search-btn">Search</button>  
						</form>
					</div>
				</div>

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
							<a href="{{ route('wishlist') }}">
								<i class="fa fa-heart-o"></i>
								<span>Your Wishlist</span>
								<div class="qty" id="wishlist-count">{{ count(Session::get('wishlist', [])) }}</div>
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
									
								</div>
								<div class="cart-summary">
									<small id="cart-total-items">0 Item(s) selected</small>
									<h5 id="cart-subtotal">SUBTOTAL: $0.00</h5>
								</div>
								<div class="cart-btns">
									<a href="{{ route('cart') }}">View Cart</a>
									<a href="{{ route('checkout') }}">Checkout  <i class="fa fa-arrow-circle-right"></i></a>
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
// ---------------------------
// Initialize cart & wishlist
// ---------------------------
let cart = JSON.parse(localStorage.getItem('cart')) || [];
let wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];

// ---------------------------
// Update header counts & subtotal
// ---------------------------
function updateHeaderCounts() {
    // Cart count
    const cartCount = cart.reduce((sum, item) => sum + item.qty, 0);
    document.getElementById('cart-count').textContent = cartCount;
    document.getElementById('cart-total-items').textContent = `${cartCount} Item(s) selected`;

    // Cart subtotal
    const subtotal = cart.reduce((sum, item) => sum + item.price * item.qty, 0);
    document.getElementById('cart-subtotal').textContent = `SUBTOTAL: ₹${subtotal.toFixed(2)}`;

    // Wishlist count
    document.getElementById('wishlist-count').textContent = wishlist.length;
}

// ---------------------------
// Render cart dropdown
// ---------------------------
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
				<h3 class="product-name">
					<a href="/product/${item.id}">${item.name}</a>
				</h3>

				<h4 class="product-price">
					₹${item.price.toFixed(2)}
				</h4>

				<div class="qty-controls">
					<button class="qty-minus" data-id="${item.id}">−</button>
					<span>${item.qty}</span>
					<button class="qty-plus" data-id="${item.id}">+</button>
				</div>
			</div>

			<button class="delete" data-id="${item.id}">
				<i class="fa fa-close"></i>
			</button>
		</div>
`;
	});
	
	document.querySelectorAll('.qty-plus').forEach(btn => {
		btn.onclick = () => {
			const item = cart.find(i => i.id == btn.dataset.id);
			item.qty++;
			saveAndRefresh();
		};
	});

	document.querySelectorAll('.qty-minus').forEach(btn => {
		btn.onclick = () => {
			const item = cart.find(i => i.id == btn.dataset.id);
			if(item.qty > 1) item.qty--;
			saveAndRefresh();
		};
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

function saveAndRefresh(){
    localStorage.setItem('cart', JSON.stringify(cart));
    updateCartHeader();
    renderCartDropdown();
}


// ---------------------------
// Add to cart button logic
// ---------------------------
document.querySelectorAll('.add-to-cart-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        const id = btn.dataset.id;
        const name = btn.dataset.name;
        const price = parseFloat(btn.dataset.price);
        const image = btn.dataset.image;

        // Check if item exists in cart
        const existing = cart.find(item => item.id == id);
        if(existing){
            existing.qty += 1;
        } else {
            cart.push({id, name, price, image, qty: 1});
        }

        // Save to localStorage
        localStorage.setItem('cart', JSON.stringify(cart));
        updateHeaderCounts();
        renderCartDropdown();
        alert(`${name} added to cart`);
    });
});

// ---------------------------
// Wishlist logic (AJAX + Laravel)
// ---------------------------
document.querySelectorAll('.add-to-wishlist').forEach(btn => {
    btn.addEventListener('click', (e) => {
        e.preventDefault(); // prevent default behavior if button is a link

        const id = btn.dataset.id;
        const name = btn.dataset.name;
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch("{{ route('wishlist.add') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ product_id: id })
        })
        .then(response => response.json())
        .then(data => {
            if(data.success){
                // Update wishlist count in header
                const countElem = document.getElementById('wishlist-count');
                if(countElem) countElem.textContent = data.wishlist_count;

                alert(`${name} added to wishlist`);
            } else {
                alert('Something went wrong. Please try again.');
            }
        })
        .catch(error => {
            console.error('Error adding to wishlist:', error);
            alert('Something went wrong. Please try again.');
        });
    });
});

// ---------------------------
// Initialize on page load
// ---------------------------
updateHeaderCounts();
renderCartDropdown();
</script>


	