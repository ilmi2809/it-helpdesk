@extends('layouts.app')

@section('title', 'Create Ticket')

@section('content')
<div class="container mx-auto px-4 py-6 max-w-4xl">
    {{-- Notifikasi flash message --}}
    @if(session('success'))
        <div class="mb-4 bg-green-100 text-green-700 px-4 py-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    <h1 class="text-2xl font-semibold mb-6">New Ticket</h1>

    <form action="{{ route('user.tickets.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        {{-- Subject --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
            <input type="text" name="title" class="w-full border px-3 py-2 rounded" required placeholder="Ticket subject">
        </div>

        {{-- Category --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
            <select name="category_id" class="w-full border px-3 py-2 rounded" required>
                <option value="">Choose Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Priority --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Priority</label>
            <select name="priority" class="w-full border px-3 py-2 rounded" required>
                <option value="">Select Priority</option>
                <option value="low">Low</option>
                <option value="medium">Medium</option>
                <option value="high">High</option>
            </select>
        </div>

        {{-- Description --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Ticket Body</label>
            <textarea name="description" rows="5" class="w-full border px-3 py-2 rounded" required placeholder="Describe your issue..."></textarea>
        </div>

        {{-- Location --}}
        <div x-data="{
            open: false,
            selected: '',
            room: '',
            expanded: {},
            toggle(item) {
                this.expanded[item] = !this.expanded[item];
            },
            select(value) {
                this.selected = value;
                this.open = false;
            },
            fullLocation() {
                return this.room ? `${this.selected} - ruang ${this.room}` : this.selected;
            }
        }" class="relative">

            <label class="block text-sm font-medium text-gray-700 mb-1">Location</label>

            <!-- Trigger Dropdown -->
            <div @click="open = !open" class="w-full border px-3 py-2 rounded cursor-pointer bg-white flex justify-between items-center">
                <span x-text="selected || 'Choose Location'"></span>
                <svg class="w-4 h-4 ml-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.939l3.71-3.71a.75.75 0 011.08 1.04l-4.24 4.25a.75.75 0 01-1.08 0l-4.25-4.25a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                </svg>
            </div>

            <!-- Hidden Input -->
            <input type="hidden" name="location" :value="fullLocation()">

            <!-- Dropdown Tree -->
            <div x-show="open" @click.outside="open = false" class="absolute z-50 bg-white w-full border mt-1 rounded shadow p-3 max-h-64 overflow-auto text-sm">
                <ul>
                    <li>
                        <div class="cursor-pointer font-semibold hover:bg-gray-100 px-2 py-1 rounded" @click="toggle('head')">
                            Head Office
                        </div>
                        <ul x-show="expanded['head']" class="ml-4 mt-1">
                            <li @click="select('Head Office - Rooftop')" class="cursor-pointer hover:bg-gray-100 px-2 py-1 rounded">Rooftop</li>
                            <li @click="select('Head Office - Lantai 3')" class="cursor-pointer hover:bg-gray-100 px-2 py-1 rounded">Lantai 3</li>
                            <li @click="select('Head Office - Lantai 2')" class="cursor-pointer hover:bg-gray-100 px-2 py-1 rounded">Lantai 2</li>
                            <li @click="select('Head Office - Lantai M')" class="cursor-pointer hover:bg-gray-100 px-2 py-1 rounded">Lantai M</li>
                            <li @click="select('Head Office - Lantai 1')" class="cursor-pointer hover:bg-gray-100 px-2 py-1 rounded">Lantai 1</li>
                            <li @click="select('Head Office - Basement')" class="cursor-pointer hover:bg-gray-100 px-2 py-1 rounded">Basement</li>
                        </ul>
                    </li>
                    <li>
                        <div class="cursor-pointer font-semibold hover:bg-gray-100 px-2 py-1 rounded mt-2" @click="toggle('halim')">
                            Halim Station
                        </div>
                        <ul x-show="expanded['halim']" class="ml-4 mt-1">
                            <li @click="select('Halim Station - Lantai 2')" class="cursor-pointer hover:bg-gray-100 px-2 py-1 rounded">Lantai 2</li>
                            <li @click="select('Halim Station - Lantai 1')" class="cursor-pointer hover:bg-gray-100 px-2 py-1 rounded">Lantai 1</li>
                        </ul>
                    </li>
                    <li>
                        <div class="cursor-pointer font-semibold hover:bg-gray-100 px-2 py-1 rounded mt-2" @click="toggle('karawang')">
                            Karawang Station
                        </div>
                        <ul x-show="expanded['karawang']" class="ml-4 mt-1">
                            <li @click="select('Karawang Station - Lantai 2')" class="cursor-pointer hover:bg-gray-100 px-2 py-1 rounded">Lantai 2</li>
                            <li @click="select('Karawang Station - Lantai 1')" class="cursor-pointer hover:bg-gray-100 px-2 py-1 rounded">Lantai 1</li>
                        </ul>
                    </li>
                    <li>
                        <div class="cursor-pointer font-semibold hover:bg-gray-100 px-2 py-1 rounded mt-2" @click="toggle('padalarang')">
                            Padalarang Station
                        </div>
                        <ul x-show="expanded['padalarang']" class="ml-4 mt-1">
                            <li @click="select('Padalarang Station - Lantai 2')" class="cursor-pointer hover:bg-gray-100 px-2 py-1 rounded">Lantai 2</li>
                            <li @click="select('Padalarang Station - Lantai 1')" class="cursor-pointer hover:bg-gray-100 px-2 py-1 rounded">Lantai 1</li>
                        </ul>
                    </li>
                    <li>
                        <div class="cursor-pointer font-semibold hover:bg-gray-100 px-2 py-1 rounded mt-2" @click="toggle('tegalluar')">
                            Tegalluar Station
                        </div>
                        <ul x-show="expanded['tegalluar']" class="ml-4 mt-1">
                            <li @click="select('Tegalluar Station - Lantai 2')" class="cursor-pointer hover:bg-gray-100 px-2 py-1 rounded">Lantai 2</li>
                            <li @click="select('Tegalluar Station - Lantai 1')" class="cursor-pointer hover:bg-gray-100 px-2 py-1 rounded">Lantai 1</li>
                        </ul>
                    </li>
                    <li>
                        <div class="cursor-pointer font-semibold hover:bg-gray-100 px-2 py-1 rounded mt-2" @click="toggle('depo')">
                            Depo
                        </div>
                        <ul x-show="expanded['depo']" class="ml-4 mt-1">
                            <li @click="select('Depo - OCC')" class="cursor-pointer hover:bg-gray-100 px-2 py-1 rounded">OCC</li>
                        </ul>
                    </li>
                </ul>
            </div>

            <div class="mt-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Ruang</label>
                <input type="text" x-model="room" class="w-full border px-3 py-2 rounded" placeholder="Contoh: Comprehensive, R.305, Panel, dll">
            </div>

        </div>

        {{-- Attachment --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Attachments (Optional)</label>
            <input type="file" name="attachment[]" multiple class="w-full border px-3 py-2 rounded bg-white">
            <p class="text-xs text-gray-400 mt-1">Supported formats: jpg, png, pdf. Max size: 10MB</p>
        </div>

        {{-- Submit --}}
        <div class="text-right">
            <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded hover:bg-red-700">
                Send Ticket
            </button>
        </div>
    </form>
</div>
@endsection
