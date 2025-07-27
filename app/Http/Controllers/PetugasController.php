<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Petugas;
use App\Models\Level;
use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller
{
    public function index()
    {
        $petugas = Petugas::with('level')->get();
        return view('petugas.index', compact('petugas'));
    }

    public function create()
    {
        $levels = Level::all();
        return view('petugas.create', compact('levels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_user' => 'required|string',
            'username' => 'required|string|unique:petugas',
            'password' => 'required|string|min:6',
            'level' => 'required|exists:level,id_level',
        ]);
        
        $last = Petugas::selectRaw("MAX(CAST(SUBSTRING(id_user, 4) AS UNSIGNED)) as max_id")->first();
        $nextNumber = $last && $last->max_id ? $last->max_id + 1 : 1;
        $idPetugas = 'PTG' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        Petugas::create([
            'id_user' => $idPetugas,
            'nama_user' => $request->nama_user,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'level' => $request->level,
        ]);

        return redirect()->route('petugas.index')->with('success', 'Petugas berhasil ditambahkan');
    }

    public function edit($id)
    {
        $petugas = Petugas::findOrFail($id);
        $levels = Level::all();
        return view('petugas.edit', compact('petugas', 'levels'));
    }

    public function update(Request $request, $id)
    {
        $petugas = Petugas::findOrFail($id);

        $request->validate([
            'nama_user' => 'required|string',
            'username' => 'required|string',
            'password' => 'nullable|string|min:6',
            'level' => 'required|exists:level,id_level',
        ]);

        $petugas->nama_user = $request->nama_user;
        $petugas->username = $request->username;
        $petugas->level = $request->level;

        if ($request->password) {
            $petugas->password = Hash::make($request->password);
        }

        $petugas->save();

        return redirect()->route('petugas.index')->with('success', 'Petugas berhasil diperbarui');
    }

    public function destroy($id)
    {
        $petugas = Petugas::findOrFail($id);
        $petugas->delete();

        return redirect()->route('petugas.index')->with('success', 'Petugas berhasil dihapus');
    }
}
