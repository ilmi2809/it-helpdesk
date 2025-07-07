<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans antialiased">
<div class="flex h-screen">
    <aside class="w-64 bg-white shadow-lg flex flex-col justify-between">
        <div>
            <div class="p-4 border-b">
                <img src="/images/kcic_logo.png" alt="KCIC Logo" class="h-10 mx-auto">
                <p class="text-center text-sm text-gray-500 mt-1">IT Helpdesk</p>
            </div>
            <nav class="mt-4">
                <ul class="space-y-1">
                    <li>
                        <a href="{{ route('dashboard') }}"
                           class="flex items-center px-4 py-2 text-red-600 font-medium hover:bg-gray-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" viewBox="0 0 24 24"
                                 fill="currentColor">
                                <path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/>
                            </svg>
                            Dashboard
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    <div class="flex-1 flex flex-col">
        <header class="bg-white shadow px-6 py-4 flex justify-between items-center">
            <div class="text-gray-700 font-semibold">
                Welcome! <span class="font-bold">{{ auth()->user()->name }}</span>
            </div>
            <div class="relative">
                <button id="userDropdownBtn" class="flex items-center space-x-2 hover:text-gray-700">
                    <span class="text-sm text-gray-700">{{ auth()->user()->name }}</span>
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
</div>

<script>
    document.getElementById('userDropdownBtn')?.addEventListener('click', function () {
        document.getElementById('userDropdownMenu')?.classList.toggle('hidden');
    });

    document.addEventListener('click', function (event) {
        const btn = document.getElementById('userDropdownBtn');
        const menu = document.getElementById('userDropdownMenu');
        if (btn && menu && !btn.contains(event.target) && !menu.contains(event.target)) {
            menu.classList.add('hidden');
        }
    });
</script>
</body>
</html>
