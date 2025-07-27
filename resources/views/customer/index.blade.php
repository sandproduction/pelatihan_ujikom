<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Customer
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-5 rounded-lg shadow bg-white">
                @if(Auth::user()->level->level != 'Manager')
                <a class="block w-[200px] text-center text-white px-3 py-2 bg-green-500 rounded-md m-4" href="{{ route('customer.create') }}">Tambah Customer</a>
                @endif
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">Nomor</th>
                            <th scope="col" class="px-6 py-3">Nama</th>
                            <th scope="col" class="px-6 py-3">Alamat</th>
                            <th scope="col" class="px-6 py-3">No. Handphone</th>
                            <th scope="col" class="px-6 py-3">Fax</th>
                            <th scope="col" class="px-6 py-3">Email</th>
                            <th scope="col" class="px-6 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customers as $customer)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                            <th scope="row" class="px-6 py-4">{{ $customer->id_customer }}</th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $customer->nama_customer }}</th>
                            <td class="px-6 py-4">{{ $customer->alamat }}</td>
                            <td class="px-6 py-4">{{ $customer->telp }}</td>
                            <td class="px-6 py-4">{{ $customer->fax }}</td>
                            <td class="px-6 py-4">{{ $customer->email }}</td>
                            <td class="px-6 py-4">
                                <a href="{{ route('customer.edit', $customer) }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Edit</a>
                                @if(Auth::user()->level->level != 'Manager')
                                <form action="{{ route('customer.destroy', $customer) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin hapus?')" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Hapus</button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
