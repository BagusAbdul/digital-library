<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Perpustakaan Digital</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        <h2 class="text-2xl font-bold mb-6 text-center text-blue-600">Pusda Digital</h2>

        @error('loginError')
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4 text-sm">
                {{ $message }}
            </div>
        @enderror

        <form action="/login" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Username</label>
                <input type="text" name="username" class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400" required>
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                <input type="password" name="password" class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400" required>
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition duration-200">
                Masuk
            </button>
        </form>
        <p class="text-center text-sm mt-4 text-gray-600">
            Belum punya akun? <a href="{{ route('register') }}" class="text-blue-600 font-bold">Daftar</a>
        </p>
    </div>
</body>
</html>
