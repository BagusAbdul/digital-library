<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::with(['user', 'buku'])->latest()->get();
        return view('admin.peminjaman.index', compact('peminjamans'));
    }

    public function create()
    {
        $users = User::whereHas('role', function($q) {
            $q->where('nama_role', 'Peminjam');
        })->get();

        $bukus = Buku::where('stok', '>', 0)->get();

        return view('admin.peminjaman.create', compact('users', 'bukus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id'              => 'required|exists:users,id',
            'buku_id'              => 'required|exists:buku,id',
            'tanggal_peminjaman'   => 'required|date',
            'tanggal_pengembalian' => 'required|date|after_or_equal:tanggal_peminjaman',
        ]);

        // Catatan: Tidak perlu $buku->decrement() karena sudah ditangani Database Trigger
        Peminjaman::create([
            'user_id'              => $request->user_id,
            'buku_id'              => $request->buku_id,
            'tanggal_peminjaman'   => $request->tanggal_peminjaman,
            'tanggal_pengembalian' => $request->tanggal_pengembalian,
            'status_peminjaman'    => 'dipinjam', // Menggunakan lowercase sesuai Enum DB
        ]);

        return redirect()->route('peminjaman.index')->with('success', 'Transaksi peminjaman berhasil dicatat.');
    }

    public function edit(Peminjaman $peminjaman)
    {
        return view('admin.peminjaman.edit', compact('peminjaman'));
    }

    public function update(Request $request, Peminjaman $peminjaman)
    {
        $request->validate([
            'status_peminjaman' => 'required|in:dipinjam,dikembalikan,terlambat',
        ]);

        // Catatan: Tidak perlu $buku->increment() manual karena Trigger DB otomatis menambah stok
        // saat status berubah dari 'dipinjam' ke 'dikembalikan'.
        $peminjaman->update([
            'status_peminjaman' => $request->status_peminjaman
        ]);

        return redirect()->route('peminjaman.index')->with('success', 'Status peminjaman berhasil diperbarui.');
    }

    public function destroy(Peminjaman $peminjaman)
    {
        // Karena Trigger DB hanya menangani INSERT dan UPDATE,
        // stok dikembalikan manual hanya jika data dihapus saat status masih 'dipinjam'
        if ($peminjaman->status_peminjaman === 'dipinjam') {
            $buku = Buku::find($peminjaman->buku_id);
            if ($buku) {
                $buku->increment('stok');
            }
        }

        $peminjaman->delete();
        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil dihapus.');
    }
}
