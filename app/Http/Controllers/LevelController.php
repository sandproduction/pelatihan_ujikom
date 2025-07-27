<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Level;

class LevelController extends Controller
{
    public function index()
    {
        $levels = Level::all();
        return view('level.index', compact('levels'));
    }

    public function create()
    {
        return view('level.create');
    }

    // Simpan data anggota baru
    public function store(Request $request)
    {
        $request->validate([
            'level' => 'required|string|max:50',
        ]);

        $last = Level::selectRaw("MAX(CAST(SUBSTRING(id_level, 4) AS UNSIGNED)) as max_id")->first();
        $nextNumber = $last && $last->max_id ? $last->max_id + 1 : 1;
        $idlevel = 'LVL' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        Level::create([
            'id_level' => $idlevel,    
            'level' => $request->level,      
        ]);
        return redirect()->route('level.index')->with('success', 'level berhasil ditambahkan.');
    }

    // Tampilkan form edit anggota
    public function edit($id)
    {
        $level = Level::findOrFail($id);
        return view('level.edit', compact('level'));
    }

    // Update data anggota
    public function update(Request $request, $id)
    {
        $level = Level::findOrFail($id);

        $request->validate([
            'level' => 'required|string|max:50',
        ]);

        $level->update($request->all());
        return redirect()->route('level.index')->with('success', 'level berhasil diupdate.');
    }

    // Hapus anggota
    public function destroy($id)
    {
        $level = Level::findOrFail($id);
        $level->delete();
        return redirect()->route('level.index')->with('success', 'level berhasil dihapus.');
    }
}
