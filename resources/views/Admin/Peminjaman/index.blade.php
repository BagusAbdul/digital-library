@extends('layouts.app')
@section('title', 'Data Peminjaman')

@section('content')
<div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
    <div class="flex justify-between items-center mb-6">
        <h3 class="font-bold text-gray-800 text-xl">Transaksi Peminjaman</h3>
        <a href="{{ route('peminjaman.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
            + Catat Peminjaman
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
                    <th class="pb-3 px-2">Peminjam</th>
                    <th class="pb-3">Buku</th>
                    <th class="pb-3">Tgl Pinjam</th>
                    <th class="pb-3">Tgl Kembali</th>
                    <th class="pb-3">Status</th>
                    <th class="pb-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach($peminjamans as $p)
                <tr class="border-b last:border-0 hover:bg-gray-50">
                    <td class="py-4 px-2 font-medium text-gray-900">{{ $p->user->nama_lengkap ?? 'User Dihapus' }}</td>
                    <td class="py-4">{{ $p->buku->judul ?? 'Buku Dihapus' }}</td>
                    <td class="py-4 text-sm">{{ \Carbon\Carbon::parse($p->tanggal_peminjaman)->format('d M Y') }}</td>
                    <td class="py-4 text-sm">{{ \Carbon\Carbon::parse($p->tanggal_pengembalian)->format('d M Y') }}</td>
                    <td class="py-4">
                    @if($p->status_peminjaman == 'dipinjam')
                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-bold uppercase">Dipinjam</span>
                        @elseif($p->status_peminjaman == 'dikembalikan')
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold uppercase">Dikembalikan</span>
                        @else
                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-bold uppercase">{{ $p->status_peminjaman }}</span>
                    @endif
                    </td>
                    <td class="py-4 text-right">
                        <div class="flex justify-end space-x-2">
                            <a href="{{ route('peminjaman.edit', $p->id) }}" class="text-blue-600 p-2 hover:bg-blue-50 rounded" title="Edit/Kembalikan">
                                <i class="ph ph-pencil"></i>
                            </a>
                            <form action="{{ route('peminjaman.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Hapus data transaksi ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 p-2 hover:bg-red-50 rounded" title="Hapus"><i class="ph ph-trash"></i></button>
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
