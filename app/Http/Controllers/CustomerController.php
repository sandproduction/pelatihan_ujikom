<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    // Tampilkan semua anggota
    public function index()
    {
        $customers = Customer::all();
        return view('customer.index', compact('customers'));
    }

    public function create()
    {
        return view('customer.create');
    }

    // Simpan data anggota baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_customer' => 'required|string|max:100',
            'alamat' => 'required|string|max:255',
            'telp' => 'required|string|max:12',
            'fax' => 'required|string|unique:customer',
            'email' => 'required|email|unique:customer',
        ]);

        $last = Customer::selectRaw("MAX(CAST(SUBSTRING(id_customer, 4) AS UNSIGNED)) as max_id")->first();
        $nextNumber = $last && $last->max_id ? $last->max_id + 1 : 1;
        $idCustomer = 'CUM' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        Customer::create([
            'id_customer' => $idCustomer,    
            'nama_customer' => $request->nama_customer,    
            'alamat' => $request->alamat,    
            'telp' => $request->telp,    
            'fax' => $request->fax,    
            'email' => $request->email,    
        ]);
        return redirect()->route('customer.index')->with('success', 'Customer berhasil ditambahkan.');
    }

    // Tampilkan form edit anggota
    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('customer.edit', compact('customer'));
    }

    // Update data anggota
    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);

        $request->validate([
            'nama_customer' => 'required|string|max:100',
            'alamat' => 'required|string|max:255',
            'telp' => 'required|string|max:12',
            'fax' => 'required|string|unique:customer,fax,' . $customer->id_customer . ',id_customer',
            'email' => 'required|email|unique:customer,email,' . $customer->id_customer . ',id_customer',
        ]);

        $customer->update($request->all());
        return redirect()->route('customer.index')->with('success', 'Customer berhasil diupdate.');
    }

    // Hapus anggota
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();
        return redirect()->route('customer.index')->with('success', 'Customer berhasil dihapus.');
    }
}
