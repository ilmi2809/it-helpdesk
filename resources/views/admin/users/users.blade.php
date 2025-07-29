@extends('layouts.app')

@section('content')
<div class="p-1">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Manage User</h1>
    <div class="flex flex-col lg:flex-row gap-6">
        <div class="w-full lg:w-3/4 bg-white p-6 rounded shadow">
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                    {{ session('error') }}
                </div>
            @endif
            <table class="w-full border text-sm text-center">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border">User ID</th>
                        <th class="px-4 py-2 border">Name</th>
                        <th class="px-4 py-2 border">Email</th>
                        <th class="px-4 py-2 border">Role</th>
                        <th class="px-4 py-2 border">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $index => $user)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $index + 1 }}</td>
                        <td class="px-4 py-2">{{ $user->name }}</td>
                        <td class="px-4 py-2">{{ $user->email }}</td>
                        <td class="px-4 py-2 capitalize">{{ $user->role }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('admin.users.edit', $user) }}"
                               class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded">
                                Edit
                            </a>

                            <button onclick="confirmDelete({{ $user->id }})"
                                class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded ml-1">
                                Delete
                            </button>

                            <form id="delete-form-{{ $user->id }}" method="POST" action="{{ route('admin.users.destroy', $user) }}" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-gray-500">No users found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

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

