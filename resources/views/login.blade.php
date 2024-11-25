<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Login</h2>

        <!-- Success Message -->
        @if (session('success'))
            <p class="text-green-600 text-center mb-4">{{ session('success') }}</p>
        @endif

        <!-- Error Messages -->
        @if ($errors->any())
            <ul class="text-red-600 mb-4">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input 
                    type="email" 
                    name="email" 
                    id="email" 
                    class="mt-1 block w-full px-3 py-2 border rounded-md text-gray-900 
                           focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 shadow-sm" 
                    required
                    autocomplete="email" 
                    autofocus
                >
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input 
                    type="password" 
                    name="password" 
                    id="password" 
                    class="mt-1 block w-full px-3 py-2 border rounded-md text-gray-900 
                           focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 shadow-sm" 
                    required
                    autocomplete="current-password"
                >
            </div>

            <button 
                type="submit" 
                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold 
                       py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
            >
                Login
            </button>
        </form>

        <p class="mt-6 text-center text-sm text-gray-500">
            Don't have an account? 
            <a href="/register" class="text-indigo-600 hover:underline">Register</a>
        </p>
    </div>
</body>
</html>
