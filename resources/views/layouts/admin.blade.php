<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Dashboard</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-gray-100">
        <div class="flex min-h-screen">
            <!-- Sidebar -->
            <aside class="w-64 bg-gray-900 text-white p-6 space-y-4">
                <h1 class="text-2xl font-bold mb-6">Admin Panel</h1>
                <nav class="space-y-2">
                    <a href="#" class="block p-2 rounded hover:bg-gray-700">Dashboard</a>
                    <a href="#" class="block p-2 rounded hover:bg-gray-700">Users</a>
                    <a href="#" class="block p-2 rounded hover:bg-gray-700">Orders</a>
                    <a href="#" class="block p-2 rounded hover:bg-gray-700">Products</a>
                    <a href="#" class="block p-2 rounded hover:bg-gray-700">Settings</a>
                </nav>
            </aside>

            <!-- Main Content Wrapper -->
            <div class="flex-1 flex flex-col">
                <!-- Top Navbar -->
                <header class="bg-white shadow p-4 flex justify-between items-center">
                    <h2 class="text-xl font-bold">Dashboard</h2>
                    <div class="flex items-center space-x-4">
                        <input type="text" placeholder="Search..." class="border rounded p-2">
                        <div class="w-10 h-10 bg-gray-300 rounded-full"></div>
                    </div>
                </header>

                <!-- Page Content -->
                <main class="p-6">
                    @yield('content')
                </main>
            </div>
        </div>
    </body>
</html>