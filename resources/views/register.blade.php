<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-lg p-8 bg-white rounded-lg shadow-lg">
        <h2 class="text-3xl font-extrabold text-center text-gray-800 mb-6">Create an Account</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded-md mb-6">
                <ul class="space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register.process') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input 
                    type="email" 
                    name="email" 
                    id="email" 
                    class="mt-1 block w-full px-4 py-2 border rounded-md text-gray-900 
                           focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 shadow-sm" 
                    value="{{ old('email') }}" 
                    required
                >
            </div>

            <div>
                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                <input 
                    type="text" 
                    name="username" 
                    id="username" 
                    class="mt-1 block w-full px-4 py-2 border rounded-md text-gray-900 
                           focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 shadow-sm" 
                    value="{{ old('username') }}" 
                    required
                >
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input 
                    type="password" 
                    name="password" 
                    id="password" 
                    class="mt-1 block w-full px-4 py-2 border rounded-md text-gray-900 
                           focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 shadow-sm" 
                    required
                >
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                <input 
                    type="password" 
                    name="password_confirmation" 
                    id="password_confirmation" 
                    class="mt-1 block w-full px-4 py-2 border rounded-md text-gray-900 
                           focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 shadow-sm" 
                    required
                >
            </div>

            <button 
                type="submit" 
                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold 
                       py-2 px-4 rounded-md transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-indigo-500"
            >
                Register
            </button>
        </form>

        <p class="mt-6 text-center text-sm text-gray-500">
            Already have an account? 
            <a href="/login" class="text-indigo-600 hover:underline">Login</a>
        </p>
    </div>
</body>
</html>
