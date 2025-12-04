<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>eCourse</title>
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-900 font-sans antialiased text-gray-100 selection:bg-green-500 selection:text-white">

    <nav class="bg-gray-900/80 border-b border-gray-800 sticky top-0 z-50 backdrop-blur-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center gap-3">
                    <div class="bg-gray-800 p-2 rounded border border-gray-700">
                        <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                    </div>
                    <span class="text-xl font-bold text-white tracking-tight">eCourse<span class="text-green-500">.</span></span>
                </div>

                <div class="flex items-center space-x-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-sm font-bold text-gray-300 hover:text-green-400 transition">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-medium text-gray-400 hover:text-white transition">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="bg-green-600 text-white px-5 py-2 rounded font-bold hover:bg-green-500 transition shadow-lg shadow-green-900/50">Join Now</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <div class="relative bg-gray-900 overflow-hidden border-b border-gray-800 min-h-[90vh] flex items-center justify-center">
        <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20"></div>
        <div class="absolute inset-0" style="background-image: radial-gradient(#374151 1px, transparent 1px); background-size: 32px 32px; opacity: 0.1;"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center w-full">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-gray-800 border border-gray-700 text-green-400 text-xs font-mono mb-8">
                <span class="relative flex h-2 w-2">
                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                  <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                </span>
                v1.0 Available Now
            </div>

            <h1 class="text-5xl md:text-7xl font-extrabold text-white tracking-tight mb-8 leading-tight">
                Upgrade Your <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-emerald-600">Tech Skills</span>
            </h1>
            
            <p class="text-gray-400 text-xl md:text-2xl mb-12 max-w-3xl mx-auto leading-relaxed">
                Cari ilmu baru, tingkatkan karir, dan bangun masa depan.
            </p>
            
            <div class="max-w-2xl mx-auto mb-10">
                <form action="{{ url('/') }}" method="GET" class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" 
                        placeholder="Cari kursus (misal: Laravel, Data Science)..." 
                        class="w-full bg-gray-800 border border-gray-700 text-white rounded-full py-4 px-8 pl-14 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent shadow-xl text-lg">
                    <div class="absolute top-0 left-0 mt-5 ml-5 text-gray-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <button type="submit" class="absolute top-2 right-2 bg-green-600 text-white rounded-full px-6 py-2.5 font-bold hover:bg-green-500 transition">
                        Cari
                    </button>
                </form>
            </div>

            <div class="flex justify-center gap-4">
                <a href="#popular" class="text-gray-400 hover:text-white transition flex flex-col items-center gap-2 text-sm animate-bounce">
                    Scroll Down
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
                </a>
            </div>
        </div>
    </div>

    @if($popularCourses->count() > 0)
    <div id="popular" class="bg-gray-800 border-b border-gray-700 min-h-screen flex items-center relative">
        <div class="absolute inset-0" style="background-image: radial-gradient(#4b5563 1px, transparent 1px); background-size: 40px 40px; opacity: 0.05;"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full relative z-10">
            <div class="text-center mb-16">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded bg-yellow-500/10 text-yellow-500 text-sm font-bold uppercase tracking-wider mb-4 border border-yellow-500/20">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    Most Popular
                </div>
                <h2 class="text-4xl font-extrabold text-white">Trending Courses</h2>
                <p class="text-gray-400 mt-4 max-w-2xl mx-auto text-lg">Kelas-kelas favorit yang paling banyak diminati oleh siswa saat ini.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6">
                @foreach($popularCourses as $course)
                <div class="bg-gray-900 rounded-xl border border-gray-700 p-6 hover:border-yellow-500 transition duration-300 group transform hover:-translate-y-2 hover:shadow-2xl hover:shadow-yellow-900/20">
                    <div class="flex justify-between items-start mb-4">
                        <span class="text-xs text-yellow-500 font-bold uppercase tracking-wider border border-yellow-500/20 px-2 py-1 rounded bg-yellow-500/5">
                            #{{ $loop->iteration }}
                        </span>
                        <div class="flex items-center gap-1 text-gray-400 text-xs">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path></svg>
                            {{ $course->students_count }}
                        </div>
                    </div>
                    
                    <h3 class="text-lg font-bold text-white mb-2 group-hover:text-yellow-400 leading-snug line-clamp-2 min-h-[3.5rem]">
                        <a href="{{ route('courses.show', $course) }}">
                            {{ $course->title }}
                        </a>
                    </h3>
                    
                    <p class="text-gray-500 text-sm mb-4 line-clamp-2">{{ $course->category->name }}</p>

                    <a href="{{ route('courses.show', $course) }}" class="block w-full text-center bg-gray-800 border border-gray-600 text-gray-300 py-2 rounded font-bold text-sm hover:bg-yellow-500 hover:text-black hover:border-yellow-500 transition">
                        View Details
                    </a>
                </div>
                @endforeach
            </div>

            <div class="flex justify-center mt-12">
                <a href="#katalog" class="text-gray-500 hover:text-white transition flex flex-col items-center gap-2 text-sm">
                    View All Courses &darr;
                </a>
            </div>
        </div>
    </div>
    @endif

    <div id="katalog" class="bg-gray-900 py-20 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="flex flex-col md:flex-row items-end justify-between mb-12 border-b border-gray-800 pb-4 gap-4">
                <div>
                    <h2 class="text-3xl font-bold text-white">All Courses</h2>
                    <p class="text-gray-500 mt-2 text-lg">
                        @if(request('search'))
                            Hasil pencarian: "{{ request('search') }}"
                        @else
                            Expand your knowledge base.
                        @endif
                    </p>
                </div>
                
                <div class="flex items-center gap-2">
                    <label for="categoryFilter" class="text-gray-400 text-sm">Filter:</label>
                    <select id="categoryFilter" class="bg-gray-800 text-white border border-gray-700 rounded-lg py-2 px-4 focus:ring-green-500 focus:border-green-500 text-sm">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($courses as $course)
                    <div class="bg-gray-800 rounded-xl border border-gray-700 hover:border-green-500/50 transition duration-300 overflow-hidden group flex flex-col h-full hover:shadow-2xl hover:shadow-green-900/10">
                        <div class="p-8 flex-grow">
                            <div class="flex justify-between items-start mb-6">
                                <span class="bg-gray-900 text-green-400 text-xs font-bold px-3 py-1 rounded border border-gray-700 uppercase tracking-wide">
                                    {{ $course->category->name ?? 'General' }}
                                </span>
                                <span class="text-xs text-gray-500 font-mono">
                                    {{ $course->created_at->format('M d, Y') }}
                                </span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-100 mb-4 group-hover:text-green-400 transition">
                                <a href="{{ route('courses.show', $course) }}">
                                    {{ $course->title }}
                                </a>
                            </h3>
                            <p class="text-gray-400 text-base line-clamp-3 leading-relaxed">
                                {{ $course->description }}
                            </p>
                        </div>
                        <div class="px-8 py-5 bg-gray-800/50 border-t border-gray-700 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded bg-gray-700 flex items-center justify-center text-gray-300 font-bold text-sm border border-gray-600">
                                    {{ substr($course->teacher->username ?? 'T', 0, 1) }}
                                </div>
                                <div class="text-sm">
                                    <p class="text-gray-500 text-xs">Instructor</p>
                                    <p class="text-gray-300 font-semibold">{{ $course->teacher->username ?? 'Unknown' }}</p>
                                </div>
                            </div>
                            <a href="{{ route('courses.show', $course) }}" class="text-green-500 hover:text-green-400 font-bold text-sm flex items-center gap-2 group-hover:translate-x-1 transition-transform">
                                Details &rarr;
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-20 border border-dashed border-gray-700 rounded-xl bg-gray-800/30">
                        <p class="text-gray-400 text-xl">Tidak ada kursus yang ditemukan.</p>
                        <a href="{{ url('/') }}" class="text-green-500 hover:underline mt-2 inline-block">Reset Filter</a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <footer class="bg-gray-900 border-t border-gray-800 py-10">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p class="text-gray-500 text-sm font-mono">&copy; {{ date('Y') }} eCourse Platform. All rights reserved.</p>
        </div>
    </footer>

    <script>
        document.getElementById('categoryFilter').addEventListener('change', function() {
            const category = this.value;
            const search = "{{ request('search') }}";
            let url = "{{ url('/') }}?category=" + category;
            
            if (search) {
                url += "&search=" + search;
            }
            
            url += "#katalog";
            
            window.location.href = url;
        });
    </script>

</body>
</html>