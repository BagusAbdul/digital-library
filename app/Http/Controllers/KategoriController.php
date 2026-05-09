<?php

namespace App\Http\Controllers;

use App\Models\KategoriBuku;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = KategoriBuku::all();
        return view('admin.kategori.index', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate(['nama_kategori' => 'required']);
        KategoriBuku::create($request->all());
        return back()->with('success', 'Kategori berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate(['nama_kategori' => 'required|nama_kategori,'.$id]);
        $kategori = KategoriBuku::findOrFail($id);
        $kategori->update($request->all());
        return back()->with('success', 'Kategori berhasil diubah');
    }

    public function destroy($id)
    {
        KategoriBuku::findOrFail($id)->delete();
        return back()->with('success', 'Kategori berhasil dihapus');
    }
}
