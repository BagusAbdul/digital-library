@extends('layouts.app')
@section('title', 'Daftar Buku')

@section('content')
<div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
    <div class="flex justify-between items-center mb-6">
        <h3 class="font-bold text-gray-800 text-xl">Koleksi Buku</h3>
        <a href="{{ route('buku.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
            + Tambah Buku
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="text-gray-400 text-sm uppercase border-b">
                    <th class="pb-3 px-2">Sampul</th>
                    <th class="pb-3">Judul & Penulis</th>
                    <th class="pb-3">Deskripsi</th>
                    <th class="pb-3">Kategori</th>
                    <th class="pb-3">Stok</th>
                    <th class="pb-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach($bukus as $b)
                <tr class="border-b last:border-0 hover:bg-gray-50">
                    <td class="py-4 px-2">
                        @if($b->cover)
                            <img src="{{ asset('storage/'.$b->cover) }}" class="w-12 h-16 object-cover rounded shadow-sm">
                        @else
                            <div class="w-12 h-16 bg-gray-100 flex items-center justify-center rounded text-[10px]">No Cover</div>
                        @endif
                    </td>
                    <td class="py-4">
                        <div class="font-bold text-gray-900">{{ $b->judul }}</div>
                        <div class="text-xs text-gray-500">{{ $b->penulis }}</div>
                    </td>
                    <td class="py-4 text-sm text-gray-500">
                        {{ \Illuminate\Support\Str::limit($b->deskripsi, 50, '...') }}
                    </td>
                    <td class="py-4">
                        @foreach($b->kategori as $k)
                            <span class="text-[10px] bg-blue-100 text-blue-600 px-2 py-0.5 rounded-full">{{ $k->nama_kategori }}</span>
                        @endforeach
                    </td>
                    <td class="py-4 text-sm font-medium">{{ $b->stok }} eks</td>
                    <td class="py-4 text-right">
                        <div class="flex justify-end space-x-2">
                            <a href="{{ route('buku.edit', $b->id) }}" class="text-blue-600 p-2 hover:bg-blue-50 rounded"><i class="ph ph-pencil"></i></a>
                            <form action="{{ route('buku.destroy', $b->id) }}" method="POST" onsubmit="return confirm('Hapus buku ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 p-2 hover:bg-red-50 rounded"><i class="ph ph-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
