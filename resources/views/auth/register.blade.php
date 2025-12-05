<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <label for="username" class="block font-medium text-sm text-gray-300">Username</label>
            <input id="username" 
                   class="block mt-1 w-full rounded-lg bg-gray-900 border border-gray-700 text-gray-100 focus:border-green-500 focus:ring-green-500 placeholder-gray-600 transition duration-200" 
                   type="text" 
                   name="username" 
                   value="{{ old('username') }}" 
                   required autofocus autocomplete="username" 
                   placeholder="Pilih username unik" />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <div class="mt-4">
            <label for="email" class="block font-medium text-sm text-gray-300">Email</label>
            <input id="email" 
                   class="block mt-1 w-full rounded-lg bg-gray-900 border border-gray-700 text-gray-100 focus:border-green-500 focus:ring-green-500 placeholder-gray-600 transition duration-200" 
                   type="email" 
                   name="email" 
                   value="{{ old('email') }}" 
                   required autocomplete="username" 
                   placeholder="nama@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <label for="role" class="block font-medium text-sm text-gray-300">Daftar Sebagai</label>
            <div class="relative">
                <select id="role" name="role" 
                        class="block mt-1 w-full rounded-lg bg-gray-900 border border-gray-700 text-gray-100 focus:border-green-500 focus:ring-green-500 transition duration-200 appearance-none cursor-pointer">
                    <option value="student">Student (Siswa)</option>
                    <option value="teacher">Teacher (Pengajar)</option>
                </select>
                {{-- Custom Dropdown Arrow --}}
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-400">
                    <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20"><path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" fill-rule="evenodd"></path></svg>
                </div>
            </div>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <div class="mt-4">
            <label for="password" class="block font-medium text-sm text-gray-300">Password</label>
            <input id="password" 
                   class="block mt-1 w-full rounded-lg bg-gray-900 border border-gray-700 text-gray-100 focus:border-green-500 focus:ring-green-500 placeholder-gray-600 transition duration-200" 
                   type="password" 
                   name="password" 
                   required autocomplete="new-password" 
                   placeholder="Minimal 8 karakter" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <label for="password_confirmation" class="block font-medium text-sm text-gray-300">Konfirmasi Password</label>
            <input id="password_confirmation" 
                   class="block mt-1 w-full rounded-lg bg-gray-900 border border-gray-700 text-gray-100 focus:border-green-500 focus:ring-green-500 placeholder-gray-600 transition duration-200" 
                   type="password" 
                   name="password_confirmation" 
                   required autocomplete="new-password" 
                   placeholder="Ulangi password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-8 pt-4 border-t border-gray-700">
            <a class="text-sm text-gray-500 hover:text-green-400 transition duration-200" href="{{ route('login') }}">
                {{ __('Sudah punya akun?') }}
            </a>

            <button type="submit" class="ms-3 bg-green-600 text-white px-6 py-2 rounded-lg font-bold hover:bg-green-500 transition duration-300 shadow-lg shadow-green-900/40 hover:shadow-green-500/20 transform hover:-translate-y-0.5">
                {{ __('Daftar Sekarang') }}
            </button>
        </div>
    </form>
</x-guest-layout>