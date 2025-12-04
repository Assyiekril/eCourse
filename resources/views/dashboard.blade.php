<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    Selamat datang, <strong>{{ Auth::user()->username }}</strong>!
                    Anda login sebagai <span class="badge bg-indigo-100 text-indigo-800 px-2 py-1 rounded text-xs uppercase">{{ Auth::user()->role }}</span>.
                </div>
            </div>

            @if(Auth::user()->role === 'teacher')
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold text-gray-800">Kursus Saya</h3>
                        <a href="{{ route('courses.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded text-sm hover:bg-indigo-700">
                            + Buat Kursus Baru
                        </a>
                    </div>

                    @if(isset($myCourses) && $myCourses->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-200">
                            <thead>
                                <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                                    <th class="py-3 px-6 text-left">Judul Kursus</th>
                                    <th class="py-3 px-6 text-left">Kategori</th>
                                    <th class="py-3 px-6 text-center">Status</th>
                                    <th class="py-3 px-6 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm font-light">
                                @foreach($myCourses as $course)
                                <tr class="border-b border-gray-200 hover:bg-gray-50">
                                    <td class="py-3 px-6 text-left whitespace-nowrap font-medium">
                                        {{ $course->title }}
                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        {{ $course->category->name }}
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <span class="{{ $course->is_active ? 'bg-green-200 text-green-700' : 'bg-red-200 text-red-700' }} py-1 px-3 rounded-full text-xs">
                                            {{ $course->is_active ? 'Aktif' : 'Non-Aktif' }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex item-center justify-center space-x-2">
                                            <a href="{{ route('courses.edit', $course->id) }}" class="text-indigo-500 hover:text-indigo-700 font-bold">
                                                Edit
                                            </a>

                                            <span class="text-gray-300">|</span>

                                            <form action="{{ route('courses.destroy', $course->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kursus ini? Semua materi di dalamnya juga akan terhapus!');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-700 font-bold">
                                                    Hapus
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
                    <p class="text-gray-500 text-center py-4">Anda belum memiliki kursus.</p>
                    @endif
                </div>
            </div>
            @endif

            @if(Auth::user()->role === 'admin')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Manajemen Kategori</h3>
                        <p class="text-gray-600 mb-4">Tambah, edit, atau hapus kategori kursus.</p>
                        <a href="{{ route('categories.index') }}" class="inline-block bg-indigo-600 text-white font-bold py-2 px-4 rounded hover:bg-indigo-700">
                            Kelola Kategori &rarr;
                        </a>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Manajemen User</h3>
                        <p class="text-gray-600 mb-4">Kelola akun Teacher dan Student.</p>
                        <a href="{{ route('users.index') }}" class="inline-block bg-indigo-600 text-white font-bold py-2 px-4 rounded hover:bg-indigo-700">
                            Kelola User &rarr;
                        </a>
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>
</x-app-layout>