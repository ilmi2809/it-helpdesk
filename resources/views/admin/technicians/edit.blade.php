@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6 max-w-lg">
    <h2 class="text-xl font-semibold mb-4">Edit Technician</h2>

    <form action="{{ route('admin.technicians.update', $technician) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-4">
            <label class="block font-medium mb-1">Name</label>
            <input type="text" name="name" value="{{ $technician->name }}" class="w-full border px-4 py-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1">Email</label>
            <input type="email" name="email" value="{{ $technician->email }}" class="w-full border px-4 py-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1">Categories</label>
            <select name="categories[]" multiple class="w-full border px-4 py-2 rounded">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(in_array($category->id, $selected))>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <button class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Update</button>
    </form>
</div>
@endsection
