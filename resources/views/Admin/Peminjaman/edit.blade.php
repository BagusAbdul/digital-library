@extends('layouts.app')
@section('title', 'Update Status Peminjaman')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100">
        <div class="flex items-center space-x-3 mb-6">
            <a href="{{ route('peminjaman.index') }}" class="text-gray-400 hover:text-blue-600">
                <i class="ph ph-arrow-left text-2xl"></i>
            </a>
            <h3 class="font-bold text-gray-800 text-xl">Update Status Peminjaman</h3>
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

        <div class="bg-blue-50 p-4 rounded-lg mb-6 border border-blue-100">
            <div class="grid grid-cols-2 gap-4 text-sm text-gray-700">
                <div>
                    <span class="block font-bold text-gray-500 mb-1">Nama Peminjam:</span>
                    {{ $peminjaman->user->nama_lengkap ?? '-' }}
                </div>
                <div>
                    <span class="block font-bold text-gray-500 mb-1">Buku yang dipinjam:</span>
                    {{ $peminjaman->buku->judul ?? '-' }}
                </div>
                <div>
                    <span class="block font-bold text-gray-500 mb-1">Tanggal Pinjam:</span>
                    {{ \Carbon\Carbon::parse($peminjaman->tanggal_peminjaman)->format('d F Y') }}
                </div>
                <div>
                    <span class="block font-bold text-gray-500 mb-1">Batas Kembali:</span>
                    {{ \Carbon\Carbon::parse($peminjaman->tanggal_pengembalian)->format('d F Y') }}
                </div>
            </div>
        </div>

        <form action="{{ route('peminjaman.update', $peminjaman->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label class="block text-sm font-bold text-gray-700 mb-2">Ubah Status</label>
                <select name="status_peminjaman" class="w-full p-2.5 border rounded-lg focus:ring-2 focus:ring-blue-400 outline-none font-bold" required>
                    <option value="dipinjam" {{ $peminjaman->status_peminjaman == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                    <option value="dikembalikan" {{ $peminjaman->status_peminjaman == 'dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                    <option value="terlambat" {{ $peminjaman->status_peminjaman == 'terlambat' ? 'selected' : '' }}>Terlambat</option>
                </select>
                <p class="text-xs text-gray-500 mt-2">*Mengubah status ke "Dikembalikan" akan otomatis menambah stok buku.</p>
            </div>

            <div class="mt-8 pt-6 border-t flex space-x-3">
                <button type="submit" class="bg-blue-600 text-white px-8 py-2.5 rounded-lg font-bold hover:bg-blue-700 shadow-lg shadow-blue-200">Update Status</button>
                <a href="{{ route('peminjaman.index') }}" class="bg-gray-100 text-gray-600 px-8 py-2.5 rounded-lg">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
