<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Ticket;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Dashboard untuk Admin.
     */
    public function index()
    {
        $today = Carbon::today();
        $yesterday = Carbon::yesterday();

        // Tiket hari ini & kemarin
        $ticketsToday = Ticket::whereDate('created_at', $today)->count();
        $ticketsYesterday = Ticket::whereDate('created_at', $yesterday)->count();

        // Status tiket
        $openTickets = Ticket::where('status', 'On-Going')->count();
        $resolvedTickets = Ticket::where('status', 'Resolved')->count();

        // Tiket resolved yang melewati SLA (jika relasi SLA tersedia)
        $slaBreached = Ticket::where('status', 'Resolved')
            ->whereHas('category.slaPolicy', function ($query) {
                $query->whereRaw('EXTRACT(EPOCH FROM (tickets.updated_at - tickets.created_at)) > (sla_policies.resolution_time_minutes * 60)');
            })
            ->count();

        // Tiket minggu ini & minggu lalu
        $weeklyTicketTotal = Ticket::whereBetween('created_at', [
            now()->subDays(6)->startOfDay(),
            now()->endOfDay()
        ])->count();

        $lastWeekTotal = Ticket::whereBetween('created_at', [
            now()->subDays(13)->startOfDay(),
            now()->subDays(7)->endOfDay()
        ])->count();

        // Growth minggu ini dibanding minggu lalu
        $weeklyGrowth = $lastWeekTotal > 0
            ? round((($weeklyTicketTotal - $lastWeekTotal) / $lastWeekTotal) * 100)
            : 0;

        // Data per kategori
        $categoryData = Category::withCount('tickets')->get();

        // Dummy SLA metric (jika belum ada hitungan dinamis)
        $slaRate = 95;
        $compliant = 70;
        $nonCompliant = 30;
        $slaGrowth = -2;

        return view('admin.dashboard.index', compact(
            'ticketsToday',
            'ticketsYesterday',
            'openTickets',
            'resolvedTickets',
            'slaBreached',
            'categoryData',
            'slaRate',
            'compliant',
            'nonCompliant',
            'weeklyTicketTotal',
            'weeklyGrowth',
            'slaGrowth'
        ));
    }

    /**
     * Dashboard untuk User (Pelapor).
     */
    public function user()
    {
        $user = auth()->user();

        $totalTickets = Ticket::where('user_id', $user->id)->count();

        $totalAssigned = Ticket::where('user_id', $user->id)
            ->whereNotNull('assignee_id')
            ->count();

        $tickets = Ticket::where('user_id', $user->id)
            ->with(['assignee'])
            ->latest()
            ->take(5)
            ->get();

        return view('user.dashboard', compact(
            'totalTickets',
            'totalAssigned',
            'tickets'
        ));
    }
}
