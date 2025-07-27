<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Sales;
use Carbon\Carbon;

class SalesController extends Controller
{
    private function generateDONumber()
    {
        $latest = Sales::orderBy('id_sales', 'desc')->first();
        $latestNumber = $latest ? intval(substr($latest->id_sales, 3)) + 1 : 1;

        $date = Carbon::now();
        $day = $date->format('d');
        $month = $this->convertToRoman($date->format('m'));
        $year = $date->format('Y');

        return sprintf("%02d/DO/%s/%s/%s", $latestNumber, $day, $month, $year);
    }

    private function convertToRoman($month)
    {
        $romawi = [
            1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV',
            5 => 'V', 6 => 'VI', 7 => 'VII', 8 => 'VIII',
            9 => 'IX', 10 => 'X', 11 => 'XI', 12 => 'XII'
        ];
        return $romawi[(int)$month];
    }

    public function index()
    {
        $sales = Sales::with('customer')->get();
        return view('sales.index', compact('sales'));
    }

    public function create()
    {
        $customers = Customer::all();
        return view('sales.create', compact('customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tgl_sales' => 'required|date',
            'id_customer' => 'required|exists:customer,id_customer',
            'status' => 'required|in:Lunas,Belum Lunas'
        ]);

        $last = Sales::selectRaw("MAX(CAST(SUBSTRING(id_sales, 4) AS UNSIGNED)) as max_id")->first();
        $nextNumber = $last && $last->max_id ? $last->max_id + 1 : 1;
        $idSales = 'INV' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
             
        Sales::create([
            'id_sales' => $idSales,
            'tgl_sales' => $request->tgl_sales,
            'id_customer' => $request->id_customer,
            'do_number' => $this->generateDONumber(),
            'status' => $request->status,
        ]);

        return redirect()->route('sales.index')->with('success', 'Data penjualan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $sales = Sales::findOrFail($id);
        $customers = Customer::all();
        return view('sales.edit', compact('sales', 'customers'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tgl_sales' => 'required|date',
            'id_customer' => 'required|exists:customer,id_customer',
            'status' => 'required|in:Lunas,Belum Lunas',
        ]);

        $sales = Sales::findOrFail($id);
        $sales->update([
            'tgl_sales' => $request->tgl_sales,
            'id_customer' => $request->id_customer,
            'do_number' => $this->generateDONumber(),
            'status' => $request->status,
        ]);
        return redirect()->route('sales.index')->with('success', 'Data penjualan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Sales::destroy($id);
        return redirect()->route('sales.index')->with('success', 'Data penjualan berhasil dihapus.');
    }
        
}
