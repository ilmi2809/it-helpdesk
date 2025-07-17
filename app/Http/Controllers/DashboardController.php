<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        $yesterday = Carbon::yesterday();

        // Jumlah tiket hari ini dan kemarin
        $ticketsToday = Ticket::whereDate('created_at', $today)->count();
        $ticketsYesterday = Ticket::whereDate('created_at', $yesterday)->count();

        // Jumlah tiket berdasarkan status
        $openTickets = Ticket::where('status', 'On-Going')->count();
        $resolvedTickets = Ticket::where('status', 'Resolved')->count();

        // Jumlah tiket resolved yang melebihi SLA
        $slaBreached = Ticket::where('status', 'Resolved')
            ->whereHas('category.slaPolicy', function ($query) {
                $query->whereRaw('EXTRACT(EPOCH FROM (tickets.updated_at - tickets.created_at)) > (sla_policies.resolution_time_minutes * 60)');
            })
            ->count();

        // Jumlah tiket minggu ini (7 hari terakhir)
        $weeklyTicketTotal = Ticket::whereBetween('created_at', [
            Carbon::now()->subDays(6)->startOfDay(),
            Carbon::now()->endOfDay()
        ])->count();

        // Jumlah tiket minggu lalu (hari ke-8 sampai ke-14 dari sekarang)
        $lastWeekTotal = Ticket::whereBetween('created_at', [
            Carbon::now()->subDays(13)->startOfDay(),
            Carbon::now()->subDays(7)->endOfDay()
        ])->count();

        // Pertumbuhan mingguan
        $weeklyGrowth = $lastWeekTotal > 0
            ? round((($weeklyTicketTotal - $lastWeekTotal) / $lastWeekTotal) * 100)
            : 0;

        // Data jumlah tiket per kategori
        $categoryData = Category::withCount('tickets')->get();

        // Dummy data untuk SLA rate
        $slaRate = 95;
        $compliant = 70;
        $nonCompliant = 30;
        $slaGrowth = -2;

        return view('dashboard.index', compact(
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
}
