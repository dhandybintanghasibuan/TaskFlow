<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Register - {{ config('app.name', 'TaskFlow') }}</title>

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
    <div class="relative min-h-screen flex flex-col items-center justify-center bg-gradient-to-br from-gray-50 to-gray-200 text-gray-800 overflow-hidden py-10">
        
        <div class="absolute inset-0 z-0 opacity-40">
            <div class="absolute top-1/4 left-1/4 w-64 h-64 bg-blue-300 rounded-lg transform -rotate-45 animate-rotate"></div>
            <div class="absolute bottom-1/4 right-1/4 w-48 h-48 bg-purple-300 rounded-full animate-pulse-fade"></div>
            <div class="absolute top-1/2 left-1/2 w-80 h-80 bg-green-300 rounded-3xl transform translate-x-1/2 -translate-y-1/2 rotate-12 opacity-30 animate-pulse-fade" style="animation-delay: 2s;"></div>
        </div>

        <div class="relative z-10 w-full max-w-md p-8 space-y-6 bg-white bg-opacity-90 backdrop-blur-sm rounded-lg shadow-xl border border-gray-100">
            <div class="text-center">
                <a href="/" class="inline-block mb-4 text-3xl font-bold">TaskFlow</a>
                <h2 class="text-2xl font-bold text-gray-900">
                    Buat Akun Baru
                </h2>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <div class="mt-1">
                        <input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name"
                               class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-gray-800 focus:border-gray-800 sm:text-sm">
                    </div>
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <div class="mt-1">
                        <input id="email" type="email" name="email" :value="old('email')" required autocomplete="username"
                               class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-gray-800 focus:border-gray-800 sm:text-sm">
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div>
                    <label for="telegram_chat_id" class="block text-sm font-medium text-gray-700">Telegram Chat ID</label>
                    <div class="mt-1">
                        <input id="telegram_chat_id" type="text" name="telegram_chat_id" :value="old('telegram_chat_id')" autocomplete="telegram_chat_id"
                               class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-gray-800 focus:border-gray-800 sm:text-sm">
                    </div>
                    <p class="mt-1 text-xs text-gray-500">Dapatkan ID Anda dari bot <a href="https://t.me/userinfobot" target="_blank" class="text-indigo-600 hover:underline">@userinfobot</a> di Telegram.</p>
                    <x-input-error :messages="$errors->get('telegram_chat_id')" class="mt-2" />
                </div>
                
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <div class="mt-1">
                        <input id="password" type="password" name="password" required autocomplete="new-password"
                               class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-gray-800 focus:border-gray-800 sm:text-sm">
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                    <div class="mt-1">
                        <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                               class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-gray-800 focus:border-gray-800 sm:text-sm">
                    </div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end pt-2">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md" href="{{ route('login') }}">
                        Sudah punya akun?
                    </a>
                    <button type="submit"
                            class="ml-4 group relative flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-700">
                        Daftar
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>