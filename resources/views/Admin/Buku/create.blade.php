@extends('layouts.app')
@section('title', 'Tambah Buku')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100">
        <h3 class="font-bold text-gray-800 text-xl mb-6">Tambah Buku Baru</h3>

        {{-- Notifikasi Error --}}
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

        <form action="{{ route('buku.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Sampul Buku</label>
                    <input type="file" name="cover" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-blue-50 file:text-blue-700">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Judul Buku</label>
                    <input type="text" name="judul" value="{{ old('judul') }}" class="w-full p-2.5 border rounded-lg focus:ring-2 focus:ring-blue-400 outline-none" required>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Penulis</label>
                    <input type="text" name="penulis" value="{{ old('penulis') }}" class="w-full p-2.5 border rounded-lg focus:ring-2 focus:ring-blue-400 outline-none" required>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Penerbit</label>
                    <input type="text" name="penerbit" value="{{ old('penerbit') }}" class="w-full p-2.5 border rounded-lg focus:ring-2 focus:ring-blue-400 outline-none" required>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Tahun Terbit</label>
                    <input type="number" name="tahun_terbit" value="{{ old('tahun_terbit') }}" class="w-full p-2.5 border rounded-lg focus:ring-2 focus:ring-blue-400 outline-none" required>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Stok</label>
                    <input type="number" name="stok" value="{{ old('stok') }}" class="w-full p-2.5 border rounded-lg focus:ring-2 focus:ring-blue-400 outline-none" required>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Kategori</label>
                    <select name="kategori_ids[]" class="w-full p-2.5 border rounded-lg h-32 focus:ring-2 focus:ring-blue-400 outline-none" multiple required>
                        @foreach($kategoris as $k)
                            <option value="{{ $k->id }}" {{ collect(old('kategori_ids'))->contains($k->id) ? 'selected' : '' }}>{{ $k->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi</label>
                    <textarea name="deskripsi" rows="3" class="w-full p-2.5 border rounded-lg focus:ring-2 focus:ring-blue-400 outline-none">{{ old('deskripsi') }}</textarea>
                </div>
            </div>
            <div class="mt-8 pt-6 border-t flex space-x-3">
                <button type="submit" class="bg-blue-600 text-white px-8 py-2.5 rounded-lg font-bold hover:bg-blue-700">Simpan Buku</button>
                <a href="{{ route('buku.index') }}" class="bg-gray-100 text-gray-600 px-8 py-2.5 rounded-lg">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
