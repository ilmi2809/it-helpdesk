@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h4 class="text-xl font-semibold mb-6 text-gray-700">🛠 Manual Assign – Tiket Tanpa Technician</h4>

    @if($tickets->isEmpty())
        <div class="bg-blue-100 text-blue-800 text-sm px-4 py-3 rounded-lg" role="alert">
            Tidak ada tiket yang menunggu penugasan manual.
        </div>
    @else
        <div class="space-y-4">
            @foreach ($tickets as $ticket)
                <div class="border rounded-xl p-4 bg-white shadow-sm flex items-center justify-between">
                    <div>
                        <p class="font-semibold text-red-600">TCK-{{ $ticket->ticket_number }}</p>
                        <p class="text-gray-800">{{ $ticket->title }}</p>
                        <p class="text-sm text-gray-500 mt-1">
                            {{ $ticket->created_at->format('d M Y, H:i') }}
                        </p>
                    </div>
                    <div>
                    <a href="{{ route('agent.tickets.show', $ticket->id) }}#assignModal" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 text-sm">
                        Assign Now
                    </a>

                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $tickets->links() }}
        </div>
    @endif
</div>
@endsection
