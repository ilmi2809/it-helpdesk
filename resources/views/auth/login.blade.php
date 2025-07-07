<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - KCIC Helpdesk</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-[Inter]">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white shadow-lg rounded-2xl p-8 w-full max-w-md">
            <div class="flex justify-center mb-6">
                <img src="/images/kcic_logo.png" alt="KCIC Logo" class="h-12">
            </div>
            <h2 class="text-xl font-semibold text-center text-gray-700 mb-6">Login ke IT Helpdesk</h2>
            @if($errors->any())
                <div class="text-red-500 text-sm mb-4">{{ $errors->first() }}</div>
            @endif
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Email</label>
                    <input type="email" name="email" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-medium mb-1">Password</label>
                    <input type="password" name="password" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
                </div>
                <button class="w-full bg-red-600 text-white font-semibold py-2 rounded-lg hover:bg-red-700 transition">Login</button>
            </form>
        </div>
    </div>
</body>
</html>
