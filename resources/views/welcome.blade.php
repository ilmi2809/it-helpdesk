<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Welcome to IT Helpdesk KCIC</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 font-[Inter]">
    <div class="min-h-screen flex flex-col justify-center items-center text-center px-6">
        <img src="{{ asset('images/kcic_logo.png') }}" class="h-20 mb-6" alt="KCIC Logo">

        <h1 class="text-3xl font-bold mb-4">Selamat Datang di Sistem IT Helpdesk KCIC</h1>
        <p class="mb-8 text-gray-600">Silakan login untuk melanjutkan ke sistem pelaporan dan penanganan tiket IT.</p>

        <a href="{{ route('login') }}"
           class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-xl text-lg transition duration-200">
            Login ke Sistem
        </a>
    </div>
</body>
</html>
