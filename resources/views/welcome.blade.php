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
<body class="bg-gray-100 font-sans antialiased text-black">

    <!-- Navbar -->
<nav class="bg-white shadow-lg p-6">
    <div class="container mx-auto flex justify-between items-center">
        <a href="/" class="text-2xl font-semibold text-yellow-500">Bengek Niken Power Streeng</a>
        <ul class="flex items-center space-x-6">
            <li><a href="#services" class="text-gray-700 hover:text-yellow-500">Services</a></li>
            <li><a href="#about" class="text-gray-700 hover:text-yellow-500">About Us</a></li>
            <li><a href="#contact" class="text-gray-700 hover:text-yellow-500">Contact</a></li>

            @if (Route::has('login'))
                <li class="flex items-center space-x-4">
                    @auth
                        <a href="{{ url('/superadmin/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="bg-yellow-500 text-white font-semibold py-2 px-4 rounded-lg shadow-md hover:bg-yellow-600 transition duration-200">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="bg-yellow-500 text-white font-semibold py-2 px-4 rounded-lg shadow-md hover:bg-yellow-600 transition duration-200 ml-4">Register</a>
                        @endif
                    @endauth
                </li>
            @endif
        </ul>
    </div>
</nav>


    <!-- Hero Section -->
    <header class="bg-yellow-500 text-white text-center py-20">
        <div class="container mx-auto">
            <h1 class="text-5xl font-bold">Welcome to Bengek Niken Power Streeng</h1>
            <p class="text-xl mt-4">Expert Services for Power Steering Repairs</p>
            <a href="#services" class="mt-6 inline-block bg-white text-yellow-500 font-semibold py-3 px-6 rounded-lg shadow-md hover:bg-gray-100">
                Learn More
            </a>
        </div>
    </header>

    <!-- Services Section -->
    <section id="services" class="py-16 bg-gray-100">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Our Services</h2>
            <p class="text-gray-600 mb-12">We offer a wide range of power steering repair services.</p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold mb-2">Power Steering Repair</h3>
                    <p class="text-gray-700">Comprehensive repair services for all types of power steering issues.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold mb-2">Fluid Replacement</h3>
                    <p class="text-gray-700">Ensure smooth steering with our fluid replacement services.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold mb-2">Steering System Diagnostics</h3>
                    <p class="text-gray-700">Accurate diagnostics for any steering problems your vehicle faces.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-16 bg-white">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">About Us</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Bengek Niken Power Streeng has been a trusted provider of power steering repair services. With over a decade of experience, we are committed to delivering quality and precision.</p>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-16 bg-gray-100">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Contact Us</h2>
            <p class="text-gray-600 mb-6">Get in touch with us for any inquiries or to schedule an appointment.</p>
            <form action="#" class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
                <input type="text" placeholder="Your Name" class="w-full p-3 border border-gray-300 rounded mb-4" />
                <input type="email" placeholder="Your Email" class="w-full p-3 border border-gray-300 rounded mb-4" />
                <textarea placeholder="Your Message" class="w-full p-3 border border-gray-300 rounded mb-4"></textarea>
                <button type="submit" class="w-full bg-yellow-500 text-white font-semibold py-3 rounded hover:bg-yellow-600">Send Message</button>
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
