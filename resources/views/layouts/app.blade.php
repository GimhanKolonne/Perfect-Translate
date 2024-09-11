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
        @viteReactRefresh
    @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased ">
        <x-banner />

        <div class="min-h-screen ">
            @livewire('navigation-menu')


            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow ">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 ">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
    </body>


    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-100 py-12 ">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap justify-between">
                <div class="w-full md:w-1/3 mb-8 md:mb-0">
                    <h3 class="font-bold text-2xl mb-4 text-gray-100">Perfect Translate</h3>
                    <p class="text-gray-400">Perfect Place For Perfect Translation</p>
                </div>
                <div class="w-full md:w-1/3">
                    <nav class="flex flex-wrap justify-center md:justify-end">
                        <a href="/" class="text-gray-400 hover:text-white mr-6 mb-4">Home</a>
                        <a href="#how-it-works" class="text-gray-400 hover:text-white mr-6 mb-4">How It Works</a>
                        <a href="#services" class="text-gray-400 hover:text-white mr-6 mb-4">Services</a>
                    </nav>
                </div>
            </div>
            <div class="mt-8 text-center text-gray-400">
                <p>&copy; 2024 Perfect Translate. All rights reserved.</p>
            </div>
        </div>
    </footer>
</html>
