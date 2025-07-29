@props(['title', 'value', 'growth', 'color' => 'green'])

<div class="bg-white p-5 rounded-xl shadow-md hover:shadow-lg transition">
    <div class="text-sm text-gray-500">{{ $title }}</div>
    <div class="text-3xl font-bold text-gray-800 mt-1">{{ $value }}</div>
    <div class="text-xs text-{{ $color }}-600 mt-1">
        {{ $growth > 0 ? '+' : '' }}{{ $growth }}%
    </div>
</div>
