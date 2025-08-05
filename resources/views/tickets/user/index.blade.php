@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-xl font-bold">My Tickets</h1>
        <a href="{{ route('tickets.create') }}" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">New Ticket</a>
    </div>

    @forelse($tickets as $ticket)
        <div class="border rounded-lg p-4 mb-4 shadow-sm">
            <div class="flex justify-between">
                <div class="flex items-center space-x-2">
                    <div class="w-3 h-3 rounded-full"
                        style="background-color: {{
                            $ticket->priority === 'High' ? '#3C89F9' :
                            ($ticket->priority === 'Medium' ? '#FFBF00' : '#00B167')
                        }}"></div>
                    <span class="font-semibold">Ticket #{{ $ticket->ticket_number }}</span>
                    @if($ticket->priority === 'High')
                        <span class="text-xs bg-red-100 text-red-600 font-semibold px-2 py-1 rounded">High Priority</span>
                    @endif
                </div>
                <span class="text-xs text-gray-500">Posted at {{ $ticket->created_at->format('h:i A') }}</span>
            </div>
            <h2 class="text-lg font-bold mt-2">{{ $ticket->title }}</h2>
            <p class="text-sm text-gray-600 mt-1">{{ Str::limit($ticket->description, 150) }}</p>

            <div class="flex justify-between items-center mt-4">
                <span class="text-sm text-gray-600">Location: {{ $ticket->location ?? '-' }}</span>
                <a href="{{ route('tickets.show', $ticket->id) }}">Open Ticket</a>
            </div>
        </div>
    @empty
        <p class="text-center text-gray-600 py-10">No tickets submitted.</p>
    @endforelse

    <div class="mt-6">
        {{ $tickets->links() }}
    </div>
</div>
@endsection
