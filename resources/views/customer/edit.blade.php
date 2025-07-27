<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Customer
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-3 rounded-lg shadow bg-white flex justify-center items-center">
                <form action="{{ route('customer.update', $customer) }}" method="POST" class="max-w-xl w-full mx-auto bg-blue-100 p-4 rounded-md">
                    @csrf
                    @method('PUT')
                    <div class="mb-5">
                        <label for="nama" class="block mb-2 text-sm font-medium text-black">Nama Customer</label>
                        <input type="text" id="nama" name="nama_customer" class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5" value="{{ $customer->nama_customer }}" required />
                    </div>
                    <div class="mb-5">
                        <label for="alamat" class="block mb-2 text-sm font-medium text-black">Alamat</label>
                        <input type="text" id="alamat" name="alamat" class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5" value="{{ $customer->alamat }}" required />
                    </div>
                    <div class="mb-5">
                        <label for="telp" class="block mb-2 text-sm font-medium text-black">Telepon</label>
                        <input type="number" id="telp" name="telp" class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5" value="{{ $customer->telp }}" required />
                    </div>
                    <div class="mb-5">
                        <label for="fax" class="block mb-2 text-sm font-medium text-black">Fax</label>
                        <input type="number" id="fax" name="fax" class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5" value="{{ $customer->fax }}" required />
                    </div>
                    <div class="mb-5">
                        <label for="email" class="block mb-2 text-sm font-medium text-black">Email</label>
                        <input type="email" id="email" name="email" class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5" value="{{ $customer->email }}" required />
                    </div>
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>