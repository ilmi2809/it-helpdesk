@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-4xl">
    <h1 class="text-xl font-bold mb-4">New Ticket</h1>
    <form action="{{ route('tickets.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow">
        @csrf

        <div class="mb-4">
            <label class="block font-semibold">Subject</label>
            <input type="text" name="title" class="w-full border rounded px-3 py-2" placeholder="Ticket Subject" required>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block font-semibold">Request Ticket Type</label>
                <select name="category_id" class="w-full border rounded px-3 py-2" required>
                    <option value="">Choose Type</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block font-semibold">Priority Status</label>
                <select name="priority" class="w-full border rounded px-3 py-2" required>
                    <option value="">Select Status</option>
                    <option value="High">High</option>
                    <option value="Medium">Medium</option>
                    <option value="Low">Low</option>
                </select>
            </div>
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Ticket Body</label>
            <textarea name="description" rows="4" class="w-full border rounded px-3 py-2" placeholder="Type ticket issue here.." required></textarea>
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Location</label>
            <input type="text" name="location" class="w-full border rounded px-3 py-2" placeholder="Locate Incident">
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Attachment</label>
            <input type="file" name="attachment" class="w-full border rounded px-3 py-2">
            <p class="text-sm text-gray-500 mt-1">Accepted: jpg, png, pdf (max 10MB)</p>
        </div>

        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded">Send Ticket</button>
    </form>
</div>
@endsection
