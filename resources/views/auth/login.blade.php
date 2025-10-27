<x-guest-layout>
    <div class="h-screen flex items-center justify-center bg-neutral-900">
        <div class="w-full max-w-6xl mx-4 rounded-3xl overflow-hidden shadow-xl grid grid-cols-1 lg:grid-cols-2">
            <div class="relative h-72 lg:h-auto">
                <img
                    src="{{ asset('storage/formLogin.jpg') }}"
                    alt="Ilustrasi latihan dan komunitas Gymnestix"
                    class="w-full h-full object-cover"
                    loading="lazy"
                    decoding="async"
                />
            </div>

            <!-- Form -->
            <div class="bg-neutral-800 lg:rounded-none rounded-b-3xl lg:rounded-r-3xl p-8 md:p-10">
                <div class="max-w-md mx-auto">
                    <h1 class="text-3xl font-semibold text-white mb-2">Hei There, Welcome!</h1>
                    <p class="text-sm text-neutral-200 mb-6">Please log in to your account to continue. Akses jadwal, booking kelas, dan progress Anda.</p>

                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}" novalidate>
                        @csrf

                        <div class="mb-4">
                            <label for="email" class="block text-sm text-neutral-200">Email</label>
                            <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                                   autocomplete="username"
                                   class="mt-2 w-full px-4 py-3 rounded-lg border border-neutral-500 bg-neutral-800 text-neutral-200 focus:outline-none focus:ring-2 focus:ring-green-400" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <label for="password" class="block text-sm text-neutral-200">Password</label>
                            <input id="password" name="password" type="password" required
                                   autocomplete="current-password"
                                   class="mt-2 w-full px-4 py-3 rounded-lg border border-neutral-500 bg-neutral-800 text-neutral-200 focus:outline-none focus:ring-2 focus:ring-green-400" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-between mb-6">
                            <label class="inline-flex items-center text-sm text-neutral-200">
                                <input id="remember_me" type="checkbox" name="remember" class="rounded border-gray-300 text-green-500" />
                                <span class="ml-2">Remember me</span>
                            </label>

                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-sm text-green-600 hover:underline">Forgot password?</a>
                            @endif
                        </div>

                        <div>
                            <button type="submit" class="w-full py-3 rounded-lg bg-green-500 text-white font-semibold hover:bg-green-600 transition">Log in</button>
                        </div>
                    </form>

                    <p class="text-sm text-gray-500 mt-6 text-center">Don't have an account?
                        <a href="{{ route('register') }}" class="text-green-600 hover:underline">Sign up</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
