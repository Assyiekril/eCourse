<section>
    <header class="mb-6">
        <h2 class="text-lg font-bold text-white flex items-center gap-2">
            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-400">
            {{ __("Update data identitas profil dan alamat email akun Anda.") }}
        </p>
    </header>

    {{-- Form Verifikasi Email (Hidden) --}}
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        {{-- Name Input --}}
        <div>
            <label for="name" class="block text-sm font-medium text-gray-300 mb-1">
                {{ __('Display Name') }}
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0c0 .884-.5 2-2 2h4c-1.5 0-2-1.116-2-2z"></path></svg>
                </div>
                <input 
                    id="name" 
                    name="name" 
                    type="text" 
                    class="block w-full pl-10 rounded-lg bg-gray-900 border border-gray-600 text-gray-100 focus:border-green-500 focus:ring-green-500 placeholder-gray-600 transition shadow-sm" 
                    value="{{ old('name', $user->name) }}" 
                    required autofocus autocomplete="name" 
                />
            </div>
            <x-input-error class="mt-2 text-red-400 text-xs font-mono" :messages="$errors->get('name')" />
        </div>

        {{-- Email Input --}}
        <div>
            <label for="email" class="block text-sm font-medium text-gray-300 mb-1">
                {{ __('Email Address') }}
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>
                <input 
                    id="email" 
                    name="email" 
                    type="email" 
                    class="block w-full pl-10 rounded-lg bg-gray-900 border border-gray-600 text-gray-100 focus:border-green-500 focus:ring-green-500 placeholder-gray-600 transition shadow-sm" 
                    value="{{ old('email', $user->email) }}" 
                    required autocomplete="username" 
                />
            </div>
            <x-input-error class="mt-2 text-red-400 text-xs font-mono" :messages="$errors->get('email')" />

            {{-- Unverified Email Alert --}}
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-4 p-4 rounded-lg bg-yellow-900/20 border border-yellow-600/30">
                    <p class="text-sm text-yellow-500 flex items-start gap-2">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        <span>
                            {{ __('Alamat email Anda belum terverifikasi.') }}
                            <button form="send-verification" class="underline font-bold hover:text-yellow-400 focus:outline-none transition">
                                {{ __('Klik di sini untuk kirim ulang email verifikasi.') }}
                            </button>
                        </span>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-mono text-xs text-green-400">
                            {{ __('✓ Link verifikasi baru telah dikirim ke email Anda.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        {{-- Action Button --}}
        <div class="flex items-center gap-4 pt-2">
            <button type="submit" class="bg-green-600 text-white px-5 py-2 rounded-lg font-bold hover:bg-green-500 transition shadow-lg shadow-green-900/50 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                {{ __('Save Changes') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-400 font-mono flex items-center gap-1"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>