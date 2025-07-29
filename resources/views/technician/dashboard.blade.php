@extends('layouts.app')

@section('content')
<div class="p-6 space-y-6">
    <h1 class="text-2xl font-bold">Technician Dashboard</h1>
    <p>Welcome back, {{ auth()->user()->name }}! Here's your daily overview.</p>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <x-dashboard.metric title="Tickets Assigned (Today)" :value="$ticketsAssignedToday" />
        <x-dashboard.metric title="Tickets Assigned (This Week)" :value="$ticketsAssignedWeek" />
        <x-dashboard.metric title="Tickets Resolved" :value="$ticketsResolved" />
        <x-dashboard.metric title="Pending Tickets" :value="$pendingTickets" />
        <x-dashboard.metric title="SLA Breaches" :value="$slaBreaches" />
    </div>


    <div>
        <h2 class="text-xl font-semibold mt-8">Resolution Performance (Last 7 Days)</h2>
        <div class="h-48 bg-white rounded-xl shadow p-4">
            <!-- dummy chart -->
            <p>Chart (placeholder)</p>
        </div>
    </div>

    <div class="grid grid-cols-2 gap-6">
        <div>
            <h3 class="font-semibold text-lg">Priority Alerts</h3>
            <ul class="space-y-2 mt-2">
                <li>Ticket #12345 - Network Outage</li>
                <li>Ticket #67890 - Application Error</li>
            </ul>
        </div>
        <div>
            <h3 class="font-semibold text-lg">SLA Warnings</h3>
            <ul class="space-y-2 mt-2">
                <li>Ticket #11223 - Printer Malfunction</li>
                <li>Ticket #44556 - Email Configuration</li>
            </ul>
        </div>
    </div>
</div>
@endsection
