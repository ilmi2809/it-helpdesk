<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - KCIC Helpdesk</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-[Inter]">
    <div class="flex min-h-screen">
        @include('partials.sidebar')
        <main class="flex-1 p-6">
            <div class="max-w-4xl mx-auto py-10">
                <div class="bg-white shadow p-6 rounded-lg flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-semibold text-gray-700">Dashboard</h1>
                    <img src="/images/kcic_logo.png" class="h-10" alt="Logo">
                </div>
                <div class="bg-white p-6 rounded-lg shadow">
                    <p class="text-lg">Halo, <strong>{{ auth()->user()->name }}</strong>! Anda login sebagai <strong>{{ auth()->user()->role }}</strong>.</p>
                </div>
            </div>
        </main>
    </div>
    </body>
</html>
