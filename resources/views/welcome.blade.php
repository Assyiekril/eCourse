<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>eCourse Platform</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased">
    
    <nav class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold text-indigo-600">eCourse</h1>
                </div>
                <div class="flex items-center space-x-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-gray-700 hover:text-indigo-600 font-semibold">Dashboard</a>
                            
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-semibold">
                                    Log Out
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-700 hover:text-indigo-600 font-semibold">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="text-gray-700 hover:text-indigo-600 font-semibold">Register</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <div class="bg-indigo-600 py-12 text-white text-center">
        <h2 class="text-4xl font-extrabold">Selamat Datang di eCourse</h2>
        <p class="mt-4 text-lg text-indigo-100">Tingkatkan skillmu dengan materi terbaik dari para ahli.</p>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <h3 class="text-2xl font-bold text-gray-800 mb-6">Katalog Kursus Terbaru</h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($courses as $course)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-2">
                            <span class="bg-indigo-100 text-indigo-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                                {{ $course->category->name ?? 'Uncategorized' }}
                            </span>
                            <span class="text-xs text-gray-500">
                                {{ $course->created_at->diffForHumans() }}
                            </span>
                        </div>
                        
                        <h4 class="text-xl font-bold text-gray-900 mb-2">{{ $course->title }}</h4>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                            {{ $course->description }}
                        </p>
                        
                        <div class="border-t pt-4 flex items-center justify-between">
                            <div class="text-sm text-gray-600">
                                <span class="block text-xs text-gray-400">Pengajar:</span>
                                {{ $course->teacher->username ?? 'Unknown' }}
                            </div>
                            <a href="#" class="bg-indigo-600 text-white px-4 py-2 rounded text-sm hover:bg-indigo-700">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-10 text-gray-500">
                    Belum ada kursus yang tersedia saat ini.
                </div>
            @endforelse
        </div>
    </div>

</body>
</html>