<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Perfect Translate</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-white text-gray-900">

<!-- Hero Section -->
<section class="bg-cover bg-center h-screen" style="background-image: url('{{ URL('Images/Perfect Translate.png') }}');">
    <div class="flex items-center justify-center h-full bg-gray-900 bg-opacity-50">
        <div class="text-center">
            <!-- Logo -->
            <div class="mb-6">
                <img src="{{ URL('Images/Black Oranye Archetype Inspired Logo.png') }}" alt="Logo" class="mx-auto h-40 w-auto">
            </div>

            <h1 class="text-4xl text-black">Perfect Place For Perfect Translation</h1>
            <p class="mt-4 text-black">Join the Sri Lankan marketplace to access top-notch translation services.</p>
            <div class="mt-6">
                @auth
                    @if(auth()->user()->role !== 'translator')
                        <a href="{{ route('translators.create') }}" class="bg-black text-white py-2 px-4 rounded hover:bg-purple-500">Become a translator</a>

                    @endif

                @endauth
                @guest
                    <a href="{{ route('register') }}" class="bg-black text-white py-2 px-4 rounded hover:bg-purple-500">Get Started</a>
                    <a href="{{ route('login') }}" class="bg-black text-white py-2 px-4 rounded ml-4 hover:bg-purple-500">Log In</a>
                @endguest
            </div>
        </div>
    </div>
</section>

<!-- How It Works Section -->
<section id="how-it-works" class="py-16">
    <div class="container mx-auto px-6">
        <h2 class="text-3xl font-bold text-center text-gray-800">How It Works</h2>
        <div class="mt-8 flex flex-wrap justify-around">
            <div class="w-full md:w-1/3 p-4">
                <div class="bg-white shadow rounded-lg p-6 text-center">
                    <img src="" class="mx-auto mb-4" alt="Post Your Job">
                    <h3 class="text-xl font-semibold">Post Your Job</h3>
                    <p class="mt-2 text-gray-600">nabeel add text</p>
                </div>
            </div>
            <div class="w-full md:w-1/3 p-4">
                <div class="bg-white shadow rounded-lg p-6 text-center">
                    <img src="" class="mx-auto mb-4" alt="Review Applications From Translators">
                    <h3 class="text-xl font-semibold">Review Applications From Translators</h3>
                    <p class="mt-2 text-gray-600">nabeel add text</p>
                </div>
            </div>
            <div class="w-full md:w-1/3 p-4">
                <div class="bg-white shadow rounded-lg p-6 text-center">
                    <img src="" class="mx-auto mb-4" alt="Hire and Get Translated">
                    <h3 class="text-xl font-semibold">Hire and Get Translated</h3>
                    <p class="mt-2 text-gray-600">nabeel add text</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section id="services" class="py-16">
    <div class="container mx-auto px-6">
        <h2 class="text-3xl font-bold text-center text-gray-800">Our Services</h2>
        <div class="mt-8 flex flex-wrap justify-around">
            <div class="w-full md:w-1/3 p-4">
                <div class="bg-white shadow rounded-lg p-6 text-center">
                    <img src="" class="mx-auto mb-4" alt="Document Translation">
                    <h3 class="text-xl font-semibold">Document Translation</h3>
                    <p class="mt-2 text-gray-600">nabeel add text</p>
                </div>
            </div>
            <div class="w-full md:w-1/3 p-4">
                <div class="bg-white shadow rounded-lg p-6 text-center">
                    <img src="" class="mx-auto mb-4" alt="Website Translation">
                    <h3 class="text-xl font-semibold">Website Translation</h3>
                    <p class="mt-2 text-gray-600">nabeel add text</p>
                </div>
            </div>
            <div class="w-full md:w-1/3 p-4">
                <div class="bg-white shadow rounded-lg p-6 text-center">
                    <img src="" class="mx-auto mb-4" alt="Localization Services">
                    <h3 class="text-xl font-semibold">Localization Services</h3>
                    <p class="mt-2 text-gray-600">nabeel add text</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="bg-gray-800 text-white py-8">
    <div class="container mx-auto px-6">
        <div class="flex justify-between">
            <div>
                <h3 class="font-bold text-lg">Perfect Translate</h3>
                <p class="mt-2 text-gray-400">Perfect Place For Perfect Translation</p>
            </div>
            <div>
                <nav class="space-x-6">
                    <a href="/" class="text-gray-400 hover:text-white">Home</a>
                    <a href="#how-it-works" class="text-gray-400 hover:text-white">How It Works</a>
                    <a href="#services" class="text-gray-400 hover:text-white">Services</a>
                    <a href="{{ route('login') }}" class="text-gray-400 hover:text-white">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="text-gray-400 hover:text-white">Register</a>
                    @endif
                </nav>
            </div>
        </div>
    </div>
</footer>

</body>
</html>
