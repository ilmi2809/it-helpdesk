<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.12/jstree.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-gray-50 font-sans antialiased">
    <div class="flex h-screen overflow-hidden">
        {{-- Sidebar --}}
        @include('partials.sidebar')

        {{-- Main content --}}
        <div class="flex-1 flex flex-col overflow-y-auto">
            @include('partials.navbar')


        </div>
    </div>



    {{-- Dropdown JS --}}
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

<script>
    document.getElementById('expandAll').addEventListener('click', () => {
      document.querySelectorAll('.collapse').forEach(el => new bootstrap.Collapse(el, {show: true}));
    });
    document.getElementById('collapseAll').addEventListener('click', () => {
      document.querySelectorAll('.collapse.show').forEach(el => new bootstrap.Collapse(el, {toggle: true}));
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
@stack('scripts')
</body>
</html>
