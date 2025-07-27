<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow sm:ml-64">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main id="main-content" class="sm:ml-64">
                @if(session('success'))
                    <div class="fixed top-5 left-1/2 transform -translate-x-1/2 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded shadow-lg z-50">
                        <div class="flex items-center justify-between gap-4">
                            <span>{{ session('success') }}</span>
                            <button type="button" class="text-green-700 hover:text-green-900" onclick="this.parentElement.parentElement.remove()">
                                &times;
                            </button>
                        </div>
                    </div>
                @endif

                @if (session('error'))
                    <div class="fixed top-5 left-1/2 transform -translate-x-1/2 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded shadow-lg z-50">
                        <div class="flex items-center justify-between gap-4">
                            <span>{{ session('error') }}</span>
                            <button type="button" class="text-red-700 hover:text-red-900" onclick="this.parentElement.parentElement.remove()">
                                &times;
                            </button>
                        </div>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="fixed top-5 left-1/2 transform -translate-x-1/2 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded shadow-lg z-50">
                        <div class="flex items-center flex-col justify-between gap-4">
                            @foreach ($errors->all() as $error)
                            <div>
                                <span>{{ $error }}</span>
                                <button type="button" class="text-green-700 hover:text-green-900" onclick="this.parentElement.parentElement.remove()">
                                    &times;
                                </button>
                            </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{ $slot }}
            </main>
        </div>
    </body>
</html>
