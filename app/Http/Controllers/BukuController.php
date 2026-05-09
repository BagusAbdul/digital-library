<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\KategoriBuku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    public function index()
    {
        $bukus = Buku::with('kategori')->latest()->get();
        return view('admin.buku.index', compact('bukus'));
    }

    public function create()
    {
        $kategoris = KategoriBuku::all();
        return view('admin.buku.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'        => 'required|string|max:255',
            'penulis'      => 'required|string|max:255',
            'penerbit'     => 'required|string|max:255',
            'tahun_terbit' => 'required|numeric|digits:4',
            'stok'         => 'required|numeric|min:0',
            'kategori_ids' => 'required|array',
            'deskripsi'    => 'nullable|string',
            'cover'        => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')->store('covers', 'public');
        }

        $buku = Buku::create($data);
        $buku->kategori()->sync($request->kategori_ids);

        return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    public function edit(Buku $buku)
    {
        $kategoris = KategoriBuku::all();
        $selectedKategori = $buku->kategori->pluck('id')->toArray();
        return view('admin.buku.edit', compact('buku', 'kategoris', 'selectedKategori'));
    }

    public function update(Request $request, Buku $buku)
    {
        $request->validate([
            'judul'        => 'required|string|max:255',
            'penulis'      => 'required|string|max:255',
            'penerbit'     => 'required|string|max:255',
            'tahun_terbit' => 'required|numeric|digits:4',
            'stok'         => 'required|numeric|min:0',
            'kategori_ids' => 'required|array',
            'deskripsi'    => 'nullable|string',
            'cover'        => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('cover')) {
            // Hapus file lama jika ada
            if ($buku->cover) {
                Storage::disk('public')->delete($buku->cover);
            }
            $data['cover'] = $request->file('cover')->store('covers', 'public');
        } else {
            // Jika tidak upload baru, tetap gunakan cover lama
            $data['cover'] = $buku->cover;
        }

        $buku->update($data);
        $buku->kategori()->sync($request->kategori_ids);

        // Pastikan redirect ke index dengan pesan sukses
        return redirect()->route('buku.index')->with('success', 'Data buku berhasil diperbarui.');
    }

    public function destroy(Buku $buku)
    {
        if ($buku->cover) {
            Storage::disk('public')->delete($buku->cover);
        }
        $buku->delete();
        return redirect()->route('buku.index')->with('success', 'Buku berhasil dihapus.');
    }
}
