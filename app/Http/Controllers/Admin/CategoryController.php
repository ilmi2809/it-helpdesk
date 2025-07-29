<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Tampilkan semua kategori.
     */
    public function index()
    {
        $categories = Category::latest()->get();
        return view('admin.category.category', compact('categories'));
    }

    /**
     * Tampilkan form edit kategori.
     */
    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Simpan kategori baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
        ]);

        Category::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.category.index')
            ->with('success', 'Category created successfully.');
    }

    /**
     * Update data kategori.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
        ]);

        $category->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.category.index')
            ->with('success', 'Category updated successfully.');
    }

    /**
     * Hapus kategori.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.category.index')
            ->with('success', 'Category deleted successfully.');
    }
}
