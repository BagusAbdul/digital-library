@php
    $rawRole = auth()->user()->role->nama_role;
    $roleRoute = match($rawRole) {
        'Administrator' => 'admin',
        'Petugas'       => 'petugas',
        'Peminjam'      => 'peminjam',
        default         => '',
    };
@endphp

<!-- Shared Menu -->
<a href="{{ route($roleRoute . '.dashboard') }}" class="flex items-center space-x-3 p-2 rounded hover:bg-blue-800 {{ request()->routeIs('*.dashboard') ? 'bg-blue-800' : '' }}">
    <i class="ph ph-house text-xl"></i>
    <span>Dashboard</span>
</a>

@if($roleRoute == 'admin' || $roleRoute == 'Petugas')
    <div class="text-xs uppercase text-blue-400 font-bold mt-4 mb-2 px-2">Data Master</div>
    <a href="{{ route('kategori.index') }}" class="flex items-center space-x-3 p-2 rounded hover:bg-blue-800 {{ request()->routeIs('kategori.*') ? 'bg-blue-800' : '' }}">
        <i class="ph ph-tag text-xl"></i>
        <span>Kategori Buku</span>
    </a>

    <a href="{{ route('buku.index') }}" class="flex items-center space-x-3 p-2 rounded hover:bg-blue-800 {{ request()->routeIs('buku.*') ? 'bg-blue-800' : '' }}">
        <i class="ph ph-books text-xl"></i>
        <span>Data Buku</span>
    </a>
@endif

@if($roleRoute == 'admin')
    <a href="{{ route('users.index') }}" class="flex items-center space-x-3 p-2 rounded hover:bg-blue-800">
        <i class="ph ph-users text-xl"></i>
        <span>Kelola User</span>
    </a>
@endif

<div class="text-xs uppercase text-blue-400 font-bold mt-4 mb-2 px-2">Transaksi</div>
    <a href="{{ route('peminjaman.index') }}" class="flex items-center space-x-3 p-2 rounded hover:bg-blue-800 {{ request()->routeIs('peminjaman.*') ? 'bg-blue-800' : '' }}">
        <i class="ph ph-hand-pointing text-xl"></i>
        <span>Peminjaman</span>
    </a>

@if($roleRoute == 'admin' || $roleRoute == 'Petugas')
    <a href="#" class="flex items-center space-x-3 p-2 rounded hover:bg-blue-800">
        <i class="ph ph-file-text text-xl"></i>
        <span>Laporan</span>
    </a>
@endif
