<x-app-layout>
    <div class="relative bg-gray-900 min-h-screen pb-20">

        <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20 pointer-events-none"></div>

        <div class="absolute inset-0 pointer-events-none" style="background-image: radial-gradient(#374151 1px, transparent 1px); background-size: 32px 32px; opacity: 0.1;"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 relative z-10">
            

            <div class="bg-gray-800 border-l-4 border-green-500 rounded-r-xl shadow-2xl p-6 mb-10 flex flex-col md:flex-row items-center justify-between gap-6 relative overflow-hidden">
                <div class="absolute inset-0 bg-green-500/5 pointer-events-none"></div>
                
                <div class="flex items-center gap-4 z-10">
                    <div class="w-16 h-16 rounded-xl bg-gray-700 border border-gray-600 flex items-center justify-center text-2xl font-bold text-green-500 shadow-inner uppercase">
                        {{ substr(Auth::user()->username, 0, 1) }}
                    </div>
                    <div>
                        <h2 class="text-3xl font-bold text-white tracking-tight">
                            Welcome, <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-emerald-600">{{ Auth::user()->username }}</span>
                        </h2>
                        <div class="flex items-center gap-3 mt-1">
                            <span class="text-gray-400 text-sm font-mono">System Role:</span>
                            <span class="px-2 py-0.5 rounded text-xs font-bold uppercase tracking-wider border 
                                {{ Auth::user()->role === 'admin' ? 'bg-red-500/10 text-red-400 border-red-500/20' : 
                                  (Auth::user()->role === 'teacher' ? 'bg-yellow-500/10 text-yellow-400 border-yellow-500/20' : 
                                  'bg-blue-500/10 text-blue-400 border-blue-500/20') }}">
                                {{ Auth::user()->role }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="text-right hidden md:block z-10">
                    <p class="text-gray-500 text-xs font-mono uppercase">Current Session</p>
                    <p class="text-white font-bold text-xl">{{ date('d M Y') }}</p>
                    <p class="text-green-500 text-sm font-mono animate-pulse">● System Online</p>
                </div>
            </div>


            @if(Auth::user()->role === 'admin')
            <div class="mb-10">
                <h3 class="text-gray-400 text-sm font-mono uppercase tracking-widest mb-4 border-b border-gray-800 pb-2">Administrative Modules</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    
                    <a href="{{ route('categories.index') }}" class="group bg-gray-800 border border-gray-700 hover:border-green-500 p-6 rounded-xl transition duration-300 hover:shadow-2xl hover:shadow-green-900/20 relative overflow-hidden">
                        <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition transform group-hover:scale-110">
                            <svg class="w-24 h-24 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                        </div>
                        <div class="relative z-10">
                            <div class="w-12 h-12 bg-gray-700 rounded-lg flex items-center justify-center mb-4 text-green-500 group-hover:bg-green-500 group-hover:text-white transition">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                            </div>
                            <h3 class="text-xl font-bold text-white mb-1 group-hover:text-green-400 transition">Category Protocol</h3>
                            <p class="text-gray-500 text-sm">Configure course taxonomy and structure.</p>
                        </div>
                    </a>


                    <a href="{{ route('users.index') }}" class="group bg-gray-800 border border-gray-700 hover:border-blue-500 p-6 rounded-xl transition duration-300 hover:shadow-2xl hover:shadow-blue-900/20 relative overflow-hidden">
                        <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition transform group-hover:scale-110">
                            <svg class="w-24 h-24 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        </div>
                        <div class="relative z-10">
                            <div class="w-12 h-12 bg-gray-700 rounded-lg flex items-center justify-center mb-4 text-blue-500 group-hover:bg-blue-500 group-hover:text-white transition">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            </div>
                            <h3 class="text-xl font-bold text-white mb-1 group-hover:text-blue-400 transition">User Database</h3>
                            <p class="text-gray-500 text-sm">Manage access control and credentials.</p>
                        </div>
                    </a>

                </div>
            </div>
            @endif


            @if(Auth::user()->role === 'teacher')
            <div class="bg-gray-800 border border-gray-700 rounded-xl shadow-xl overflow-hidden">
                <div class="p-6 border-b border-gray-700 flex flex-col sm:flex-row justify-between items-center gap-4 bg-gray-800/50 backdrop-blur">
                    <div>
                        <h3 class="text-xl font-bold text-white">Repository Kursus Saya</h3>
                        <p class="text-gray-400 text-sm">Kelola materi dan status publikasi.</p>
                    </div>
                    <a href="{{ route('courses.create') }}" class="bg-green-600 text-white px-5 py-2.5 rounded-lg font-bold hover:bg-green-500 transition shadow-lg shadow-green-900/50 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Deploy New Course
                    </a>
                </div>

                @if(isset($myCourses) && $myCourses->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-900 border-b border-gray-700 text-gray-400 text-xs font-mono uppercase tracking-wider">
                                <th class="p-5">Course Details</th>
                                <th class="p-5">Category</th>
                                <th class="p-5 text-center">Status</th>
                                <th class="p-5 text-center">Controls</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-700">
                            @foreach($myCourses as $course)
                            <tr class="group hover:bg-gray-700/30 transition duration-150">
                                <td class="p-5">
                                    <h4 class="font-bold text-gray-200 group-hover:text-white mb-1">{{ $course->title }}</h4>
                                    <span class="text-xs text-gray-500 font-mono">Created: {{ $course->created_at->format('d M Y') }}</span>
                                </td>
                                <td class="p-5">
                                    <span class="px-2 py-1 rounded text-xs font-bold border border-gray-600 text-gray-400 bg-gray-900">
                                        {{ $course->category->name }}
                                    </span>
                                </td>
                                <td class="p-5 text-center">
                                    @if($course->is_active)
                                        <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-green-500/10 border border-green-500/20 text-green-400 text-xs font-bold">
                                            <span class="relative flex h-2 w-2">
                                              <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                              <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                                            </span>
                                            Published
                                        </div>
                                    @else
                                        <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-gray-700 border border-gray-600 text-gray-400 text-xs font-bold">
                                            <span class="h-2 w-2 rounded-full bg-gray-500"></span>
                                            Draft / Inactive
                                        </div>
                                    @endif
                                </td>
                                <td class="p-5 text-center">
                                    <div class="flex justify-center items-center gap-3">
                                        <a href="{{ route('courses.edit', $course->id) }}" class="text-gray-400 hover:text-green-400 transition font-bold text-sm flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                            Edit
                                        </a>
                                        
                                        <form action="{{ route('courses.destroy', $course->id) }}" method="POST" onsubmit="return confirm('DANGER ZONE: Deleting this course removes ALL content permanently. Confirm deletion?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-gray-400 hover:text-red-500 transition font-bold text-sm flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="p-12 text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-700/50 mb-4 text-gray-500">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-white">Repository Kosong</h3>
                    <p class="text-gray-500 mb-6">Anda belum membuat kursus apapun.</p>
                    <a href="{{ route('courses.create') }}" class="text-green-500 hover:text-green-400 font-bold hover:underline">Mulai Buat Kursus Sekarang &rarr;</a>
                </div>
                @endif
            </div>
            @endif


            @if(Auth::user()->role === 'student')
            <div>
                <h3 class="text-gray-400 text-sm font-mono uppercase tracking-widest mb-4 border-b border-gray-800 pb-2">Student Dashboard</h3>
                
                @if(isset($myCourses) && count($myCourses) > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        {{-- Card 'Cari Materi' tetap ada sebagai opsi pertama --}}
                        <div class="bg-gray-800 border border-gray-700 rounded-xl p-6 hover:border-green-500 transition group flex flex-col justify-center items-center text-center">
                            <div class="w-12 h-12 bg-gray-700 rounded-full flex items-center justify-center text-green-500 mb-4 group-hover:scale-110 transition">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                            <h2 class="text-xl font-bold text-white mb-2">Cari Materi Baru</h2>
                            <p class="text-gray-500 text-sm mb-4">Jelajahi katalog untuk skill baru.</p>
                            <a href="{{ url('/') }}" class="text-green-500 font-bold hover:text-green-400 text-sm">Browse Catalog &rarr;</a>
                        </div>

                        @foreach($myCourses as $course)
                        <div class="bg-gray-800 border border-gray-700 rounded-xl overflow-hidden hover:border-blue-500 transition duration-300 group flex flex-col shadow-lg">
                            {{-- Card Header --}}
                            <div class="px-6 py-4 border-b border-gray-700 bg-gray-800/50 flex justify-between items-center">
                                <span class="text-xs font-mono font-bold uppercase text-blue-400 tracking-wider">
                                    {{ $course->category->name ?? 'General' }}
                                </span>
                                <div class="flex items-center gap-1">
                                    <span class="w-2 h-2 rounded-full bg-blue-500 animate-pulse"></span>
                                    <span class="text-[10px] text-gray-400 uppercase font-bold">Active</span>
                                </div>
                            </div>

                            <div class="p-6 flex-grow">
                                <h4 class="text-lg font-bold text-white mb-2 line-clamp-2 group-hover:text-blue-400 transition">
                                    {{ $course->title }}
                                </h4>
                                <div class="flex items-center gap-2 mb-4">
                                    <div class="w-6 h-6 rounded-full bg-gray-700 flex items-center justify-center text-xs text-gray-300 font-bold border border-gray-600">
                                        {{ substr($course->teacher->username ?? 'T', 0, 1) }}
                                    </div>
                                    <p class="text-xs text-gray-400 font-mono">
                                        {{ $course->teacher->username ?? 'Unknown Teacher' }}
                                    </p>
                                </div>
                                <p class="text-gray-500 text-sm line-clamp-3 leading-relaxed">
                                    {{ Str::limit($course->description, 80) }}
                                </p>
                            </div>

                            {{-- Card Footer --}}
                            <div class="p-6 pt-0 mt-auto">
                                <a href="{{ route('courses.show', $course->id) }}" class="block w-full text-center bg-gray-700 hover:bg-blue-600 text-white py-2.5 rounded-lg font-bold transition duration-200 border border-gray-600 hover:border-blue-500 shadow-lg">
                                    Continue Learning
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-800 border border-gray-700 rounded-xl p-8 text-center">
                            <h2 class="text-2xl font-bold text-white mb-2">Belum ada kelas</h2>
                            <p class="text-gray-500 mb-6">Anda belum terdaftar di kursus manapun saat ini.</p>
                            <a href="{{ url('/') }}" class="inline-block px-6 py-3 bg-green-600 text-white rounded-lg font-bold hover:bg-green-500 transition shadow-lg shadow-green-900/50">
                                Mulai Belajar Sekarang
                            </a>
                        </div>
                    </div>
                @endif
            </div>
            @endif

        </div>
    </div>
</x-app-layout>