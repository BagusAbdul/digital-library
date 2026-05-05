@extends('layouts.app')
@section('title', 'Dashboard Petugas')

@section('content')
<!-- Welcome Section -->
<div class="mb-8">
    <h2 class="text-2xl font-bold text-gray-800">Selamat Bekerja, {{ auth()->user()->nama_lengkap }}!</h2>
    <p class="text-gray-600">Pantau aktivitas perpustakaan dan kelola transaksi hari ini.</p>
</div>

<!-- Statistik Ringkas -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <!-- Card Peminjaman Hari Ini -->
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center space-x-4">
        <div class="p-3 bg-orange-100 text-orange-600 rounded-lg">
            <i class="ph ph-hand-pointing text-2xl"></i>
        </div>
        <div>
            <p class="text-sm text-gray-500">Peminjaman Baru</p>
            <h3 class="text-xl font-bold text-gray-800">12</h3>
        </div>
    </div>

    <!-- Card Buku Kembali -->
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center space-x-4">
        <div class="p-3 bg-green-100 text-green-600 rounded-lg">
            <i class="ph ph-arrow-u-up-left text-2xl"></i>
        </div>
        <div>
            <p class="text-sm text-gray-500">Buku Dikembalikan</p>
            <h3 class="text-xl font-bold text-gray-800">8</h3>
        </div>
    </div>

    <!-- Card Anggota Baru -->
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center space-x-4">
        <div class="p-3 bg-purple-100 text-purple-600 rounded-lg">
            <i class="ph ph-user-plus text-2xl"></i>
        </div>
        <div>
            <p class="text-sm text-gray-500">Registrasi Peminjam</p>
            <h3 class="text-xl font-bold text-gray-800">5</h3>
        </div>
    </div>
</div>

<!-- Quick Actions Section -->
<div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
    <h3 class="font-bold text-gray-800 mb-4">Aksi Cepat</h3>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <a href="#" class="flex flex-col items-center p-4 border border-gray-100 rounded-lg hover:bg-blue-50 transition group">
            <i class="ph ph-plus-circle text-3xl text-blue-600 mb-2"></i>
            <span class="text-sm font-medium text-gray-700 group-hover:text-blue-700">Entry Peminjaman</span>
        </a>
        <a href="#" class="flex flex-col items-center p-4 border border-gray-100 rounded-lg hover:bg-blue-50 transition group">
            <i class="ph ph-book-open text-3xl text-blue-600 mb-2"></i>
            <span class="text-sm font-medium text-gray-700 group-hover:text-blue-700">Tambah Buku</span>
        </a>
        <a href="#" class="flex flex-col items-center p-4 border border-gray-100 rounded-lg hover:bg-blue-50 transition group">
            <i class="ph ph-identification-card text-3xl text-blue-600 mb-2"></i>
            <span class="text-sm font-medium text-gray-700 group-hover:text-blue-700">Daftar Anggota</span>
        </a>
        <a href="#" class="flex flex-col items-center p-4 border border-gray-100 rounded-lg hover:bg-blue-50 transition group">
            <i class="ph ph-printer text-3xl text-blue-600 mb-2"></i>
            <span class="text-sm font-medium text-gray-700 group-hover:text-blue-700">Cetak Laporan</span>
        </a>
    </div>
</div>
@endsection
