<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Manajemen Kategori (Admin)
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <div class="md:col-span-1">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg sticky top-6">
                    <div class="p-6">
                        <h3 class="text-lg font-bold mb-4">Tambah Kategori</h3>
                        <form action="{{ route('categories.store') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Nama Kategori</label>
                                <input type="text" name="name" class="shadow border rounded w-full py-2 px-3" required placeholder="Contoh: Mobile Apps">
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Deskripsi</label>
                                <textarea name="description" rows="3" class="shadow border rounded w-full py-2 px-3" placeholder="Deskripsi singkat..."></textarea>
                            </div>
                            <button type="submit" class="bg-indigo-600 text-white font-bold py-2 px-4 rounded w-full hover:bg-indigo-700">
                                + Simpan
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="md:col-span-2">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-bold mb-4">Daftar Kategori Tersedia</h3>
                        
                        @if(session('success'))
                            <div class="bg-green-100 text-green-700 p-3 rounded mb-4 text-sm">
                                {{ session('success') }}
                            </div>
                        @endif

                        <table class="min-w-full border-collapse block md:table">
                            <thead class="block md:table-header-group">
                                <tr class="border border-grey-500 md:border-none block md:table-row absolute -top-full md:top-auto -left-full md:left-auto  md:relative ">
                                    <th class="bg-gray-100 p-2 text-gray-600 font-bold md:border md:border-grey-500 text-left block md:table-cell">Nama</th>
                                    <th class="bg-gray-100 p-2 text-gray-600 font-bold md:border md:border-grey-500 text-left block md:table-cell">Deskripsi</th>
                                    <th class="bg-gray-100 p-2 text-gray-600 font-bold md:border md:border-grey-500 text-center block md:table-cell">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="block md:table-row-group">
                                @foreach($categories as $category)
                                <tr class="bg-white border border-grey-500 md:border-none block md:table-row">
                                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                                        <form action="{{ route('categories.update', $category->id) }}" method="POST" id="form-edit-{{ $category->id }}">
                                            @csrf @method('PUT')
                                            <input type="text" name="name" value="{{ $category->name }}" class="w-full text-sm border-gray-300 rounded shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        </form>
                                    </td>
                                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                                        <textarea form="form-edit-{{ $category->id }}" name="description" rows="1" class="w-full text-sm border-gray-300 rounded shadow-sm">{{ $category->description }}</textarea>
                                    </td>
                                    <td class="p-2 md:border md:border-grey-500 text-center block md:table-cell">
                                        <div class="flex justify-center gap-2">
                                            <button type="submit" form="form-edit-{{ $category->id }}" class="bg-blue-500 text-white text-xs px-3 py-1 rounded hover:bg-blue-600">
                                                Update
                                            </button>
                                            
                                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="bg-red-500 text-white text-xs px-3 py-1 rounded hover:bg-red-600">
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
                </div>
            </div>

        </div>
    </div>
</x-app-layout>