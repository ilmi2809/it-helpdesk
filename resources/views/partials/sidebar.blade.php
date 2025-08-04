<aside class="w-64 bg-white shadow-lg flex flex-col justify-between rounded-xl">
    <div>
        {{-- Logo --}}
        <div class="p-4 flex items-center justify-center border-b">
            <a href="{{ match(auth()->user()->role) {
                'admin' => route('admin.dashboard'),
                'helpdesk_agent' => route('agent.dashboard'),
                'it_support' => route('technician.dashboard'),
                'user' => route('user.dashboard'),
                default => '#'
            } }}">
                <img src="{{ asset('images/kcic_logo.png') }}" class="h-12 object-contain" alt="KCIC Logo">
            </a>
        </div>

        {{-- Navigation --}}
        <nav class="p-4">
            <ul class="space-y-2">

                {{-- DASHBOARD --}}
                <li>
                    <a href="{{ match(auth()->user()->role) {
                        'admin' => route('admin.dashboard'),
                        'helpdesk_agent' => route('agent.dashboard'),
                        'it_support' => route('technician.dashboard'),
                        'user' => route('user.dashboard'),
                    } }}"
                       class="flex items-center px-4 py-2 rounded-xl font-medium hover:bg-gray-100
                       {{ request()->routeIs('admin.dashboard', 'agent.dashboard', 'technician.dashboard', 'user.dashboard') ? 'bg-gray-100 text-black' : 'text-gray-500' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2"
                             fill="{{ request()->routeIs('admin.dashboard', 'agent.dashboard', 'technician.dashboard', 'user.dashboard') ? 'currentColor' : 'none' }}"
                             stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/>
                        </svg>
                        Dashboard
                    </a>
                </li>

                {{-- TICKETS --}}
                <li>
                    <a href="{{ match(auth()->user()->role) {
                        'admin' => route('admin.tickets.index'),
                        'helpdesk_agent' => route('agent.tickets.index'),
                        'it_support' => route('technician.tickets.index'),
                        'user' => route('user.tickets.index'),
                    } }}"
                       class="flex items-center px-4 py-2 rounded-xl font-medium hover:bg-gray-100
                       {{ request()->routeIs('admin.tickets.index', 'agent.tickets.index', 'technician.tickets.index', 'user.tickets.index') ? 'bg-gray-100 text-black' : 'text-gray-500' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2"
                             fill="{{ request()->routeIs('admin.tickets.index', 'agent.tickets.index', 'technician.tickets.index', 'user.tickets.index') ? 'currentColor' : 'none' }}"
                             stroke="currentColor" viewBox="0 0 16 16">
                            <path d="M0 4.5A1.5 1.5 0 0 1 1.5 3h13A1.5 1.5 0 0 1 16 4.5V6a.5.5 0 0 1-.5.5
                                     1.5 1.5 0 0 0 0 3 .5.5 0 0 1 .5.5v1.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5
                                     1.5 0 0 1 0 11.5V10a.5.5 0 0 1 .5-.5 1.5 1.5 0 1 0 0-3A.5.5 0 0 1 0 6z"/>
                        </svg>
                        {{ auth()->user()->role === 'user' ? 'My Tickets' : 'Tickets' }}
                    </a>
                </li>

                {{-- MANUAL ASSIGN (Helpdesk Agent Only) --}}
                @if(auth()->user()->role === 'helpdesk_agent')
                <li>
                    <a href="{{ route('agent.tickets.manual') }}"
                       class="flex items-center px-4 py-2 rounded-xl font-medium
                       {{ request()->routeIs('agent.tickets.manual') ? 'bg-gray-100 text-black' : 'text-gray-500 hover:bg-gray-100' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2"
                             fill="{{ request()->routeIs('agent.tickets.manual') ? 'currentColor' : 'none' }}"
                             stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M9 12l2 2l4-4m1-5h-1.586a1 1 0 01-.707-.293l-.707-.707A1
                                  1 0 0011.586 3H9a1 1 0 00-1 1v0a1 1 0 01-1 1v1M6 6v13a2 2 0 002 2h8a2 2
                                  0 002-2V6H6z" />
                        </svg>
                        Manual Assign
                    </a>
                </li>
                @endif

                {{-- ADMIN ONLY MENU --}}
                @if(auth()->user()->role === 'admin')
                {{-- Users --}}
                <li>
                    <a href="{{ route('admin.users.index') }}"
                       class="flex items-center px-4 py-2 rounded-xl font-medium hover:bg-gray-100
                       {{ request()->routeIs('admin.users.*') ? 'bg-gray-100 text-black' : 'text-gray-500' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2"
                             fill="{{ request()->routeIs('admin.users.*') ? 'currentColor' : 'none' }}"
                             stroke="currentColor" viewBox="0 0 16 16">
                            <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0
                                     2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1
                                     1-4 6-4 6 3 6 4z"/>
                        </svg>
                        Users
                    </a>
                </li>

                {{-- Categories --}}
                <li>
                    <a href="{{ route('admin.categories.index') }}"
                       class="flex items-center px-4 py-2 rounded-xl font-medium hover:bg-gray-100
                       {{ request()->routeIs('admin.categories.*') ? 'bg-gray-100 text-black' : 'text-gray-500' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2"
                             fill="{{ request()->routeIs('admin.categories.*') ? 'currentColor' : 'none' }}"
                             stroke="currentColor" viewBox="0 0 16 16">
                            <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2
                                     2v13.5a.5.5 0 0 1-.777.416L8
                                     13.101l-5.223 2.815A.5.5 0 0 1
                                     2 15.5z"/>
                        </svg>
                        Categories
                    </a>
                </li>
                @endif

            </ul>
        </nav>
    </div>
</aside>
