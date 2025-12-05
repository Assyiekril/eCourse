<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'eCourse') }}</title>
    
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-100 antialiased bg-gray-900 min-h-screen flex flex-col justify-center items-center relative overflow-hidden">
    
    {{-- Background Textures (Agar konsisten dengan Welcome Page) --}}
    <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20 pointer-events-none"></div>
    <div class="absolute inset-0 pointer-events-none" style="background-image: radial-gradient(#374151 1px, transparent 1px); background-size: 32px 32px; opacity: 0.1;"></div>

    <div class="w-full sm:max-w-md px-6 relative z-10">
        {{-- Logo Section --}}
        <div class="flex justify-center mb-8">
            <a href="/" class="flex items-center gap-3 group transition-transform hover:scale-105 duration-300">
                <div class="bg-gray-800 p-2.5 rounded-lg border border-gray-700 group-hover:border-green-500 transition-colors shadow-lg">
                    <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                </div>
                <span class="text-3xl font-extrabold text-white tracking-tight">eCourse<span class="text-green-500">.</span></span>
            </a>
        </div>

        {{-- Card Container --}}
        <div class="w-full sm:max-w-md bg-gray-800 border border-gray-700 shadow-2xl rounded-xl overflow-hidden relative backdrop-blur-sm">
            {{-- Accent Top Border --}}
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-green-500 to-emerald-600"></div>
            
            <div class="px-8 py-8">
                {{ $slot }}
            </div>
        </div>
    </div>
</body>
</html>