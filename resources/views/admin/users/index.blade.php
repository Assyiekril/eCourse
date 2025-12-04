<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Manajemen User</h2>
            <a href="{{ route('users.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded text-sm hover:bg-indigo-700 font-bold">+ Tambah User</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if(session('success'))
                        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
                    @endif
                    @if(session('error'))
                        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">{{ session('error') }}</div>
                    @endif

                    <table class="min-w-full border-collapse block md:table">
                        <thead class="block md:table-header-group">
                            <tr class="bg-gray-100 text-gray-600 font-bold block md:table-row">
                                <th class="p-3 text-left block md:table-cell">Username</th>
                                <th class="p-3 text-left block md:table-cell">Email</th>
                                <th class="p-3 text-left block md:table-cell">Role</th>
                                <th class="p-3 text-center block md:table-cell">Status</th>
                                <th class="p-3 text-center block md:table-cell">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="block md:table-row-group">
                            @foreach($users as $user)
                            <tr class="border-b hover:bg-gray-50 block md:table-row">
                                <td class="p-3 block md:table-cell">{{ $user->username }}</td>
                                <td class="p-3 block md:table-cell text-sm text-gray-500">{{ $user->email }}</td>
                                <td class="p-3 block md:table-cell">
                                    <span class="px-2 py-1 rounded text-xs font-bold uppercase
                                        {{ $user->role === 'admin' ? 'bg-red-100 text-red-800' : 
                                          ($user->role === 'teacher' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800') }}">
                                        {{ $user->role }}
                                    </span>
                                </td>
                                <td class="p-3 block md:table-cell text-center">
                                    <span class="px-2 py-1 rounded text-xs font-bold {{ $user->is_active ? 'bg-green-200 text-green-800' : 'bg-gray-200 text-gray-600' }}">
                                        {{ $user->is_active ? 'Aktif' : 'Non-Aktif' }}
                                    </span>
                                </td>
                                <td class="p-3 block md:table-cell text-center">
                                    <div class="flex justify-center space-x-2">
                                        <a href="{{ route('users.edit', $user->id) }}" class="text-indigo-600 hover:text-indigo-900 font-bold text-sm">Edit</a>
                                        @if($user->id !== Auth::id())
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Hapus user ini?');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 font-bold text-sm">Hapus</button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>