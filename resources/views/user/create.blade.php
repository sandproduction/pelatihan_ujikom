<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah user
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-3 rounded-lg shadow bg-white flex justify-center items-center">
                <form action="{{ route('user.store') }}" method="POST" class="max-w-xl w-full mx-auto bg-blue-100 p-4 rounded-md">
                    @csrf
                    <div class="mb-5">
                        <label for="nama" class="block mb-2 text-sm font-medium text-black">Nama User</label>
                        <input type="text" id="nama" name="nama" class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5" value="{{ old('nama') }}" required />
                    </div>
                    <div class="mb-5">
                        <label for="username" class="block mb-2 text-sm font-medium text-black">Username</label>
                        <input type="text" id="username" name="username" class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5" value="{{ old('username') }}" required />
                    </div>
                    <div class="mb-5">
                        <label for="email" class="block mb-2 text-sm font-medium text-black">Email</label>
                        <input type="text" id="email" name="email" class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5" value="{{ old('email') }}" required />
                    </div>
                    <div class="mb-5">
                        <label for="password" class="block mb-2 text-sm font-medium text-black">Password</label>
                        <input type="text" id="password" name="password" class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5" value="{{ old('password') }}" required />
                    </div>
                    <div class="form-group mb-5">
                        <label for="level" class="block mb-2 text-sm font-medium text-black">Level</label>
                        <select name="level" class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5" required>
                            <option value="">Pilih Level</option>
                            @foreach($levels as $level)
                            <option value="{{ $level->id_level }}">{{ $level->level }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>