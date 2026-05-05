@extends('layouts.app')
@section('title', 'Tambah User')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100">
        <div class="flex items-center space-x-3 mb-6">
            <a href="{{ route('users.index') }}" class="text-gray-400 hover:text-blue-600">
                <i class="ph ph-arrow-left text-2xl"></i>
            </a>
            <h3 class="font-bold text-gray-800 text-xl">Tambah Pengguna Baru</h3>
        </div>

        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="md:col-span-2">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Role</label>
                    <select name="role_id" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-400 outline-none" required>
                        <option value="">-- Pilih Role --</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->nama_role }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-400" required value="{{ old('nama_lengkap') }}">
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Username</label>
                    <input type="text" name="username" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-400" required>
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                    <input type="email" name="email" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-400" required>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                    <input type="password" name="password" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-400" required>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Alamat</label>
                    <textarea name="alamat" rows="3" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-400" required>{{ old('alamat') }}</textarea>
                </div>
            </div>

            <div class="mt-8 flex space-x-3">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                    Simpan User
                </button>
                <a href="{{ route('users.index') }}" class="bg-gray-100 text-gray-600 px-6 py-2 rounded-lg hover:bg-gray-200 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
