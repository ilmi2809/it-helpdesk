@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
<h1 class="text-2xl font-semibold">Technicians</h1>
    <div class="flex justify-between items-center mb-6">
        <div></div>
        <a href="{{ route('admin.technicians.create') }}" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Add Technician</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50 text-gray-700 text-sm font-semibold">
                <tr>
                    <th class="px-6 py-3 text-left">Name</th>
                    <th class="px-6 py-3 text-left">Email</th>
                    <th class="px-6 py-3 text-left">Categories</th>
                    <th class="px-6 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 text-sm">
                @foreach ($technicians as $tech)
                    <tr>
                        <td class="px-6 py-4">{{ $tech->name }}</td>
                        <td class="px-6 py-4">{{ $tech->email }}</td>
                        <td class="px-6 py-4">
                            {{ $tech->categories->pluck('name')->join(', ') }}
                        </td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('admin.technicians.edit', $tech) }}" class="text-blue-600 hover:underline">Edit</a>
                            <form action="{{ route('admin.technicians.destroy', $tech) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure?')" class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                @if ($technicians->isEmpty())
                    <tr><td colspan="4" class="px-6 py-4 text-center text-gray-500">No technicians found.</td></tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
