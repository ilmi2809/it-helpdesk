@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Edit Category</h1>

    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" class="bg-white p-6 rounded shadow space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-semibold">Category Name</label>
            <input type="text" name="name" value="{{ old('name', $category->name) }}" class="w-full border px-4 py-2 rounded" required>
        </div>

        <div>
            <label class="block font-semibold">Description</label>
            <textarea name="description" rows="3" class="w-full border px-4 py-2 rounded" required>{{ old('description', $category->description) }}</textarea>
        </div>

        <div class="text-right">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">
                Update
            </button>
        </div>
    </form>
</div>
@endsection
