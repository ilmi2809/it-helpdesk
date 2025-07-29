@extends('layouts.app')

@section('content')
<div class="p-6 space-y-6">
    <h1 class="text-2xl font-bold">My Tickets</h1>
    <p class="text-gray-600">Tickets assigned to you</p>

    <input type="text" placeholder="Search by Ticket ID, keyword..." class="mt-4 w-full border rounded p-2" />

    <div class="flex space-x-4 mt-4">
        <button class="px-4 py-2 bg-gray-100 rounded">All</button>
        <button class="px-4 py-2 bg-gray-100 rounded">New</button>
        <button class="px-4 py-2 bg-gray-100 rounded">On-Going</button>
        <button class="px-4 py-2 bg-gray-100 rounded">Resolved</button>
        <button class="px-4 py-2 bg-gray-100 rounded">Today</button>
    </div>

    <div class="space-y-4">
        @foreach($tickets as $ticket)
        <div class="flex justify-between items-center p-4 bg-white rounded shadow">
            <div>
                <h2 class="font-bold">{{ $ticket->title }}</h2>
                <p class="text-sm text-gray-500">{{ $ticket->description }}</p>
            </div>
            <div>
                <a href="{{ route('technician.tickets.show', $ticket->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded">View Ticket</a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
