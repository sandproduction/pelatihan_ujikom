<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
        public function index()
    {
        $users = User::with('level')->get();
        return view('user.index', compact('users'));
    }

    public function create()
    {
        $levels = Level::all(); // Untuk dropdown pilihan role
        return view('user.create', compact('levels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'username' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'level' => 'required|exists:level,id_level'
        ]);
        //dd($request->nama);
        User::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'id_level' => $request->level,
        ]);

        return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $levels = Level::all(); // Untuk dropdown level
        return view('user.edit', compact('user', 'levels'));
    }

     public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'nama' => 'required|string',
            'username' => 'required|string',
            'email' => 'required|email',
            'password' => 'nullable|string|min:6',
            'level' => 'required|exists:level,id_level',
        ]);

        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->id_level = $request->level;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('user.index')->with('success', 'User berhasil diperbarui');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user.index')->with('success', 'User berhasil dihapus.');
    }
}
