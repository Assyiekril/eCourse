<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit User: {{ $user->username }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                        @csrf @method('PUT')
                        
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Username</label>
                            <input type="text" name="username" value="{{ old('username', $user->username) }}" class="shadow border rounded w-full py-2 px-3" required>
                        </div>
                        
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="shadow border rounded w-full py-2 px-3" required>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Role</label>
                                <select name="role" class="shadow border rounded w-full py-2 px-3 bg-white">
                                    <option value="student" {{ $user->role == 'student' ? 'selected' : '' }}>Student</option>
                                    <option value="teacher" {{ $user->role == 'teacher' ? 'selected' : '' }}>Teacher</option>
                                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Status Akun</label>
                                <select name="is_active" class="shadow border rounded w-full py-2 px-3 bg-white">
                                    <option value="1" {{ $user->is_active ? 'selected' : '' }}>Aktif</option>
                                    <option value="0" {{ !$user->is_active ? 'selected' : '' }}>Non-Aktif (Banned)</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-6">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Password Baru (Opsional)</label>
                            <input type="password" name="password" class="shadow border rounded w-full py-2 px-3" placeholder="Isi hanya jika ingin mengubah password">
                        </div>

                        <div class="flex justify-end">
                            <a href="{{ route('users.index') }}" class="text-gray-500 mr-4 py-2">Batal</a>
                            <button type="submit" class="bg-indigo-600 text-white font-bold py-2 px-4 rounded hover:bg-indigo-700">Update User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>