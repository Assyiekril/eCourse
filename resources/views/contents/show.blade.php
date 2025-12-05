<x-app-layout>
    <div class="min-h-screen bg-gray-900 flex flex-col md:flex-row relative">
        
        <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20 pointer-events-none fixed"></div>
        <div class="absolute inset-0 pointer-events-none fixed" style="background-image: radial-gradient(#374151 1px, transparent 1px); background-size: 32px 32px; opacity: 0.1;"></div>

        <aside class="w-full md:w-80 bg-gray-900 border-r border-gray-800 flex-shrink-0 flex flex-col relative z-20 md:h-screen sticky top-0">
            {{-- Header Sidebar --}}
            <div class="p-5 border-b border-gray-800 bg-gray-900">
                <a href="{{ route('courses.show', $course->id) }}" class="flex items-center gap-2 text-gray-400 hover:text-white transition mb-4 text-xs font-mono uppercase tracking-widest">
                    &larr; Kembali ke Silabus
                </a>
                <h2 class="text-white font-bold leading-tight">
                    {{ $course->title }}
                </h2>
            </div>

            <div class="overflow-y-auto flex-1 p-2 space-y-1 custom-scrollbar">
                @foreach($course->contents as $idx => $item)
                    @php
                        $isActive = $item->id === $content->id;
                        // Pastikan logika isCompleted di sidebar juga sinkron (opsional, tergantung data controller)
                        // $itemIsCompleted = ... 
                    @endphp
                    
                    <a href="{{ route('contents.show', $item->id) }}" class="block">
                        <div class="flex items-center gap-3 p-3 rounded-lg transition-all duration-200 
                            {{ $isActive 
                                ? 'bg-gray-800 border border-green-500/50 shadow-lg shadow-green-900/10' 
                                : 'hover:bg-gray-800 border border-transparent' 
                            }}">
                            
                            <div class="flex-shrink-0 w-6 h-6 rounded flex items-center justify-center text-xs font-bold
                                {{ $isActive ? 'bg-green-500 text-black' : 'bg-gray-800 text-gray-500 border border-gray-700' }}">
                                {{ $idx + 1 }}
                            </div>

                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium truncate {{ $isActive ? 'text-green-400' : 'text-gray-400 hover:text-gray-200' }}">
                                    {{ $item->title }}
                                </p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </aside>

        <main class="flex-1 relative z-10 overflow-y-auto h-screen custom-scrollbar bg-gray-900 md:bg-gray-800/30">
            <div class="max-w-4xl mx-auto px-6 py-10">
                
                <div class="flex items-center gap-2 text-xs font-mono text-gray-500 mb-4">
                    <span class="bg-gray-800 px-2 py-1 rounded border border-gray-700">{{ $course->category->name }}</span>
                    <span>/</span>
                    <span>Materi Pembelajaran</span>
                </div>

                <h1 class="text-3xl md:text-4xl font-extrabold text-white tracking-tight leading-tight mb-8">
                    {{ $content->title }}
                </h1>

                <div class="bg-gray-800 border border-gray-700 rounded-xl p-8 shadow-2xl relative overflow-hidden mb-8">
                    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-green-500 to-emerald-600"></div>
                    
                    <div class="prose prose-invert prose-lg max-w-none text-gray-300 leading-relaxed whitespace-pre-line">
                        {{ $content->description ?? $content->body }}

                        @if(isset($content->video_url))
                            <div class="mt-8 aspect-w-16 aspect-h-9 bg-black rounded-lg overflow-hidden border border-gray-700">
                                <iframe src="{{ $content->video_url }}" class="w-full h-full" frameborder="0" allowfullscreen></iframe>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row items-center justify-between gap-6 border-t border-gray-800 pt-8 pb-20">
                    
                    @php
                        $currentIndex = $course->contents->search(function($i) use($content){ return $i->id === $content->id; });
                        $prevContent = $course->contents[$currentIndex - 1] ?? null;
                        $nextContent = $course->contents[$currentIndex + 1] ?? null;
                    @endphp

                    @if($prevContent)
                        <a href="{{ route('contents.show', $prevContent->id) }}" class="text-gray-500 hover:text-white transition text-sm font-bold flex items-center gap-2">
                            &larr; {{ Str::limit($prevContent->title, 20) }}
                        </a>
                    @else
                        <div></div>
                    @endif

                    @auth
                        @if(Auth::user()->role === 'student')
                            <form action="{{ route('lessons.toggle', $content->id) }}" method="POST">
                                @csrf
                                
                                @if(isset($isCompleted) && $isCompleted)
                                    {{-- STATE: SUDAH SELESAI (HIJAU) --}}
                                    <button type="submit" class="bg-green-600 text-white border border-green-500 px-8 py-3 rounded-lg font-bold shadow-[0_0_20px_rgba(34,197,94,0.3)] hover:bg-green-500 transition-all duration-200 transform active:scale-95 flex items-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                        Selesai
                                    </button>
                                @else
                                    {{-- STATE: BELUM SELESAI (PUTIH) --}}
                                    <button type="submit" class="bg-white text-gray-900 border border-gray-200 px-8 py-3 rounded-lg font-bold shadow-md hover:bg-gray-100 hover:shadow-lg transition-all duration-200 transform active:scale-95">
                                        Tandai Selesai
                                    </button>
                                @endif
                            </form>
                        @endif
                    @endauth

                    @if($nextContent)
                        <a href="{{ route('contents.show', $nextContent->id) }}" class="text-gray-500 hover:text-white transition text-sm font-bold flex items-center gap-2">
                            {{ Str::limit($nextContent->title, 20) }} &rarr;
                        </a>
                    @else
                        <a href="{{ route('courses.show', $course->id) }}" class="text-green-500 hover:text-green-400 font-bold text-sm">
                            Selesai & Kembali &rarr;
                        </a>
                    @endif

                </div>

            </div>
        </main>
    </div>
</x-app-layout>