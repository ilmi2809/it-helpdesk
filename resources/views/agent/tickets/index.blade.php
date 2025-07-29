@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">Tickets</h4>

    <!-- Search & Filter -->
    <div class="d-flex justify-content-between mb-3">
        <input type="text" class="form-control w-50" placeholder="Search ticket...">
        <select class="form-select w-auto">
            <option>This Week</option>
            <option>Today</option>
            <option>This Month</option>
            <option>All Time</option>
        </select>
    </div>

    <!-- Tabs -->
    <ul class="nav nav-tabs mb-3">
        <li class="nav-item"><a class="nav-link active" href="#">All Tickets</a></li>
        <li class="nav-item"><a class="nav-link" href="#">New</a></li>
        <li class="nav-item"><a class="nav-link" href="#">On-Going</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Resolved</a></li>
    </ul>

    <!-- Ticket List -->
    @foreach ($tickets as $ticket)
    <div class="card mb-3">
        <div class="card-body d-flex justify-content-between">
            <div>
                <span class="badge bg-{{ $ticket->status_color }}">{{ $ticket->status_label }}</span>
                <strong class="ms-2">Ticket# {{ $ticket->ticket_number }}</strong>
                <p class="fw-bold">{{ $ticket->title }}</p>
                <p>{{ Str::limit($ticket->description, 80) }}</p>
                <small>By: {{ $ticket->user->name }}</small>
            </div>
            <div class="text-end">
                <small>{{ $ticket->created_at->format('d M Y H:i') }}</small><br>
                <a href="{{ route('tickets.show', $ticket->id) }}" class="btn btn-link text-danger p-0">Open Ticket</a>
            </div>
        </div>
    </div>
    @endforeach

    {{ $tickets->links() }}
</div>
@endsection
