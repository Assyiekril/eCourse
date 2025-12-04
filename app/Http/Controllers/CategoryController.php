<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        if (Auth::user()->role !== 'admin') { abort(403); }

        $categories = Category::latest()->get();
        return view('admin.categories.index', compact('categories'));
    }

    
    public function store(Request $request)
    {
        if (Auth::user()->role !== 'admin') { abort(403); }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Category::create($request->all());

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    
    public function update(Request $request, Category $category)
    {
        if (Auth::user()->role !== 'admin') { abort(403); }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category->update($request->all());

        return redirect()->route('categories.index')->with('success', 'Kategori diperbarui!');
    }

    
    public function destroy(Category $category)
    {
        if (Auth::user()->role !== 'admin') { abort(403); }

        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Kategori dihapus.');
    }
}