<x-guest-layout>
    <div class="h-screen flex items-center justify-center bg-neutral-900">
        <div class="w-full max-w-6xl mx-4 rounded-3xl overflow-hidden shadow-xl grid grid-cols-1 lg:grid-cols-2">
            <div class="relative h-72 lg:h-auto">
                <img
                    src="{{ asset('images/formRegister.jpg') }}"
                    alt="KEKAR MEMBAHANA"
                    class="w-full h-full object-cover"
                    loading="lazy"
                    decoding="async"
                />
            </div>

            <!-- Register Form -->
            <div class="bg-neutral-800 lg:rounded-none rounded-b-3xl lg:rounded-r-3xl p-8 md:p-10">
                <div class="max-w-md mx-auto">
                    <h1 class="text-3xl font-semibold text-white mb-2">Buat Akun Baru</h1>
                    <p class="text-sm text-neutral-200 mb-6">Daftar untuk mengakses jadwal, booking kelas, dan memantau progress Anda.</p>

                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form method="POST" action="{{ route('register') }}" novalidate>
                        @csrf

                        <!-- Name -->
                        <div class="mb-4">
                            <label for="name" class="block text-sm text-neutral-200">Nama</label>
                            <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus
                                   autocomplete="name"
                                   class="mt-2 w-full px-4 py-3 rounded-lg border border-neutral-500 bg-neutral-800 text-neutral-200 focus:outline-none focus:ring-2 focus:ring-green-400" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <label for="email" class="block text-sm text-neutral-200">Email</label>
                            <input id="email" name="email" type="email" value="{{ old('email') }}" required
                                   autocomplete="username"
                                   class="mt-2 w-full px-4 py-3 rounded-lg border border-neutral-500 bg-neutral-800 text-neutral-200 focus:outline-none focus:ring-2 focus:ring-green-400" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="mb-4">
                            <label for="password" class="block text-sm text-neutral-200">Password</label>
                            <input id="password" name="password" type="password" required
                                   autocomplete="new-password"
                                   class="mt-2 w-full px-4 py-3 rounded-lg border border-neutral-500 bg-neutral-800 text-neutral-200 focus:outline-none focus:ring-2 focus:ring-green-400" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-4">
                            <label for="password_confirmation" class="block text-sm text-neutral-200">Konfirmasi Password</label>
                            <input id="password_confirmation" name="password_confirmation" type="password" required
                                   autocomplete="new-password"
                                   class="mt-2 w-full px-4 py-3 rounded-lg border border-neutral-500 bg-neutral-800 text-neutral-200 focus:outline-none focus:ring-2 focus:ring-green-400" />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="w-full py-3 rounded-lg bg-green-500 text-white font-semibold hover:bg-green-600 transition">
                                {{ __('Register') }}
                            </button>

                            <div class="text-center mt-4">
                                <a class="underline text-sm text-neutral-200 hover:text-neutral-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-400"
                                    href="{{ route('login') }}">
                                    {{ __('Already registered?') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
