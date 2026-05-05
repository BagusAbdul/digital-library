@extends('layouts.app')
@section('title', 'Kelola User')

@section('content')
<div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
    <div class="flex justify-between items-center mb-6">
        <h3 class="font-bold text-gray-800 text-xl">Daftar Pengguna</h3>
        <a href="{{ route('users.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
            + Tambah User
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="text-gray-400 text-sm uppercase border-b">
                    <th class="pb-3">Nama Lengkap</th>
                    <th class="pb-3">Username</th>
                    <th class="pb-3">Role</th>
                    <th class="pb-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach($users as $user)
                <tr class="border-b last:border-0">
                    <td class="py-4">{{ $user->nama_lengkap }}</td>
                    <td class="py-4">{{ $user->username }}</td>
                    <td class="py-4">
                        <span class="px-2 py-1 bg-gray-100 rounded text-xs">
                            {{ $user->role->nama_role }}
                        </span>
                    </td>
                    <td class="py-4">
                        <div class="flex space-x-2">
                            <a href="{{ route('users.edit', $user->id) }}" class="text-blue-600 hover:underline">Edit</a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Hapus</button>
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
