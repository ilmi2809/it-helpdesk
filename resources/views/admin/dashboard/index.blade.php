@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="p-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-8">Admin Dashboard</h1>

    {{-- Summary Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <x-dashboard-card title="Tickets Today" :value="$ticketsToday" :growth="$ticketsYesterday > 0 ? round((($ticketsToday - $ticketsYesterday) / $ticketsYesterday) * 100) : 100" color="green" />
        <x-dashboard-card title="Open" :value="$openTickets" growth="-2" color="red" />
        <x-dashboard-card title="Resolved" :value="$resolvedTickets" growth="+10" color="green" />
        <x-dashboard-card title="SLA Breach" :value="$slaBreached" growth="+1" color="green" />
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Tickets by Category --}}
        <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-gray-800">Tickets by Category</h2>
                <span class="text-xs text-gray-500">Last 7 Days</span>
            </div>
            <div class="text-xl font-bold text-gray-700 mb-6">{{ $weeklyTicketTotal }} Total</div>

            <div class="space-y-4 max-h-[300px] overflow-y-auto pr-2">
                @foreach ($categoryData as $category)
                    <div class="space-y-1">
                        <div class="flex justify-between text-sm font-medium text-gray-700">
                            <span>{{ $category->name }}</span>
                            <span>{{ $category->tickets_count }}</span>
                        </div>
                        <div class="w-full bg-gray-200 h-2 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-red-500 to-red-400 rounded-full transition-all duration-300"
                                 style="width: {{ $weeklyTicketTotal ? min(100, ($category->tickets_count / $weeklyTicketTotal) * 100) : 0 }}%">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- SLA Compliance Rate --}}
        <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-gray-800">SLA Compliance Rate</h2>
                <span class="text-xs text-gray-500">Last 30 Days</span>
            </div>

            <div class="text-3xl font-bold text-gray-800 mb-1">{{ $slaRate }}%</div>
            <div class="text-sm text-red-500 mb-6">{{ $slaGrowth }}%</div>

            <div class="grid grid-cols-2 gap-4 items-end h-32">
                <div class="text-center">
                    <div class="flex justify-center items-end h-full bg-gray-100 rounded-lg">
                        <div class="bg-green-500 w-2/3 rounded-t-lg"
                             style="height: {{ $compliant + $nonCompliant > 0 ? ($compliant / ($compliant + $nonCompliant) * 100) : 0 }}%">
                        </div>
                    </div>
                    <div class="mt-2 text-sm font-medium text-gray-700">Compliant</div>
                </div>
                <div class="text-center">
                    <div class="flex justify-center items-end h-full bg-gray-100 rounded-lg">
                        <div class="bg-red-500 w-2/3 rounded-t-lg"
                             style="height: {{ $compliant + $nonCompliant > 0 ? ($nonCompliant / ($compliant + $nonCompliant) * 100) : 0 }}%">
                        </div>
                    </div>
                    <div class="mt-2 text-sm font-medium text-gray-700">Non-Compliant</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
