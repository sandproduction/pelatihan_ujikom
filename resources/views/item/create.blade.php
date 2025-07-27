<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Item
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-3 rounded-lg shadow bg-white flex justify-center items-center">
                <form action="{{ route('item.store') }}" method="POST" class="max-w-xl w-full mx-auto bg-blue-100 p-4 rounded-md">
                    @csrf
                    <div class="mb-5">
                        <label for="nama" class="block mb-2 text-sm font-medium text-black">Nama item</label>
                        <input type="text" id="nama" name="nama_item" class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5" value="{{ old('nama_item') }}" required />
                    </div>
                    <div class="mb-5">
                        <label for="UOM" class="block mb-2 text-sm font-medium text-black">UOM</label>
                        <input type="text" id="UOM" name="uom" class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5" value="{{ old('uom') }}" required />
                    </div>
                    <div class="mb-5">
                        <label for="harga_beli" class="block mb-2 text-sm font-medium text-black">Harga Beli</label>
                        <input type="number" id="harga_beli" name="harga_beli" class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5" value="{{ old('harga_beli') }}" required />
                    </div>
                    <div class="mb-5">
                        <label for="harga_jual" class="block mb-2 text-sm font-medium text-black">Harga Jual</label>
                        <input type="number" id="harga_jual" name="harga_jual" class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5" value="{{ old('harga_jual') }}" required />
                    </div>
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>