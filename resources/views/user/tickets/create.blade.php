@extends('layouts.app')

@section('title', 'Create Ticket')

@section('content')
<div class="container mx-auto px-4 py-6 max-w-4xl">
    {{-- Notifikasi flash message --}}
    @if(session('success'))
        <div class="mb-4 bg-green-100 text-green-700 px-4 py-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    <h1 class="text-2xl font-semibold mb-6">New Ticket</h1>

    <form action="{{ route('user.tickets.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        {{-- Subject --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
            <input type="text" name="title" class="w-full border px-3 py-2 rounded" required placeholder="Ticket subject">
        </div>

        {{-- Category --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Request Type</label>
            <select name="category_id" class="w-full border px-3 py-2 rounded" required>
                <option value="">Choose Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Priority --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Priority</label>
            <select name="priority" class="w-full border px-3 py-2 rounded" required>
                <option value="">Select Priority</option>
                <option value="low">Low</option>
                <option value="medium">Medium</option>
                <option value="high">High</option>
            </select>
        </div>

        {{-- Description --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Ticket Body</label>
            <textarea name="description" rows="5" class="w-full border px-3 py-2 rounded" required placeholder="Describe your issue..."></textarea>
        </div>

        {{-- Location --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Location</label>
            <input type="text" name="location" class="w-full border px-3 py-2 rounded" placeholder="e.g., Jakarta - Tower A - Floor 5">
        </div>

        {{-- Attachment --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Attachments (Optional)</label>
            <input type="file" name="attachment[]" multiple class="w-full border px-3 py-2 rounded bg-white">
            <p class="text-xs text-gray-400 mt-1">Supported formats: jpg, png, pdf. Max size: 10MB</p>
        </div>

        {{-- Submit --}}
        <div class="text-right">
            <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded hover:bg-red-700">
                Send Ticket
            </button>
        </div>
    </form>
</div>
@endsection
