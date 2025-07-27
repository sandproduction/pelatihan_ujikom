<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Customer
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-3 rounded-lg shadow bg-white flex justify-center items-center">
                <form action="{{ route('sales.update', $sales) }}" method="POST" class="max-w-xl w-full mx-auto bg-blue-100 p-4 rounded-md">
                    @csrf
                    @method('PUT')
                    <div class="mb-5">
                        <label for="tgl" class="block mb-2 text-sm font-medium text-black">Tanggal Sales</label>
                        <input type="date" id="tgl" name="tgl_sales" class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5" value="{{ $sales->tgl_sales }}" required />
                    </div>

                    <div class="mb-3">
                        <label for="id_customer" class="block mb-2 text-sm font-medium text-black">Customer</label>
                        <select name="id_customer" class="form-control bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5" required>
                            <option value="">-- Pilih Customer --</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id_customer }}" {{ $sales->id_customer == $customer->id_customer ? 'selected' : '' }}>
                                    {{ $customer->nama_customer }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="block mb-2 text-sm font-medium text-black">Status</label>
                        <select name="status" class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5" required>
                            <option value="Belum Lunas" {{ $sales->status == 'Belum Lunas' ? 'selected' : '' }}>Belum Lunas</option>
                            <option value="Lunas" {{ $sales->status == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                        </select>
                    </div>

                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>