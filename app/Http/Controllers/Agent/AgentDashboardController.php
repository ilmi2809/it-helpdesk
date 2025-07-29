<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Ticket;

class AgentDashboardController extends Controller
{
    public function index()
    {
        $newCount = Ticket::where('status', 'New')->count();
        $onGoingCount = Ticket::where('status', 'On-Going')->count();
        $resolvedCount = Ticket::where('status', 'Resolved')->count();
        $totalCount = Ticket::count();

        $latestTickets = Ticket::latest()->take(5)->get();

        return view('agent.dashboard', compact(
            'newCount',
            'onGoingCount',
            'resolvedCount',
            'totalCount',
            'latestTickets'
        ));
    }
}
