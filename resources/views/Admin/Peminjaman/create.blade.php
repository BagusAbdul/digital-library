@extends('layouts.app')
@section('title', 'Catat Peminjaman')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100">
        <div class="flex items-center space-x-3 mb-6">
            <a href="{{ route('peminjaman.index') }}" class="text-gray-400 hover:text-blue-600">
                <i class="ph ph-arrow-left text-2xl"></i>
            </a>
            <h3 class="font-bold text-gray-800 text-xl">Catat Peminjaman Baru</h3>
        </div>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <strong class="font-bold">Terjadi kesalahan!</strong>
                <ul class="mt-2 list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('peminjaman.store') }}" method="POST">
            @csrf
            <div class="space-y-5">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Pilih Anggota (Peminjam)</label>
                    <select name="user_id" class="w-full p-2.5 border rounded-lg focus:ring-2 focus:ring-blue-400 outline-none" required>
                        <option value="">-- Pilih Anggota --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->nama_lengkap }} (@ {{ $user->username }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Pilih Buku</label>
                    <select name="buku_id" class="w-full p-2.5 border rounded-lg focus:ring-2 focus:ring-blue-400 outline-none" required>
                        <option value="">-- Pilih Buku --</option>
                        @foreach($bukus as $buku)
                            <option value="{{ $buku->id }}" {{ old('buku_id') == $buku->id ? 'selected' : '' }}>
                                {{ $buku->judul }} (Stok Tersedia: {{ $buku->stok }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Tanggal Peminjaman</label>
                        <input type="date" name="tanggal_peminjaman" value="{{ old('tanggal_peminjaman', date('Y-m-d')) }}" class="w-full p-2.5 border rounded-lg focus:ring-2 focus:ring-blue-400 outline-none" required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Tanggal Pengembalian</label>
                        <input type="date" name="tanggal_pengembalian" value="{{ old('tanggal_pengembalian', date('Y-m-d', strtotime('+7 days'))) }}" class="w-full p-2.5 border rounded-lg focus:ring-2 focus:ring-blue-400 outline-none" required>
                    </div>
                </div>
            </div>

            <div class="mt-8 pt-6 border-t flex space-x-3">
                <button type="submit" class="bg-blue-600 text-white px-8 py-2.5 rounded-lg font-bold hover:bg-blue-700">Simpan Transaksi</button>
                <a href="{{ route('peminjaman.index') }}" class="bg-gray-100 text-gray-600 px-8 py-2.5 rounded-lg">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
