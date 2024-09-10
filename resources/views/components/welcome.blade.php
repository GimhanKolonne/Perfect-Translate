<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Perfect Translate</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <style>
        .gradient-text {
            background: linear-gradient(45deg, #6b46c1, #4299e1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-900 font-sans">

<!-- Hero Section -->
<section class="bg-cover bg-center h-screen relative" style="background-image: url('{{ URL('Images/Perfect Translate.png') }}');">
    <div class="absolute inset-0 bg-gradient-to-r from-purple-300 to-purple-800 opacity-70"></div>
    <div class="relative z-10 flex items-center justify-center h-full">
        <div class="text-center">
            <!-- Logo -->
            <div class="mb-8" data-aos="zoom-in">
                <img src="{{ URL('Images/Black Oranye Archetype Inspired Logo.png') }}" alt="Logo" class="mx-auto h-40 w-auto">
            </div>

            <h1 class="text-6xl font-bold text-white mb-4 " data-aos="fade-up" data-aos-delay="200">Perfect Place For Perfect Translation</h1>
            <p class="mt-4 text-xl text-white mb-8" data-aos="fade-up" data-aos-delay="400">Join the Sri Lankan marketplace to access top-notch translation services.</p>
            <div class="mt-6" data-aos="fade-up" data-aos-delay="600">
                @auth
                    @if(auth()->user()->role == 'user')
                        <a href="{{ route('translators.create') }}" class="bg-purple-700 text-white py-3 px-6 rounded-full text-lg font-semibold hover:bg-white transition duration-300 hover:text-purple-700 mr-4">Become a translator</a>
                        <a href="{{ route('clients.create') }}" class="bg-purple-700 text-white py-3 px-6 rounded-full text-lg font-semibold hover:bg-white transition duration-300 hover:text-purple-700">Become a client</a>
                    @endif
                @endauth
                @guest
                    <a href="{{ route('register') }}" class="bg-black text-white py-3 px-6 rounded-full text-lg font-semibold hover:bg-white transition duration-300 hover:text-purple-700 mr-4">Get Started</a>
                    <a href="{{ route('login') }}" class="bg-transparent border-2 border-white text-white py-3 px-6 rounded-full text-lg font-semibold hover:bg-white hover:text-purple-700 transition duration-300">Log In</a>
                @endguest
            </div>
        </div>
    </div>
</section>

<!-- How It Works Section -->
<section id="how-it-works" class="py-20 bg-gray-100">
    <div class="container mx-auto px-4">
        <h2 class="text-5xl font-bold text-center text-gray-900 mb-12 gradient-text" data-aos="fade-up">How It Works</h2>
        <div class="flex flex-wrap -mx-4">
            <div class="w-full md:w-1/3 px-4 mb-8" data-aos="fade-up" data-aos-delay="200">
                <div class="bg-white rounded-lg p-8 h-full shadow-lg transition duration-300 hover:shadow-xl hover:scale-105 transform">
                    <div class="text-purple-600 text-5xl mb-4">
                        <i class="fas fa-clipboard-list"></i>
                    </div>
                    <h3 class="text-2xl font-semibold mb-4 text-gray-900">1. Post Your Job</h3>
                    <p class="text-gray-700">Easily submit your translation project with detailed requirements and preferences.</p>
                </div>
            </div>
            <div class="w-full md:w-1/3 px-4 mb-8" data-aos="fade-up" data-aos-delay="400">
                <div class="bg-white rounded-lg p-8 h-full shadow-lg transition duration-300 hover:shadow-xl hover:scale-105 transform">
                    <div class="text-purple-600 text-5xl mb-4">
                        <i class="fas fa-search"></i>
                    </div>
                    <h3 class="text-2xl font-semibold mb-4 text-gray-900">2. Review Applications</h3>
                    <p class="text-gray-700">Browse profiles and proposals from qualified translators tailored to your project needs.</p>
                </div>
            </div>
            <div class="w-full md:w-1/3 px-4 mb-8" data-aos="fade-up" data-aos-delay="600">
                <div class="bg-white rounded-lg p-8 h-full shadow-lg transition duration-300 hover:shadow-xl hover:scale-105 transform">
                    <div class="text-purple-600 text-5xl mb-4">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <h3 class="text-2xl font-semibold mb-4 text-gray-900">3. Hire and Translate</h3>
                    <p class="text-gray-700">Select your preferred translator, collaborate efficiently, and receive high-quality translations.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section id="services" class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <h2 class="text-5xl font-bold text-center text-gray-900 mb-12 gradient-text" data-aos="fade-up">Our Services</h2>
        <div class="flex flex-wrap -mx-4">
            <div class="w-full md:w-1/3 px-4 mb-8" data-aos="fade-up" data-aos-delay="200">
                <div class="bg-purple-100 rounded-lg p-8 h-full shadow-lg transition duration-300 hover:shadow-xl hover:bg-purple-200">
                    <div class="text-purple-600 text-5xl mb-4">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <h3 class="text-2xl font-semibold mb-4 text-gray-900">Document Translation</h3>
                    <p class="text-gray-700">Professional translation of various document types, ensuring accuracy and cultural relevance.</p>
                </div>
            </div>
            <div class="w-full md:w-1/3 px-4 mb-8" data-aos="fade-up" data-aos-delay="400">
                <div class="bg-purple-100 rounded-lg p-8 h-full shadow-lg transition duration-300 hover:shadow-xl hover:bg-purple-200">
                    <div class="text-purple-600 text-5xl mb-4">
                        <i class="fas fa-globe"></i>
                    </div>
                    <h3 class="text-2xl font-semibold mb-4 text-gray-900">Website Translation</h3>
                    <p class="text-gray-700">Comprehensive website localization services to reach global audiences effectively.</p>
                </div>
            </div>
            <div class="w-full md:w-1/3 px-4 mb-8" data-aos="fade-up" data-aos-delay="600">
                <div class="bg-purple-100 rounded-lg p-8 h-full shadow-lg transition duration-300 hover:shadow-xl hover:bg-purple-200">
                    <div class="text-purple-600 text-5xl mb-4">
                        <i class="fas fa-language"></i>
                    </div>
                    <h3 class="text-2xl font-semibold mb-4 text-gray-900">Localization Services</h3>
                    <p class="text-gray-700">Adapt your content to specific markets, considering cultural nuances and local preferences.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Reviews Section -->
<section id="reviews" class="py-20 bg-gray-100">
    <div class="container mx-auto px-4">
        <h2 class="text-5xl font-bold text-center text-gray-900 mb-12 gradient-text" data-aos="fade-up">What Our Clients And Translators Say</h2>
        <div class="relative" data-aos="fade-up" data-aos-delay="200">
            <div class="review-scroll flex overflow-x-auto pb-8 -mx-4 scrollbar-hide">
                <!-- Client Review 1 -->
                <div class="w-80 flex-shrink-0 mx-4">
                    <div class="bg-white rounded-lg p-6 shadow-lg">
                        <div class="flex items-center mb-4">
                            <img src="https://via.placeholder.com/50" alt="Client" class="w-12 h-12 rounded-full mr-4">
                            <div>
                                <h4 class="font-semibold text-lg">Client 1</h4>
                                <p class="text-gray-600">Client</p>
                            </div>
                        </div>
                        <p class="text-gray-700">"blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah "</p>
                    </div>
                </div>
                <!-- Translator Review 1 -->
                <div class="w-80 flex-shrink-0 mx-4">
                    <div class="bg-white rounded-lg p-6 shadow-lg">
                        <div class="flex items-center mb-4">
                            <img src="https://via.placeholder.com/50" alt="Translator" class="w-12 h-12 rounded-full mr-4">
                            <div>
                                <h4 class="font-semibold text-lg">Translator 1</h4>
                                <p class="text-gray-600">Translator</p>
                            </div>
                        </div>
                        <p class="text-gray-700">"blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah "</p>
                    </div>
                </div>
                <!-- Client Review 2 -->
                <div class="w-80 flex-shrink-0 mx-4">
                    <div class="bg-white rounded-lg p-6 shadow-lg">
                        <div class="flex items-center mb-4">
                            <img src="https://via.placeholder.com/50" alt="Client" class="w-12 h-12 rounded-full mr-4">
                            <div>
                                <h4 class="font-semibold text-lg">Client 2</h4>
                                <p class="text-gray-600">Client</p>
                            </div>
                        </div>
                        <p class="text-gray-700">"blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah "</p>
                    </div>
                </div>
                <!-- Translator Review 2 -->
                <div class="w-80 flex-shrink-0 mx-4">
                    <div class="bg-white rounded-lg p-6 shadow-lg">
                        <div class="flex items-center mb-4">
                            <img src="https://via.placeholder.com/50" alt="Translator" class="w-12 h-12 rounded-full mr-4">
                            <div>
                                <h4 class="font-semibold text-lg">Translator 2</h4>
                                <p class="text-gray-600">Translator</p>
                            </div>
                        </div>
                        <p class="text-gray-700">"blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah "</p>
                    </div>
                </div>
                <!-- Client Review 3 -->
                <div class="w-80 flex-shrink-0 mx-4">
                    <div class="bg-white rounded-lg p-6 shadow-lg">
                        <div class="flex items-center mb-4">
                            <img src="https://via.placeholder.com/50" alt="Client" class="w-12 h-12 rounded-full mr-4">
                            <div>
                                <h4 class="font-semibold text-lg">Client 3</h4>
                                <p class="text-gray-600">Client</p>
                            </div>
                        </div>
                        <p class="text-gray-700">"blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah "</p>
                    </div>
                </div>
                <!-- Translator Review 3 -->
                <div class="w-80 flex-shrink-0 mx-4">
                    <div class="bg-white rounded-lg p-6 shadow-lg">
                        <div class="flex items-center mb-4">
                            <img src="https://via.placeholder.com/50" alt="Translator" class="w-12 h-12 rounded-full mr-4">
                            <div>
                                <h4 class="font-semibold text-lg">Translator 3</h4>
                                <p class="text-gray-600">Translator</p>
                            </div>
                        </div>
                        <p class="text-gray-700">"blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah" </p>
                    </div>
                </div>
                <!-- Client Review 4 -->
                <div class="w-80 flex-shrink-0 mx-4">
                    <div class="bg-white rounded-lg p-6 shadow-lg">
                        <div class="flex items-center mb-4">
                            <img src="https://via.placeholder.com/50" alt="Client" class="w-12 h-12 rounded-full mr-4">
                            <div>
                                <h4 class="font-semibold text-lg">Client 4</h4>
                                <p class="text-gray-600">Client</p>
                            </div>
                        </div>
                        <p class="text-gray-700">"blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah "</p>
                    </div>
                </div>
            </div>
            <div class="absolute top-1/2 left-0 transform -translate-y-1/2">
                <button class="bg-white rounded-full p-2 shadow-md hover:bg-gray-100 focus:outline-none scroll-btn" data-direction="left">
                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                </button>
            </div>
            <div class="absolute top-1/2 right-0 transform -translate-y-1/2">
                <button class="bg-white rounded-full p-2 shadow-md hover:bg-gray-100 focus:outline-none scroll-btn" data-direction="right">
                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </button>
            </div>
        </div>
    </div>
</section>



@guest
<section class="py-20 bg-gradient-to-r from-purple-500 to-purple-900 text-white">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-4xl font-bold mb-8" data-aos="fade-up">Ready to Start Your Translation Journey?</h2>
        <p class="text-xl mb-8" data-aos="fade-up" data-aos-delay="200" >Join our community of translators and clients today!</p>
        <a href="{{ route('register') }}" class="bg-white text-purple-700 py-3 px-8 rounded-full text-lg font-semibold hover:bg-purple-100 transition duration-300" data-aos="fade-up" data-aos-delay="400">Get Started Now</a>
    </div>
</section>
@endguest





<script>

        AOS.init({
        duration: 1000,
        once: true,
    });

        // Horizontal scroll functionality
        document.addEventListener('DOMContentLoaded', (event) => {
        const scrollContainer = document.querySelector('.review-scroll');
        const scrollAmount = 300;

        document.querySelectorAll('.scroll-btn').forEach(btn => {
        btn.addEventListener('click', function() {
        const direction = this.dataset.direction;
        if (direction === 'left') {
        scrollContainer.scrollBy({left: -scrollAmount, behavior: 'smooth'});
    } else {
        scrollContainer.scrollBy({left: scrollAmount, behavior: 'smooth'});
    }
    });
    });
    });



</script>

</body>
</html>

