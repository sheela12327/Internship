<!-- NAVIGATION -->
<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <!-- Logo & Main Navigation -->
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('index') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200"/>
                    </a>
                </div>

                <!-- Desktop Links -->
                <div class="hidden sm:flex sm:space-x-6 sm:ms-10">
                    <x-nav-link :href="route('index')" :active="request()->routeIs('index')">Home</x-nav-link>
                    <x-nav-link href="#">Hot Deals</x-nav-link>
                    <x-nav-link href="#">Summer Collection</x-nav-link>
                    <x-nav-link href="#">Winter Collection</x-nav-link>
                    <x-nav-link href="#">Footwear</x-nav-link>
                    <x-nav-link href="#">Bags</x-nav-link>
                    <x-nav-link href="#">Accessories</x-nav-link>

                    <!-- Optional Categories Dropdown -->
                    <div x-data="{ dropdownOpen: false }" class="relative">
                        <button @click="dropdownOpen = !dropdownOpen"
                            class="inline-flex items-center px-3 py-2 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none">
                            Categories
                            <svg class="ml-1 h-4 w-4 fill-current" viewBox="0 0 20 20">
                                <path d="M5.25 7.75L10 12.5l4.75-4.75H5.25z"/>
                            </svg>
                        </button>
                        <div x-show="dropdownOpen" @click.away="dropdownOpen = false"
                             class="absolute mt-2 w-48 bg-white dark:bg-gray-700 shadow-lg rounded-md py-2 z-50">
                            <a href="#" class="block px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600">Summer Collection</a>
                            <a href="#" class="block px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600">Winter Collection</a>
                            <a href="#" class="block px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600">Footwear</a>
                            <a href="#" class="block px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600">Bags</a>
                            <a href="#" class="block px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600">Accessories</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Dropdown & Hamburger -->
            <div class="flex items-center">
                <!-- User Dropdown -->
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 border border-transparent rounded-md hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none">
                                <div>{{ Auth::user()->name }}</div>
                                <svg class="ml-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293L10 12.586l4.707-4.707 1.414 1.414-6.121 6.121-6.121-6.121z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">Profile</x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">Log Out</x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>

                <!-- Hamburger -->
                <div class="-me-2 flex sm:hidden">
                    <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('index')" :active="request()->routeIs('index')">Home</x-responsive-nav-link>
            <x-responsive-nav-link href="#">Hot Deals</x-responsive-nav-link>
            <x-responsive-nav-link href="#">Summer Collection</x-responsive-nav-link>
            <x-responsive-nav-link href="#">Winter Collection</x-responsive-nav-link>
            <x-responsive-nav-link href="#">Footwear</x-responsive-nav-link>
            <x-responsive-nav-link href="#">Bags</x-responsive-nav-link>
            <x-responsive-nav-link href="#">Accessories</x-responsive-nav-link>
        </div>

        <!-- Mobile User Settings -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">Profile</x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">Log Out</x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
