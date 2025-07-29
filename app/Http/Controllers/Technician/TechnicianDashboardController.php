<?php

namespace App\Http\Controllers\Technician;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Ticket;

class TechnicianDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $today = now()->toDateString();
        $weekStart = now()->startOfWeek();

        $ticketsAssignedToday = Ticket::where('assignee_id', $user->id)
            ->whereDate('created_at', $today)
            ->count();

        $ticketsAssignedWeek = Ticket::where('assignee_id', $user->id)
            ->whereBetween('created_at', [$weekStart, now()])
            ->count();

        $ticketsResolved = Ticket::where('assignee_id', $user->id)
            ->where('status', 'Selesai')
            ->count();

        $pendingTickets = Ticket::where('assignee_id', $user->id)
            ->where('status', '!=', 'Selesai')
            ->count();

        $slaBreaches = Ticket::where('assignee_id', $user->id)
            ->where('is_sla_breached', true)
            ->count();

        return view('technician.dashboard', compact(
            'ticketsAssignedToday',
            'ticketsAssignedWeek',
            'ticketsResolved',
            'pendingTickets',
            'slaBreaches'
        ));
    }
}
