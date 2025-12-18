<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center px-6">
        <div class="w-full max-w-[1600px] bg-white dark:bg-gray-800 shadow-2xl rounded-2xl overflow-hidden">

            <div class="grid grid-cols-1 lg:grid-cols-2 min-h-[650px]">

                <!-- LEFT IMAGE -->
                <div class="hidden lg:flex bg-cover bg-center"
                    style="background-image:url('https://images.unsplash.com/photo-1441986300917-64674bd600d8?q=80&w=2070&auto=format&fit=crop');">
                    <div class="flex flex-col justify-center bg-black/70 p-20 text-white">
                        <h1 class="text-6xl font-extrabold mb-6">Welcome Back</h1>
                        <p class="text-2xl text-gray-200 max-w-lg">
                            Log in to access your cart, wishlist and exclusive offers.
                        </p>
                    </div>
                </div>

                <!-- RIGHT FORM -->
                <div class="flex items-center">
                    <div class="w-full max-w-xl mx-auto px-14 py-16">

                        <h2 class="text-5xl font-extrabold text-gray-900 dark:text-white">
                            Sign In
                        </h2>
                        <p class="text-gray-500 mt-3 mb-10 text-xl">
                            Continue shopping with your account
                        </p>

                        <form method="POST" action="{{ route('login') }}" class="space-y-6">
                            @csrf

                            <div>
                                <x-input-label for="email" value="Email Address" />
                                <x-text-input id="email"
                                    class="block mt-2 w-full h-14 text-lg"
                                    type="email" name="email" required autofocus />
                            </div>

                            <div x-data="{ show: false }" class="relative mt-2">
                                <div class="flex justify-between items-center">
                                    <x-input-label for="password" value="Password" />
                                    <a href="{{ route('password.request') }}"
                                        class="text-sm text-indigo-600 hover:underline">
                                        Forgot password?
                                    </a>
                                </div>

                                <input :type="show ? 'text' : 'password'" id="password" name="password"
                                    class="block mt-2 w-full h-14 text-lg pr-12" required />

                                <button type="button" @click="show = !show"
                                        class="absolute inset-y-0 right-3 flex items-center text-gray-500">
                                    <!-- Eye Open Icon -->
                                    <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>

                                    <!-- Eye Closed Icon -->
                                    <svg x-show="show" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.269-2.944-9.543-7a10.05 10.05 0 012.317-3.891M6.11 6.11A9.956 9.956 0 0112 5c4.478 0 8.269 2.944 9.543 7a10.05 10.05 0 01-1.456 2.911M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 3l18 18" />
                                    </svg>
                                </button>
                            </div>

                            <x-primary-button class="w-full px-6 py-4 text-xl flex items-center justify-center">
                                Log in
                            </x-primary-button>


                            <p class="text-center text-base text-gray-600 mt-6">
                                Don’t have an account?
                                <a href="{{ route('register') }}"
                                    class="font-semibold text-indigo-600 hover:text-indigo-500">
                                    Create one
                                </a>
                            </p>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
</x-guest-layout>
