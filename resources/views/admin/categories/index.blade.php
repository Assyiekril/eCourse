<x-app-layout>
    {{-- Background Texture & Header Section --}}
    <div class="relative bg-gray-900 pb-12">
        <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20 pointer-events-none"></div>
        <div class="absolute inset-0 pointer-events-none" style="background-image: radial-gradient(#374151 1px, transparent 1px); background-size: 32px 32px; opacity: 0.1;"></div>

        {{-- Custom Header --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10 pb-6 relative z-10">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-gray-800 border border-gray-700 rounded-lg">
                    <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-white tracking-tight">System Configuration</h2>
                    <p class="text-gray-400 text-sm font-mono">Category Protocol Management</p>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-8 relative z-10">
            
            {{-- KOLOM KIRI: FORM TAMBAH --}}
            <div class="md:col-span-1">
                <div class="bg-gray-800 border border-gray-700 rounded-xl shadow-xl sticky top-6 overflow-hidden">
                    <div class="bg-gray-800/50 p-4 border-b border-gray-700 flex justify-between items-center">
                        <h3 class="text-gray-100 font-bold flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                            New Input
                        </h3>
                    </div>
                    
                    <div class="p-6">
                        <form action="{{ route('categories.store') }}" method="POST">
                            @csrf
                            <div class="mb-5">
                                <label class="block text-gray-400 text-xs font-mono mb-2 uppercase tracking-wider">Category Name</label>
                                <input type="text" name="name" 
                                    class="w-full bg-gray-900 border border-gray-600 text-gray-100 rounded-lg p-3 focus:border-green-500 focus:ring-green-500 placeholder-gray-600 transition" 
                                    required placeholder="e.g. Cyber Security">
                            </div>
                            <div class="mb-6">
                                <label class="block text-gray-400 text-xs font-mono mb-2 uppercase tracking-wider">Description</label>
                                <textarea name="description" rows="3" 
                                    class="w-full bg-gray-900 border border-gray-600 text-gray-100 rounded-lg p-3 focus:border-green-500 focus:ring-green-500 placeholder-gray-600 transition" 
                                    placeholder="Brief parameter description..."></textarea>
                            </div>
                            <button type="submit" class="w-full bg-green-600 text-white font-bold py-3 px-4 rounded-lg hover:bg-green-500 hover:shadow-lg hover:shadow-green-500/20 transition duration-300 flex justify-center items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                Execute Add
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- KOLOM KANAN: TABEL DATA --}}
            <div class="md:col-span-2">
                <div class="bg-gray-800 border border-gray-700 rounded-xl shadow-xl overflow-hidden">
                    <div class="p-4 border-b border-gray-700 flex justify-between items-center bg-gray-800/50 backdrop-blur">
                        <h3 class="text-gray-100 font-bold">Database Records</h3>
                        @if(session('success'))
                            <span class="text-xs text-green-400 font-mono border border-green-500/30 bg-green-500/10 px-2 py-1 rounded">
                                {{ session('success') }}
                            </span>
                        @endif
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-900 text-gray-400 text-xs font-mono uppercase tracking-wider border-b border-gray-700">
                                    <th class="p-4">Category Name</th>
                                    <th class="p-4">Description</th>
                                    <th class="p-4 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-700">
                                @foreach($categories as $category)
                                <tr class="group hover:bg-gray-700/30 transition duration-150">
                                    {{-- Kolom Nama (Editable) --}}
                                    <td class="p-3 align-top">
                                        <form action="{{ route('categories.update', $category->id) }}" method="POST" id="form-edit-{{ $category->id }}">
                                            @csrf @method('PUT')
                                            <input type="text" name="name" value="{{ $category->name }}" 
                                                class="w-full bg-transparent border-transparent text-gray-200 font-bold rounded px-2 py-1 focus:bg-gray-900 focus:border-green-500 focus:ring-0 transition duration-200 hover:bg-gray-700/50">
                                        </form>
                                    </td>
                                    
                                    {{-- Kolom Deskripsi (Editable) --}}
                                    <td class="p-3 align-top">
                                        <textarea form="form-edit-{{ $category->id }}" name="description" rows="1" 
                                            class="w-full bg-transparent border-transparent text-gray-400 text-sm rounded px-2 py-1 focus:bg-gray-900 focus:border-green-500 focus:ring-0 transition duration-200 resize-none hover:bg-gray-700/50 h-auto">{{ $category->description }}</textarea>
                                    </td>
                                    
                                    {{-- Kolom Aksi --}}
                                    <td class="p-3 align-top">
                                        <div class="flex justify-center items-center gap-2">
                                            {{-- Tombol Save (Hanya muncul/penting saat diedit, tapi kita kasih icon disket) --}}
                                            <button type="submit" form="form-edit-{{ $category->id }}" 
                                                class="text-gray-500 hover:text-green-400 transition p-2 rounded hover:bg-gray-700" title="Save Changes">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                                            </button>
                                            
                                            {{-- Tombol Delete --}}
                                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('PERINGATAN: Menghapus kategori ini mungkin mempengaruhi kursus terkait. Lanjutkan?');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-gray-500 hover:text-red-500 transition p-2 rounded hover:bg-red-500/10" title="Delete">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    {{-- Empty State jika data kosong --}}
                    @if($categories->isEmpty())
                        <div class="p-12 text-center border-t border-gray-700">
                            <p class="text-gray-500 italic">No category data found in memory.</p>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>