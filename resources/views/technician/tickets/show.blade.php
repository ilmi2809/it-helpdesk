@extends('layouts.app')

@section('content')
<div class="p-6 space-y-6">
    <h1 class="text-2xl font-bold">Detail Tiket</h1>

    <div class="grid grid-cols-3 gap-6">
        <div class="col-span-2 space-y-4">
            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-lg font-semibold">Informasi Tiket</h2>
                <p><strong>Nomor Tiket:</strong> {{ $ticket->ticket_number }}</p>
                <p><strong>Status:</strong> {{ ucfirst($ticket->status) }}</p>
                <p><strong>Tanggal Dibuat:</strong> {{ $ticket->created_at->format('d M Y H:i') }}</p>
                <p><strong>Prioritas:</strong> {{ $ticket->priority }}</p>
                <p><strong>Kategori:</strong> {{ $ticket->category->name }}</p>
                <p><strong>Deskripsi:</strong> {{ $ticket->description }}</p>
            </div>

            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-lg font-semibold">Log Aktivitas</h2>
                @foreach($ticket->logs as $log)
                    <p>{{ $log->activity }} - {{ $log->created_at->format('d M Y, H:i') }}</p>
                @endforeach
            </div>

            @if($ticket->attachments->count())
            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-lg font-semibold">Lampiran</h2>
                <ul>
                    @foreach($ticket->attachments as $attachment)
                        <li>
                            <a href="{{ asset('storage/'.$attachment->file_path) }}" class="text-blue-500" download>{{ $attachment->file_name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>

        <div class="space-y-4">
            <div class="bg-white p-4 rounded shadow">
                <h3 class="text-lg font-semibold mb-2">Technician Actions</h3>
                <form method="POST" action="{{ route('technician.tickets.update', $ticket->id) }}">
                    @csrf
                    @method('PUT')

                    <label class="block mb-1">Status</label>
                    <select name="status" class="w-full border rounded p-2 mb-4">
                        <option value="on_going" {{ $ticket->status == 'on_going' ? 'selected' : '' }}>On Going</option>
                        <option value="resolved" {{ $ticket->status == 'resolved' ? 'selected' : '' }}>Resolved</option>
                    </select>

                    <label class="block mb-1">Priority</label>
                    <select name="priority" class="w-full border rounded p-2 mb-4">
                        <option value="low" {{ $ticket->priority == 'low' ? 'selected' : '' }}>Low</option>
                        <option value="medium" {{ $ticket->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                        <option value="high" {{ $ticket->priority == 'high' ? 'selected' : '' }}>High</option>
                    </select>

                    <button class="w-full bg-blue-600 text-white py-2 rounded" type="submit">Update Ticket</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
