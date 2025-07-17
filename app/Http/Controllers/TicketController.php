<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Category;
use App\Models\Department;
use App\Models\User;
use App\Models\TicketLog;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        $query = Ticket::with('user');

        // Filter berdasarkan status
        if ($request->has('status') && $request->status != 'all') {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan prioritas
        if ($request->has('priority') && $request->priority != '') {
            $query->where('priority', $request->priority);
        }

        // Pencarian berdasarkan judul atau nomor tiket
        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('title', 'ILIKE', '%' . $request->search . '%')
                  ->orWhere('ticket_number', 'ILIKE', '%' . $request->search . '%');
            });
        }

        // Waktu (opsional): filter tiket yang dibuat minggu ini
        if ($request->time == 'this_week') {
            $query->whereBetween('created_at', [
                now()->startOfWeek(), now()->endOfWeek()
            ]);
        }

        $tickets = $query->latest()->paginate(5);

        return view('tickets.index', compact('tickets'));
    }


    public function show(Ticket $ticket)
    {
        $ticket->load([
            'user',
            'category',
            'department.directorate',
            'logs.user',
            'attachments',
        ]);

        return view('tickets.show', compact('ticket'));
    }

    public function reply(Request $request, Ticket $ticket)
    {
        // Validasi input
        $request->validate([
            'status' => 'required',
            'note' => 'required|string', // <- pastikan note wajib
        ]);

        // Update status tiket
        $ticket->update([
            'status' => $request->status,
        ]);

        // Simpan ke ticket_logs
        TicketLog::create([
            'ticket_id' => $ticket->id,
            'user_id' => auth()->id(),
            'status' => $request->status,
            'note' => $request->note, // <--- di sinilah masuknya note
        ]);

        return redirect()->route('tickets.show', $ticket->id)->with('success', 'Reply submitted!');
    }
}
