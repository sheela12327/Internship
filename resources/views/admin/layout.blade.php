<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap 5 -->
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style> 
        body { 
            background-color: #f4f6f9; 
        } 
        .sidebar { 
            width: 240px; 
            height: 100vh; 
            position: fixed; 
            left: 0; 
            top: 0; 
            background-color: #212529; 
        } 
        .sidebar h5 { 
            color: #fff; 
            padding: 16px; 
            text-align: center; 
            border-bottom: 1px solid #343a40; 
        } 
        .sidebar a { 
            display: block; 
            padding: 12px 20px; 
            color: #adb5bd; 
            text-decoration: none; 
            font-size: 15px; 
        } 
        .sidebar a:hover, .sidebar a.active { 
            background-color: #343a40; 
            color: #ffffff; 
        } 
        .content { 
            margin-left: 240px; 
            padding: 20px; 
        } 
        .topbar { 
            background-color: #ffffff; 
            padding: 12px 20px; 
            box-shadow: 0 1px 4px rgba(0,0,0,0.08); 
            margin-bottom: 20px; 
        } 
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h4 class="text-center mb-4">Admin Panel</h4>

        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            🏠 Dashboard
        </a>

        <a href="{{ route('admin.categories.index') }}" class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
            📂 Categories
        </a>

        <a href="{{ route('admin.products.index') }}" class="{{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
            📦 Products
        </a>

        <a href="{{ route('admin.orders.index') }}" class="{{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
            📦 Orders
        </a>

        <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
            👤 Users
        </a>
   
        <hr class="text-secondary mx-3">

        <form method="POST" action="{{ route('logout') }}" class="px-3">
            @csrf
            <button class="btn btn-danger w-100 btn-sm">
                Logout
            </button>
        </form>

    </div>

    <!-- Top Bar -->
    <div class="topbar d-flex justify-content-between align-items-center">
        <h6 class="mb-0">Dashboard</h6>

        <div class="dropdown">
            <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                👤 {{ Auth::user()->name }}
            </button>

            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <a class="dropdown-item" href="{{ route('home') }}">
                        🏠 Customer Dashboard
                    </a>
                </li>

                <li><hr class="dropdown-divider"></li>

                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="dropdown-item text-danger">
                            🚪 Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="content">
        @yield('pagecontent')
    </div>

    @yield('scripts')

</body>

</html>
