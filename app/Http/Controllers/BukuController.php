<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    // Tampilkan semua anggota
    public function index()
    {
        $bukus = Buku::all();
        return view('buku.index', compact('bukus'));
    }

    public function create()
    {
        return view('buku.create');
    }

    // Simpan data buku baru
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:100',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahun_terbit' => 'required|int',
            'stok' => 'required|int',
        ]);

        Buku::create($request->all());
        return redirect()->route('buku.index')->with('success', 'buku berhasil ditambahkan.');
    }

    // Tampilkan form edit buku
    public function edit($id)
    {
        $buku = Buku::findOrFail($id);
        return view('buku.edit', compact('buku'));
    }

    // Update data buku
    public function update(Request $request, $id)
    {
        $Buku = Buku::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:100',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahun_terbit' => 'required|int',
            'stok' => 'required|int',
        ]);

        $Buku->update($request->all());
        return redirect()->route('buku.index')->with('success', 'buku berhasil diupdate.');
    }

    // Hapus buku
    public function destroy($id)
    {
        $Buku = Buku::findOrFail($id);
        $Buku->delete();
        return redirect()->route('buku.index')->with('success', 'buku berhasil dihapus.');
    }
}
