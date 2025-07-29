<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;

class AgentTicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::latest()->paginate(10);
        return view('agent.tickets.index', compact('tickets'));
    }

    public function show(Ticket $ticket)
    {
        $ticket->load(['user', 'category', 'assignee', 'logs', 'attachments']);

        $technicians = User::where('role', 'technician')
            ->get()
            ->map(function ($tech) {
                $tech->available_in = 'Available in ' . rand(10, 240) . ' minutes'; // Simulasi
                return $tech;
            })
            ->sortBy('available_in');

        return view('agent.tickets.show', compact('ticket', 'technicians'));
    }


    public function manualAssign(Ticket $ticket)
    {
        // Dapatkan daftar teknisi sesuai kategori dan urut berdasarkan availability
        $technicians = User::where('role', 'technician')
            ->get()
            ->map(function ($tech) {
                // Simulasi waktu available (ganti dengan real logic kalau sudah ada)
                $tech->available_in = 'Available in ' . rand(10, 120) . ' minutes';
                return $tech;
            })
            ->sortBy('available_in');

        return view('agent.tickets.manual-assign', compact('ticket', 'technicians'));
    }

    public function storeAssign(Request $request, Ticket $ticket)
    {
        $request->validate([
            'technician_id' => 'required|exists:users,id',
        ]);

        $ticket->assignee_id = $request->technician_id;
        $ticket->status = 'On-Going'; // Optional: ubah status
        $ticket->save();

        // Tambahkan log assign (jika ada model TicketLog)
        $ticket->logs()->create([
            'status' => 'Assigned by Agent',
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('agent.tickets.show', $ticket->id)
            ->with('success', 'Technician has been successfully assigned.');
    }

    public function manualList()
    {
        $tickets = Ticket::whereNull('assignee_id')->orderBy('created_at', 'desc')->paginate(10);
        return view('agent.tickets.manual-list', compact('tickets'));
    }

}
