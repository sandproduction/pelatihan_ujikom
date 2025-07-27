<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Item;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('item')->orderBy('id_item', 'desc')->get();
        return view('transaction.index', compact('transactions'));
    }

    public function create()
    {
        $transactions = Transaction::all();
        $items = Item::all();
        return view('transaction.create', compact('transactions', 'items'));
    }

     public function store(Request $request)
    {
        $request->validate([
            'id_item' => 'required|exists:item,id_item',
            'quantity' => 'required|integer|min:1',
        ]);

        // Ambil harga dari database untuk keamanan
        $item = Item::findOrFail($request->id_item);
        $harga = $item->harga_jual;
        $amount = $harga * $request->quantity;

        $last = Transaction::selectRaw("MAX(CAST(SUBSTRING(id_transaction, 4) AS UNSIGNED)) as max_id")->first();
        $nextNumber = $last && $last->max_id ? $last->max_id + 1 : 1;
        $idTransaction = 'TNS' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        Transaction::create([
            'id_transaction' => $idTransaction,
            'id_item' => $request->id_item,
            'quantity' => $request->quantity,
            'price' => $harga,
            'amount' => $amount,
        ]);

        return redirect()->route('transaction.index')->with('success', 'Transaksi berhasil ditambahkan!');
    }

    public function edit(Transaction $transaction)
    {
        $transactions = Transaction::all();
        $items = Item::all();
        return view('transaction.edit', compact('transaction', 'items'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'id_item' => 'required|exists:items,id_item',
            'quantity' => 'required|integer|min:1'
        ]);

        $item = Item::findOrFail($request->id_item);

        $price = $item->harga_jual;
        $quantity = $request->quantity;
        $amount = $price * $quantity;

        $transaction->update([
            'id_item' => $item->id_item,
            'price' => $price,
            'quantity' => $quantity,
            'amount' => $amount,
        ]);

        return redirect()->route('transaction.index')->with('success', 'Transaksi berhasil diupdate.');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('transaction.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}
