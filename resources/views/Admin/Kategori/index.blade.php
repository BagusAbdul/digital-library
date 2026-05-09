@extends('layouts.app')
@section('title', 'Kategori Buku')

@section('content')
<div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
    <div class="flex justify-between items-center mb-6">
        <h3 class="font-bold text-gray-800 text-xl">Daftar Kategori</h3>
        <button onclick="document.getElementById('modal-tambah').classList.remove('hidden')" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
            + Tambah Kategori
        </button>
    </div>

    <table class="w-full text-left">
        <thead>
            <tr class="text-gray-400 text-sm uppercase border-b">
                <th class="pb-3 w-16">No</th>
                <th class="pb-3">Nama Kategori</th>
                <th class="pb-3 text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="text-gray-600">
            @foreach($kategori as $k)
            <tr class="border-b last:border-0">
                <td class="py-4">{{ $loop->iteration }}</td>
                <td class="py-4">{{ $k->nama_kategori }}</td>
                <td class="py-4 text-right">
                    {{-- <button onclick="editKategori('{{ $k->id }}', '{{ $k->nama_kategori }}')" class="text-blue-600 hover:underline mr-3">Edit</button> --}}
                    <form action="{{ route('kategori.destroy', $k->id) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Hapus kategori ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div id="modal-tambah" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg w-96 shadow-xl">
        <h3 class="font-bold mb-4">Tambah Kategori</h3>
        <form action="{{ route('kategori.store') }}" method="POST">
            @csrf
            <input type="text" name="nama_kategori" class="w-full p-2 border rounded mb-4" placeholder="Nama Kategori" required>
            <div class="flex justify-end space-x-2">
                <button type="button" onclick="this.closest('#modal-tambah').classList.add('hidden')" class="bg-gray-200 px-4 py-2 rounded">Batal</button>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function editKategori(id, nama) {
        // Logika sederhana: ganti action form dan isi value untuk edit
        // Untuk UKK, Anda bisa membuat modal edit terpisah atau menggunakan JS ini
        const modal = document.getElementById('modal-tambah');
        modal.classList.remove('hidden');
        modal.querySelector('h3').innerText = 'Edit Kategori';
        modal.querySelector('form').action = `/kategori/${id}`;
        modal.querySelector('form').innerHTML += '@method("PUT")';
        modal.querySelector('input[name="nama_kategori"]').value = nama;
    }
</script>
@endsection
