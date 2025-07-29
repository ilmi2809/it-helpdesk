@extends('layouts.app')

@section('title', 'My Tickets')

@section('content')
<div class="px-6 py-6">
    {{-- Header --}}
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">My Tickets</h1>
        <a href="{{ route('user.tickets.create') }}"
           class="bg-red-600 hover:bg-red-700 text-white text-sm px-4 py-2 rounded-lg shadow-sm">
            + New Ticket
        </a>
    </div>

    {{-- Ticket List --}}
    <div class="space-y-4">
        @forelse ($tickets as $ticket)
            @php
                $priorityColor = match(strtolower($ticket->priority)) {
                    'high' => 'bg-blue-500',
                    'medium' => 'bg-yellow-400',
                    'low' => 'bg-green-500',
                    default => 'bg-gray-400'
                };
            @endphp

            <div class="bg-white rounded-xl shadow-sm p-4 border border-gray-100 hover:shadow-md transition">
                <div class="flex justify-between items-center">
                    <div class="flex items-center space-x-2">
                        <span class="w-3 h-3 rounded-full {{ $priorityColor }}"></span>
                        <p class="font-semibold text-gray-800 text-sm">
                            Ticket #{{ $ticket->ticket_number }}
                        </p>
                        <span class="text-xs text-gray-600 bg-gray-100 px-2 py-0.5 rounded-full font-medium">
                            {{ ucfirst($ticket->priority) }} Priority
                        </span>
                    </div>
                    <p class="text-xs text-gray-500">{{ $ticket->created_at->format('d M Y, H:i') }}</p>
                </div>

                <div class="mt-2">
                    <h2 class="text-sm font-bold text-gray-800">{{ $ticket->title }}</h2>
                    <p class="text-sm text-gray-600 mt-1">{{ Str::limit($ticket->description, 100) }}</p>
                </div>

                <div class="text-right mt-4">
                    <a href="{{ route('user.tickets.index', $ticket->id) }}"
                       class="text-sm font-medium text-red-600 hover:underline">
                        View Ticket →
                    </a>
                </div>
            </div>
        @empty
            <div class="text-center text-gray-500 text-sm py-10">
                You haven't created any tickets yet.
            </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $tickets->links() }}
    </div>
</div>
@endsection
