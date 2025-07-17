<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans antialiased">
<div class="flex h-screen">
    @include('partials.sidebar')
    @include('partials.navbar')
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
