@extends('layouts.app')
@section('title', 'Admin Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-4 gap-6">
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Total Buku</p>
                <h3 class="text-2xl font-bold text-gray-800">1,240</h3>
            </div>
            <div class="p-3 bg-blue-100 text-blue-600 rounded-lg">
                <i class="ph ph-books text-2xl"></i>
            </div>
        </div>
    </div>
    <!-- Duplikat card untuk Total User, Peminjaman Aktif, dsb -->
</div>

<div class="mt-8 bg-white p-6 rounded-xl shadow-sm border border-gray-100">
    <h3 class="font-bold text-gray-800 mb-4">Aktivitas Terbaru</h3>
    <p class="text-gray-500 text-sm">Belum ada aktivitas baru hari ini.</p>
</div>
@endsection
