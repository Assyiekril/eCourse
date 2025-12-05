<section>
    <header class="mb-6">
        <h2 class="text-lg font-bold text-white flex items-center gap-2">
            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
            {{ __('Security Credentials') }}
        </h2>

        <p class="mt-1 text-sm text-gray-400">
            {{ __('Pastikan akun Anda menggunakan password yang panjang dan acak untuk menjaga keamanan sistem.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        {{-- Current Password --}}
        <div>
            <label for="update_password_current_password" class="block text-sm font-medium text-gray-300 mb-1">
                {{ __('Current Password') }}
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg>
                </div>
                <input 
                    id="update_password_current_password" 
                    name="current_password" 
                    type="password" 
                    class="block w-full pl-10 rounded-lg bg-gray-900 border border-gray-600 text-gray-100 focus:border-green-500 focus:ring-green-500 placeholder-gray-600 transition shadow-sm" 
                    autocomplete="current-password" 
                    placeholder="••••••••"
                />
            </div>
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-red-400 text-xs font-mono" />
        </div>

        {{-- New Password --}}
        <div>
            <label for="update_password_password" class="block text-sm font-medium text-gray-300 mb-1">
                {{ __('New Password') }}
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                </div>
                <input 
                    id="update_password_password" 
                    name="password" 
                    type="password" 
                    class="block w-full pl-10 rounded-lg bg-gray-900 border border-gray-600 text-gray-100 focus:border-green-500 focus:ring-green-500 placeholder-gray-600 transition shadow-sm" 
                    autocomplete="new-password" 
                    placeholder="Min. 8 karakter"
                />
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-red-400 text-xs font-mono" />
        </div>

        {{-- Confirm Password --}}
        <div>
            <label for="update_password_password_confirmation" class="block text-sm font-medium text-gray-300 mb-1">
                {{ __('Confirm Password') }}
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <input 
                    id="update_password_password_confirmation" 
                    name="password_confirmation" 
                    type="password" 
                    class="block w-full pl-10 rounded-lg bg-gray-900 border border-gray-600 text-gray-100 focus:border-green-500 focus:ring-green-500 placeholder-gray-600 transition shadow-sm" 
                    autocomplete="new-password" 
                    placeholder="Ulangi password baru"
                />
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-red-400 text-xs font-mono" />
        </div>

        <div class="flex items-center gap-4 pt-2">
            <button type="submit" class="bg-green-600 text-white px-5 py-2 rounded-lg font-bold hover:bg-green-500 transition shadow-lg shadow-green-900/50 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                {{ __('Update Credentials') }}
            </button>

            @if (session('status') === 'password-updated')
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