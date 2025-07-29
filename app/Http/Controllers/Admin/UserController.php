<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Menampilkan daftar seluruh user (non teknisi).
     */
    public function index()
    {
        $users = User::where('role', '!=', 'it_support')->get();
        return view('admin.users.users', compact('users'));
    }

    /**
     * Menampilkan form tambah user.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Simpan user baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role'     => 'required|in:user,admin,helpdesk_agent',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'role'     => $request->role,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    /**
     * Form edit user.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Simpan perubahan user.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role'  => 'required|in:user,admin,helpdesk_agent',
        ]);

        $user->update($request->only('name', 'email', 'role'));

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Hapus user.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}
