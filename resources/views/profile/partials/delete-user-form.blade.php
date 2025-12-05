<section class="space-y-6 relative">
    
    {{-- Header Section --}}
    <header>
        <h2 class="text-lg font-bold text-red-500 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-gray-400">
            {{ __('PERINGATAN: Tindakan ini bersifat permanen. Semua resource, data, dan progress kursus akan dihapus total dari database sistem.') }}
        </p>
    </header>

    {{-- Trigger Button --}}
    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="bg-red-600/10 border border-red-600/50 text-red-500 hover:bg-red-600 hover:text-white font-bold py-2 px-4 rounded transition duration-200 flex items-center gap-2"
    >
        {{ __('Execute Deletion') }}
    </button>

    {{-- Confirmation Modal --}}
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        {{-- Kita bungkus form dengan style gelap agar menimpa default modal putih (jika ada) --}}
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 bg-gray-800 text-gray-100 border border-gray-700">
            @csrf
            @method('delete')

            <h2 class="text-xl font-bold text-white mb-4 border-b border-gray-700 pb-2">
                {{ __('Konfirmasi Penghapusan?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-400 mb-6">
                {{ __('Data yang dihapus tidak dapat dikembalikan. Masukkan password Anda untuk otorisasi penghapusan akun secara permanen.') }}
            </p>

            {{-- Input Password --}}
            <div class="mt-6">
                <label for="password" class="sr-only">{{ __('Password') }}</label>

                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </div>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        class="block w-3/4 pl-10 rounded-lg bg-gray-900 border border-red-500/30 text-gray-100 focus:border-red-500 focus:ring-red-500 placeholder-gray-600 transition"
                        placeholder="{{ __('Masukkan Password untuk Konfirmasi') }}"
                    />
                </div>

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 text-red-400 font-mono text-xs" />
            </div>

            <div class="mt-8 flex justify-end gap-3">
                <button type="button" x-on:click="$dispatch('close')" class="bg-gray-700 hover:bg-gray-600 text-gray-200 font-bold py-2 px-4 rounded transition">
                    {{ __('Cancel') }}
                </button>

                <button type="submit" class="bg-red-600 hover:bg-red-500 text-white font-bold py-2 px-4 rounded shadow-lg shadow-red-900/50 transition transform hover:scale-105">
                    {{ __('Permanently Delete') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>