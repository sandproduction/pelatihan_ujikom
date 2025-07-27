<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Transaction
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-3 rounded-lg shadow bg-white flex justify-center items-center">
                <form action="{{ route('transaction.update', $transaction) }}" method="POST" class="bg-blue-100 p-4 rounded-md w-full max-w-xl">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="id_item" class="block mb-2">Item</label>
                        <select name="id_item" class="w-full p-2 rounded" required>
                            <option value="">-- Pilih Item --</option>
                            @foreach($items as $item)
                                <option value="{{ $item->id_item }}" {{ $transaction->id_item == $item->id_item ? 'selected' : '' }}>
                                    {{ $item->nama_item }} - Rp{{ number_format($item->harga_jual) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="quantity" class="block mb-2">Jumlah</label>
                        <input type="number" name="quantity" value="{{ $transaction->quantity }}" class="w-full p-2 rounded" required>
                    </div>

                    <div class="mb-3">
                        <label class="block mb-2">Harga per Item (otomatis)</label>
                        <input type="text" value="{{ $transaction->price }}" class="w-full p-2 bg-gray-200 rounded" disabled>
                    </div>

                    <div class="mb-3">
                        <label class="block mb-2">Total (otomatis)</label>
                        <input type="text" value="{{ $transaction->amount }}" class="w-full p-2 bg-gray-200 rounded" disabled>
                    </div>

                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>