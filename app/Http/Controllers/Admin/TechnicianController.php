<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TechnicianController extends Controller
{
    public function index()
    {
        $technicians = User::with('categories')
            ->where('role', 'it_support')
            ->get();

        return view('admin.technicians.index', compact('technicians'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.technicians.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|string',
            'email'      => 'required|email|unique:users',
            'password'   => 'required|string|min:6',
            'categories' => 'array',
            'categories.*' => 'exists:categories,id'
        ]);

        $technician = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'it_support',
        ]);

        $technician->categories()->sync($request->categories);

        return redirect()->route('admin.technicians.index')->with('success', 'Technician created successfully.');
    }

    public function edit(User $technician)
    {
        abort_unless($technician->role === 'it_support', 403);

        $categories = Category::all();
        $selected = $technician->categories->pluck('id')->toArray();

        return view('admin.technicians.edit', compact('technician', 'categories', 'selected'));
    }

    public function update(Request $request, User $technician)
    {
        abort_unless($technician->role === 'it_support', 403);

        $request->validate([
            'name'       => 'required|string',
            'email'      => 'required|email|unique:users,email,' . $technician->id,
            'categories' => 'array',
            'categories.*' => 'exists:categories,id'
        ]);

        $technician->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        $technician->categories()->sync($request->categories);

        return redirect()->route('admin.technicians.index')->with('success', 'Technician updated successfully.');
    }

    public function destroy(User $technician)
    {
        abort_unless($technician->role === 'it_support', 403);

        $technician->categories()->detach();
        $technician->delete();

        return redirect()->route('admin.technicians.index')->with('success', 'Technician deleted.');
    }
}
