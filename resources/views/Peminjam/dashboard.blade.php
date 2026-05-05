@extends('layouts.app')
@section('title', 'Dashboard Peminjam')

@section('content')
<div class="bg-blue-600 rounded-2xl p-8 text-white mb-8">
    <h2 class="text-2xl font-bold">Halo, {{ auth()->user()->nama_lengkap }}!</h2>
    <p class="mt-2 opacity-90">Mau baca buku apa hari ini? Cari koleksi terbaik kami.</p>
</div>

<h3 class="font-bold text-gray-800 mb-4 text-xl">Buku yang Sedang Anda Pinjam</h3>
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-white p-4 rounded-lg shadow-sm border text-center py-10">
        <p class="text-gray-400">Anda tidak sedang meminjam buku.</p>
    </div>
</div>
@endsection
