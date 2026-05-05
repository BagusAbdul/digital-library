<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Pusda Digital</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen py-10">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold mb-2 text-center text-blue-600">Daftar Anggota</h2>
        <p class="text-gray-500 text-center mb-6 text-sm">Lengkapi data untuk mulai meminjam buku</p>

        <form action="{{ route('register.store') }}" method="POST">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-1">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-400 outline-none" required value="{{ old('nama_lengkap') }}">
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-1">Username</label>
                    <input type="text" name="username" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-400 outline-none" required>
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-1">Email</label>
                    <input type="email" name="email" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-400 outline-none" required>
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-1">Password</label>
                    <input type="password" name="password" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-400 outline-none" required>
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-1">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-400 outline-none" required>
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-1">Alamat</label>
                    <textarea name="alamat" rows="2" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-400 outline-none" required>{{ old('alamat') }}</textarea>
                </div>
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded mt-6 hover:bg-blue-700 transition">
                Daftar Sekarang
            </button>
            <p class="text-center text-sm mt-4 text-gray-600">
                Sudah punya akun? <a href="{{ route('login') }}" class="text-blue-600 font-bold">Login</a>
            </p>
        </form>
    </div>
</body>
</html>
