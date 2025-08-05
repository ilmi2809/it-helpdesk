@extends('layouts.app')

@section('content')
<div class="p-4">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Manage User</h1>
    <div class="flex flex-col lg:flex-row gap-6">
        <div class="w-full lg:w-3/4 bg-white p-6 rounded-xl shadow-md">

            {{-- Flash Messages --}}
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-md">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-md">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Technician & IT Support Table --}}
            <div class="mb-10">
                <h2 class="text-lg font-semibold text-blue-700 mb-3">Technician & IT Support</h2>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-center border border-gray-200">
                        <thead class="bg-gray-100 text-gray-700">
                            <tr>
                                <th class="px-4 py-2 border">#</th>
                                <th class="px-4 py-2 border">Name</th>
                                <th class="px-4 py-2 border">Email</th>
                                <th class="px-4 py-2 border">Role</th>
                                <th class="px-4 py-2 border">Category</th>
                                <th class="px-4 py-2 border">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($technicians as $index => $user)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-4 py-2">{{ $index + 1 }}</td>
                                    <td class="px-4 py-2">{{ $user->name }}</td>
                                    <td class="px-4 py-2">{{ $user->email }}</td>
                                    <td class="px-4 py-2 capitalize">{{ $user->role }}</td>
                                    <td class="px-4 py-2">
                                        @if($user->handledCategories->isNotEmpty())
                                            @foreach ($user->handledCategories as $category)
                                                <span>{{ $category->name }}</span>@if (!$loop->last), @endif
                                            @endforeach
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="px-4 py-2">
                                        <a href="{{ route('admin.users.edit', $user) }}"
                                           class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded-md transition">Edit</a>
                                        <button onclick="confirmDelete({{ $user->id }})"
                                            class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-md ml-1 transition">Delete</button>
                                        <form id="delete-form-{{ $user->id }}" method="POST" action="{{ route('admin.users.destroy', $user) }}" class="hidden">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-4 text-gray-500">No technician/IT support users found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Other Users Table --}}
            <div>
                <h2 class="text-lg font-semibold text-gray-700 mb-3">User Lainnya</h2>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-center border border-gray-200">
                        <thead class="bg-gray-100 text-gray-700">
                            <tr>
                                <th class="px-4 py-2 border">#</th>
                                <th class="px-4 py-2 border">Name</th>
                                <th class="px-4 py-2 border">Email</th>
                                <th class="px-4 py-2 border">Role</th>
                                <th class="px-4 py-2 border">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($otherUsers as $index => $user)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-4 py-2">{{ $index + 1 }}</td>
                                    <td class="px-4 py-2">{{ $user->name }}</td>
                                    <td class="px-4 py-2">{{ $user->email }}</td>
                                    <td class="px-4 py-2 capitalize">{{ $user->role }}</td>
                                    <td class="px-4 py-2">
                                        <a href="{{ route('admin.users.edit', $user) }}"
                                           class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded-md transition">Edit</a>
                                        <button onclick="confirmDelete({{ $user->id }})"
                                            class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-md ml-1 transition">Delete</button>
                                        <form id="delete-form-{{ $user->id }}" method="POST" action="{{ route('admin.users.destroy', $user) }}" class="hidden">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-4 text-gray-500">No users found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        {{-- Create Form --}}
        @include('admin.users.create')
    </div>
</div>

<script>
    function confirmDelete(id) {
        if (confirm("Are you sure you want to delete this user?")) {
            document.getElementById('delete-form-' + id).submit();
        }
    }
</script>
@endsection
