<x-app-layout>
    {{-- Background Textures --}}
    <div class="relative bg-gray-900 min-h-screen pb-20">
        <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20 pointer-events-none fixed"></div>
        <div class="absolute inset-0 pointer-events-none fixed" style="background-image: radial-gradient(#374151 1px, transparent 1px); background-size: 32px 32px; opacity: 0.1;"></div>

        {{-- Header Section --}}
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pt-10 pb-6 relative z-10">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-gray-800 border border-gray-700 rounded-lg">
                    <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-white tracking-tight">Deploy New Course</h2>
                    <p class="text-gray-400 text-sm font-mono">Initialize a new learning module.</p>
                </div>
            </div>
        </div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            {{-- Form Container --}}
            <div class="bg-gray-800 border border-gray-700 rounded-xl shadow-2xl overflow-hidden">
                
                {{-- Decorative Line --}}
                <div class="h-1 w-full bg-gradient-to-r from-green-500 to-emerald-600"></div>

                <div class="p-8">
                    {{-- Error Logs --}}
                    @if ($errors->any())
                        <div class="mb-8 bg-red-900/20 border border-red-500/50 rounded-lg p-4">
                            <div class="flex items-center gap-2 mb-2 text-red-500 font-bold uppercase text-xs tracking-wider">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                System Error Log
                            </div>
                            <ul class="list-disc list-inside text-sm text-red-400 font-mono space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('courses.store') }}" method="POST" class="space-y-6">
                        @csrf

                        {{-- Judul Kursus --}}
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-300 mb-2">Judul Kursus</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                </div>
                                <input type="text" name="title" id="title" value="{{ old('title') }}" 
                                    class="block w-full pl-10 rounded-lg bg-gray-900 border border-gray-600 text-gray-100 focus:border-green-500 focus:ring-green-500 placeholder-gray-600 transition p-3" 
                                    placeholder="e.g. Advanced Laravel Architecture">
                            </div>
                        </div>

                        {{-- Kategori --}}
                        <div>
                            <label for="category_id" class="block text-sm font-medium text-gray-300 mb-2">Kategori</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                                </div>
                                <select name="category_id" id="category_id" 
                                    class="block w-full pl-10 rounded-lg bg-gray-900 border border-gray-600 text-gray-100 focus:border-green-500 focus:ring-green-500 transition p-3 appearance-none">
                                    <option value="" class="text-gray-500">-- Select Protocol Category --</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                    <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20"><path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" fill-rule="evenodd"></path></svg>
                                </div>
                            </div>
                        </div>

                        {{-- Deskripsi --}}
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-300 mb-2">Deskripsi Singkat</label>
                            <textarea name="description" id="description" rows="5" 
                                class="block w-full rounded-lg bg-gray-900 border border-gray-600 text-gray-100 focus:border-green-500 focus:ring-green-500 placeholder-gray-600 transition p-3" 
                                placeholder="Jelaskan silabus dan target pembelajaran...">{{ old('description') }}</textarea>
                        </div>

                        {{-- Tanggal --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="start_date" class="block text-sm font-medium text-gray-300 mb-2">Tanggal Mulai</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                    <input type="date" name="start_date" id="start_date" value="{{ old('start_date') }}"
                                        class="block w-full pl-10 rounded-lg bg-gray-900 border border-gray-600 text-gray-100 focus:border-green-500 focus:ring-green-500 transition p-3 [color-scheme:dark]">
                                </div>
                            </div>
                            <div>
                                <label for="end_date" class="block text-sm font-medium text-gray-300 mb-2">Tanggal Selesai</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                    <input type="date" name="end_date" id="end_date" value="{{ old('end_date') }}"
                                        class="block w-full pl-10 rounded-lg bg-gray-900 border border-gray-600 text-gray-100 focus:border-green-500 focus:ring-green-500 transition p-3 [color-scheme:dark]">
                                </div>
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-700">
                            <a href="{{ route('dashboard') }}" class="text-gray-400 hover:text-white font-bold text-sm transition">
                                Cancel Operation
                            </a>
                            <button type="submit" class="bg-green-600 hover:bg-green-500 text-white font-bold py-3 px-6 rounded-lg shadow-lg shadow-green-900/50 hover:shadow-green-500/20 transition transform hover:-translate-y-0.5 flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Initialize Course
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>