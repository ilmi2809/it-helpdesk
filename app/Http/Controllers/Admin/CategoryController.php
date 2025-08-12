<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Tampilkan semua kategori.
     */
    public function index()
    {
        $parents = \App\Models\Category::with(['children' => function($q){
            $q->orderBy('order')->orderBy('name');
        }])
        ->whereNull('parent_id')           // hanya parent
        ->orderBy('order')->orderBy('name')
        ->paginate(20);

        return view('admin.category.category', compact('parents'));
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
            'name' => [
              'required','string','max:255',
              Rule::unique('categories')->where(fn($q) => $q->where('parent_id', $request->parent_id)),
            ],
            'parent_id' => ['nullable','exists:categories,id'],
            'description' => ['nullable','string'],
        ]);

        Category::create([
            'name'        => strtoupper($request->name),
            'description' => $request->description,
            'parent_id'   => $request->parent_id,   // <-- ini akan bekerja setelah fillable dibetulkan
            'slug'        => $candidate ?? null,
            'order'       => $request->order ?? 0,
        ]);

        return redirect()->route('admin.categories.index')
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

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category updated successfully.');
    }

    /**
     * Hapus kategori.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category deleted successfully.');
    }

    public function tree()
    {
        $parents = Category::with(['children' => function($q){
            $q->orderBy('order')->orderBy('name');
        }])->whereNull('parent_id')
          ->orderBy('order')->orderBy('name')
          ->get();

        $toNode = function ($cat) use (&$toNode) {
            return [
                'id'   => (string)$cat->id,
                'text' => $cat->name,
                'children' => $cat->relationLoaded('children')
                    ? $cat->children->map(fn($c) => $toNode($c))->values()->all()
                    : [],
            ];
        };

        $nodes = $parents->map(fn($p) => $toNode($p))->values();
        return response()->json($nodes);
    }
}
