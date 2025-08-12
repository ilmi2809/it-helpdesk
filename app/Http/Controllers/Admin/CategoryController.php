<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Tampilkan semua kategori (hanya parent + preload children).
     */
    public function index()
    {
        $parents = Category::with(['children' => fn($q) => $q->orderBy('order')->orderBy('name')])
            ->whereNull('parent_id')
            ->orderBy('order')->orderBy('name')
            ->paginate(20);

        return view('admin.category.category', compact('parents'));
    }

    /**
     * Form edit kategori.
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
            'name'        => [
                'required','string','max:255',
                Rule::unique('categories')->where(
                    fn($q) => $q->where('parent_id', $request->parent_id)
                ),
            ],
            'parent_id'   => ['nullable','exists:categories,id'],
            'description' => ['nullable','string','max:1000'],
            'order'       => ['nullable','integer','min:0'],
        ]);

        // generate slug unik
        $base = Str::slug($request->name) ?: 'category';
        $slug = $base;
        $i = 2;
        while (Category::where('slug', $slug)->exists()) {
            $slug = $base.'-'.$i++;
        }

        DB::transaction(function () use ($request, $slug) {
            Category::create([
                'name'        => strtoupper($request->name),
                'description' => $request->description,
                'parent_id'   => $request->parent_id,
                'slug'        => $slug,
                'order'       => $request->order ?? 0,
            ]);
        });

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category created successfully.');
    }

    /**
     * Update data kategori.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name'        => [
                'required','string','max:255',
                Rule::unique('categories')
                    ->where(fn($q) => $q->where('parent_id', $request->parent_id))
                    ->ignore($category->id),
            ],
            'description' => ['nullable','string','max:1000'],
            'parent_id'   => ['nullable','exists:categories,id','different:id'], // jangan jadi anak dari dirinya sendiri
            'order'       => ['nullable','integer','min:0'],
        ]);

        DB::transaction(function () use ($request, $category) {
            // jika nama berubah, boleh update slug (opsional); jika tak ingin, hapus blok ini
            if (!Str::of($category->name)->exactly(strtoupper($request->name))) {
                $base = Str::slug($request->name) ?: 'category';
                $slug = $base;
                $i = 2;
                while (Category::where('slug', $slug)->where('id','!=',$category->id)->exists()) {
                    $slug = $base.'-'.$i++;
                }
                $category->slug = $slug;
            }

            $category->name        = strtoupper($request->name);
            $category->description = $request->description;
            $category->parent_id   = $request->parent_id;
            $category->order       = $request->order ?? $category->order;
            $category->save();
        });

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category updated successfully.');
    }

    /**
     * Hapus kategori. Cegah jika masih punya child.
     */
    public function destroy(Category $category)
    {
        if ($category->children()->exists()) {
            return back()->with('error', 'Cannot delete: category still has sub‑categories.');
        }

        $category->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category deleted successfully.');
    }

    /**
     * JSON tree untuk picker di Create Ticket.
     * Tambahkan ?leaf=1 untuk hanya mengembalikan daun (anak tanpa child) saat dipilih.
     */
    public function tree(Request $request)
    {
        $leafOnly = (int) $request->query('leaf', 0) === 1;

        $parents = Category::with(['children' => fn($q) => $q->orderBy('order')->orderBy('name')])
            ->whereNull('parent_id')
            ->orderBy('order')->orderBy('name')
            ->get(['id','name']);

        $toNode = function ($cat) use (&$toNode, $leafOnly) {
            $children = $cat->relationLoaded('children')
                ? $cat->children->map(fn($c) => $toNode($c))->values()->all()
                : [];

            return [
                'id'       => (string) $cat->id,
                'text'     => $cat->name,
                'selectable' => !$children || !$leafOnly, // untuk frontend jika butuh
                'children' => $children,
            ];
        };

        return response()->json($parents->map(fn($p) => $toNode($p))->values());
    }


}
