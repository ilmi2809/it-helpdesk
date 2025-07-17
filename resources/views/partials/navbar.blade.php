<div class="flex-1 flex flex-col">
    <header class="bg-white shadow px-6 py-4 flex justify-between items-center">
        <div class="text-gray-700 font-semibold">
        </div>
        <div class="relative">
            <button id="userDropdownBtn" class="flex items-center space-x-2 hover:text-gray-700">
                <span class="text-sm text-gray-700"><b>{{ auth()->user()->name }}</b></span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M19 9l-7 7-7-7"/>
                </svg>
            </button>

            <div id="userDropdownMenu" class="absolute right-0 mt-2 w-40 bg-white border rounded shadow hidden z-50">
                <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">Profil</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-sm hover:bg-gray-100">Logout</button>
                </form>
            </div>
        </div>
    </header>

    <main class="p-6 overflow-auto">
        @yield('content')
    </main>
</div>
