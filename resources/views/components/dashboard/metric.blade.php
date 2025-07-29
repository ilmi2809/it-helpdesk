<div class="bg-white shadow-md rounded-xl px-6 py-4 w-full text-center">
    <h3 class="text-sm text-gray-500 mb-1">{{ $title }}</h3>
    <div class="text-2xl font-bold text-gray-800">{{ $value }}</div>
    @if($percentage !== null)
        <div class="text-sm mt-1 {{ $percentage >= 0 ? 'text-green-500' : 'text-red-500' }}">
            {{ $percentage >= 0 ? '+' : '' }}{{ $percentage }}%
        </div>
    @endif
</div>
