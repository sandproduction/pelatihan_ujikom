<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Transaction
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-3 rounded-lg shadow bg-white flex justify-center items-center">
                <form action="{{ route('transaction.store') }}" method="POST" class="max-w-xl w-full mx-auto bg-blue-100 p-4 rounded-md">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="id_item" class="block mb-2 text-sm font-medium text-black">Item</label>
                        <select id="id_item" name="id_item" class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5" required>
                            <option value="">-- Pilih Item --</option>
                            @foreach($items as $item)
                                <option value="{{ $item->id_item }}" data-harga="{{ $item->harga_jual }}" {{ isset($transaction) && $transaction->id_item == $item->id_item ? 'selected' : '' }}>
                                    {{ $item->nama_item }} - Rp{{ number_format($item->harga_jual) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="quantity" class="block mb-2 text-sm font-medium text-black">Quantity</label>
                        <input type="number" id="quantity" name="quantity" min="1" class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5" value="{{ $transaction->quantity ?? 1 }}" required />
                    </div>

                    <div class="mb-3">
                        <label for="amount" class="block mb-2 text-sm font-medium text-black">Total Amount</label>
                        <input type="text" id="amount" class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5" value="{{ $transaction->amount ?? '' }}" readonly />
                    </div>

                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                        Submit
                    </button>
                </form>

                {{-- Script untuk update amount --}}
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const itemSelect = document.getElementById('id_item');
                        const qtyInput = document.getElementById('quantity');
                        const amountInput = document.getElementById('amount');

                        function updateAmount() {
                            const selectedOption = itemSelect.options[itemSelect.selectedIndex];
                            const harga = selectedOption.dataset.harga || 0;
                            const qty = qtyInput.value || 0;
                            const total = harga * qty;
                            amountInput.value = 'Rp' + parseInt(total).toLocaleString('id-ID');
                        }

                        itemSelect.addEventListener('change', updateAmount);
                        qtyInput.addEventListener('input', updateAmount);
                        updateAmount();
                    });
                </script>
            </div>
        </div>
    </div>
</x-app-layout>