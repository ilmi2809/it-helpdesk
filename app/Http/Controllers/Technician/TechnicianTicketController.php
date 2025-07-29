<?php

namespace App\Http\Controllers\Technician;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\TicketLog;
use Illuminate\Support\Facades\Auth;

class TechnicianTicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::where('assignee_id', Auth::id())->latest()->get();
        return view('technician.tickets.index', compact('tickets'));
    }

    public function show(Ticket $ticket)
    {
        $ticket->load('logs', 'attachments');
        return view('technician.tickets.show', compact('ticket'));
    }

    public function update(Request $request, Ticket $ticket)
    {
        $ticket->update([
            'status' => $request->status,
            'priority' => $request->priority,
        ]);

        TicketLog::create([
            'ticket_id' => $ticket->id,
            'user_id' => Auth::id(),
            'message' => 'Ticket updated by technician.'
        ]);

        return back()->with('success', 'Ticket updated');
    }

    public function reply(Request $request, Ticket $ticket)
    {
        TicketLog::create([
            'ticket_id' => $ticket->id,
            'user_id' => Auth::id(),
            'message' => $request->message,
        ]);

        return back()->with('success', 'Reply added.');
    }
}
