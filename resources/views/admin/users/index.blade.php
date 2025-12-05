<x-app-layout>
    {{-- Background Textures --}}
    <div class="relative bg-gray-900 pb-12 min-h-screen">
        <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20 pointer-events-none"></div>
        <div class="absolute inset-0 pointer-events-none" style="background-image: radial-gradient(#374151 1px, transparent 1px); background-size: 32px 32px; opacity: 0.1;"></div>

        {{-- Custom Header --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10 pb-6 relative z-10">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-gray-800 border border-gray-700 rounded-lg">
                        <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-white tracking-tight">User Database</h2>
                        <p class="text-gray-400 text-sm font-mono">Access Control & Role Management</p>
                    </div>
                </div>
                
                <a href="{{ route('users.create') }}" class="group bg-green-600 text-white px-5 py-2.5 rounded-lg font-bold hover:bg-green-500 transition duration-300 shadow-lg shadow-green-900/50 flex items-center gap-2">
                    <svg class="w-5 h-5 group-hover:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Register New Node
                </a>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            {{-- Alerts --}}
            @if(session('success'))
                <div class="mb-6 bg-green-500/10 border border-green-500/50 text-green-400 p-4 rounded-lg flex items-center gap-3 backdrop-blur-sm">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="font-mono text-sm">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 bg-red-500/10 border border-red-500/50 text-red-400 p-4 rounded-lg flex items-center gap-3 backdrop-blur-sm">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="font-mono text-sm">{{ session('error') }}</span>
                </div>
            @endif

            {{-- Table Container --}}
            <div class="bg-gray-800 border border-gray-700 rounded-xl shadow-xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-900 border-b border-gray-700 text-gray-400 text-xs font-mono uppercase tracking-wider">
                                <th class="p-5">Identity (User)</th>
                                <th class="p-5">Contact (Email)</th>
                                <th class="p-5 text-center">Privilege (Role)</th>
                                <th class="p-5 text-center">State (Status)</th>
                                <th class="p-5 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-700">
                            @foreach($users as $user)
                            <tr class="group hover:bg-gray-700/30 transition duration-150">
                                {{-- Identity --}}
                                <td class="p-5">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-lg bg-gray-700 flex items-center justify-center text-gray-300 font-bold border border-gray-600 group-hover:border-green-500 group-hover:text-green-500 transition-colors">
                                            {{ substr($user->username, 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="font-bold text-gray-200 group-hover:text-white">{{ $user->username }}</div>
                                            <div class="text-xs text-gray-500 font-mono">ID: #{{ $user->id }}</div>
                                        </div>
                                    </div>
                                </td>
                                
                                {{-- Email --}}
                                <td class="p-5 text-sm text-gray-400 font-mono">
                                    {{ $user->email }}
                                </td>
                                
                                {{-- Role Badge --}}
                                <td class="p-5 text-center">
                                    @php
                                        $roleStyles = match($user->role) {
                                            'admin' => 'bg-red-500/10 text-red-400 border-red-500/20',
                                            'teacher' => 'bg-yellow-500/10 text-yellow-400 border-yellow-500/20',
                                            default => 'bg-blue-500/10 text-blue-400 border-blue-500/20',
                                        };
                                    @endphp
                                    <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide border {{ $roleStyles }}">
                                        {{ $user->role }}
                                    </span>
                                </td>
                                
                                {{-- Status Badge --}}
                                <td class="p-5 text-center">
                                    @if($user->is_active)
                                        <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-green-500/10 border border-green-500/20 text-green-400 text-xs font-bold">
                                            <span class="relative flex h-2 w-2">
                                              <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                              <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                                            </span>
                                            Active
                                        </div>
                                    @else
                                        <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-gray-700 border border-gray-600 text-gray-400 text-xs font-bold">
                                            <span class="h-2 w-2 rounded-full bg-gray-500"></span>
                                            Inactive
                                        </div>
                                    @endif
                                </td>
                                
                                {{-- Actions --}}
                                <td class="p-5 text-center">
                                    <div class="flex justify-center items-center gap-2">
                                        <a href="{{ route('users.edit', $user->id) }}" class="p-2 rounded hover:bg-gray-700 text-gray-400 hover:text-indigo-400 transition" title="Edit Configuration">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </a>

                                        @if($user->id !== Auth::id())
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('WARNING: Terminating this user account is irreversible. Proceed?');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="p-2 rounded hover:bg-gray-700 text-gray-400 hover:text-red-500 transition" title="Terminate Account">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Pagination (Jika ada) --}}
                <div class="bg-gray-800 px-5 py-4 border-t border-gray-700">
                    {{ $users->links() }} 
                </div>
            </div>
        </div>
    </div>
</x-app-layout>