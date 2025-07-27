<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Level
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-3 rounded-lg shadow bg-white flex justify-center levels-center">
                <form action="{{ route('level.update', $level) }}" method="POST" class="max-w-xl w-full mx-auto bg-blue-100 p-4 rounded-md">
                    @csrf
                    @method('PUT')
                    <div class="mb-5">
                        <label for="level" class="block mb-2 text-sm font-medium text-black">Level</label>
                        <input type="text" id="level" name="level" class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5" value="{{ $level->level }}" required />
                    </div>
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>