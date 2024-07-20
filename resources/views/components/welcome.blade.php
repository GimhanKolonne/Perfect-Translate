<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Perfect Translate</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-gray-100 text-gray-900 font-sans">

<!-- Hero Section -->
<section class="bg-cover bg-center h-screen relative" style="background-image: url('{{ URL('Images/Perfect Translate.png') }}');">
    <div class="absolute inset-0 bg-black opacity-50"></div>
    <div class="relative z-10 flex items-center justify-center h-full">
        <div class="text-center">
            <!-- Logo -->
            <div class="mb-8">
                <img src="{{ URL('Images/Black Oranye Archetype Inspired Logo.png') }}" alt="Logo" class="mx-auto h-40 w-auto">
            </div>

            <h1 class="text-5xl font-bold text-white mb-4">Perfect Place For Perfect Translation</h1>
            <p class="mt-4 text-xl text-white mb-8">Join the Sri Lankan marketplace to access top-notch translation services.</p>
            <div class="mt-6">
                @auth
                    @if(auth()->user()->role !== 'translator' && auth()->user()->role !== 'client')
                        <a href="{{ route('translators.create') }}" class="bg-purple-600 text-white py-3 px-6 rounded-full text-lg font-semibold hover:bg-purple-700 transition duration-300">Become a translator</a>
                        <a href="{{ route('clients.create') }}" class="bg-purple-600 text-white py-3 px-6 rounded-full text-lg font-semibold hover:bg-purple-700 transition duration-300">Become a client</a>
                    @endif

                @endauth
                @guest
                    <a href="{{ route('register') }}" class="bg-purple-600 text-white py-3 px-6 rounded-full text-lg font-semibold hover:bg-purple-700 transition duration-300">Get Started</a>
                    <a href="{{ route('login') }}" class="bg-transparent border-2 border-white text-white py-3 px-6 rounded-full text-lg font-semibold ml-4 hover:bg-white hover:text-purple-600 transition duration-300">Log In</a>
                @endguest
            </div>
        </div>
    </div>
</section>

<!-- How It Works Section -->
<section id="how-it-works" class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <h2 class="text-4xl font-bold text-center text-gray-800 mb-12">How It Works</h2>
        <div class="flex flex-wrap -mx-4">
            <div class="w-full md:w-1/3 px-4 mb-8">
                <div class="bg-gray-100 rounded-lg p-8 h-full shadow-lg hover:shadow-xl transition duration-300">
                    <img src="" class="mx-auto mb-6 w-16 h-16" alt="Post Your Job">
                    <h3 class="text-2xl font-semibold mb-4">Post Your Job</h3>
                    <p class="text-gray-600">nabeel add text</p>
                </div>
            </div>
            <div class="w-full md:w-1/3 px-4 mb-8">
                <div class="bg-gray-100 rounded-lg p-8 h-full shadow-lg hover:shadow-xl transition duration-300">
                    <img src="" class="mx-auto mb-6 w-16 h-16" alt="Review Applications From Translators">
                    <h3 class="text-2xl font-semibold mb-4">Review Applications From Translators</h3>
                    <p class="text-gray-600">nabeel add text</p>
                </div>
            </div>
            <div class="w-full md:w-1/3 px-4 mb-8">
                <div class="bg-gray-100 rounded-lg p-8 h-full shadow-lg hover:shadow-xl transition duration-300">
                    <img src="" class="mx-auto mb-6 w-16 h-16" alt="Hire and Get Translated">
                    <h3 class="text-2xl font-semibold mb-4">Hire and Get Translated</h3>
                    <p class="text-gray-600">nabeel add text</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section id="services" class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <h2 class="text-4xl font-bold text-center text-gray-800 mb-12">Our Services</h2>
        <div class="flex flex-wrap -mx-4">
            <div class="w-full md:w-1/3 px-4 mb-8">
                <div class="bg-gray-100 rounded-lg p-8 h-full shadow-lg hover:shadow-xl transition duration-300">
                    <img src="" class="mx-auto mb-6 w-16 h-16" alt="Document Translation">
                    <h3 class="text-2xl font-semibold mb-4">Document Translation</h3>
                    <p class="text-gray-600">nabeel add text</p>
                </div>
            </div>
            <div class="w-full md:w-1/3 px-4 mb-8">
                <div class="bg-gray-100 rounded-lg p-8 h-full shadow-lg hover:shadow-xl transition duration-300">
                    <img src="" class="mx-auto mb-6 w-16 h-16" alt="Website Translation">
                    <h3 class="text-2xl font-semibold mb-4">Website Translation</h3>
                    <p class="text-gray-600">nabeel add text</p>
                </div>
            </div>
            <div class="w-full md:w-1/3 px-4 mb-8">
                <div class="bg-gray-100 rounded-lg p-8 h-full shadow-lg hover:shadow-xl transition duration-300">
                    <img src="" class="mx-auto mb-6 w-16 h-16" alt="Localization Services">
                    <h3 class="text-2xl font-semibold mb-4">Localization Services</h3>
                    <p class="text-gray-600">nabeel add text</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="bg-gray-800 text-white py-12">
    <div class="container mx-auto px-4">
        <div class="flex flex-wrap justify-between">
            <div class="w-full md:w-1/3 mb-8 md:mb-0">
                <h3 class="font-bold text-2xl mb-4">Perfect Translate</h3>
                <p class="text-gray-400">Perfect Place For Perfect Translation</p>
            </div>
            <div class="w-full md:w-1/3">
                <nav class="flex flex-wrap justify-center md:justify-end">
                    <a href="/" class="text-gray-400 hover:text-white mr-6 mb-4">Home</a>
                    <a href="#how-it-works" class="text-gray-400 hover:text-white mr-6 mb-4">How It Works</a>
                    <a href="#services" class="text-gray-400 hover:text-white mr-6 mb-4">Services</a>
                    <a href="{{ route('login') }}" class="text-gray-400 hover:text-white mr-6 mb-4">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="text-gray-400 hover:text-white mb-4">Register</a>
                    @endif
                </nav>
            </div>
        </div>
    </div>
</footer>

</body>
</html>
