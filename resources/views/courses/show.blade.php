<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Kursus') }}
        </h2>
    </x-slot>

    <div class="bg-indigo-700 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                <div>
                    <span class="bg-indigo-500 text-indigo-100 text-xs px-2 py-1 rounded uppercase tracking-wide">
                        {{ $course->category->name }}
                    </span>
                    <h1 class="text-3xl font-bold mt-2">{{ $course->title }}</h1>
                    <p class="mt-2 text-indigo-200">
                        Oleh: {{ $course->teacher->username }} |
                        Dibuat: {{ $course->created_at->format('d M Y') }}
                    </p>
                </div>

                <div class="mt-6 md:mt-0">
                    @auth
                    @if(Auth::user()->role === 'admin' || (Auth::user()->role === 'teacher' && Auth::id() === $course->teacher_id))
                    <a href="{{ route('contents.create', $course->id) }}" class="bg-white text-indigo-700 font-bold py-2 px-6 rounded shadow hover:bg-gray-100 transition">
                        + Tambah Materi Baru
                    </a>

                    @elseif(Auth::user()->role === 'student')

                    @if($isEnrolled)
                    <div class="bg-green-100 text-green-800 font-bold py-2 px-6 rounded shadow border border-green-200 cursor-default">
                        ✓ Anda Sudah Terdaftar
                    </div>
                    @else
                    <form action="{{ route('courses.join', $course->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-green-500 text-white font-bold py-2 px-6 rounded shadow hover:bg-green-600 transition" onclick="return confirm('Yakin ingin bergabung dengan kursus ini?')">
                            Gabung Kursus Ini
                        </button>
                    </form>
                    @endif

                    @endif
                    @else
                    <a href="{{ route('login') }}" class="bg-white text-indigo-700 font-bold py-2 px-6 rounded shadow hover:bg-gray-100 transition">
                        Login untuk Gabung
                    </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-3 gap-8">

            <div class="lg:col-span-2">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Tentang Kursus</h3>
                        <p class="text-gray-600 leading-relaxed whitespace-pre-line">
                            {{ $course->description }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg sticky top-6">
                    <div class="p-6 border-b border-gray-100">
                        <h3 class="text-lg font-bold text-gray-800">Materi Pembelajaran</h3>
                        <span class="text-xs text-gray-500">{{ $course->contents->count() }} Pelajaran tersedia</span>
                    </div>
                    <div class="p-0">
                        @if($course->contents->count() > 0)
                        <ul class="divide-y divide-gray-100">
                            @foreach($course->contents as $index => $content)
                            <a href="{{ route('contents.show', $content->id) }}" class="block hover:bg-gray-50 transition duration-150 ease-in-out">
                                <li class="p-4 flex items-center">
                                    <span class="bg-gray-200 text-gray-600 rounded-full h-8 w-8 flex items-center justify-center text-xs font-bold mr-3">
                                        {{ $index + 1 }}
                                    </span>
                                    <div>
                                        <h4 class="text-sm font-semibold text-gray-700">{{ $content->title }}</h4>
                                        <span class="text-xs text-gray-400">Teks/Bacaan - Klik untuk membaca</span>
                                    </div>
                                </li>
                            </a>
                            @endforeach
                        </ul>
                        @else
                        <div class="p-6 text-center text-gray-500 text-sm italic">
                            Belum ada materi yang diunggah oleh pengajar.
                        </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>