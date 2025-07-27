<button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
   <span class="sr-only">Open sidebar</span>
   <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
   <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
   </svg>
</button>

<aside id="default-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
   <div class="h-full px-3 py-4 overflow-y-auto bg-gradient-to-t from-cyan-400 to-blue-600 dark:bg-gray-800 text-white">
      <ul class="space-y-2 font-medium">
        <li class=" my-5 mx-3">       
            <h1 class="text-xl">{{ Auth::user()->username }}</h1>    
            <h2 class="text-md">{{ Auth::user()->level->level }}</h2>    
        </li>
        <li>
            <x-nav-link href="{{ route('dashboard') }}" class="text-white">Dashboard</x-nav-link>
        </li>
        @if(Auth::user()->level->level == 'Manager')
            <li>
                <x-nav-link href="{{ route('customer.index') }}" class="text-white">Customer</x-nav-link>
            </li>
            <li>
                <x-nav-link href="{{ route('transaction.index') }}" class="text-white">Transaction</x-nav-link>
            </li>
             <li>
                <x-nav-link href="{{ route('sales.index') }}" class="text-white">Sales</x-nav-link>
            </li>
            <li>
                <x-nav-link href="{{ route('item.index') }}" class="text-white">Item</x-nav-link>
            </li>
            <li>
                <x-nav-link href="{{ route('level.index') }}" class="text-white">Level</x-nav-link>
            </li>
            
            <li>
                <x-nav-link href="{{ route('user.index') }}" class="text-white">User</x-nav-link>
            </li>
            
        @endif
        
        @if(Auth::user()->level->level == 'Petugas')
            <li>
                <x-nav-link href="{{ route('customer.index') }}" class="text-white">Customer</x-nav-link>
            </li>
            <li>
                <x-nav-link href="{{ route('transaction.index') }}" class="text-white">Transaction</x-nav-link>
            </li>
            <li>
                <x-nav-link href="{{ route('sales.index') }}" class="text-white">Sales</x-nav-link>
            </li>
            <li>
                <x-nav-link href="{{ route('item.index') }}" class="text-white">Item</x-nav-link>
            </li>
        @endif
        <li>
            <x-nav-link href="{{ route('profile.edit') }}" class="text-white">Profile</x-nav-link>
        </li>
        <li>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="{{route('logout')}}" class="py-2 px-3 border-2 border-red-500 hover:bg-red-600 rounded-lg"  onclick="event.preventDefault();
            this.closest('form').submit();">

            <span class="whitespace-nowrap text-white">Log out</span>
            </a>
        </form>
        </li>
      </ul>
   </div>
</aside>

