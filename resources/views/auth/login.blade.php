<x-guest-layout>
    {{-- Header Login --}}
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-bold text-white">Welcome Back</h2>
        <p class="text-gray-400 text-sm mt-1">Masuk untuk melanjutkan pembelajaran.</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <label for="email" class="block font-medium text-sm text-gray-300">Email</label>
            <input id="email" 
                   class="block mt-1 w-full rounded-lg bg-gray-900 border border-gray-700 text-gray-100 focus:border-green-500 focus:ring-green-500 placeholder-gray-600 transition duration-200" 
                   type="email" 
                   name="email" 
                   value="{{ old('email') }}" 
                   required autofocus autocomplete="username" 
                   placeholder="nama@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <label for="password" class="block font-medium text-sm text-gray-300">Password</label>

            <input id="password" 
                   class="block mt-1 w-full rounded-lg bg-gray-900 border border-gray-700 text-gray-100 focus:border-green-500 focus:ring-green-500 placeholder-gray-600 transition duration-200" 
                   type="password" 
                   name="password" 
                   required autocomplete="current-password" 
                   placeholder="••••••••" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center group cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded bg-gray-900 border-gray-700 text-green-600 shadow-sm focus:ring-green-500 cursor-pointer transition" name="remember">
                <span class="ms-2 text-sm text-gray-400 group-hover:text-green-400 transition">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-between mt-6">
            @if (Route::has('password.request'))
                <a class="text-sm text-gray-500 hover:text-green-400 transition duration-200" href="{{ route('password.request') }}">
                    {{ __('Lupa password?') }}
                </a>
            @endif

            <button type="submit" class="ms-3 bg-green-600 text-white px-6 py-2 rounded-lg font-bold hover:bg-green-500 transition duration-300 shadow-lg shadow-green-900/40 hover:shadow-green-500/20 transform hover:-translate-y-0.5">
                {{ __('Log in') }}
            </button>
        </div>
    </form>
    
    {{-- Footer link (Optional) --}}
    <div class="mt-8 text-center border-t border-gray-700 pt-4">
        <p class="text-sm text-gray-500">
            Belum punya akun? 
            <a href="{{ route('register') }}" class="text-green-500 hover:text-green-400 font-bold transition">Daftar Sekarang</a>
        </p>
    </div>
</x-guest-layout>