<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bengek Niken Power Streeng</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans text-gray-800">

    <!-- Navbar -->
    <nav class="bg-white shadow-lg py-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="/" class="ml-5 text-2xl font-bold text-yellow-600">Bengkel Niken</a>
            <ul class="flex space-x-6 items-center">
                <li><a href="#services" class="text-lg hover:text-yellow-600 transition">Services</a></li>
                <li><a href="#about" class="text-lg hover:text-yellow-600 transition">About</a></li>
                <li><a href="#contact" class="text-lg hover:text-yellow-600 transition">Contact</a></li>

                @if (Route::has('login'))
                    <li class="flex items-center space-x-4">
                        @auth
                                <a href="{{ url('/Owner/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Home</a>
                         @else
                            <a href="{{ route('login') }}" class="bg-yellow-600 text-white py-2 px-4 rounded-lg hover:bg-yellow-700 transition">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="bg-gray-800 text-white py-2 px-4 rounded-lg hover:bg-gray-900 transition ml-4">Register</a>
                            @endif
                        @endauth
                    </li>
                @endif
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="bg-yellow-600 text-white text-center py-24">
        <div class="container mx-auto px-4">
            <h1 class="text-5xl font-extrabold mb-4">Welcome to Bengkel Niken Power Streeng</h1>
            <p class="text-xl mb-6">Expert Services for Power Steering Repairs</p>
            <a href="#services" class="bg-white text-yellow-600 py-3 px-6 rounded-lg text-lg font-semibold hover:bg-gray-100 transition">Learn More</a>
        </div>
    </header>

    <!-- Services Section -->
    <section id="services" class="py-16 bg-gray-50">
        <div class="container mx-auto text-center px-4">
            <h2 class="text-4xl font-bold text-gray-800 mb-8">Our Services</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-xl">
                    <h3 class="text-xl font-semibold mb-4">Power Steering Repair</h3>
                    <p class="text-gray-600">Comprehensive repair services for all types of power steering issues.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-xl">
                    <h3 class="text-xl font-semibold mb-4">Fluid Replacement</h3>
                    <p class="text-gray-600">Ensure smooth steering with our fluid replacement services.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-xl">
                    <h3 class="text-xl font-semibold mb-4">Steering System Diagnostics</h3>
                    <p class="text-gray-600">Accurate diagnostics for any steering problems your vehicle faces.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-16 bg-white">
        <div class="container mx-auto text-center px-4">
            <h2 class="text-4xl font-bold text-gray-800 mb-8">About Us</h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">At Bengek Niken Power Streeng, we specialize in providing exceptional power steering repair services with over a decade of experience. Our team ensures quality and precision in every repair.</p>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-16 bg-gray-50">
        <div class="container mx-auto text-center px-4">
            <h2 class="text-4xl font-bold text-gray-800 mb-8">Contact Us</h2>
            <p class="text-xl text-gray-600 mb-8">Get in touch with us for inquiries or to schedule an appointment.</p>
            <form action="#" class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-xl">
                <input type="text" placeholder="Your Name" class="w-full p-3 border border-gray-300 rounded mb-4" />
                <input type="email" placeholder="Your Email" class="w-full p-3 border border-gray-300 rounded mb-4" />
                <textarea placeholder="Your Message" class="w-full p-3 border border-gray-300 rounded mb-4"></textarea>
                <button type="submit" class="w-full bg-yellow-600 text-white py-3 rounded-lg hover:bg-yellow-700 transition">Send Message</button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-6">
        <div class="container mx-auto text-center">
            <p>&copy; {{ date('Y') }} Bengek Niken Power Streeng. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>
