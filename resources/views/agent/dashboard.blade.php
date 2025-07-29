@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">Dashboard Helpdesk Agent</h4>

    <div class="row">
        <div class="col-md-3">
            <div class="card text-white bg-danger mb-3">
                <div class="card-body">
                    <h5 class="card-title">Tiket Baru</h5>
                    <p class="card-text fs-4">{{ $newCount }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Tiket Dalam Proses</h5>
                    <p class="card-text fs-4">{{ $onGoingCount }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Tiket Selesai</h5>
                    <p class="card-text fs-4">{{ $resolvedCount }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-secondary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Tiket</h5>
                    <p class="card-text fs-4">{{ $totalCount }}</p>
                </div>
            </div>
        </div>
    </div>

    <h5 class="mt-5">Tiket Terbaru</h5>
    <ul class="list-group">
        @foreach ($latestTickets as $ticket)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <strong>{{ $ticket->ticket_number }}</strong> - {{ $ticket->title }}
                    <br><small class="text-muted">{{ $ticket->created_at->format('d M Y H:i') }}</small>
                </div>
                <a href="{{ route('agent.tickets.show', $ticket->id) }}" class="btn btn-sm btn-outline-danger">Lihat</a>
            </li>
        @endforeach
    </ul>
</div>
@endsection
