@extends('layouts.app')

@section('content')
<div class="container mx-auto p-1">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Tickets</h1>
    <div class="bg-white shadow p-6 rounded-lg">
        <form method="GET" action="{{ route('tickets.index') }}">
            <div class="flex justify-between items-center mb-4">
                <!-- Search -->
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search for ticket" />

                <div class="space-x-2">
                    <!-- Priority Dropdown -->
                    <select name="priority" onchange="this.form.submit()" class="border rounded px-2 py-1">
                        <option value="">Select Priority</option>
                        <option value="High" {{ request('priority') == 'High' ? 'selected' : '' }}>High</option>
                        <option value="Medium" {{ request('priority') == 'Medium' ? 'selected' : '' }}>Medium</option>
                        <option value="Low" {{ request('priority') == 'Low' ? 'selected' : '' }}>Low</option>
                    </select>

                    <!-- Time Filter (optional) -->
                    <select name="time" onchange="this.form.submit()" class="border rounded px-2 py-1">
                        <option value="">All Time</option>
                        <option value="this_week" {{ request('time') == 'this_week' ? 'selected' : '' }}>This Week</option>
                    </select>
                </div>
            </div>
        </form>

        {{-- <div class="flex justify-between items-center mb-4">
            <div></div>
            <div class="flex space-x-2">
                <select class="border rounded px-2 py-1">
                    <option>Select Priority</option>
                    <option value="new">New Tickets</option>
                    <option value="on-going">On-Going Tickets</option>
                    <option value="resolved">Resolved Tickets</option>
                </select>
                <select class="border rounded px-2 py-1">
                    <option>This Week</option>
                    <option>This Month</option>
                </select>
            </div>
        </div> --}}

        {{-- <div class="flex space-x-6 border-b mb-4">
            @foreach(['All Tickets', 'New', 'On-Going', 'Resolved'] as $status)
                <button class="py-2 text-sm font-semibold border-b-2 border-red-500 text-red-600">
                    {{ $status }}
                </button>
            @endforeach
        </div> --}}

        @php
        $currentStatus = request('status', 'all');
        $statusOptions = ['all' => 'All Tickets', 'new' => 'New', 'on-going' => 'On-Going', 'resolved' => 'Resolved'];
        @endphp

        <div class="flex space-x-6 border-b mb-4">
            @foreach($statusOptions as $key => $label)
                <a href="{{ route('tickets.index', ['status' => $key] + request()->except('page')) }}"
                class="py-2 text-sm font-semibold border-b-2 {{ $currentStatus === $key ? 'border-red-500 text-red-600' : 'border-transparent text-gray-600 hover:text-red-600 hover:border-red-500' }}">
                    {{ $label }}
                </a>
            @endforeach
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
                    <div class="flex items-center space-x-2">
                        <span class="text-sm">{{ $ticket->user->name ?? '-' }}</span>
                    </div>
                    <a href="{{ route('tickets.show', $ticket->id) }}">Lihat Detail</a>
                </div>
            </div>
        @empty
            <div class="text-center text-gray-600 py-10">Tidak ada tiket ditemukan.</div>
        @endforelse

        <div class="flex justify-center mt-6">
            {{ $tickets->links() }}
        </div>
    </div>
</div>
@endsection
