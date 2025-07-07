@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <h1 class="text-2xl font-semibold text-gray-800 mb-4">Dashboard</h1>
    <div class="bg-white shadow p-6 rounded-lg">
        <p>Selamat datang, <strong>{{ auth()->user()->name }}</strong>!</p>
        <p class="mt-2">Anda login sebagai <strong>{{ auth()->user()->role }}</strong>.</p>
    </div>
@endsection
