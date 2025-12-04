<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    
    public function index()
    {
        if (Auth::user()->role !== 'admin') { abort(403); }
        $users = User::orderByRaw("FIELD(role, 'admin', 'teacher', 'student')")
                     ->orderBy('created_at', 'asc')
                     ->paginate(10);
        
        return view('admin.users.index', compact('users'));
    }

    
    public function create()
    {
        if (Auth::user()->role !== 'admin') { abort(403); }
        return view('admin.users.create');
    }

    
    public function store(Request $request)
    {
        if (Auth::user()->role !== 'admin') { abort(403); }

        $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,teacher,student',
        ]);

        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'is_active' => true,
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan!');
    }

    
    public function edit(User $user)
    {
        if (Auth::user()->role !== 'admin') { abort(403); }
        return view('admin.users.edit', compact('user'));
    }

    
    public function update(Request $request, User $user)
    {
        if (Auth::user()->role !== 'admin') { abort(403); }

        $request->validate([
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'role' => 'required|in:admin,teacher,student',
            'is_active' => 'required|boolean',
            'password' => 'nullable|string|min:8',
        ]);

        
        $data = [
            'username' => $request->username,
            'email' => $request->email,
            'role' => $request->role,
            'is_active' => $request->is_active,
        ];

        
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'Data user diperbarui!');
    }

    
    public function destroy(User $user)
    {
        if (Auth::user()->role !== 'admin') { abort(403); }
        
        if ($user->id === Auth::id()) {
            return back()->with('error', 'Anda tidak bisa menghapus akun sendiri!');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }
}