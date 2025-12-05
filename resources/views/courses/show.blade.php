<x-app-layout>
    {{-- Hapus default header slot jika ingin tampilan benar-benar custom dan menyatu --}}
    {{-- <x-slot name="header">...</x-slot> --}}

    {{-- Hero Section dengan Texture Konsisten --}}
    <div class="relative bg-gray-900 border-b border-gray-800">
        {{-- Visual textures (Noise & Grid) --}}
        <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20"></div>
        <div class="absolute inset-0" style="background-image: radial-gradient(#374151 1px, transparent 1px); background-size: 32px 32px; opacity: 0.1;"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 relative z-10">
            <div class="flex flex-col md:flex-row justify-between items-start gap-8">
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="bg-green-500/10 text-green-400 border border-green-500/20 text-xs px-3 py-1 rounded-full uppercase tracking-wider font-mono font-bold">
                            {{ $course->category->name }}
                        </span>
                        <span class="text-gray-500 text-sm font-mono flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            {{ $course->created_at->format('d M Y') }}
                        </span>
                    </div>

                    <h1 class="text-4xl md:text-5xl font-extrabold text-white tracking-tight leading-tight mb-4">
                        {{ $course->title }}
                    </h1>

                    <div class="flex items-center gap-4 text-gray-400">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 rounded bg-gray-800 border border-gray-700 flex items-center justify-center text-green-500 font-bold text-xs">
                                {{ substr($course->teacher->username, 0, 1) }}
                            </div>
                            <span class="text-sm font-medium text-gray-300">By {{ $course->teacher->username }}</span>
                        </div>
                    </div>
                </div>

                <div class="w-full md:w-auto shrink-0 flex flex-col sm:flex-row gap-3">
                    @auth
                    @if(Auth::user()->role === 'admin' || (Auth::user()->role === 'teacher' && Auth::id() === $course->teacher_id))
                    <a href="{{ route('contents.create', $course->id) }}" class="inline-flex justify-center items-center gap-2 bg-gray-800 border border-gray-600 text-gray-200 font-bold py-3 px-6 rounded-lg hover:bg-gray-700 hover:border-green-500 hover:text-green-400 transition duration-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Tambah Materi
                    </a>
                    @elseif(Auth::user()->role === 'student')
                    @if($isEnrolled)
                    <div class="flex items-center justify-center bg-green-500 text-white font-bold py-3 px-8 rounded-lg shadow-lg cursor-default border border-green-400">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Anda Sudah Terdaftar
                    </div>
                    @else
                    <form action="{{ route('courses.join', $course->id) }}" method="POST" class="w-full">
                        @csrf <button type="submit"
                            class="w-full flex items-center justify-center bg-yellow-500 text-white font-bold py-3 px-8 rounded-lg shadow-lg hover:bg-yellow-400 hover:scale-105 transition transform duration-200"
                            onclick="return confirm('Yakin ingin bergabung dengan kursus ini?')">
                            Gabung Kursus Ini
                        </button>
                    </form>
                    @endif
                    @endif
                    @else
                    <a href="{{ route('login') }}" class="w-full sm:w-auto bg-gray-800 border border-gray-600 text-gray-300 font-bold py-3 px-8 rounded-lg hover:bg-white hover:text-black transition duration-300 text-center">
                        Login untuk Gabung
                    </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <div class="py-12 bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- Kolom Kiri: Deskripsi --}}
            <div class="lg:col-span-2">
                <div class="bg-gray-800 border border-gray-700 rounded-xl p-8 shadow-xl">
                    <h3 class="text-2xl font-bold text-white mb-6 flex items-center gap-2">
                        <span class="w-1 h-8 bg-green-500 rounded-full"></span>
                        Tentang Kursus
                    </h3>
                    <div class="prose prose-invert prose-lg max-w-none text-gray-400 leading-relaxed whitespace-pre-line">
                        {{ $course->description }}
                    </div>
                </div>
            </div>

            {{-- Kolom Kanan: Sidebar Materi --}}
            <div class="lg:col-span-1">
                <div class="sticky top-24">
                    <div class="bg-gray-800 border border-gray-700 rounded-xl overflow-hidden shadow-xl">
                        <div class="p-5 border-b border-gray-700 bg-gray-800/50 backdrop-blur">
                            <h3 class="text-lg font-bold text-white flex justify-between items-center">
                                Materi Pembelajaran
                                <span class="text-xs font-mono bg-gray-700 text-gray-300 px-2 py-1 rounded border border-gray-600">
                                    {{ $course->contents->count() }} ITEM
                                </span>
                            </h3>
                        </div>

                        <div class="max-h-[70vh] overflow-y-auto custom-scrollbar">
                            @if($course->contents->count() > 0)
                            <ul class="divide-y divide-gray-700">
                                @foreach($course->contents as $index => $content)
                                <li>
                                    <a href="{{ route('contents.show', $content->id) }}" class="block p-4 hover:bg-gray-700/50 transition duration-150 group border-l-2 border-transparent hover:border-green-500">
                                        <div class="flex items-start gap-4">
                                            <span class="flex-shrink-0 w-8 h-8 rounded bg-gray-900 border border-gray-700 text-gray-400 flex items-center justify-center text-xs font-bold font-mono group-hover:text-green-500 group-hover:border-green-500/50 transition-colors">
                                                {{ sprintf('%02d', $index + 1) }}
                                            </span>
                                            <div>
                                                <h4 class="text-sm font-bold text-gray-200 group-hover:text-white mb-1 transition-colors line-clamp-2">
                                                    {{ $content->title }}
                                                </h4>
                                                <div class="flex items-center gap-2">
                                                    <span class="text-[10px] uppercase tracking-wider text-gray-500 border border-gray-700 px-1.5 py-0.5 rounded group-hover:border-gray-600">
                                                        Text
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                            @else
                            <div class="p-8 text-center">
                                <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-gray-700 mb-3 text-gray-500">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </div>
                                <p class="text-gray-400 text-sm italic">
                                    Belum ada materi yang diunggah.
                                </p>
                            </div>
                            @endif
                        </div>
                    </div>

                    {{-- Card Tambahan (Optional, buat visual balance) --}}
                    <div class="mt-6 p-5 rounded-xl border border-dashed border-gray-700 bg-gray-900/50 text-center">
                        <p class="text-xs text-gray-500 mb-2">Upgrade skill codingmu hari ini.</p>
                        <span class="text-green-500 font-bold text-sm tracking-wide">eCourse Platform v1.0</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>