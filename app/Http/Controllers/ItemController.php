<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();
        return view('item.index', compact('items'));
    }

    public function create()
    {
        return view('item.create');
    }

    // Simpan data anggota baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_item' => 'required|string|max:100',
            'uom' => 'required|string|max:255',
            'harga_beli' => 'required|int',
            'harga_jual' => 'required|int',
        ]);

        $last = Item::selectRaw("MAX(CAST(SUBSTRING(id_item, 4) AS UNSIGNED)) as max_id")->first();
        $nextNumber = $last && $last->max_id ? $last->max_id + 1 : 1;
        $idItem = 'ITM' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        Item::create([
            'id_item' => $idItem,    
            'nama_item' => $request->nama_item,    
            'uom' => $request->uom,    
            'harga_beli' => $request->harga_beli,    
            'harga_jual' => $request->harga_jual,    
        ]);
        return redirect()->route('item.index')->with('success', 'item berhasil ditambahkan.');
    }

    // Tampilkan form edit anggota
    public function edit($id)
    {
        $item = Item::findOrFail($id);
        return view('item.edit', compact('item'));
    }

    // Update data anggota
    public function update(Request $request, $id)
    {
        $item = Item::findOrFail($id);

        $request->validate([
            'nama_item' => 'required|string|max:100',
            'uom' => 'required|string|max:255',
            'harga_beli' => 'required|int',
            'harga_jual' => 'required|int',
        ]);

        $item->update($request->all());
        return redirect()->route('item.index')->with('success', 'item berhasil diupdate.');
    }

    // Hapus anggota
    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();
        return redirect()->route('item.index')->with('success', 'item berhasil dihapus.');
    }
}
