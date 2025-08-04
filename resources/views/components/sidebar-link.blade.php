@props(['href', 'label', 'icon' => 'circle', 'active' => false])

@php
    $classes = $active
        ? 'bg-gray-100 text-black'
        : 'text-gray-500 hover:bg-gray-100';
@endphp

<li>
    <a href="{{ $href }}" class="flex items-center px-4 py-2 rounded-xl font-medium transition duration-150 {{ $classes }}">
        @switch($icon)
            @case('home')
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                          d="M3 9.75L12 3l9 6.75V21a1.5 1.5 0 0 1-1.5 1.5H4.5A1.5 1.5 0 0 1 3 21V9.75z"/>
                </svg>
                @break
            @case('ticket')
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M3 6a3 3 0 013-3h12a3 3 0 013 3v3a3 3 0 110 6v3a3 3 0 01-3 3H6a3 3 0 01-3-3v-3a3 3 0 110-6V6z" />
                </svg>
                @break
            @case('plus')
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M12 4v16m8-8H4" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                </svg>
                @break
            @case('users')
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M17 20h5v-2a4 4 0 00-5-4m-4 6v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87M12 12a4 4 0 100-8 4 4 0 000 8z" />
                </svg>
                @break
            @case('wrench')
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M14.25 17.25l-1.5 1.5M16.5 14.25l-1.5 1.5M9 21h6a3 3 0 003-3v-6a3 3 0 00-3-3h-6a3 3 0 00-3 3v6a3 3 0 003 3z" />
                </svg>
                @break
            @case('folder')
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M3 7a2 2 0 012-2h4l2 2h8a2 2 0 012 2v1H3V7zM3 10h18v7a2 2 0 01-2 2H5a2 2 0 01-2-2v-7z"/>
                </svg>
                @break
            @default
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10" />
                </svg>
        @endswitch

        {{ $label }}
    </a>
</li>
