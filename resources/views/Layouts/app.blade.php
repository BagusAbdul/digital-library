<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Pusda Digital</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body class="bg-gray-50 font-sans">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-blue-900 text-white flex-shrink-0 hidden md:flex flex-col">
            <div class="p-6 text-2xl font-bold border-b border-blue-800">
                Pusda Digital
            </div>
            <nav class="flex-1 p-4 space-y-2">
                @include('layouts.partials.sidebar')
            </nav>
            <div class="p-4 border-t border-blue-800">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="flex items-center space-x-2 w-full p-2 hover:bg-red-600 rounded transition">
                        <i class="ph ph-sign-out text-xl"></i>
                        <span>Keluar</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Navbar -->
            <header class="bg-white shadow-sm h-16 flex items-center justify-between px-8">
                <h1 class="text-xl font-semibold text-gray-800">@yield('title')</h1>
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-gray-600 italic">{{ auth()->user()->role->nama_role }}</span>
                    <div class="h-8 w-8 rounded-full bg-blue-600 flex items-center justify-center text-white font-bold">
                        {{ substr(auth()->user()->nama_lengkap, 0, 1) }}
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="p-8">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
