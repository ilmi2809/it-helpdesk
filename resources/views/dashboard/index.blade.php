@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="p-1">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Dashboard</h1>
            {{-- Top Stats --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white p-4 rounded-xl shadow">
            <div class="text-sm text-gray-500">Tickets Today</div>
            <div class="text-2xl font-bold">{{ $ticketsToday }}</div>
            <div class="text-green-500 text-sm mt-1">
                @if($ticketsYesterday > 0)
                    +{{ round((($ticketsToday - $ticketsYesterday) / $ticketsYesterday) * 100) }}%
                @else
                    +100%
                @endif
            </div>
        </div>
        <div class="bg-white p-4 rounded-xl shadow">
            <div class="text-sm text-gray-500">Open</div>
            <div class="text-2xl font-bold">{{ $openTickets }}</div>
            <div class="text-red-500 text-sm mt-1">-2%</div>
        </div>
        <div class="bg-white p-4 rounded-xl shadow">
            <div class="text-sm text-gray-500">Resolved</div>
            <div class="text-2xl font-bold">{{ $resolvedTickets }}</div>
            <div class="text-green-500 text-sm mt-1">+10%</div>
        </div>
        <div class="bg-white p-4 rounded-xl shadow">
            <div class="text-sm text-gray-500">SLA Breach</div>
            <div class="text-2xl font-bold">{{ $slaBreached }}</div>
            <div class="text-green-500 text-sm mt-1">+1%</div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        {{-- Tickets by Category --}}
        <div class="bg-white p-6 rounded-xl shadow">
            <div class="text-lg font-semibold mb-2">Tickets by Category</div>
            <div class="text-3xl font-bold">{{ $weeklyTicketTotal }}</div>
            <div class="text-sm text-gray-500 mb-4">Last 7 Days <span class="text-green-500">+{{ $weeklyGrowth }}%</span></div>

            @foreach ($categoryData as $category)
                <div class="flex justify-between text-sm font-medium">
                    <span>{{ $category->name }}</span>
                    <span>{{ $category->tickets_count }}</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-red-500 h-2 rounded-full" style="width: {{ $weeklyTicketTotal ? ($category->tickets_count / $weeklyTicketTotal * 100) : 0 }}%"></div>
                </div>
            @endforeach
        </div>

        {{-- SLA Compliance --}}
        <div class="bg-white p-6 rounded-xl shadow">
            <div class="text-lg font-semibold mb-2">SLA Compliance Rate</div>
            <div class="text-3xl font-bold">{{ $slaRate }}%</div>
            <div class="text-sm text-gray-500 mb-4">Last 30 Days <span class="text-red-500">{{ $slaGrowth }}%</span></div>
            <div class="grid grid-cols-2 gap-4">
                <div class="text-center">
                    <div class="h-24 w-full bg-gray-100 flex items-end">
                        <div class="bg-green-500 w-full" style="height: {{ $compliant > 0 ? ($compliant / ($compliant + $nonCompliant) * 100) : 0 }}%"></div>
                    </div>
                    <div class="mt-2 text-sm">Compliant</div>
                </div>
                <div class="text-center">
                    <div class="h-24 w-full bg-gray-100 flex items-end">
                        <div class="bg-red-500 w-full" style="height: {{ $nonCompliant > 0 ? ($nonCompliant / ($compliant + $nonCompliant) * 100) : 0 }}%"></div>
                    </div>
                    <div class="mt-2 text-sm">Non-Compliant</div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
