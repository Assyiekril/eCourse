<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $course->title }}
            </h2>
            <a href="{{ route('courses.show', $course->id) }}" class="text-sm text-indigo-600 hover:text-indigo-800">
                &larr; Kembali ke Silabus
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">

                <div class="lg:col-span-1">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg sticky top-6">
                        <div class="p-4 border-b">
                            <h3 class="font-bold text-gray-700">Daftar Materi</h3>
                        </div>
                        <ul class="divide-y divide-gray-100 text-sm">
                            @foreach($course->contents as $item)
                            <li>
                                <a href="{{ route('contents.show', $item->id) }}"
                                    class="block p-3 hover:bg-indigo-50 {{ $item->id === $content->id ? 'bg-indigo-50 text-indigo-700 font-bold border-l-4 border-indigo-500' : 'text-gray-600' }}">
                                    {{ $item->title }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="lg:col-span-3">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                        <div class="p-8">
                            <span class="text-xs font-bold bg-indigo-100 text-indigo-700 px-2 py-1 rounded mb-4 inline-block">
                                Materi Pembelajaran
                            </span>
                            <div class="flex justify-between items-start mb-6">
                                <h1 class="text-3xl font-bold text-gray-900">{{ $content->title }}</h1>

                                @auth
                                @if(Auth::user()->role === 'admin' || (Auth::user()->role === 'teacher' && Auth::id() === $course->teacher_id))
                                <a href="{{ route('contents.edit', $content->id) }}" class="bg-yellow-500 text-white text-sm px-4 py-2 rounded shadow hover:bg-yellow-600 font-bold">
                                    ✎ Edit Materi
                                </a>
                                @endif
                                @endauth
                            </div>

                            <div class="prose max-w-none text-gray-700 leading-relaxed whitespace-pre-line">
                                {{ $content->body }}
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-between items-center">
                        @if($prevContent)
                        <a href="{{ route('contents.show', $prevContent->id) }}" class="bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded shadow-sm hover:bg-gray-50">
                            &larr; Sebelumnya
                        </a>
                        @else
                        <div></div> @endif

                        @auth
                        @if(Auth::user()->role === 'student')
                        <form action="{{ route('lessons.toggle', $content->id) }}" method="POST">
                            @csrf

                            @if($isCompleted)
                            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded shadow hover:bg-green-700 font-bold flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Selesai
                            </button>
                            @else
                            <button type="submit" class="bg-white border border-gray-300 text-gray-700 px-6 py-2 rounded shadow hover:bg-gray-100 font-bold">
                                Tandai Selesai
                            </button>
                            @endif
                        </form>
                        @endif
                        @endauth

                        @if($nextContent)
                        <a href="{{ route('contents.show', $nextContent->id) }}" class="bg-indigo-600 text-white px-4 py-2 rounded shadow hover:bg-indigo-700">
                            Lanjutkan &rarr;
                        </a>
                        @else
                        <span class="text-gray-400 text-sm">Akhir Materi</span>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>