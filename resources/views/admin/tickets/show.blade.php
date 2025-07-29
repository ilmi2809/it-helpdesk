@extends('layouts.app')

@section('content')
<div class="px-6 py-8 max-w-6xl mx-auto">
    <nav class="text-sm text-gray-500 mb-4">
        <a href="{{ route('tickets.index') }}" class="hover:underline text-red-600">Tiket</a> / Detail Tiket
    </nav>

    <h1 class="text-2xl font-semibold mb-1">Detail Tiket</h1>
    <p class="text-sm text-red-400 mb-6">Informasi lengkap mengenai tiket yang Anda laporkan.</p>

    {{-- Informasi Tiket --}}
    <div class="bg-white rounded-md shadow p-6 mb-6">
        <h2 class="text-md font-bold mb-4">Informasi Tiket</h2>
        <div class="grid grid-cols-2 gap-6 text-sm text-gray-800">
            <div>
                <p class="text-gray-500">Nomor Tiket</p>
                <p class="font-semibold">{{ $ticket->ticket_number }}</p>
            </div>
            <div>
                <p class="text-gray-500">Status</p>
                <p class="font-semibold">{{ $ticket->status }}</p>
            </div>
            <div>
                <p class="text-gray-500">Tanggal Dibuat</p>
                <p class="font-semibold">{{ $ticket->created_at->format('d M Y') }}</p>
            </div>
            <div>
                <p class="text-gray-500">Prioritas</p>
                <p class="font-semibold">{{ $ticket->priority }}</p>
            </div>
            <div>
                <p class="text-gray-500">Kategori</p>
                <p class="font-semibold">{{ $ticket->category->name ?? '-' }}</p>
            </div>
            <div>
                <p class="text-gray-500">Deskripsi</p>
                <p class="font-semibold">{{ $ticket->description }}</p>
            </div>
        </div>
    </div>

    {{-- Log Aktivitas --}}
    <div class="bg-white rounded-md shadow p-6 mb-6">
        <h2 class="text-md font-bold mb-4">Log Aktivitas</h2>
        <div class="space-y-6">
            @foreach ($ticket->logs as $log)
                <div class="flex gap-4 items-start">
                    @if ($loop->first)
                        <span class="text-2xl">🕒</span>
                    @elseif ($loop->last)
                        <span class="text-2xl">✅</span>
                    @else
                        <span class="text-2xl">👤</span>
                    @endif
                    <div>
                        <p class="font-semibold">{{ $log->note }}</p>
                        <p class="text-sm text-red-400">{{ $log->created_at->format('d M Y, H:i') }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Lampiran --}}
    @if ($ticket->attachments->count())
    <div class="bg-white rounded-md shadow p-6 mb-6">
        <h2 class="text-md font-bold mb-4">Lampiran</h2>
        @foreach ($ticket->attachments as $attachment)
            <div class="flex items-center gap-4 mb-4">
                <span class="text-2xl">🖼️</span>
                <p class="text-sm">{{ basename($attachment->file_path) }}</p>
                <a href="{{ asset($attachment->file_path) }}" target="_blank" class="ml-auto text-sm px-3 py-1 rounded bg-gray-100 hover:bg-gray-200">Unduh</a>
            </div>
        @endforeach
    </div>
    @endif

    {{-- Unduh Tiket --}}
    <form action="#" method="POST" class="mb-8">
        @csrf
        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Unduh Tiket</button>
    </form>

    {{-- Reply to Ticket --}}
    <div class="bg-white rounded-md shadow p-6">
        <h2 class="text-md font-bold mb-4">Reply to Ticket</h2>

        <form method="POST" action="{{ route('tickets.reply', $ticket->id) }}">
            @csrf
            <div class="grid grid-cols-3 gap-4 mb-4 text-sm">
                <div>
                    <p class="text-gray-600">Agent Email</p>
                    <input type="email" value="{{ auth()->user()->email }}" disabled class="w-full border rounded px-3 py-2 bg-gray-100">
                </div>
                <div>
                    <p class="text-gray-600">Request Ticket Type</p>
                    <select name="type" class="w-full border rounded px-3 py-2">
                        <option value="Deposit Issue">Deposit Issue</option>
                        <option value="Connection Issue">Connection Issue</option>
                    </select>
                </div>
                <div>
                    <p class="text-gray-600">Status</p>
                    <select name="status" class="w-full border rounded px-3 py-2">
                        <option value="on_going" {{ $ticket->status == 'on-Going' ? 'selected' : '' }}>On-Going</option>
                        <option value="new" {{ $ticket->status == 'new' ? 'selected' : '' }}>New</option>
                        <option value="resolved" {{ $ticket->status == 'resolved' ? 'selected' : '' }}>Resolved</option>
                    </select>
                </div>
            </div>
            <div class="mb-4">
                <p class="text-gray-600 text-sm">Ticket Body</p>
                <textarea name="note" rows="4" class="w-full border rounded px-3 py-2" placeholder="Type ticket issue here.."></textarea>
            </div>
            <div class="text-right">
                <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded hover:bg-red-700">Submit Reply</button>
            </div>
        </form>
    </div>
</div>
@endsection
