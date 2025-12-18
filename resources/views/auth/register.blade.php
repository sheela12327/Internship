<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center px-6">
        <div class="w-full max-w-[1600px] bg-white dark:bg-gray-800 shadow-2xl rounded-2xl overflow-hidden">

            <div class="grid grid-cols-1 lg:grid-cols-2 min-h-[700px]">

                <!-- LEFT BRAND SECTION -->
                <div class="hidden lg:flex bg-cover bg-center"
                    style="background-image:url('https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?q=80&w=2070&auto=format&fit=crop');">
                    <div class="flex flex-col justify-center bg-indigo-900/70 p-20 text-white">
                        <h1 class="text-6xl font-extrabold mb-6">Join Our Store</h1>
                        <p class="text-2xl text-indigo-100 max-w-lg leading-relaxed">
                            Create your account to enjoy exclusive deals, faster checkout,
                            order tracking and personalized offers.
                        </p>
                    </div>
                </div>

                <!-- RIGHT FORM -->
                <div class="flex items-center">
                    <div class="w-full max-w-2xl mx-auto px-14 py-16">

                        <h2 class="text-5xl font-extrabold text-gray-900 dark:text-white">
                            Create Account
                        </h2>
                        <p class="text-gray-500 mt-3 mb-10 text-xl">
                            Sign up and start shopping smarter
                        </p>

                        <form method="POST" action="{{ route('register') }}" class="space-y-6">
                            @csrf

                            <div>
                                <x-input-label for="name" value="Full Name" />
                                <x-text-input id="name"
                                    class="block mt-2 w-full h-14 text-lg"
                                    type="text" name="name" required autofocus />
                            </div>

                            <div>
                                <x-input-label for="email" value="Email Address" />
                                <x-text-input id="email"
                                    class="block mt-2 w-full h-14 text-lg"
                                    type="email" name="email" required />
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Password -->
                                <div x-data="{ show: false }" class="relative">
                                    <x-input-label for="password" value="Password" />
                                    <input :type="show ? 'text' : 'password'" id="password" name="password" 
                                        class="block mt-2 w-full h-14 text-lg pr-12" required />
                                    <button type="button" @click="show = !show"
                                            class="absolute inset-y-0 right-3 flex items-center text-gray-500">
                                        <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        <svg x-show="show" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.269-2.944-9.543-7a10.05 10.05 0 012.317-3.891M6.11 6.11A9.956 9.956 0 0112 5c4.478 0 8.269 2.944 9.543 7a10.05 10.05 0 01-1.456 2.911M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 3l18 18" />
                                        </svg>
                                    </button>
                                </div>

                                <!-- Confirm Password -->
                                <div x-data="{ show: false }" class="relative">
                                    <x-input-label for="password_confirmation" value="Confirm Password" />
                                    <input :type="show ? 'text' : 'password'" id="password_confirmation" name="password_confirmation"
                                        class="block mt-2 w-full h-14 text-lg pr-12" required />
                                    <button type="button" @click="show = !show"
                                            class="absolute inset-y-0 right-3 flex items-center text-gray-500">
                                        <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        <svg x-show="show" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.269-2.944-9.543-7a10.05 10.05 0 012.317-3.891M6.11 6.11A9.956 9.956 0 0112 5c4.478 0 8.269 2.944 9.543 7a10.05 10.05 0 01-1.456 2.911M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 3l18 18" />
                                        </svg>
                                    </button>
                                </div>
                            </div>


                            <x-primary-button class="w-full px-6 py-4 text-xl flex items-center justify-center">
                                Create Account
                            </x-primary-button>

                            <p class="text-center text-base text-gray-600 mt-6">
                                Already have an account?
                                <a href="{{ route('login') }}"
                                    class="font-semibold text-indigo-600 hover:text-indigo-500">
                                    Log in
                                </a>
                            </p>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
</x-guest-layout>
