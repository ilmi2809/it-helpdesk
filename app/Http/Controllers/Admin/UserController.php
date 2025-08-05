<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $technicians = User::with('handledCategories')->where('role', 'it_support')->get();
        $otherUsers  = User::where('role', '!=', 'it_support')->get();
        $categories  = Category::all();

        return view('admin.users.users', compact('technicians', 'otherUsers', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.users.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|unique:users,email',
            'password'     => 'required|string|min:6',
            'role'         => 'required|in:user,admin,helpdesk_agent,technician,it_support',
            'categories'   => 'nullable|array',
            'categories.*' => 'exists:categories,id',
        ]);

        // Map 'technician' to 'it_support' before saving
        $role = $request->role === 'technician' ? 'it_support' : $request->role;

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'role'     => $role,
            'password' => Hash::make($request->password),
        ]);

        if ($role === 'it_support' && $request->has('categories')) {
            $user->handledCategories()->sync($request->categories);
        }

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        $categories = Category::all();
        $selectedCategories = $user->handledCategories->pluck('id')->toArray();

        return view('admin.users.edit', compact('user', 'categories', 'selectedCategories'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|unique:users,email,' . $user->id,
            'role'         => 'required|in:user,admin,helpdesk_agent,technician,it_support',
            'categories'   => 'nullable|array',
            'categories.*' => 'exists:categories,id',
        ]);

        // Map 'technician' to 'it_support' before updating
        $role = $request->role === 'technician' ? 'it_support' : $request->role;

        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
            'role'  => $role,
        ]);

        if ($role === 'it_support') {
            $user->handledCategories()->sync($request->categories ?? []);
        } else {
            $user->handledCategories()->detach();
        }

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->handledCategories()->detach();
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}
