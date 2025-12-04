<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Kursus</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('courses.update', $course->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Judul Kursus:</label>
                            <input type="text" name="title" value="{{ old('title', $course->title) }}" class="shadow border rounded w-full py-2 px-3" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Kategori:</label>
                            <select name="category_id" class="shadow border rounded w-full py-2 px-3">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $course->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Deskripsi:</label>
                            <textarea name="description" rows="4" class="shadow border rounded w-full py-2 px-3" required>{{ old('description', $course->description) }}</textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Mulai:</label>
                                <input type="date" name="start_date" value="{{ $course->start_date->format('Y-m-d') }}" class="shadow border rounded w-full py-2 px-3">
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Selesai:</label>
                                <input type="date" name="end_date" value="{{ $course->end_date->format('Y-m-d') }}" class="shadow border rounded w-full py-2 px-3">
                            </div>
                        </div>

                        <div class="mb-6">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Status Kursus:</label>
                            <select name="is_active" class="shadow border rounded w-full py-2 px-3 bg-gray-50">
                                <option value="1" {{ $course->is_active ? 'selected' : '' }}>Aktif (Tayang di Katalog)</option>
                                <option value="0" {{ !$course->is_active ? 'selected' : '' }}>Non-Aktif (Sembunyikan)</option>
                            </select>
                        </div>

                        <div class="flex justify-end">
                            <a href="{{ route('dashboard') }}" class="text-gray-500 mr-4 py-2">Batal</a>
                            <button type="submit" class="bg-indigo-600 text-white font-bold py-2 px-4 rounded hover:bg-indigo-700">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>