<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login - {{ config('app.name', 'TaskFlow') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        @keyframes pulse-fade {
            0% { opacity: 0.2; transform: scale(0.9); }
            50% { opacity: 0.4; transform: scale(1.1); }
            100% { opacity: 0.2; transform: scale(0.9); }
        }
        .animate-rotate {
            animation: rotate 60s linear infinite;
        }
        .animate-pulse-fade {
            animation: pulse-fade 8s ease-in-out infinite alternate;
        }
    </style>
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="relative min-h-screen flex flex-col items-center justify-center bg-gradient-to-br from-gray-50 to-gray-200 text-gray-800 overflow-hidden">
        
        <div class="absolute inset-0 z-0 opacity-40">
            <div class="absolute top-1/4 left-1/4 w-64 h-64 bg-blue-300 rounded-lg transform -rotate-45 animate-rotate"></div>
            <div class="absolute bottom-1/4 right-1/4 w-48 h-48 bg-purple-300 rounded-full animate-pulse-fade"></div>
            <div class="absolute top-1/2 left-1/2 w-80 h-80 bg-green-300 rounded-3xl transform translate-x-1/2 -translate-y-1/2 rotate-12 opacity-30 animate-pulse-fade" style="animation-delay: 2s;"></div>
        </div>

        <div class="relative z-10 w-full max-w-md p-8 space-y-6 bg-white bg-opacity-90 backdrop-blur-sm rounded-lg shadow-xl border border-gray-100">
            <div class="text-center">
                <a href="/" class="inline-block mb-4 text-3xl font-bold">TaskFlow</a>
                <h2 class="text-2xl font-bold text-gray-900">
                    Login ke Akun Anda
                </h2>
                <p class="mt-2 text-sm text-gray-600">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="font-medium text-gray-800 hover:text-gray-600">
                        Daftar di sini
                    </a>
                </p>
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <div class="mt-1">
                        <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                               class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-gray-800 focus:border-gray-800 sm:text-sm">
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <div class="mt-1">
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                               class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-gray-800 focus:border-gray-800 sm:text-sm">
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember_me" type="checkbox" name="remember" class="h-4 w-4 text-gray-800 focus:ring-gray-700 border-gray-300 rounded">
                        <label for="remember_me" class="ml-2 block text-sm text-gray-900">Ingat saya</label>
                    </div>

                    @if (Route::has('password.request'))
                        <div class="text-sm">
                            <a href="{{ route('password.request') }}" class="font-medium text-gray-800 hover:text-gray-600">
                                Lupa password?
                            </a>
                        </div>
                    @endif
                </div>

                <div>
                    <button type="submit"
                            class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-700">
                        Login
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>