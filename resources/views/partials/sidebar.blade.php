<aside class="w-64 bg-white shadow-lg flex flex-col justify-between rounded-xl">
    <div>
        <div class="p-4 flex items-center justify-center border-b">
            <a href="{{ route('dashboard') }}">
                <img src="/images/kcic_logo.png" class="h-10" alt="KCIC Logo">
            </a>
        </div>
        <nav class="p-4">
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('dashboard') }}" class="block px-4 py-2 rounded-xl hover:bg-gray-200">Dashboard</a>
                </li>
            </ul>
        </nav>
    </div>

    <div class="p-4 border-t relative">
        <div class="relative">
            <button id="profileToggle" type="button"
                class="w-full text-left px-4 py-2 bg-gray-100 rounded-xl flex items-center justify-between hover:bg-gray-200">
                <span>{{ auth()->user()->name }}</span>
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div id="profileMenu"
                class="absolute bottom-14 left-0 w-full bg-white border rounded-xl shadow-md hidden z-50">
                <a href="#" class="block px-4 py-2 hover:bg-gray-100">Profil</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100">Logout</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('profileToggle')?.addEventListener('click', function () {
            const menu = document.getElementById('profileMenu');
            menu.classList.toggle('hidden');
        });
    </script>
</aside>
