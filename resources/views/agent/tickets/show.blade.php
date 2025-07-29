
@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-8">
    {{-- Header --}}
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">📝 Detail Tiket</h1>
        <p class="text-gray-500">Informasi lengkap mengenai tiket yang Anda laporkan.</p>
    </div>

    {{-- Informasi Tiket --}}
    <div class="bg-white shadow rounded-xl p-6 mb-6">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">🎫 Informasi Tiket</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-700">
            <div><span class="font-semibold">No Tiket:</span> {{ $ticket->ticket_number }}</div>
            <div><span class="font-semibold">Status:</span> {{ $ticket->status }}</div>
            <div><span class="font-semibold">Prioritas:</span> {{ $ticket->priority }}</div>
            <div><span class="font-semibold">Kategori:</span> {{ $ticket->category->name }}</div>
            <div class="md:col-span-2"><span class="font-semibold">Deskripsi:</span> {{ $ticket->description }}</div>
        </div>
    </div>

    {{-- Log Aktivitas --}}
    <div class="bg-white shadow rounded-xl p-6 mb-6">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">📜 Log Aktivitas</h2>
        @if ($ticket->logs->isEmpty())
            <p class="text-sm text-gray-500 italic">Belum ada aktivitas pada tiket ini.</p>
        @else
            <ul class="list-disc pl-5 text-sm text-gray-700">
                @foreach ($ticket->logs as $log)
                    <li>{{ $log->status }} oleh {{ $log->user->name }} - {{ $log->created_at->format('d M Y H:i') }}</li>
                @endforeach
            </ul>
        @endif
    </div>

    {{-- Assignee --}}
    <div class="bg-white shadow rounded-xl p-6 mb-6">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">👨‍🔧 Assignee</h2>
        @if ($ticket->assignee)
            <p class="text-sm text-green-700 font-medium">Teknisi: {{ $ticket->assignee->name }}</p>
        @else
            <p class="text-sm text-red-600 mb-2 font-medium">No Technician Available</p>
            <button onclick="document.getElementById('assignModal').showModal()" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 text-sm">
                Manual Assign
            </button>
        @endif
    </div>

    {{-- Modal Manual Assign --}}
    <dialog id="assignModal" class="rounded-xl p-0 w-full max-w-2xl">
        <form method="POST" action="{{ route('agent.tickets.assign', $ticket->id) }}" class="bg-white rounded-xl shadow p-6">
            @csrf
            <h3 class="text-lg font-semibold mb-2 text-gray-800">Manual Assign</h3>
            <p class="text-sm text-gray-500 mb-4">Tiket No: <span class="font-semibold text-red-600">#{{ $ticket->ticket_number }}</span></p>
            <div class="overflow-x-auto">
                <table class="table-auto w-full text-sm">
                    <thead>
                        <tr class="border-b">
                            <th class="text-left py-2">Technician</th>
                            <th class="text-left py-2">Availability</th>
                            <th class="text-left py-2">Pilih</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($technicians as $tech)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-2">{{ $tech->name }}</td>
                            <td class="py-2 text-red-500">{{ $tech->available_in }}</td>
                            <td class="py-2">
                                <input type="radio" name="technician_id" value="{{ $tech->id }}" required>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="flex justify-end mt-4">
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 text-sm">
                    Assign
                </button>
                <form method="dialog">
                    <button class="ml-2 px-4 py-2 rounded-lg text-gray-600 hover:bg-gray-100 text-sm" onclick="document.getElementById('assignModal').close()">Close</button>
                </form>
            </div>
        </form>
    </dialog>
</div>
@endsection
