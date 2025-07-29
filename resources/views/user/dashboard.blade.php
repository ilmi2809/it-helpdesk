@extends('layouts.app')

@section('content')
<div class="px-6 py-6">
    <h1 class="text-2xl font-semibold mb-6 text-gray-800">Dashboard</h1>

    {{-- Stat Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
        <div class="bg-white shadow rounded-xl p-4 flex items-center">
            <div class="bg-red-100 text-red-500 rounded-full p-3 mr-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M20 6H4v2h16V6zM4 10h16v2H4v-2zm0 4h10v2H4v-2z"/>
                </svg>
            </div>
            <div>
                <p class="text-sm text-gray-500">Total Tickets</p>
                <p class="text-xl font-bold text-gray-800">{{ $totalTickets }}</p>
            </div>
        </div>

        <div class="bg-white shadow rounded-xl p-4 flex items-center">
            <div class="bg-blue-100 text-blue-500 rounded-full p-3 mr-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 12c2.21 0 4-1.79 4-4S14.21 4 12 4 8 5.79 8 8s1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                </svg>
            </div>
            <div>
                <p class="text-sm text-gray-500">Assigned Tickets</p>
                <p class="text-xl font-bold text-gray-800">{{ $totalAssigned }}</p>
            </div>
        </div>
    </div>

    {{-- Recent Tickets --}}
    <div class="bg-white shadow rounded-xl p-6">
        <h2 class="text-lg font-semibold mb-4 text-gray-700">Recent Tickets</h2>

        @forelse($tickets as $ticket)
        <div class="border-b last:border-none py-4 flex justify-between items-start">
            <div>
                {{-- Ticket Status Dot --}}
                <div class="flex items-center mb-1">
                    @php
                        $color = match($ticket->status) {
                            'Pending' => 'bg-yellow-400',
                            'Resolved' => 'bg-green-500',
                            'Closed' => 'bg-gray-500',
                            default => 'bg-blue-500'
                        };
                    @endphp
                    <span class="w-3 h-3 rounded-full {{ $color }} mr-2"></span>
                    <span class="text-sm font-medium text-gray-700">Ticket# {{ $ticket->ticket_number }}</span>
                </div>
                <p class="text-sm text-gray-800 font-semibold">{{ $ticket->title }}</p>
                <p class="text-xs text-gray-500 mt-1">{{ Str::limit($ticket->description, 120) }}</p>
                <p class="text-xs text-gray-400 mt-1">Status: <strong>{{ $ticket->status }}</strong></p>
                @if($ticket->assignee)
                    <p class="text-xs text-gray-400">Assigned to: {{ $ticket->assignee->name }}</p>
                @endif
            </div>
            <div>
                <a href="{{ route('user.tickets.index', $ticket->id) }}"
                   class="text-red-600 text-sm font-semibold hover:underline">
                    Open Ticket
                </a>
            </div>
        </div>
        @empty
        <p class="text-gray-500 text-sm">You have not submitted any tickets yet.</p>
        @endforelse
    </div>
</div>
@endsection
