@extends('layouts.app')
@section('title', 'Edit Buku')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100">
        <h3 class="font-bold text-gray-800 text-xl mb-6">Edit Data Buku</h3>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <strong class="font-bold">Periksa kembali inputan Anda:</strong>
                <ul class="mt-2 list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('buku.update', $buku->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="md:col-span-2 flex items-center space-x-6 p-4 bg-gray-50 rounded-lg">
                    <div class="shrink-0">
                        @if($buku->cover)
                            <img src="{{ asset('storage/'.$buku->cover) }}" class="h-24 w-20 object-cover rounded shadow-md">
                        @else
                            <div class="h-24 w-20 bg-gray-200 rounded flex items-center justify-center text-xs">No Cover</div>
                        @endif
                    </div>
                    <label class="block w-full">
                        <span class="text-sm font-bold text-gray-700">Ganti Sampul (Opsional)</span>
                        <input type="file" name="cover" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-blue-50 file:text-blue-700 mt-2">
                    </label>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-gray-700 mb-1">Judul Buku</label>
                    <input type="text" name="judul" value="{{ old('judul', $buku->judul) }}" class="w-full p-2.5 border rounded-lg focus:ring-2 focus:ring-blue-400 outline-none" required>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Penulis</label>
                    <input type="text" name="penulis" value="{{ old('penulis', $buku->penulis) }}" class="w-full p-2.5 border rounded-lg focus:ring-2 focus:ring-blue-400 outline-none" required>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Penerbit</label>
                    <input type="text" name="penerbit" value="{{ old('penerbit', $buku->penerbit) }}" class="w-full p-2.5 border rounded-lg focus:ring-2 focus:ring-blue-400 outline-none" required>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Tahun Terbit</label>
                    <input type="number" name="tahun_terbit" value="{{ old('tahun_terbit', $buku->tahun_terbit) }}" class="w-full p-2.5 border rounded-lg focus:ring-2 focus:ring-blue-400 outline-none" required>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Stok</label>
                    <input type="number" name="stok" value="{{ old('stok', $buku->stok) }}" class="w-full p-2.5 border rounded-lg focus:ring-2 focus:ring-blue-400 outline-none" required>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-gray-700 mb-1">Kategori</label>
                    <select name="kategori_ids[]" class="w-full p-2.5 border rounded-lg h-32 focus:ring-2 focus:ring-blue-400 outline-none" multiple required>
                        @foreach($kategoris as $k)
                            <option value="{{ $k->id }}" {{ in_array($k->id, old('kategori_ids', $selectedKategori)) ? 'selected' : '' }}>{{ $k->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-gray-700 mb-1">Deskripsi</label>
                    <textarea name="deskripsi" rows="3" class="w-full p-2.5 border rounded-lg focus:ring-2 focus:ring-blue-400 outline-none">{{ old('deskripsi', $buku->deskripsi) }}</textarea>
                </div>
            </div>
            <div class="mt-8 pt-6 border-t flex space-x-3">
                <button type="submit" class="bg-blue-600 text-white px-8 py-2.5 rounded-lg font-bold hover:bg-blue-700 shadow-lg shadow-blue-200">Update Data</button>
                <a href="{{ route('buku.index') }}" class="bg-gray-100 text-gray-600 px-8 py-2.5 rounded-lg">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
